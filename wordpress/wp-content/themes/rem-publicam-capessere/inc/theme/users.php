<?php

function insertInAdmin($userId) {
    $client = new \GuzzleHttp\Client(
        [
            "base_uri" => $_ENV["RPC_ADMIN_URL"] . "wp/",
            "timeout" => 2.0,
            "verify" => false,
        ]
    );
    try {
        $req = $client->request("POST", "user", [
            "form_params" => [
                "name" => $_POST["user_login"],
                "email" => $_POST["email"],
                "password" => $_POST["pass1"],
                "site" => get_bloginfo("url")
            ]
        ]);
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        $res = json_decode($e->getResponse()->getBody()->getContents());
        if (isset($res->status) && $res->status == "error") {
            wp_die($res->message);
        }
    }
    $res = json_decode($req->getBody()->getContents());
    if ($res->status == "ok") {
        update_user_meta($userId, "rpc_user_id", $res->data->user->id);
    } else {
        wp_die("Error while registering with RPC API");
    }
}

add_action('user_register', 'insertInAdmin');


function updateInadmin() {
    $user = get_user_by('id', $_POST["user_id"]);
    if (isset($_POST["pass1"]) && $_POST["pass1"] != "") {
        $client = new \GuzzleHttp\Client(
            [
                "base_uri" => $_ENV["RPC_ADMIN_URL"] . "wp/",
                "timeout" => 2.0,
                "verify" => false,
            ]
        );
        $req = $client->request("POST", "user", [
            "form_params" => [
                "name" => $user->data->user_login,
                "email" => $_POST["email"],
                "password" => $_POST["pass1"],
                "site" => get_bloginfo("url")
            ]
        ]);
        $res = json_decode($req->getBody()->getContents());
        var_dump($res);
        exit;
        if ($res->status == "ok") {
            update_user_meta($userId, "rpc_user_id", $res->data->user->id);
        } else {
            wp_die("Error while registering with RPC API");
        }
    }
}

add_action('profile_update', 'updateInadmin');

function passwordReset($user) {
    if (isset($_POST["pass1"]) && $_POST["pass1"] != "") {
        $client = new \GuzzleHttp\Client(
            [
                "base_uri" => $_ENV["RPC_ADMIN_URL"] . "wp/",
                "timeout" => 2.0,
                "verify" => false,
            ]
        );
        $req = $client->request("POST", "user", [
            "form_params" => [
                "name" => $user->data->user_login,
                "email" => $user->data->user_email,
                "password" => $_POST["pass1"],
                "site" => get_bloginfo("url")
            ]
        ]);
        $res = json_decode($req->getBody()->getContents());
    }
}

add_action('after_password_reset', 'passwordReset');
