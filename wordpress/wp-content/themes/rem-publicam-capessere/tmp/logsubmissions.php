<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

$submission = json_encode($data);

$file = date("Y-m-d_H-i-s") . ".json";
file_put_contents(__DIR__ . "/loggedsubmissions/". $file, $submission);

echo(json_encode("ok"));