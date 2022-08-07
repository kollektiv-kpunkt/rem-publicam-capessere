<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

$config = json_decode(base64_decode($data["config"]), true);

if ($config["default_status"] == "") {
    $post_status = "pending";
} else {
    $post_status = "publish";
}

$supporter = array(
    'post_title'    =>   $data["fname"] . " " . $data["lname"],
    'post_date'     =>   date("Y-m-d H:i:s"),
    'post_type'     =>   'supporter',
    'post_content'  =>   $data["quote"],
    'post_status'   =>   $post_status,
);
// create post in wordpress. Yay!
$new_post_id = wp_insert_post($supporter);

update_field("position", $data["position"], $new_post_id);
update_field("plz", $data["zip"], $new_post_id);
update_field("city", $data["city"], $new_post_id);

if ($data["quote"] == "") {
    $action = "thanksInterface";
} else {
    $action = "nextStep";
}

$return = [
    "status" => "success",
    "id" => $new_post_id,
    "formData" => $data,
    "action" => $action,
];

echo(json_encode($return));
exit;