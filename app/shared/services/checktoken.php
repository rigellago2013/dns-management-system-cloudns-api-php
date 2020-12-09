<?php
if(isset($_POST['auth_token'])) {
    $cookie_token = $_COOKIE['auth_token'];
    if($cookie_token == $_POST['auth_token']) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}