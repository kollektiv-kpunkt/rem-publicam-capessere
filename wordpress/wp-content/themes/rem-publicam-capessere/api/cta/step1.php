<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Form Signup", "Step 1", $data["uuid"]);
}

$mcstep = $mcconfig->step1;

try {
    $response = $client->lists->setListMember($mclistid, md5($data["email"]), [
        "email_address" => $data["email"],
        'merge_fields' => [
                "FNAME" => $data["firstname"],
                $mcconfig->misc->plzmerge => $data["plz"]
        ],
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

if (!$response) {
    echo(json_encode(["success" => false]));
    exit;
}

try {
    $response = $client->lists->createListMemberNote(
        $mclistid,
        md5($data["email"]),
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

if ($response) {
    echo(json_encode(["success" => true]));
}