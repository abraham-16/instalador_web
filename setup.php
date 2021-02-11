<?php
class Setup{

  private $host = null;
  private $db = null;
  private $userdb = null;
  private $passworddb = null;
  private $conn = null;
  private $user = null;
  private $password = null;
  private $url = null;
  private $system = null;
  private $urlx = null;
  private $path = null;

  public function __construct(){
    if (isset($_POST['enviar'])) {
      $this->host = isset($_POST['host']) ? $_POST['host']:null;
      $this->db = isset($_POST['bd']) ? $_POST['bd']:null;
      $this->userdb = isset($_POST['userdb']) ? $_POST['userdb']:null;
      $this->passworddb = isset($_POST['passworddb']) ? $_POST['passworddb']:null;
      $this->conn = mysqli_connect($this->host,$this->userdb,$this->passworddb,$this->db);
      $this->user = isset($_POST['user']) ? $_POST['user']:null;
      $this->password = isset($_POST['password']) ? $_POST['password']:null;
      $this->url = isset($_POST['url']) ? $_POST['url']:null;
      $this->ystem = isset($_POST['system']) ? $_POST['system']:null;
      if ($this->conn) {
        $sql = $this->importSql();
        echo $sql."<br>";
        if ($sql=="") {
          echo "Base de datos creada correctamente <br>";
          $file = $this->createFileConfig();
          echo $file."<br>";
          $dirs = $this->moveFileProject();
          echo $dirs."<br>";
          $deploy = $this->deployPrject();
          echo $deploy."<br>";
        }else{
          echo "Ocurrio un error al importar la base de datos <br>";
        }
      }else {
        echo "Ocurrio un error al conectarse con la base de datos <br>";
      }
    }
  }

  public function importSql(){
    $query = '';
    $status = "";
    $sqlScript = file('database.sql');
    foreach ($sqlScript as $line)   {
      $startWith = substr(trim($line), 0 ,2);
      $endWith = substr(trim($line), -1 ,1);
      if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
      }
      $query = $query . $line;
      if ($endWith == ';') {
        //mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
        if (!mysqli_query($this->conn,$query)) {
          $status = "Problema de sql en la linea ".$query;
        }
        $query= '';
      }
    }
    return $status;
  }

  public function createFileConfig(){
    $status = "";
    if (!file_exists("config.php")) {
      $requestUrl = parse_url($this->url);
      $urlPath = $requestUrl["path"];
      $this->urlx = explode("/",$urlPath);
      $project = count($this->urlx) == 2 ? array(0,1,2) : array(1,2,3);
      $this->path = count($this->urlx) == 2 ? "/" : "/".$this->urlx[1]."/";
      $contenido = "<?php \n";
      $contenido .="defined('ACCESS_SUCCESS') or header('location: ../error-403'); \n";
      $contenido .="define('BASE_URL','".$this->url."'); \n";
      $contenido .="define('DEFAULT_PROYECT_PATH','".$this->path."'); \n";
      $contenido .="define('DEFAULT_CONTROLLER','HomeController'); \n";
      $contenido .="define('CONTROLLER_INDEX',".$project[0]."); \n";
      $contenido .="define('METHOD_INDEX',".$project[1]."); \n";
      $contenido .="define('PARAM_INDEX',".$project[2]."); \n";
      $contenido .="define('ERROR_404','views/errors/404.php'); \n";
      $contenido .="define('ERROR_403','views/errors/403.php'); \n";
      $contenido .="define('ERROR_401','views/errors/401.php'); \n";
      $contenido .="define('HOST_NAME','".$this->host."'); \n";
      $contenido .="define('DB_NAME','".$this->db."'); \n";
      $contenido .="define('DB_USER','".$this->userdb."'); \n";
      $contenido .="define('DB_PASS','".$this->passworddb."'); \n";
      $contenido .= "?>";
      $archivo = fopen('config.php', 'w');
      $error = 0;
      if (!isset($archivo)) {
        $error = 1;
        $status = "No se ha podido crear el archivo de configuracion";
      }elseif (!fwrite($archivo, $contenido)) {
        $error = 1;
        $status = "No se ha podido escribir sobre el archivo";
      }
      fclose();
      if ($error == 0) {
        $status = "Se ha creado correctamente el archivo de configuracion";
      }
    }else{
      $status = "Este proyecto ya esta configurado";
    }
    return $status;
  }

  public function moveFileProject(){
    $status = "";
    $dir = $_SERVER["DOCUMENT_ROOT"].$this->path;
    if (!file_exists($dir)) {
      $from = 'proyecto';
      $to = $_SERVER["DOCUMENT_ROOT"]."/".$this->urlx[1];
      if (rename($from, $to)) {
        chmod($dir, 0777);
        $status = "Archivo creados correctamente";
      }else{
        unlink("config.php");
        rmdir($dir);
        $status = "Ocurrio un error al mover los ficheros del proyecto";
      }
    }else {
      $status = "El proyecto ".$this->path." ya existe";
    }
    return $status;
  }

  public function createUserApplication(){

  }

  public function deployPrject(){
    $status = "";
    if (copy("config.php",$_SERVER["DOCUMENT_ROOT"].$this->path."config/config.php")) {
      $status = "proyecto creado correctamente para visualizarlo has click <a href='".$this->url."'>aqui</a>";
    }else{
      unlink("config.php");
      rmdir($dir);
      $status = "No se ha podido crear el proyecto favor de revisar sus datos <a href='".$_SERVER['HTTP_HOST']."installer/'></a>";
    }
    return $status;
  }

}

$Setup = new Setup;
?>
