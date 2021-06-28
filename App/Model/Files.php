<?php
    namespace App\Model;
    class files{
        
        public function wasSuccessful($name){
            return isset($_FILES[$name]) && $_FILES[$name]['error'] == UPLOAD_ERR_OK;
        }
        
        public function get($name, $detail){
            return  $_FILES[$name][$detail];
        }
    }
    
