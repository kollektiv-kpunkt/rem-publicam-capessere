<?php
require_once __DIR__ . '/../../../../wp-load.php';
require __DIR__ . '/../vendor/autoload.php';

$supporters_missing = get_posts(
    array(
        'post_type' => 'supporter',
        'posts_per_page' => -1,
        'meta_query' => array(
        array(
            'key' => 'email',
            'compare' => 'NOT EXISTS'
        ),
        )
    )
);

$mcapi = $_ENV["MCAPI"];
$mclistid = $_ENV["MCLISTID"];
$mcserver = $_ENV["MCSERVERPREFIX"];
$client = new \MailchimpMarketing\ApiClient();
$client->setConfig([
    'apiKey' => $mcapi,
    'server' => $mcserver
]);

$mc_supporters = [];

$response = $client->lists->getListMembersInfo($mclistid);

$iterations = ceil($response->total_items / 1000);

for ($i1=0; $i1<$iterations; $i1++) {
    $contacts = $client->lists->getListMembersInfo($mclistid, null, null, 1000, $i1*1000)->members;
    array_push($mc_supporters, ...$contacts);
}

foreach ($supporters_missing as $supporter) {
    
}