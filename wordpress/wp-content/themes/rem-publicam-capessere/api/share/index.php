<?php
if (isset($_COOKIE["mtm_consent"])) {
    $mtm->doTrackEvent("Share", $channel);
}

$text = $_GET["text"];

$url = $_GET["url"];

if ($channel == "whatsapp") {
    header("Location: https://wa.me/?text=" . urlencode($text . "\n" . $url));
} else if ($channel == "telegram") {
    header("Location: https://t.me/share/url?url=" . rawurlencode($url) . "&text=" . rawurlencode($text));
} else if ($channel == "facebook") {
    header("Location: https://www.facebook.com/sharer/sharer.php?u=" . rawurlencode($url));
} else if ($channel == "twitter") {
    header("Location: https://twitter.com/intent/tweet?text=" . rawurlencode($text) . " " . rawurlencode($url));
} else if ($channel == "mail") {
    header("Location: mailto:?subject=" . rawurlencode($text) . "&body=" . rawurlencode($url));
}