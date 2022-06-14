<?php
$afconfig = json_decode(file_get_contents(__DIR__ . "/../../" . $_ENV["AFconfig"]), true);
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Form Signup", "Step 1", $data["uuid"]);
}

$mcload = [
    "email_address" => $data["email"],
    'merge_fields' => [],
    'tags' => [$afconfig["misc"]["formTag"]],
    "status" => "subscribed",
];

foreach ($afconfig["steps"]["step1"]["fields"] as $name => $field) {
    if (isset($field["mmerge"])) {
        $mcload["merge_fields"][$field["mmerge"]] = $data[$name];
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

try {
    $response = $client->lists->createListMemberNote(
        $mclistid,
        strtolower(md5($data["email"])),
        [
            "note" => "Form submission: " . $data["uuid"]
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

$return = [
    "success" => true,
    "action" => "nextStep",
    "content" => "",
    "errors" => []
];
echo json_encode($return);
exit;