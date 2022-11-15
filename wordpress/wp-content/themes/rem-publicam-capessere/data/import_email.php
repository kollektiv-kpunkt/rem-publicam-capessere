<?php
require_once __DIR__ . '/../../../../wp-load.php';

ob_start();

// Read csv file import_email.csv
$supporters = array_map('str_getcsv', file('import_email.csv'));

$notKomitee = [];
$noWP = [];
$duplicates = [];
$added = [];
$missing = [];

// Loop through all supporters
$i = 0;
foreach ($supporters as $supporter) {
    $i++;
    $suppID = "{$supporter[1]} {$supporter[2]} " . ($i);
    $supporter["tags"] = explode(",", $supporter[4]);

    $wp_supporter = get_posts(
        array(
            'post_type' => 'supporter',
            "title" => "{$supporter[1]} {$supporter[2]}",
            'posts_per_page' => -1,
            'meta_key' => 'plz',
            'meta_value' => $supporter[3],
        )
    );
    if (count($wp_supporter) == 0) {
        array_push($noWP, $suppID);
        continue;
    }
    if (count($wp_supporter) > 1) {
        array_push($duplicates, $suppID);
        continue;
    }

    update_field("email", $supporter[0], $wp_supporter[0]->ID);
    array_push($added, "{$supporter[1]} {$supporter[2]}");
}

$missing_email = get_posts(
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

foreach ($missing_email as $supporter) {
    array_push($missing, $supporter->post_title);
}

echo("****************************************************************") . PHP_EOL;
echo("*********************** Email Import Log ***********************") . PHP_EOL;
echo("****************************************************************") . PHP_EOL . PHP_EOL;
echo("No WP: " . count($noWP) . PHP_EOL);
echo(implode(", ", $noWP) . PHP_EOL . PHP_EOL);
echo("Duplicates: " . count($duplicates) . PHP_EOL);
echo(implode(", ", $duplicates) . PHP_EOL . PHP_EOL);
echo("Added: " . count($added) . PHP_EOL);
echo(implode(", ", $added)) . PHP_EOL . PHP_EOL;
echo("Missing: " . count($missing) . PHP_EOL);
echo(implode(", ", $missing) . PHP_EOL . PHP_EOL);
echo("****************************************************************") . PHP_EOL;

file_put_contents("import_email_log.txt", ob_get_clean());