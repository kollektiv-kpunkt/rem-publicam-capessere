<?php
header("Content-Type: application/json");
$entityBody = json_decode(file_get_contents('php://input'));
echo json_encode($entityBody);
?>