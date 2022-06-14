<?php
$afconfig = json_decode(file_get_contents(__DIR__ . "/../../" . $_ENV["AFconfig"]), true);
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Form Signup", "Step 2", $data["uuid"]);
}

$mcload = [
    "email_address" => $data["email"],
    'tags' => [$afconfig["misc"]["formTag"]],
    "status" => "subscribed",
];

$redirects = [];

foreach ($afconfig["steps"]["step2"]["fields"] as $name => $field) {
    if (isset($data[$name])) {
        if (isset($field["mtag"])) {
            array_push($mcload["tags"], $field["mtag"]);
        }
        $nextStep = $field["nextStep"];
    }

}

try {
    $response = $client->lists->setListMember($mclistid, strtolower(md5($data["email"])), $mcload);
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


$return = [
    "success" => true,
    "action" => "nextStep",
    "nextStep" => $nextStep,
    "content" => "",
    "errors" => []
];
echo json_encode($return);
exit;