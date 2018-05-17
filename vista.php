<?php
//Autor: Claudio Morales
//Fecha: 09 mayo 2018
//Video del Webinar: 
class vista
{
  public function __construct($metodo="inicio")
    {
      switch ($metodo) 
        {
            case "inicio":
              $this->metodoPantallaInicio();
              break;
            case "nuevoeditor":
              $this->metodoNuevoEditor();
              break;
            case "nuevanoticia":
              $this->metodoNuevaNoticia();
              break;
            case "listarnoticia":
              $this->metodoListarNoticia();
              break;
            case "detallenoticia":
              $this->metodoDetalleNoticia();
              break;
            default:
              $this->sinMetodo();
              break;
        }
    }
  private function sinMetodo()
    {
      echo '<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                             <h4 class="panel-title">
                            <span class="glyphicon glyphicon-file">
                           </span>No existe esta opción, favor de verificar.</a>
                        </h4></div> </div></div> </div></div> ';
    }
  private function metodoPantallaInicio()
    {
      echo '<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                             <h4 class="panel-title">
                            <span class="glyphicon glyphicon-file">
                            </span>Bienvenido al sistema de publicaciones.</a>
                        </h4></div> </div></div> </div></div> ';
    }
  private function metodoDetalleNoticia()
    {
      include('consultas.php');
      $consulta = new ClaseConsultasBase();
      $arreglo = $consulta->detalleNoticia();
      echo '<div class="container">
      <div style="text-align:center;" >
      <div class="panel-body">
      <div class="row">';
      echo "<div>Detalle de Noticias.</div>";
      echo "<div>Titulo: ".$arreglo["titulo"]."</div>";
      echo "<div>Autor: ".$arreglo["email_autor"]."</div>";
      echo "<div>Fecha: ".$arreglo["fechahora"]."</div>";
      echo "<div>Noticia: ".$arreglo["textopublicacion"]."</div></div></div></div> </div>";
    }
  private function metodoListarNoticia()
    {
      include('consultas.php');
      $consulta = new ClaseConsultasBase();
      $arreglo = $consulta->listarNoticias();
     echo'<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <h4 class="panel-title">Listado de Noticias:</h4>';
       foreach($arreglo as $valor)       //Warning: Invalid argument supplied for foreach() in vista.php on line 56  si no existen noticias, validarlo para que no de ese warning
        {
          echo "<div>";
            echo "Titulo Noticia: ".$valor["titulo"]."<br>";
            echo '<a href="index.php?o=detallenoticia&id='.$valor["id"].'">Detalle</a>';
            echo '<hr>';
          echo "</div>";
        } echo "</div> </div></div> </div></div> </div>";
    }
  private function metodoNuevaNoticia()
    {
      //Tarea crear un campo select donde podamos seleccionar los diferentes
      //autores de la base de datos
    // Bug en la tabla publicacion
    //Error:Cannot add or update a child row: a foreign key constraint fails (`curso`.`publicacion`, CONSTRAINT `email_autor_fk` FOREIGN KEY (`email_autor`) REFERENCES `persona` (`email`) ON DELETE CASCADE ON UPDATE CASCADE)
    
      include('consultas.php');
      $consulta = new ClaseConsultasBase();
      $arreglo = $consulta->listarAutores();
      $mensaje = '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
		Noticia <strong> agregada </strong> correctamente.</div>';
        echo'<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">';
              
            echo '<form action="guardar.php?o=nuevanoticia" method="POST" >';
             
              echo 'Selecciona el editor:';
              echo '<select name="editores">';
              
              foreach($arreglo as $valor)
              {
              echo "<option value=".$valor[email].">".$valor[email]."</option>";
              }
              echo '</select>';
              echo '</div>';
              
              echo 'Titulo: ';
                echo '<input type="text" class="form-control" name="titulonoticia" id="idtitulonoticia" required placeholder="Título de la noticia">';
                echo '<br>';
                
             echo ' Noticia:';
                echo '<textarea rows="4" cols="50" class="form-control" name="cuerponoticia" id="idcuerponoticia" required placeholder="Cuerpo de la noticia" ></textarea>';
                echo '<br>';
                
              echo '<input class="btn btn-default btn-sm" name"guardar" type="submit" value="Guardar Nueva Noticia">';
              
            echo "</form></div>";
  if(isset($_GET['mensaje'])) {
    echo $mensaje;
}
    echo "</div></div> </div></div> </div>";

    }  //En el form action del siguiente metodo tenia el error de <form action="guardar.php?o=nuevanoticia" method="POST" >
       // Y en realidad es nuevo editor  <form action="guardar.php?o=nuevoeditor" method="POST" >
  // Archivo https://github.com/ComunidadDePHP/WebinarPHP/blob/master/02-php-profesional-con-mysql/clase-06-11-may-2018-vista.php
  //linea 90 es nuevoeditor en vez de nuevanoticia corregir en el github
  private function metodoNuevoEditor()
    {
      $mensaje = '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
		Editor <strong> agregado </strong> correctamente.</div>';
      echo '<div class="container">
      <div style="text-align:center;" >
      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
              <form action="guardar.php?o=nuevoeditor" method="POST" >
              Correo: 
                <input type="email" class="form-control" name="correoformulario" id="idcorreoformulario" required placeholder="">
                <br>
             Password: 
                <input type="password" class="form-control" name="passformulario" id="idpassformulario" required placeholder="" >
                <br>
             Nombre: 
                <input type="text" class="form-control" name="nombreformulario" id="idnombreformulario" required placeholder="">
                <br>
              Apellido Paterno: 
                <input type="text" class="form-control" name="apaternoformulario" id="idapaternoformulario" required placeholder="">
                <br>
              Apellido Materno: 
                <input type="text" class="form-control" name="amaternoformulario" id="idamaternoformulario" required placeholder="">
                <br>
              Nacimiento (Mes-Día-Año): 
                <input type="date" class="form-control" name="nacioformulario" id="idnacioformulario" required placeholder="">
                <br>  
               <div class="form-group">
              <input class="btn btn-default btn-sm" type="submit" value="Guardar datos del nuevo editor">
              </div>
            </form></div>'; 
  if(isset($_GET['mensaje'])) {
    echo $mensaje;
} 
            echo '</div></div> </div></div> </div>';
      
    
    }
}
