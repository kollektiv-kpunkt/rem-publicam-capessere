<?php
$afconfig = json_decode(file_get_contents(__DIR__ . "/../../" . $_ENV["AFconfig"]), true);
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Form Signup", "Step 3", $data["uuid"]);
}

$mcload = [
    "email_address" => $data["email"],
    'merge_fields' => [
        "ADDRESS" => [
            "addr1" => "",
            "city" => "",
            "state" => "",
            "zip" => $data["plz"],
            "country" => ""
        ],
    ],
    "status" => "subscribed",
];

foreach ($afconfig["steps"]["step3"]["fields"] as $name => $field) {
    if ($mcload["merge_fields"]["ADDRESS"][$field["addressField"]] != "") {
        $mcload["merge_fields"]["ADDRESS"][$field["addressField"]] .= " ";
    }
    $mcload["merge_fields"]["ADDRESS"][$field["addressField"]] .= $data[$name];
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
    "action" => "redirect",
    "redirect" => $afconfig["steps"]["step3"]["redirect"] . "?rnw-stored_customer_firstname={$data["name"]}&rnw-stored_customer_email={$data["email"]}&rnw-stored_customer_street={$data["street"]}&rnw-stored_customer_street_number={$data["number"]}&rnw-stored_customer_zip_code={$data["plz"]}&rnw-stored_customer_city={$data["city"]}",
    "content" => "",
    "errors" => []
];
echo json_encode($return);
exit;