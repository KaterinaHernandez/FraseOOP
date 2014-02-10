<?php 
	include('Modelo/Frase.php');
  $objFrase= new Frase();
  $ultimaFrase=$objFrase->obtenerUltimoRegistro();
  $categorias=$objFrase->traerCategorias();
  $fecha=$objFrase->convertirFecha();
  $f=$objFrase->obtenerFrases();


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
    <script src="librerias/jquery.js"></script>
    <script src="librerias/bootstrap-modal.js"></script>
    <title>Frases Diaria</title>
    <!-- Bootstrap core CSS -->
    <link href="librerias/bootstrap-3.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="librerias/bootstrap-3.0.2-dist/css/offcanvas.css" rel="stylesheet">
    <link href="librerias/hola.css" rel="stylesheet">
   
  </head>
  <body> 
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Frases Diarias</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"></a></li>
            <li><a href="#about"></a></li>
            <li><a href="#contact"></a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>  
          <div class="jumbotron">
            <?php 
              foreach ($ultimaFrase as $ultima) {
                // var_dump($ultimaFrase);
              echo"
                <h1>$ultima[titulo]</h1>
                <p>$ultima[frase]</p>
                <p>Autor: $ultima[autor]</p>
                <br/>
                <label class='labelito'>Ultima frase, publicada el $fecha  </label>
              ";
            } 
            ?>
           
          </div>
          <div class="row">
          <?php 
        
           if(isset($_GET['idCat']) && $_GET['idCat'] != ""){
                $categ=$_GET['idCat'];
                $frasesCategorizadas=$objFrase->traerFrasesCategorizadas($categ);
                foreach ($frasesCategorizadas as $fraseCat) {      
                    echo"       
                      <div class='col-6 col-sm-6 col-lg-4'>
                      <h2>$fraseCat[titulo]</h2>
                      <p>$fraseCat[frase]</p>
                      <p><a class='btn btn-default create-user' href=index.php?idFrase=$fraseCat[id]' role='button'>Ver con detalles &raquo;</a></p>
                      </div>";      
                }
            }else{ 
                  $frases=$objFrase->obtenerFrases();             
                  foreach ($frases as $frase) {      
                    echo"         
                      <div class='col-6 col-sm-6 col-lg-4'>
                      <h2>$frase[titulo]</h2>
                      <p>$frase[frase]</p>
                      <p><a class='btn btn-default create-user'  href='index.php?idFrase=$frase[id]' role='button'>Ver con detalles &raquo;</a></p>
                      </div> ";
                  }
          } 
          ?>             
          </div><!--/row-->
        </div><!--/span-->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
             <a href="#" class="list-group-item active">Categorias</a>
             <?php
              foreach ($categorias as $categoria) {
              echo" 
                <a href='index.php?idCat=$categoria[categoria]' class='list-group-item'>$categoria[categoria]</a>
                ";
              }      
            ?>
          </div>
        </div><!--/span-->
      </div><!--/row-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Dialog - Modal form</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  <script>
  $(function() {
    var name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
      buttons: {
       Ok: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( ".create-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  </script>
</head>
<body>
      <div id='dialog-form' title='Create new user'>
        <form>
          <fieldset>
             <?php 
            if(isset($_GET['idFrase']) && $_GET['idFrase'] > 0){
                $id=$_GET['idFrase'];
                $frasesPorId=$objFrase->obtenerFrasePorId($id);
                   if(!Empty($frasesPorId)){
                      foreach ($frasesPorId as $frasePorId){
                        echo"
                        <label>$frasePorId[titulo]</label>.
                        <label>$frasePorId[categoria]</label>.
                        <p>$frasePorId[frase]</p>.
                        <label>$frasePorId[autor]</label>";
                      }
                    }
            }else{
                 echo"<label>No se pudo cargar la frase</label>";
            }
            ?>
          </fieldset>
        </form>
      </div>  


 </body>
</html>
