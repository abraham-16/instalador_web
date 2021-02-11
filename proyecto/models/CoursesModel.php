<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
class CoursesModel extends DataBase{

  private $link = null;

  public function __construct(){
    $this->link = DataBase::getInstance();
  }

  public function getCourses(){
    $query = $this->link->getAllRow("SELECT * from sw_c_course ");
    return $query;
  }

  public function __destruct(){
    $this->link = null;
  }

}

?>
