<?php
$type = get_field("type");

$config = base64_encode(json_encode(get_fields()));

if (in_array("quotes", $type)) {
    get_template_part( "template-parts/elements/supp-quotes", "", $config);
}

if (in_array("list", $type)) {
    get_template_part( "template-parts/elements/supp-list", "", $config);
}

if (in_array("form", $type)) {
    get_template_part( "template-parts/elements/supp-form", "", $config);
}


?>