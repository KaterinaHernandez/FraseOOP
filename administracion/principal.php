<?php
  include('../Modelo/Frase.php');
  //include('../Modelo/seguridad.php');
  $instancia=new Frase();
  $frases=$instancia->obtenerFrases();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Mantenimiento</title>

    <!-- Bootstrap core CSS -->
    <link href="../librerias/bootstrap-3/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../librerias/bootstrap-3.0.2-dist/css/justified-nav.css" rel="stylesheet">
  </head>
  <body>
    <div id="usuario">
      <label>Esta loguado como <?php echo($_SESSION["nombre"]);?></label> |
      <a style="text-decoration:none; color:#000000;" href="../Modelo/logout.php">Salir</a>
    </div>
    <div class="container">

      <div class="masthead">
        <h3 class="text-muted"><a style="text-decoration:none; color:#000000;" href="principal.php">Frases Diarias</a></h3>
        <ul class="nav nav-justified">
          <li class="active"><a href="#">Mantenimiento</a></li>
         
        </ul>
      </div>

      <!-- Jumbotron -->
      <div class="jumbotron tablet">
      <h2><b>Frases agregadas</b></h2>
      <br>
      <label style="float:right;">
        <a style="text-decoration:none; color:#000000;" href='agregar.php'>
          <img src='../recursos/agregar.jpg'/>Agregar
        </a>
      </label>
      <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
               <th>Titulo</th>
               <th>Frase</th>
               <th>Autor</th>
               <th>Categoria</th>       
               <th>Fecha de Publicacion</th>              
               <th>Editar</th>
               <th>Borrar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(empty($frases)){
                echo "
                <tr>
                  <td></td>
                  <td></td>
                  <td>No hay datos</td>
                  <td></td>
                  <td></td>
                </tr>";
                
              }
            
              foreach($frases as $frase){
                 echo"
                 <tr>
                  <td>$frase[id]</td>
                  <td>$frase[titulo]</td>
                  <td>$frase[frase]</td>
                  <td>$frase[autor]</td>
                  <td>$frase[categoria]</td>
                  <td>$frase[fechaDePublicacion]</td>                               
                  <td>
                    <a href='agregar.php?id=$frase[id]'>
                    <img src='../recursos/editar.gif'/></a>
                  </td>
                  <td>
                    <a href='agregar.php?id_B=$frase[id]'>
                    <img src='../recursos/borrar.png'/></a>
                  </td>
                </tr>";
              }

            ?>
           
          </tbody>
        </table>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          
        </div>
        <div class="col-lg-4">
          
       </div>
        <div class="col-lg-4">
          
        </div>
      </div>

      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Katerina 2013</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
