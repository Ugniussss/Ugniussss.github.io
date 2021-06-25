<?php

define('DB_NAME', 'order_management_system');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'Ugniussss.github.io');


$string = "mysql:host=Ugniussss.github.io;dbname=order_management_system";
$connection = new PDO($string, DB_USER, DB_PASS);
if (!$connection = new PDO($string, DB_USER, DB_PASS)) {
    die("Nepavyko prisijungti");
}
