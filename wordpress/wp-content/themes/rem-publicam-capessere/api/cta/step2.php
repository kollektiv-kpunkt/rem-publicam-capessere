<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Form Signup", "Step 2", $data["uuid"]);
}

$mcstep = $mcconfig->step2;

try {
    $response = $client->lists->setListMember($mclistid, md5(strtolower($data["email"])), [
        "email_address" => $data["email"],
        'tags' => assortTags($mcstep->tags, $data),
        "status" => "subscribed",
    ]);
} catch (GuzzleHttp\Exception\ClientException $e) {
    $return = [
      "sucess" => false,
      "content" => $e->getResponse()->getBody()->getContents(),
      "errors" => [$e->getMessage()]
    ];
    echo json_encode($return);
    exit;
}

if ($response) {
    echo(json_encode(["success" => true]));
}