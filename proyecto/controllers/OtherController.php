<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
class OtherController{

  function __construct(){}

  public function index(){
    echo "Soy la método index de OtherController";
  }

  public function other(){
    echo "Soy el método other de OtherController";
  }

  public function params($name = "alguien", $lastname = "soy"){
    //echo "Soy un método con parámetros los parámetros son {$name} y {$lastName}";
    require_once "views/home.php";
  }

}

?>
