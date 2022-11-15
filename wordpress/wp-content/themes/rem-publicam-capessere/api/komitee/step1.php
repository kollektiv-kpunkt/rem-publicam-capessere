<?php

if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

if (!isset($data["uuid"])) {
    $data["uuid"] = uniqid("komitee-");
}

if (!isset($data["config"])) {
    $data["post_status"] = "publish";
    $config = [
        "info_email" => get_bloginfo('admin_email')
    ];
} else {
    $config = json_decode(base64_decode($data["config"]), true);
    $data["post_status"] = $config["default_status"];
}

$preexistingSupporter = get_posts(array(
    'post_type'     => 'supporter',
    'meta_key'      => 'email',
    'meta_value'    => $data["email"],
    'post_status' => 'any',
));

if (count($preexistingSupporter) > 0) {
    $data["post_id"] = $preexistingSupporter[0]->ID;
} else {
    $data["post_id"] = wp_insert_post(array(
        'post_date'     =>  date("Y-m-d H:i:s"),
        'post_name'     =>  $data["uuid"],
        'post_type'     =>  'supporter',
        'post_status'   =>  $data["post_status"],
    ));
}

wp_update_post(array(
    'ID'            =>  $data["post_id"],
    'post_title'    =>  $data["fname"]  . (isset($data["lname"]) ? " " . $data["lname"] : ""),
));

if ($data["quote"] == "") {
    $data["categories"] = [];
} else {
    $data["categories"] = array("testimonial");
}

wp_set_object_terms($data["post_id"], $data["categories"], 'category');

if (isset($data["position"])) {
    update_field("position", $data["position"], $data["post_id"]);
}
if (isset($data["zip"])) {
    update_field("plz", $data["zip"], $data["post_id"]);
}
if (isset($data["city"])) {
    update_field("city", $data["city"], $data["post_id"]);
}
if (isset($data["email"])) {
    update_field("email", $data["email"], $data["post_id"]);
}

if (!isset($data["public"])) {
    $data["public"] = true;
}

if ($data["public"] == true) {
    update_field("public", "public", $data["post_id"]);
} else {
    update_field("public", "", $data["post_id"]);
}

if (isset($data["quote"])) {
    wp_update_post(array(
        'ID'            =>  $data["post_id"],
        'post_content'  =>  $data["quote"],
    ));
}

if (isset($data["actionform"]) && $data["actionform"] == "true") {
    echo(json_encode(array(
        "status" => "success",
        "post_id" => $data["post_id"],
        "post" => get_post( $data["post_id"])
    )));
}

exit;
$action = "js";
if ($data["quote"] == "") {
    $js = <<<EOD
    document.querySelector('form[data-step-id=supporters-1]').style.display = "none";
    document.querySelector('div[data-step-id=supporters-3]').style.display = "block";
    EOD;
} else {
    $js = <<<EOD
    document.querySelector('form[data-step-id=supporters-1]').style.display = "none";
    document.querySelector('form[data-step-id=supporters-2]').style.display = "block";
    EOD;
}

$return = [
    "status" => "success",
    "id" => $data["post_id"],
    "formData" => $data,
    "action" => $action,
];

if ($action == "js") {
    $return["js"] = $js;
}

// $mailcontent = <<<EOD
//     <h1>Neuer Unterstützer</h1>
//     <p>Es wurde ein neuer Unterstützer hinzugefügt:</p>
//     <p><b>Name:</b> {$data["fname"]} {$data["lname"]}</p>
//     <p><b>Position:</b> {$data["position"]}</p>
//     <p><b>PLZ:</b> {$data["zip"]}</p>
//     <p><b>Stadt:</b> {$data["city"]}</p>
//     <p><b>Quote:</b> {$data["quote"]}</p>
//     <p><b>Status:</b> {$data["post_status"]}</p>
// EOD;
// wp_mail($config["info_email"],"New Supporter",$mailcontent );

echo(json_encode($return));
exit;