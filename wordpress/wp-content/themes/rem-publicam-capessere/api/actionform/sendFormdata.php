<?php
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;

if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (!isset($data["db_type"])) {

    $mcload = [
        "email_address" => $data["email"]["value"],
        'merge_fields' => [],
        'tags' => [$data["formTag"]],
        "status" => "subscribed",
    ];

    foreach ($data as $name => $field) {
        if (gettype($field) == "string") {
            continue;
        }
        if ($field["mmerge"] != false && $field["is-address"] == false) {
            $mcload["merge_fields"][$field["mmerge"]] = $field["value"];
        }
        if ($field["mtag"] != false) {
            $mcload["tags"][] = $field["mtag"];
        }
        if ($field["is-optin"] != false) {
            $mcload["tags"][] = "optin";
        }
        if ($field["is-address"] == true) {
            $mcload["merge_fields"]["ADDRESS"][$field["address-field"]] = $field["value"];
        }
    }

    try {
        $response = $client->lists->setListMember($mclistid, strtolower(md5($data["email"]["value"])), $mcload);
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $return = [
        "sucess" => false,
        "content" => $e->getResponse()->getBody()->getContents(),
        "errors" => [$e->getMessage()]
        ];
        echo json_encode($return);
        exit;
    }

    if (!$response) {
        echo(json_encode(["success" => false]));
        exit;
    }

    try {
        $response = $client->lists->createListMemberNote(
            $mclistid,
            strtolower(md5($data["email"]["value"])),
            [
                "note" => "Form submission: {$data["uuid"]} | Form Tag: {$data["formTag"]}"
            ]
        );
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $return = [
        "sucess" => false,
        "content" => $e->getResponse()->getBody()->getContents(),
        "errors" => [$e->getMessage()]
        ];
        echo json_encode($return);
        exit;
    }

    if (!$response) {
        echo(json_encode(["success" => false]));
        exit;
    }
} else if ($data["db_type"]["value"] == "Mautic") {
    $settings = [
        'userName'   => $_ENV["MAUUSER"],
        'password'   => $_ENV["MAUPASS"],
    ];
    $initAuth = new ApiAuth();
    $auth     = $initAuth->newAuth($settings, 'BasicAuth');
    $api = new MauticApi();
    $contactApi = $api->newApi('contacts', $auth, $_ENV["MAUURL"]);

    $contact = [
        "email" => $data["email"]["value"],
        "firstname" => $data["fname"]["value"],
        "lastname" => $data["lname"]["value"],
        "company" => $_ENV["MAUCOMPANY"],
        "tags" => [$data["formTag"]],
    ];

    foreach ($data as $name => $field) {
        if (gettype($field) == "string") {
            continue;
        }
        if ($field["mmerge"] != false && $field["is-address"] == false) {
            $contact[$field["mmerge"]] = $field["value"];
        }
        if ($field["mtag"] != false) {
            $contact["tags"][] = $field["mtag"];
        }
        if ($field["is-optin"] != false) {
            $contact["tags"][] = "optin";
        }
        if ($field["is-address"] == true) {
            $contact[$field["address-field"]] = $field["value"];
        }
    }

    $contact = $contactApi->create($contact);
    if (!$contact) {
        echo(json_encode(["success" => false]));
        exit;
    }
}

if (isset($data["base-config"]["komitee_name"])) {
    $json = [
        "fname" => $data["fname"]["value"],
        "zip" => $data["plz"]["value"],
        "public" => $data["komitee_name"]["value"]
    ];
    if ($data["base-config"]["komitee_name"] == true) {
        $json["lname"] = $data["lname"]["value"];
        $json["city"] = $data["city"]["value"];
    }
    $client = new \GuzzleHttp\Client();
    $promise = $client->requestAsync('POST', "{$_ENV["BASEURL"]}/api/v1/komitee/step1", [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => $json,
    ]);

    $response = $promise->wait();
}

$return = [
    "success" => true,
    "content" => "",
    "errors" => []
];
echo json_encode($return);

?>