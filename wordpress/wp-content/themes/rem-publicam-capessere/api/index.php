<?php
require '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter as Router;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();
// header("Content-Type: application/json");

function assortTags($tags, $data) {
    $result = [];
    foreach($tags as $tag) {
        $check = explode(":",$tag)[0];
        $tag = explode(":",$tag)[1];
        if ($check == "all") {
            array_push($result, $tag);
        } else if ($data[$check]) {
            array_push($result, $tag);
        }
    }
    return $result;
}

Router::post('/api/v1/cta/{step}', function($step) {
    $mcconfig = json_decode($_ENV["MCCONFIG"]);
    $mcapi = $_ENV["MCAPI"];
    $mclistid = $_ENV["MCLISTID"];
    $mcserver = $_ENV["MCSERVERPREFIX"];
    $client = new \MailchimpMarketing\ApiClient();
    $client->setConfig([
        'apiKey' => $mcapi,
        'server' => $mcserver
    ]);

    $mtmpageid = $_ENV["MATOMOID"];
    $mtmurl = $_ENV["MATOMOURL"];
    $mtmtoken = $_ENV["MATOMOTOKEN"];
    $mtm = new MatomoTracker((int)$mtmpageid, $mtmurl);

    $mtm->setTokenAuth($mtmtoken);

    include(__DIR__ . "/cta/{$step}.php");
    exit;
});




// Start the routing
Router::start();
?>