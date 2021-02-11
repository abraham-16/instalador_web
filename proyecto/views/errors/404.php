<?php
if (defined("ACCESS_SUCCESS")) {
  header("HTTP/1.0 404 Not Found");
}else{
  header("location: ../../error-403");
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Error 404</title>
  </head>
  <body>
    <h1>Error 404 - página no encontrada en el servidor</h1>
  </body>
</html>
