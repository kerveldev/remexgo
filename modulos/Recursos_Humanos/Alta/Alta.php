<?php
session_start();
ini_set('display_errors', '1');
$us = $_SESSION['user']['data'];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Irek Pelaez, Chrystian Redín, Jaquie Gonzalez">

    <title>REMEX | Alta RH</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
 

      <!-- DataTables Responsive CSS -->
      <link href="/js/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
      <link href="/js/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
      <link href="/js/datatables/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Toastr style -->
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">

  

    <link rel="icon" href="/img/ico.png">

</head>

<body>
     
    <div class="modal dark_bg" id="modal_usuario" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="titulo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                    <!--Encabezado modal-->
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo">Datos del Usuario: <span id="nUsuario"></span></h5>
                        <button type="button" class="close" onclick="cerrarModalUsuario_Id();" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>

                    <div class="modal-body">
                        <div class="card">
                          <div class="card-header">
                              <h6 class="card-title">Datos del usuario</h6>
                          </div>
                          <div class="card-body">

                                <div class="ibox float-e-margins">
                                  <div class="ibox-title">
                                      <h5>Basic Wizzard</h5>
                                      <div class="ibox-tools">
                                          <a class="collapse-link">
                                              <i class="fa fa-chevron-up"></i>
                                          </a>
                                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                              <i class="fa fa-wrench"></i>
                                          </a>
                                          <ul class="dropdown-menu dropdown-user">
                                              <li><a href="#">Config option 1</a>
                                              </li>
                                              <li><a href="#">Config option 2</a>
                                              </li>
                                          </ul>
                                          <a class="close-link">
                                              <i class="fa fa-times"></i>
                                          </a>
                                      </div>
                                  </div>
                                  <div class="ibox-content">
                                      <p>
                                          This is basic example of Step
                                      </p>
                                      <div id="wizard">
                                          <h1>First Step</h1>
                                          <div class="step-content">
                                              <div class="text-center m-t-md">
                                              <h2>Hello in Step 1</h2>
                                              <p>
                                                  This is the first content.
                                              </p>
                                              </div>
                                          </div>
              
                                          <h1>Second Step</h1>
                                          <div class="step-content">
                                              <div class="text-center m-t-md">
                                                  <h2>This is step 2</h2>
                                                  <p>
                                                      This content is diferent than the first one.
                                                  </p>
                                              </div>
                                          </div>
              
                                          <h1>Third Step</h1>
                                          <div class="step-content">
                                              <div class="text-center m-t-md">
                                                  <h2>This is step 3</h2>
                                                  <p>
                                                      This is last content.
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
              
                                  </div>
                              </div>

                                  <!-- <div class="row">

                                    <div class="col-sm-4">
                                      <label for="num_emp_usuario">N° Empleado:</label>
                                      <input type="text" class="form-control" name="num_emp_usuario" id="num_emp_usuario"> 
                                    </div>

                                    <div class="col-sm-4">
                                      <label for="RFC_usuario">RFC:</label>
                                      <input type="text" class="form-control" name="RFC_usuario" id="RFC_usuario"> 
                                    </div>

                                    <div class="col-sm-4">
                                      <label  for="CURP_usuario">CURP:</label>
                                      <input type="text" class="form-control" name="CURP_usuario" id="CURP_usuario"> 
                                    </div>  
      
                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                      <label for="A_Paterno_usuario">A. Paterno:</label>
                                      <input type="text" class="form-control" name="A_Paterno_usuario" id="A_Paterno_usuario"> 
                                    </div>

                                    <div class="col-sm-4">
                                      <label for="A_Materno_usuario">A. Materno:</label>
                                      <input type="text" class="form-control" name="A_Materno_usuario" id="A_Materno_usuario"> 
                                    </div>

                                    <div class="col-sm-4">
                                      <label  for="Nombre_usuario">Nombre:</label>
                                      <input type="text" class="form-control" name="Nombre_usuario" id="Nombre_usuario"> 
                                    </div>  
      
                                </div>



                                <div class="row">

                                    <div class="col-sm-6">
                                      <label  for="Nick">Nick:</label>
                                      <input type="text" class="form-control" name="Nick_cam" id="Nick_cam"> 
                                    </div>
                                      
                                    <div class="col-sm-6">
                                      <label for="Pasword">Pasword:</label>
                                      <input type="text" class="form-control" name="Pasword_cam" id="Pasword_cam"> 
                                    </div>

                                </div> -->

                          </div>
                        </div>
                    </div>
                  <div class="modal-footer ">
                      <button type="button " class="btn btn-secondary " onclick="cerrarModalUsuario_Id();" >Cerrar</button>
                      <button type="button" class="btn btn-primary" onclick="guardarcambio();">Cambiar Contraseña</button>
                  </div>
            
            </div>
        </div>
    </div>

    <div id="wrapper">
                            <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/menu.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>
                <div id="page-wrapper" class="gray-bg">
                             <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/header.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Alta RH</h2>
                        </div>
                    </div>

                      <div class="row wrapper wrapper-content mx-auto">
                        <div class="col-sm-12">
                          <div class="card">
                            <div class="card-header">

                              <h6 class="card-title">Listado Elementos</h6>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <!-- <button class="btn btn-success " id="btn_agregar" onclick="abrirUsuario('')">Agregar Usuario</button> -->
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-striped nowrap" id="tabla_usuarios">
                                    <thead>
                                      <th>N° Emp</th>
                                      <th>Nombre</th>
                                      <th>Edo. Adm.</th>
                                      <th>Acciones</th>
                                    </thead>
                                    <tbody>
                    
                                    </tbody>
                                    <tfoot>
                                      <th>N° Emp</th>
                                      <th>Nombre</th>
                                      <th>Edo. Adm.</th>
                                      <th>Acciones</th>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                         <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/footer.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>
                </div>
        </div>
    
    <!-- Mainly scripts -->
    <script src="/js/plugins/sweetAlert2/sweetalert2.all.js"></script>
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

     <!-- Datables -->
<!--     <script src="../../../js/plugins/dataTables/datatables.min.js"></script> -->

    <!--Datatables-->
    <script src="/js/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/js/dataTables.bootstrap4.js"></script>
    <script src="/js/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/js/datatables/js/jszip.min.js"></script>
    <script src="/js/datatables/js/pdfmake.min.js"></script>
    <script src="/js/datatables/js/vfs_fonts.js"></script>
    <script src="/js/datatables/js/dataTables.buttons.min.js"></script>
    <script src="/js/datatables/js/buttons.html5.min.js"></script>
    <script src="/js/datatables/js/dataTables.select.min.js" type="text/javascript" ></script>

     <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    
    <script src="js/Alta.js"></script>




    <script src="/js/end.js" type="text/javascript"></script>
    <script src="/js/ayudante.js" type="text/javascript"></script>

    <script>
        var nuser = JSON.parse(<?php echo "'".json_encode($us)."'"; ?>);
        if(!nuser){
            alert("La sesion a caducado.");
            location = "https://remex.kerveldev.com";
        }
        localStorage.setItem("user",nuser);
        //console.log(nuser);
    </script>

</body>
</html>
