<?php
    namespace App\Model;
    class post{
        
        public function hasValue($name, $value){
            return isset($_POST[$name]) && $_POST[$name]==$value;
        }
        
    }
    