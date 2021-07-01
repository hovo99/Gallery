<?php
    namespace App\Controller;
    class delete
    {
       public function index(){
           $session = new \App\Model\session();
           $message = "";
            if (array_key_exists('delete_file', $_POST)) {
                $filename = $_POST['delete_file'];
                echo $filename;
//                die();
                if (file_exists($filename)) {
                    rmdir($filename);
                    unlink($filename);
                    $message = $filename.' has been deleted';
                } else {
                    $message = 'Could not delete '.$filename.', does not exist';
                }
            }
            
           $session->set('message', $message);
            header('location: ../');
        }
        }