<?php
    const APP_NAME = "Task Manager PHP App";
    const APP_DESC = "Task Manager PHP App V1.0 (C)2024";
    const DEBUG = true;
    if ($_SERVER['SERVER_NAME'] == '127.0.0.1' or  $_SERVER['SERVER_NAME'] == 'localhost') {
        //localhost
        $host = $_SERVER['HTTP_HOST'];
        $folder = trim(dirname($_SERVER['PHP_SELF']), '/\\');
        $base_url = "http://$host/$folder";
        $parts = explode('/', $base_url);
        $path = implode('/', array_slice($parts, 0, count($parts) - 1));
        define('ROOT', $path . "/public");
        define('URL', $path . "/");
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', 'toor');
        define('DB_NAME', 'taskmanagerdb');
    }else {
        //live server
        define('ROOT', 'https://'. $_SERVER['HTTP_HOST'] . '/taskmanager/public');
        define('URL', 'https://' .  $_SERVER['HTTP_HOST'] .  '/taskmanager');
        define('DB_HOST', 'localhost');
        define('DB_USER', 'koyinta588443_taskManager');
        define('DB_PASS', 'gbrCBRM2908');
        define('DB_NAME', 'koyinta588443_taskManager');
    }
