<?php
namespace Core;

 class Controller {
     
     public function view($view, $data = []) {
         if (file_exists("../App/View/" . $view . ".php")){
             include "../App/View/" . $view . ".php";
         }
     }
 }