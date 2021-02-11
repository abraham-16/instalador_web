<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
define("BASE_URL","http://localhost/framework/");
//si el proyecto esta en la raiz del servidor ponemos solo la diagonal(/)
define("DEFAULT_PROYECT_PATH","/framework/");
define("DEFAULT_CONTROLLER","HomeController");
define("CONTROLLER_INDEX",1);//0
define("METHOD_INDEX",2);//1
define("PARAM_INDEX",3);//2 en caso de estar en la raiz del servidor
define("ERROR_404","views/errors/404.php");
define("ERROR_403","views/errors/403.php");
define("ERROR_401","views/errors/401.php");
define("HOST_NAME","localhost");
define("DB_NAME","moodle");
define("DB_USER","root");
define("DB_PASS","Tic_root123");
?>
