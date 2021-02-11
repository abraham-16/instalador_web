<?php
if (defined("ACCESS_SUCCESS")) {
  header("HTTP/1.0 401 Unauthorized");
}else{
  header("location: ../../error-403");
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Error 401</title>
  </head>
  <body>
    <h1>Error 401 - No tienes permiso para acceder a este sitio</h1>
  </body>
</html>
