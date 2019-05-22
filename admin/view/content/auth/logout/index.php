<?php
    session_destroy();
    header('location:'. $config -> rootUrl() .'./admin');
    exit;