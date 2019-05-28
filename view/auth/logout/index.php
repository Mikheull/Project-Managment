<?php
    setcookie("user_email", '', time() - 86400);
    setcookie("user_password", '', time() - 86400);
    session_destroy();

    header('location:'. $config -> rootUrl() .'./');
    exit;