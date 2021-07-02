<?php
namespace App\Controller;
 class move {
    public function index(){
    if(isset($_POST['move_folder'])){
        $folder_dir = $GLOBALS['gallery']->folder_dir;
        $session = new \App\Model\session();
        $message = "";
        $fileNameCmps = explode("/", $_POST['file_path']);
        $fileExtension = end($fileNameCmps);
        echo $fileExtension;
        echo '<br>';
        $destination = './upload/' . $_POST['move_folder'] . '/' .$fileExtension  ;
        echo $destination;
        echo '<br>';
        echo $_POST['file_path'];
    
        if( !copy($_POST['file_path'], $destination) ) {
            $message = "File can't be moved! \n";
        }
        else {
            $message = "File has been moved! \n";
            unlink($_POST['file_path']);
        }
        $session->set('message', $message);
        if (empty($folder_dir)) {
            header("Location: ../");
        } else {
            header("location: ../?page=" . $folder_dir);
        }
    }
    
    }
 }