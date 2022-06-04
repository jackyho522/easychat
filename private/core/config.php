<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'chat_db');
define('URLROOT', 'chatapp');
define('bootstrap', 'public/bootstrap-5.1.3/');
define('parsley', 'public/parsley/');
define('css', 'public/css/');
define('assets', 'public/assets/');
define('js', 'public/js/');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 