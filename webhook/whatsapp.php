<?php

$verify_token = "weddingsparampara_verify_2026";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $mode = $_GET['hub_mode'];
    $token = $_GET['hub_verify_token'];
    $challenge = $_GET['hub_challenge'];

    if ($mode === 'subscribe' && $token === $verify_token) {
        echo $challenge;
    } else {
        http_response_code(403);
    }
}