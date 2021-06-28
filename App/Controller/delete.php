<?php
    namespace App\Controller;
    class delete
    {
       public function index(){
           $session = new \App\Model\session();
           $message = "";
            if (array_key_exists('delete_file', $_POST)) {
                $filename = $_POST['delete_file'];
                if (file_exists($filename)) {
                    rmdir($filename);
                    unlink($filename);
                    $message =  'Image '.$filename.' has been deleted';
                } else {
                    $message = 'Could not delete '.$filename.', Image does not exist';
                }
            }
           $session->set('message', $message);
            header('location: ../');
        }
        }