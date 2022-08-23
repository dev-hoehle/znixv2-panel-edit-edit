<?php

header('Content-Type: application/json; charset=UTF-8');

require_once 'app/require.php';
require_once 'app/controllers/ApiController.php';
require_once 'app/ratelimiter.php';
$RATELIMITER = new RateLimiter();
$API = new ApiController();

$rateLimiter = new RateLimiter(new Memcache(), $_SERVER["REMOTE_ADDR"]);
try {
    // allow a maximum of 100 requests for the IP in 5 minutes
    $rateLimiter->limitRequestsInMinutes(2, 5);
    // Check data
    if (
    empty($_GET['user']) ||
    empty($_GET['pass']) ||
    empty($_GET['hwid']) ||
    empty($_GET['key'])
) {
        $response = ['status' => 'failed', 'error' => 'Missing arguments'];
    } else {
        $username = $_GET['user'];
        $passwordHash = $_GET['pass'];
        $hwidHash = $_GET['hwid'];
        $key = $_GET['key'];
        $admin = $_GET['admin'];

        if (API_KEY === $key) {
            // decode
            $password = base64_decode($passwordHash);
            $hwid = base64_decode($hwidHash);

            $response = $API->getUserAPI($username, $password, $hwid, $admin);
        } else {
            $response = ['status' => 'failed', 'error' => 'Invalid API key'];
        }
    }

    echo json_encode($response);
} catch (RateExceededException $e) {
    header("HTTP/1.0 529 Too Many Requests");
    exit;
}
