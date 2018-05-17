<?php
include ('vista.php')
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mi Sistema de Publicaciones</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>
    <header>
      <div class="container">
      <div style="text-align:center;" >
         <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
        Mi sistema de publicación de noticias</h4>
      </div>
      <nav style="text-align:center;">
        <a href="index.php?o=inicio"> Inicio </a>| 
        <a href="index.php?o=nuevoeditor">Nuevo Editor </a>|
        <a href="index.php?o=nuevanoticia">Nueva Noticia</a>|
        <a href="index.php?o=listarnoticia">Editar Noticia</a>|
      </nav>
 </div></div> </div> </div> </div> </div>
    </header>
    
    <main>
    <?php
      $opcion = (isset($_GET["o"])) ? $_GET["o"] : "inicio";
      $objeto = new vista($opcion);
    ?>
      
    </main>
  </body>
</html>
