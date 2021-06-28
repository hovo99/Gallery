<?php
//    echo $_SERVER['SERVER_NAME'];
//    die();
$path = str_replace("\\", "/", "http://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
//echo $path;