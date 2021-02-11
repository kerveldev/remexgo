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

    <title>REMEX | Ventas</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
      <!-- DataTables Responsive CSS -->
      <link href="/js/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
      <link href="/js/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
      <link href="/js/datatables/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
        
    <!-- Toastr style -->
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">

  

    <link rel="icon" href="../../../img/ico.png">

</head>

<body>

    <div id="wrapper">
        <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/menu.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>
        <div id="page-wrapper" class="gray-bg">
            <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/header.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>

            <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-content">
                                <div class="card">
                            <div class="card-block">
                            <div class="card-header">

                              <h6 class="card-title">Listado de Venta</h6>
                              <hr>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-11">
                                  
                                </div>
                                <div class="col-md-1">
                                <button class="btn btn-primary " type="button" onclick="nuevo_cliente();"><i class="fa fa-group"></i>&nbsp;&nbsp;<span class="bold">Nuevo</span></button>
                                  
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-striped nowrap" id="tabla_clientes">
                                    <thead>
                                      <th>Id</th>
                                      <th>Cliente</th>
                                      <th>Entidad</th>
                                      <th>Status</th>
                                      <th>Acciones</th>
                                    </thead>
                                    <tbody>
                    
                                    </tbody>
                                    <tfoot>
                                      <th>Id</th>
                                      <th>Cliente</th>
                                      <th>Entidad</th>
                                      <th>Status</th>
                                      <th>Acciones</th>
                                    </tfoot>
                                  </table>
                                </div>
                              </div>
                            </div>
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
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

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
    
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
    
    <!-- JSKnob -->
    <script src="js/plugins/jsKnob/jquery.knob.js"></script>
    
    <!-- Input Mask-->
    <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- Select2 -->
    <script src="js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Tags Input -->
    <script src="js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Dual Listbox -->
    <script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>

    <!-- Steps -->
    <script src="/js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="/js/plugins/validate/jquery.validate.min.js"></script>
    
    
    <script src="js/Ventas.js"></script>
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
