<?php

namespace App\Controller;
//use Core\App;

class upload  {
//public $uploadFileDir = './upload/' ;


    public function index () {
//        echo Load::$filename;
//        die();
//        echo $filename = $_GET['asd'];
//        var_dump($GLOBALS['gallery']->directory);
//        echo "esia tpel";
//        die();
//        var_dump(2);
//        var_dump($_GET);
        $uploadFileDir = $GLOBALS['gallery']->directory;
        echo $uploadFileDir;
//        die();
//        echo $asdasds;
        $files = new \App\Model\files();
        $post = new \App\Model\post();
        $session = new \App\Model\session();
        
        $message = "";
        $uploadedFile ="uploadedFile";
        
        if($post->hasValue('uploadBtn', 'Upload')){
            if($files->wasSuccessful($uploadedFile)){
                $fileTmpPath = $files->get($uploadedFile, 'tmp_name');
                $fileName = $files->get($uploadedFile, 'name');
                $fileSize = $files->get($uploadedFile, 'size');
                $fileType = $files->get($uploadedFile, 'type');
                
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = time(). $fileName. '.'.$fileExtension;
                $allowedFileExtensions = ['jpg','jpeg','png',];
                
                if(in_array($fileExtension, $allowedFileExtensions)){
//                    $uploadFileDir = './upload/';
                    
                    if (!file_exists($uploadFileDir)){
                        mkdir($uploadFileDir,0777,TRUE);
                    }
                    $dest_path = $uploadFileDir.$newFileName;
                    
                    if(move_uploaded_file($fileTmpPath, $dest_path) && isset($uploadFileDir)){
                        $message = 'File is successfully uploaded!';
                    } else {
                        $message = 'Please make sure the upload directory is writable by web server.';
                    }
                } else {
                    $message = 'Upload failed. Allowed file types: ' . implode(', ', $allowedFileExtensions);
                }
            } else {
                $message = 'There is some error in the file upload. Please check the following error.<br>';
                $fileErr = $files->get($uploadedFile, 'error');
                $message .= 'Error:' . $fileErr;
            }
        }
     $session->set('message', $message);
    header('location: ../');
    }
    
    public function folder() {
        $uploadFileDir = $GLOBALS['gallery']->directory;
//        var_dump($GLOBALS['gallery']->directory);
//        die();
        $session = new \App\Model\session();
        $message = '';

        $folder_name = $_POST['createfolder'];
        
        if (!file_exists($folder_name))
        {
            mkdir($uploadFileDir . $folder_name, 0777);
            $message = $folder_name . " Folder Created";
        }
        $session->set('message', $message);
        header('location: ../');
    }
    }
