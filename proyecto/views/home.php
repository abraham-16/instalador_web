<?php
defined("ACCESS_SUCCESS") or header("location: ../error-403");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inicio</title>
  </head>
  <body>
    <h1>Hola mundo, bienvenido <?=$name; ?> <?=$lastname; ?> </h1>
    <?php
    foreach ($data as $row) {
      echo $row['fullname']."<br>";
    }
    ?>
  </body>
</html>
