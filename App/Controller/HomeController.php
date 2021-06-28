<?php
    namespace App\Controller;
    
    class HomeController extends \Core\Controller {
      public  function index (){
          $this -> view("image_upload");
          $this -> view("rend");
      }
    }