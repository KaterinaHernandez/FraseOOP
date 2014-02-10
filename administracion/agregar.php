<?php ob_start();
  include('../Modelo/Frase.php');
  //include('../Modelo/seguridad.php');
//  $usuario=$_SESSION["nombre"];
  $frase= new Frase();
  if($_POST){
    $frase->id=$_POST['txtId'];
    $frase->frase=$_POST['txtFrase'];
    $frase->autor=$_POST['txtAutor'];
    $frase->titulo=$_POST['txtTitulo'];
    $frase->categoria=$_POST['txtCategoria'];
    $frase->agregar();
    header("Location:principal.php");
    exit();

  }else if(isset($_GET['id']) && $_GET['id'] > 0){
      $frase->id=$_GET['id'];
      $frase->cargar();

    }else if(isset($_GET['id_B']) && $_GET['id_B'] > 0){
        $frase->id=$_GET['id_B'];
        $frase->borrar();
        header("Location:principal.php");
        exit();
    }
       

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
      <h2><b>Agrega frase</b></h2>
      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <form role="form" method="post" action="">
          <div class="form-group panelito">
            <div id="formulario">
              <input readonly="readonly" type="hidden" name="txtId" value=<?php echo $frase->id ?>>
              <label for="exampleInputEmail1">Titulo:</label>
              <input type="text" required="required" class="form-control" name="txtTitulo" placeholder=" Ingrese el titulo" value=<?php echo $frase->titulo;?>>            
              <label for="exampleInputPassword1">Autor:</label>
              <input type="text" required="required" class="form-control" name="txtAutor" placeholder="Ingrese el autor" value=<?php echo $frase->autor;?>> 
              <label>Categoria:</label>
              <select name="txtCategoria">
                <option><?php echo $frase->categoria;?></option>
               <?php
                  /* $cat=$frase->traerCategoriasParaAgregar();
                   foreach ($cat as $categorias) {
                     echo"
                          <option>$categorias[nombre]</option>
                     ";
                   }*/
                ?>
              </select>           
              <label for="exampleInputPassword1">Frase:</label>
              <textarea name="txtFrase" required="required"  placeholder="Ingrese la frase"><?php echo $frase->frase;?></textarea>
              <br/>
              <br/>
              <div id="btnSubmit">
                <button class="btn btn-primary" type="submit" method="post" title="">Agregar</button>
              </div>
            </div>
          </div>
       </div>
    </form>
  </div>
</div>
</div>
<div id="volver">
  <label><a style="text-decoration:none; color:#000000;" href="principal.php"><img src="../recursos/volver.jpg"/>Volver</a></label>
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
       
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
