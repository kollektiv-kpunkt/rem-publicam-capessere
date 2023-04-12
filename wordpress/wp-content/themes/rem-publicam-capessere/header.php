<?php
get_template_part( "template-parts/elements/credits");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($args["title-overwrite"])) {
        echo "<title>{$args["title-overwrite"]}</title>";
    }
    wp_head()
    ?>
    <script src="/wp-content/themes/rem-publicam-capessere/public/Hyphenopoly_Loader.js"></script>
    <script>
    Hyphenopoly.config({
        require: {
            "de": "FORCEHYPHENOPOLY"
        },
        setup: {
            selectors: {
                "#main-content": {}
            },
            dontHyphenateClass: "nohyphen"
        }
    });
    </script>
</head>
<?php
$bodyclasses = [];


global $template;
$template_array = explode("/", explode(".php", $template)[0]);
$template_file = end($template_array);
array_push($bodyclasses, $template_file);

if (is_front_page()) {
    array_push($bodyclasses, 'home');
}


?>
<body class="<?php
        $i=0;
        foreach($bodyclasses as $bodyclass):
            echo($bodyclass);
            if ($i < count($bodyclasses)-1) {
                echo " ";
            }
            $i++;
        endforeach;
        ?>">
    <?php
    if (!isset($args["noNavbar"])) {
        get_template_part("/templates/partials/navbar");
    }
    ?>
    <div id="main-content">
