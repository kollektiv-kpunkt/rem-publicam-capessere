<?php
require_once __DIR__ . '/../../../../wp-load.php';
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


Router::post('/api/v1/actionform/{step}', function($step) {
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

    include(__DIR__ . "/actionform/{$step}.php");
    exit;
});

Router::get('/api/v1/actionform/playground', function() {
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

    include(__DIR__ . "/actionform/playground.php");
    exit;
});

Router::post('/api/v1/af-v2', function() {
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

    include(__DIR__ . "/actionform/sendFormdata.php");
    exit;
});

Router::post('/api/v1/komitee/step1', function() {
    include(__DIR__ . "/komitee/step1.php");
    exit;
});

Router::post('/api/v1/komitee/step2', function() {
    include(__DIR__ . "/komitee/step2.php");
    exit;
});




// Start the routing
Router::start();
?>