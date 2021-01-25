<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$_SESSION['shot'] = 1;

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Irek Pelaez, Chrystian Redín, Jaquie Gonzalez">

    <title>REMEX ERP | 2020</title>


    <link href='../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../font-awesome/css/font-awesome.css' rel='stylesheet'>

    <link href='../css/animate.css' rel='stylesheet'>
    <link href='../css/style.css' rel='stylesheet'>

    <link rel='icon' href='../img/ico.png'>
         

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">REMEX ERP</h2>

                <hr>

                <p>
                     Otorgar apoyo a los clientes del negocio, tiempos rápidos de respuesta a sus problemas.
                </p>

                <p>
                    Eficiente manejo de información que permita la toma oportuna de decisiones.
                </p>

                <p>
                   	Disminución de los costos totales de operación.
                </p>

                <p>
                    <small>Planificador de Recursos Empresariales.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                        <br>
                          <div>
                            <span id="mensaje">Ingreso a la plataforma</span>
                          </div>

					<form method="post" action="proc_login.php" enctype="multipart/form-data" class="m-t">
                        <div class="form-group">
                            <input type="text" id="nick" name="nick" class="form-control" placeholder="Usuario"  autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña"  autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b" value="Login" >Iniciar</button> <!--onclick="logERP()"-->

<!-- 

                        <a href="#">
                            <small>Olvidaste tu Contraseña?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>No tienes una cuenta?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="#">Crear una cuenta</a> -->
                    </form>
                    <p class="m-t">
                        <small>Sistema de administración Remex &copy; 2021</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
       
    </div>




     <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/footer.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>
	<!-- * Libraries jQuery, Easing and Bootstrap - Be careful to not remove them * -->
	<script src="../js/jquery-3.1.1.min.js"></script>
    


    <script>
    
   /* function logERP(){
        window.open("Menu_Principal/dashboard_remex.php","_self");    
    }*/

    var mensaje = 
    <?php if(isset($_SESSION['msj_login'])){ 
      echo "'".$_SESSION['msj_login']."'"; 
    }else{
      echo "'Ingreso a la plataforma.'";
    } ?> ;
    $("#mensaje").text(mensaje).addClass( "text-danger" );
  </script>



</body>

</html>
