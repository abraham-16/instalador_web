<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
class DataBase{

  private $host = HOST_NAME;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $database = DB_NAME;
  private $link = null;
  static $_instance = null;

  public function __construct(){
    $this->link = mysqli_connect($this->host,$this->user,$this->password,$this->database) or die("error de conexion");
    mysqli_set_charset($this->link, 'utf8');
  }

  private function __clone(){}

  public static function getInstance(){
    if(!(self::$_instance instanceof self)):
      self::$_instance = new self();
    endif;
    return self::$_instance;
  }

  public function getAllRow($sql){
    $arre = array();
    $resp = mysqli_query($this->link,$sql);
    if($resp!=false):
      while($row = mysqli_fetch_assoc($resp)):
        $arre[] = $row;
      endwhile;
      return $arre;
    else:
      return false;
    endif;
  }

  public function getOnlyRow($sql){
    $resp = mysqli_query($this->link,$sql);
    if($resp!=false):
      $row = mysqli_fetch_assoc($resp);
      return $row;
    else:
      return false;
    endif;
  }

  public function exec($sql){
    $resp = mysqli_query($this->link,$sql);
    if($resp!=false):
      return true;
    else:
      return false;
    endif;
  }

  public function __destruct(){
    $this->link = null;
  }

}
?>
