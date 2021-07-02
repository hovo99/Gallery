<?php
    namespace App\Controller;
    class delete
    {
       public function index(){
           
           $session = new \App\Model\session();
           $message = "";
           $folder_dir = $GLOBALS['gallery']->folder_dir;
           
            if (array_key_exists('delete_file', $_POST)) {
                $filename = $_POST['delete_file'];
                if ((file_exists($filename)) && (rmdir($filename) xor unlink($filename)) ) {
                    $message = $filename.' has been deleted';
                } else {
                    $message = 'Could not delete '.$filename.', does not exist';
                }
            }
            
           $session->set('message', $message);
           if (empty($folder_dir)) {
               header("Location: ../");
           } else {
               header("location: ../?page=" . $folder_dir);
           }
        }
        }