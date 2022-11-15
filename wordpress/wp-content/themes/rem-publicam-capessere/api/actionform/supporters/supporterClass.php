<?php
namespace api\actionform\supporters;

require __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . '/../../../../../../wp-load.php';


class Supporter {
    public string $uuid;
    public string $formID;
    public string $formTag;
    public string $ID;
    public string $name;
    public string $email;
    public array $fields;
    public array $baseConfig;
    public bool $preexisting;
    public bool $optin;
    public $httpClient;
    public $httpClientException;
    public $mcClient;
    public bool $success;
    public string $error;
    public string $logfile;

    public function __construct($data) {
        $this->uuid = $data["uuid"];
        $this->formID = $data["formID"];
        $this->formTag = $data["formTag"];
        $this->email = $data["email"]["value"];
        $this->httpClient = new \GuzzleHttp\Client();
        $this->mcClient = new \MailchimpMarketing\ApiClient();
        $this->mcClient->setConfig([
            'apiKey' => $_ENV["MCAPI"] ?? "",
            'server' => $_ENV["MCSERVERPREFIX"] ?? ""
        ]);
        $this->success = true;
        $this->logfile = __DIR__ . "/" . md5($email) . "-{$this->uuid}.log";
        $preexistingSupporter = get_posts(array(
            'post_type'     => 'supporter',
            'meta_key'      => 'email',
            'meta_value'    => $this->email,
            'post_status' => 'any',
        ));
        if (count($preexistingSupporter) > 0) {
            $this->ID = $preexistingSupporter[0]->ID;
            $this->name = $preexistingSupporter[0]->post_title;
            $this->preexisting = true;
        }
    }

    public function addField($name, $field) {
        if ($name == "base-config") {
            $this->baseConfig = $field;
            return;
        }

        $this->fields[$name] = [];
        if ($field["merge"] != false) {
            if ($field["merge"] == "JUSTWP") {
                $this->fields[$name]["value"] = $field["value"];
            }
            $this->fields[$name]["type"] = "merge";
            $this->fields[$name]["merge"] = $field["merge"];
            $this->fields[$name]["value"] = $field["value"];
        }
        if ($field["mtag"] != false && $field["value"] != false) {
            $this->fields[$name]["type"] = "mtag";
            $this->fields[$name]["mtag"] = $field["mtag"];
        }
    }

    public function storeWP() {
        $json = [
            "actionform" => true,
            "uuid" => $this->uuid,
            "fname" => $this->fields["fname"]["value"],
            "zip" => $this->fields["plz"]["value"],
            "email" => $this->email,
            "public" => $this->baseConfig["komitee_name"],
        ];
        if ($this->baseConfig["komitee_name"] == true) {
            $json["lname"] = $this->fields["lname"]["value"];
            $json["city"] = $this->fields["city"]["value"];
        }
        if (isset($this->fields["position"]["value"]) && $this->fields["position"]["value"] != "") {
            $json["position"] = $this->fields["position"]["value"];
        }

        $json["config"] = json_encode([
            "default_status" => $this->baseConfig["supporter_status"]
        ]);

        if (isset($this->baseConfig["komitee_quote"]) && $this->baseConfig["komitee_quote"] == true) {
            $json["quote"] = $this->fields["quote"]["value"];
            $json["position"] = $this->fields["position"]["value"];
        }

        $response = $this->httpClient->request("POST", "{$_ENV["BASEURL"]}/api/v1/komitee/step1", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $json,
        ]);

        $response = json_decode($response->getBody(), true);

        if ($response["status"] == "success") {
            $this->ID = $response["post_id"];
            if ($this->fields["img_src"]["value"] == true) {
                $json = [
                    "image" => $this->fields["img_src"]["value"],
                    "uuid" => $this->uuid,
                    "post_id" => $this->ID,
                ];
                $response = $this->httpClient->request("POST", "{$_ENV["BASEURL"]}/api/v1/komitee/step2", [
                'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $json,
                ]);
            }
        } else {
            $this->success = false;
            return;
        }
    }

    public function storeExternal() {
        if (!isset($this->fields["base-config"]["db_type"]) || $this->fields["base-config"]["db_type"] == "mailchimp") {
            $this->storeMailchimp();
        }
    }

    public function storeMailchimp() {
        $mcload = [
            "email_address" => $this->email,
            'merge_fields' => [],
            "status" => "subscribed",
        ];

        foreach ($this->fields as $name => $field) {
            if (gettype($field) == "string") {
                continue;
            }
            if ($field["type"] == "merge") {
                $mcload["merge_fields"][$field["merge"]] = $field["value"];
            }
            if ($field["type"] == "mtag") {
                $mcload["tags"][] = $field["mtag"];
            }
        }

        try {
            $response = $this->mcClient->lists->setListMember($_ENV["MCLISTID"], strtolower(md5($this->email)), $mcload);
        } catch (\Exception $e) {
            $this->success = false;
            $this->error = $e->getMessage();
            return;
        }


        if (!$response) {
            $this->success = false;
            $this->error = $e->getMessage();
        }

        try {
            $response = $this->mcClient->lists->createListMemberNote(
                $_ENV["MCLISTID"],
                strtolower(md5($this->email)),
                [
                    "note" => "Form submission: {$this->uuid} | Logfile : {$this->logfile}"
                ]
            );
        } catch (\Exception $e) {
            $this->success = false;
            $this->error = $e->getMessage();
        }

        if (!$response) {
            $this->success = false;
            $this->error = $e->getMessage();
        }
    }

    public function logInternal() {
        $log = json_encode($this);
        ob_start();
        $date = date("Y-m-d H:i:s");
        echo("**********************************************************" . PHP_EOL);
        echo("********** {$this->uuid} **********" . PHP_EOL);
        echo("****************** {$date}  ******************" . PHP_EOL);
        echo("**********************************************************" . PHP_EOL . PHP_EOL);
        echo $log . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;

        $log = ob_get_clean();
        file_put_contents($this->logfile, $log, FILE_APPEND);
    }
}