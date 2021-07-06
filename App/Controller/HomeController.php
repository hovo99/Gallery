<?php
    namespace App\Controller;
    
    class HomeController extends \Core\Controller {
      public  function index (){
          $this -> view("header");
          $this -> view("image_upload");
          $this -> view("rend", $_GET['page'] ?? '');
          $this -> view("footer");
      }
    }