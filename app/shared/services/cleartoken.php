<?php
    if(isset($_POST['auth_token'])) {
        unset($_COOKIE['auth_token']);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }