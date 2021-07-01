<?php
require '../vendor/autoload.php';

    if (isset($_GET['page'])){
        $GLOBALS['gallery'] = new \App\Controller\Load('./upload/' . $_GET['page'] . '/' ?? '', 4);
    }
    else{
        $GLOBALS['gallery'] = new \App\Controller\Load('./upload/', 4);
    }
    
    $app = new Core\App();
    $gallery = $GLOBALS['gallery'];
