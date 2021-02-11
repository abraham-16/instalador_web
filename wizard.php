<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container"><br><br>
  <form class="" action="setup.php" method="post">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3>Datos de la base de datos</h3>
          </div>
          <div class="col-md-12 form-group">
            <label for="host">Nombre de host</label>
            <input type="text" name="host" class="form-control" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="bd">Nombre de la base de datos</label>
            <input type="text" name="bd" class="form-control" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="userdb">Nombre de usuario de la base de datos</label>
            <input type="text" name="userdb" class="form-control" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="passworddb">Contraseña de la base de datos</label>
            <input type="password" name="passworddb" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3>Datos del sistema</h3>
          </div>
          <div class="col-md-12 form-group">
            <label for="user">Nombre de usuario</label>
            <input type="text" name="user" class="form-control" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="url">Url del sitio</label>
            <input type="url" class="form-control" name="url" value="http://<?= $_SERVER["HTTP_HOST"] ?>/" required>
          </div>
          <div class="col-md-12 form-group">
            <label for="system">Sistema operativo a usar</label>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="1" name="system" required>Windows
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="2" name="system" required>Linux
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" value="3" name="system" required>Mac Os
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <input type="submit" value="Instalar" name="enviar" class="btn btn-info btn-sm">
      </div>
    </div>
  </form>
</div>

</body>
</html>
