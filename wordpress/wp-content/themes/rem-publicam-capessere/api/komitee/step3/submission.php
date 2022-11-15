<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}

$supporter = get_post($data["supporter_ID"]);

$supporter_data = array(
    'ID'            =>  $supporter->ID,
    'post_status'   =>  'pending',
    'post_title'    =>  $data["name"],
    'post_content'  =>  substr($data["quote"], 0, 300),
);

wp_update_post($supporter_data);

if ($data["quote"] == "") {
    $data["categories"] = [];
} else {
    $data["categories"] = array("testimonial");
}

wp_set_object_terms($supporter->ID, $data["categories"], 'category');

if (isset($data["position"])) {
    update_field("position", $data["position"], $supporter->ID);
}
if (isset($data["zip"])) {
    update_field("plz", $data["zip"], $supporter->ID);
}
if (isset($data["city"])) {
    update_field("city", $data["city"], $supporter->ID);
}


require_once( ABSPATH . 'wp-admin/includes/image.php' );

function save_image( $base64_img, $title ) {

	// Upload dir.
	$upload_dir  = wp_upload_dir();
	$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

	$img             = str_replace( 'data:image/png;base64,', '', $base64_img );
	$img             = str_replace( ' ', '+', $img );
	$decoded         = base64_decode( $img );
	$filename        = $title . '.png';
	$file_type       = 'image/png';
	$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

	// Save the image in the uploads directory.
	$upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );

	$attachment = array(
		'post_mime_type' => $file_type,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
		'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
	);

	$attach_id = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_dir['path'] . '/' . $hashed_filename );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    return $attach_id;
}

$attach_id = save_image( $data["image"], uniqid() );


$post_thumbnail = set_post_thumbnail( $supporter->ID, $attach_id );

if (is_wp_error($post_thumbnail)) {
    $return = [
        "status" => "error",
        "message" => "Error while saving image",
    ];
} else {
    $action = "js";
    $js = <<<EOD
    document.querySelector('.rpc-komitee-completion-form-wrapper').remove();
    document.querySelector('.rpc-komitee-completion-success').style.display = "block";
    EOD;
    $return = [
        "status" => "success",
        "action" => $action,
        "js" => $js,
    ];
}

echo(json_encode($return));
exit;