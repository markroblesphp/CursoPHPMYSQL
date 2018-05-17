<?php
//Autor: Claudio Morales
//Fecha: 11 mayo 2018
//Video del Webinar: 
//Tarea Eliminar o quitar las instrucciones de tipo echo
// Mark
define("SERVER",      "localhost");
define("USUARIO",     "root");
define("PASS",        "");
define("NOMBREBASE",  "curso");
class ClaseBaseDatos
  {
      private $objetoBase = '';
      public function __construct()
        {
            $this->objetoBase = new mysqli(SERVER, USUARIO, PASS, NOMBREBASE);
            if($this->objetoBase->connect_errno)
              {
                  echo "Fallo la conexion: ".$objetoMysqli->connect_error;
              }
        }
      public function nuevoEditor()
        {
            //echo "nuevo editor";
            //var_dump($this->objetoBase);
            $correo = $_POST["correoformulario"];
            $correo = htmlentities($correo);
            
            $pass = $_POST["passformulario"];
            $pass = password_hash($pass,PASSWORD_DEFAULT);
        
            $nombre = $_POST["nombreformulario"];
            $nombre = htmlentities($nombre);
        
            $apaterno = $_POST["apaternoformulario"];
            $apaterno = htmlentities($apaterno);
        
            $amaterno = $_POST["amaternoformulario"];
            $amaterno = htmlentities($amaterno);
        
            $nacio = $_POST["nacioformulario"];
            $nacio = htmlentities($nacio);
        
            $sql = 
            "insert into persona 
            (email, pass, nombre, a_paterno, a_materno, nacio ) 
            values ('$correo','$pass','$nombre','$apaterno','$amaterno','$nacio')";
        
            if($this->objetoBase->query($sql))
            {
              //echo "salio bien";
              $mensaje = '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
		          Autor agregado<strong>correctamente</strong>.</div>';
              header('Location: index.php?o=nuevoeditor&mensaje=1');
            }
            else
            {
              echo "Error:".$this->objetoBase->error;
            }
        }
      public function nuevaNoticia()
        {   
            $editores = $_POST["editores"];   // Autor seleccionado en la vista que obtuvimos de nuestra bd 
            $editores = htmlentities($editores);
        
            $titulo	 = $_POST["titulonoticia"];
            $titulo = htmlentities($titulo);
        
            $textopublicacion = $_POST["cuerponoticia"];
            $textopublicacion = htmlentities($textopublicacion);
        
            $fecha = date("Y-m-d H:i:s");
            $sql = 
            "insert into publicacion 
            (email_autor, fechahora, titulo, textopublicacion) 
            values ('$editores','$fecha','$titulo','$textopublicacion')";    // Modificado para insertar autores de la bd que seleccionamos en el select
        
            if($this->objetoBase->query($sql))
            {
              //echo "salio bien";
              header('Location: index.php?o=nuevanoticia&mensaje=1');
            }
            else
            {
              echo "Error:".$this->objetoBase->error;
            }
        }
      public function sinMetodo()
        {
            echo '<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                             <h4 class="panel-title">
                            <span class="glyphicon glyphicon-file">
                            </span>No existe esta opción, favor de verificar</a>
                        </h4></div> </div></div> </div></div> ';
        }
      public function __destruct()
        {
            $this->objetoBase = null;
            //var_dump($this->objetoBase);
        }
  }
$operacion = (isset($_GET["o"])) ? $_GET["o"] : "ninguna";
$basedatos = new ClaseBaseDatos();
switch ($operacion) 
  {
    case "nuevoeditor":
      $basedatos->nuevoEditor();
      break;
    case "nuevanoticia":
      $basedatos->nuevaNoticia();
      break;
    default:
      $this->sinMetodo();
      break;
  }
