<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
class HomeController{

  private $coursesModel;

  public function __construct(){
    require_once "models/CoursesModel.php";
    $this->coursesModel = new CoursesModel();
  }

  public function index(){
    $name = "Alguiendsd";
    $lastname = "De alguna manera";
    $data = $this->coursesModel->getCourses();
    require_once "views/home.php";
  }

  public function getElement($lugar, $parametros="Abraham"){
    echo "Obtener de {$lugar} el elemento {$parametros}";
    //$this->getData();
  }

  public function getData(){
    echo "Hola";
  }

}

?>
