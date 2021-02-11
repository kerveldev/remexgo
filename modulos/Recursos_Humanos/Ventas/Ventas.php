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
      <!-- DataTables Responsive CSS -->
      <link href="/js/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
      <link href="/js/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
      <link href="/js/datatables/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
      <link href="/js/datatables/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>

        
    <!-- Toastr style -->
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">

  

    <link rel="icon" href="../../../img/ico.png">

</head>

<body>

    <div class="modal dark_bg" id="modal_articulos" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">   
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Listado de Articulos</h5>
                    <button type="button" class="close" onclick="cerrarModalArticulos();" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="text-center m-t-md">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped nowrap" id="tabla_articulos">
                                            <thead>
                                                <th>Id Articulo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Precio</th>
                                            </thead>
                                            <tbody>
                                
                                            </tbody>
                                            <tfoot>
                                                <th>Id Articulo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Precio</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" onclick="cerrarModalArticulos();">Cerrar</button>
                    <button class="btn btn-primary" type="button"  id="botonGuardar">Agregar</button>

                </div>
            </div>
        </div>
    </div>
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
                                            <div class="col-md-8">
                                                <label>Cliente:</label>
                                                <input  type="hidden" class="form-control" name="Cliente" id="Cliente"></input>
                                                <select class="form-control" id="Sel_clientes">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Fecha:</label>
                                                <input  type="date" class="form-control" name="Fecha" id="Fecha"></input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Sucursal:</label>
                                                <input  type="text" class="form-control" name="Sucursal" id="Sucursal"></input>
                                            </div>
                                            <div class="col-md-6">
                                        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                    
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-success " type="button" onclick="nuevo_articulo();"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Agregar articulo</span></button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <table class="table table-striped" id="tabla_clientes">
                                                <thead>
                                                <th>Id Articulo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Precio</th>
                                                <!--<th>Acciones</th>-->
                                                </thead>
                                                <tbody>
                                
                                                </tbody>
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
