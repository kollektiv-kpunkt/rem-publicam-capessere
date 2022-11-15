<?php
if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
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

$attach_id = save_image( $data["image"], $data["uuid"] );

$post_thumbnail = set_post_thumbnail( $data["post_id"], $attach_id );

if ($post_thumbnail) {
    $action = "js";
    $js = <<<EOD
    document.querySelector('form[data-step-id=supporters-2]').style.display = "none";
    console.log(document.querySelector('form[data-step-id=supporters-2]'));
    document.querySelector('div[data-step-id=supporters-3]').style.display = "block";
    EOD;
    $return = [
        "status" => "success",
        "id" => $data["image"],
        "formData" => $data,
        "action" => $action,
        "js" => $js,
    ];
} else {
    $return = [
        "status" => "error",
        "message" => "Error while saving image",
    ];
}


if ($action == "js") {
    $return["js"] = $js;
}

echo(json_encode($return));
exit;