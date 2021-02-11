<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define("ACCESS_SUCCESS", true);
$requestUrl = parse_url($_SERVER["REQUEST_URI"]);
$urlPath = $requestUrl["path"];
$url = explode("/",$urlPath);

$lastIndexUrl = count($url) - 1;
if(empty($url[$lastIndexUrl])){
  array_shift($url);
  array_pop($url);
}else{
  array_shift($url);
}
require_once "config/config.php";
require_once "config/routes.php";
require_once "core/DataBase.php";
if(DEFAULT_PROYECT_PATH === $urlPath or DEFAULT_PROYECT_PATH === ($urlPath."/")){
  if(file_exists("controllers/".DEFAULT_CONTROLLER.".php")){
    require_once "controllers/".DEFAULT_CONTROLLER.".php";
    $defaultController = DEFAULT_CONTROLLER;
    $controller = new $defaultController();
    if (method_exists($controller, "index")) {
      $methodInfo = new ReflectionMethod($controller, "index");
      $requiredParams = $methodInfo->getNumberOfRequiredParameters();
      if ($requiredParams === 0) {
        $controller->index();
      }else{
        require_once ERROR_404;
        exit();
      }
    }else{
      //echo "No se econtro el metodo index";
      require_once ERROR_404;
    }
  }else{
    //echo "El archivo no existe";
    require_once ERROR_404;
  }
}elseif(isset($url[CONTROLLER_INDEX])) {
  if(file_exists("controllers/".$url[CONTROLLER_INDEX].".php")){
    require_once "controllers/".$url[CONTROLLER_INDEX].".php";
    $controller = new $url[CONTROLLER_INDEX]();
    if(isset($url[METHOD_INDEX])){
      if (method_exists($controller, $url[METHOD_INDEX])) {
        $method = $url[METHOD_INDEX];
        $methodInfo = new ReflectionMethod($controller, $method);
        $requiredParams = $methodInfo->getNumberOfRequiredParameters();
        $totalParams = $methodInfo->getNumberOfParameters();
        if (!$methodInfo->isPublic()) {
          require_once ERROR_401;
          exit();
        }
        if(isset($url[PARAM_INDEX])){
          $params = array();
          for ($i = PARAM_INDEX; $i < count($url); $i++) {
            $params[] = $url[$i];
          }
          if(count($params) > $totalParams or count($params) < $requiredParams){
            require_once ERROR_404;
            exit();
          }
          call_user_func_array(array($controller, $method), $params);
        }else{
          if ($requiredParams === 0) {
            $controller->$method();
          }else{
            require_once ERROR_404;
            exit();
          }
        }
      }else{
        //echo "No existe el método solicitado ni el predeterminado";
        require_once ERROR_404;
      }
    }elseif (method_exists($controller,"index")) {
      $methodInfo = new ReflectionMethod($controller, "index");
      $requiredParams = $methodInfo->getNumberOfRequiredParameters();
      if ($requiredParams === 0) {
        $controller->index();
      }else{
        require_once ERROR_404;
        exit();
      }
    }else{
      //echo "No existe el método predeterminado";
      require_once ERROR_404;
    }
  }else{
    //echo "Se solicitó controlador inexistente";
    if ($url[CONTROLLER_INDEX] === "error-401") {
      require_once ERROR_401;
    }elseif ($url[CONTROLLER_INDEX] === "error-403") {
      require_once ERROR_403;
    }else{
      require_once ERROR_404;
    }
  }
}
?>
