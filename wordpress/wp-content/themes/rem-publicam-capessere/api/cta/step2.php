<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

$mcstep = $mcconfig->step2;

try {
    $response = $client->lists->setListMember($mclistid, md5($data["email"]), [
        "email_address" => $data["email"],
        'tags' => assortTags($mcstep->tags, $data),
        "status" => "subscribed",
    ]);
} catch (GuzzleHttp\Exception\ClientException $e) {
  echo '<pre>' . var_export($e->getResponse()->getBody()->getContents()).'</pre>';
  $errors[] = $e->getMessage();
}

if ($response) {
    echo(json_encode(["success" => true]));
}