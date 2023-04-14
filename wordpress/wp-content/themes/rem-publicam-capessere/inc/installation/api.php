<?php
/**
 * Register Theme Instance with RPC API
 *
 * @package RemPublicamCapessere
 * @version 2.0.0
 * @since 2.0.0
 */

/**
 * Register Theme Instance with RPC API
 */
function registerAPI() {
    $client = new \GuzzleHttp\Client(
        [
            "base_uri" => "https://rpc-admin.kpunkt.ch/wp/",
            "timeout" => 2.0,
            "verify" => false,
        ]
    );
    $req = $client->request("POST", "new-site", [
        "form_params" => [
            "name" => get_bloginfo("name"),
            "url" => get_bloginfo("url"),
            "email" => get_bloginfo("admin_email"),
        ]
    ]);
    $res = json_decode($req->getBody()->getContents());
    if (isset($res->status) && $res->status == "ok") {
        return $res->siteKey;
    } else {
        wp_die("Error while registering with RPC API");
    }
}

$key = registerAPI();
if (!file_exists(__DIR__ . "/../../.env")) {
    copy(__DIR__ . "/../../.env.example", __DIR__ . "/../../.env");
}
$env = file_get_contents(__DIR__ . "/../../.env");
if (strpos($env, "RPC_API_KEY=" ) !== false) {
    $env = str_replace("RPC_API_KEY=", "RPC_API_KEY=" . $key, $env);
    file_put_contents(__DIR__ . "/../../.env", $env);
} else {
    file_put_contents(__DIR__ . "/../../.env", $env . "\nRPC_API_KEY=" . $key, FILE_APPEND);
}
