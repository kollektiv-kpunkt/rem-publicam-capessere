<?php
$starttime = microtime(true);
ob_start();
echo("*******************************************" . PHP_EOL);
echo("Log for Mailchimp Sync: " . date("Y-m-d H:i:s") . PHP_EOL);
echo("*******************************************" . PHP_EOL . PHP_EOL);
require_once __DIR__ . '/../../../../wp-load.php';
require __DIR__ . '/../vendor/autoload.php';

$mcapi = $_ENV["MCAPI"];
$mclistid = $_ENV["MCLISTID"];
$mcserver = $_ENV["MCSERVERPREFIX"];
$client = new \MailchimpMarketing\ApiClient();
$client->setConfig([
    'apiKey' => $mcapi,
    'server' => $mcserver
]);

$response = $client->lists->getListMembersInfo($mclistid);

$iterations = ceil($response->total_items / 1000);

$supporters = get_posts([
    'post_type' => 'supporter',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

$i0 = 0;
foreach($supporters as $suppoter) {
    $plz = get_field("plz", $suppoter->ID);
    $supporters[$i0]->plz = $plz;
    $i0++;
}


for ($i1=0; $i1<$iterations; $i1++) {
    $contacts = $client->lists->getListMembersInfo($mclistid, null, null, 1000, $i1*1000)->members;

    $i2 = 0;
    $contactsAdded = 0;
    foreach ($contacts as $contact) {
        $add2komitee = false;
        foreach($contact->tags as $tag) {
            if ($tag->name == "public_komitee") {
                $add2komitee = true;
            }
        }
        if (!$add2komitee) {
            $i2++;
            continue;
        }
        if ($add2komitee) {
            $contactPLZ = $contact->merge_fields->MMERGE6;
            $contactName = $contact->merge_fields->FNAME . " " . $contact->merge_fields->LNAME;

            foreach ($supporters as $supporter) {
                if ($supporter->plz == $contactPLZ && $supporter->post_title == $contactName) {
                    $add2komitee = false;
                }

            }
            if ($add2komitee) {
                $supporter2add = array(
                    'post_title'    =>  $contactName,
                    'post_date'     =>  date("Y-m-d H:i:s"),
                    'post_name'     =>  uniqid("komitee-"),
                    'post_type'     =>  'supporter',
                    'post_status'   =>  "publish"
                );

                $post_id = wp_insert_post($supporter2add);

                update_field("plz", $contactPLZ, $post_id);
                update_field("city", $contact->merge_fields->MMERGE8, $post_id);
                update_field("public", "public", $post_id);

                echo("Added " . $contactName . " to Komitee" . PHP_EOL);
                $contactsAdded++;
            }

        }
        $i2++;
    }
}


$endtime = microtime(true);
$timediff = $endtime - $starttime;
echo("__________________" . PHP_EOL);
echo("Contacts added: " . $contactsAdded . PHP_EOL);
echo("__________________" . PHP_EOL . PHP_EOL);

echo("*******************************************" . PHP_EOL);
echo("Finished at: " . date("Y-m-d H:i:s") . PHP_EOL);
echo("Time elapsed: " . $timediff . " seconds" . PHP_EOL);
echo("*******************************************" . PHP_EOL . PHP_EOL . PHP_EOL);

file_put_contents("log.txt", ob_get_contents(), FILE_APPEND);