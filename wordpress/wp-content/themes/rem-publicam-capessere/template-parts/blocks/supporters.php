<div style="height: 300px; background: yellow; display: flex; justify-content: center; align-items: center; margin-top: 3rem; margin-bottom: 3rem">
    <p><b>This is a placeholder</b></p>
</div>

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