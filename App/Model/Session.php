<?php
    namespace App\Model;
    class session{
        
        public function __construct(){
            session_start();
        }
        
        public function set($name, $value){
            $_SESSION[$name] = $value;
        }
        
        public function has($name){
            return isset($_SESSION[$name]) && $_SESSION[$name];
        }
        
        public function hasValue($name, $value){
            return isset($_SESSION[$name]) && $_SESSION[$name]==$value;
        }
        public function remove($name){
            unset($_SESSION[$name]);
        }
    }