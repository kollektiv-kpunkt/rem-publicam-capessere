<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

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

$return = [
    "success" => true,
    "content" => "",
    "errors" => []
];
echo json_encode($return);

?>