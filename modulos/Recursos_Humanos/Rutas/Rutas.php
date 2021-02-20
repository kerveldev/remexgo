<?php
session_start();
//ini_set('display_errors', '1');
$us = $_SESSION['user']['data'];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Irek Pelaez, Chrystian Redín, Jaquie Gonzalez">

    <title>REMEX | Rutas</title>

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

<div class="modal dark_bg" id="modal_proveedor" data-backdrop="false" tabindex="-1" role="dialog"
    aria-labelledby="titulo" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="titulo">Datos del proveedor: <span id="nProveedor"></span></h5>
                <button type="button" class="close" onclick="cerrarModalProveedor_Id();" aria-label="Close"> <span
                        aria-hidden="true">×</span> </button>
            </div>

            <div class="modal-body">
                <div class="card">

                    <div class="card-body">

                        <h1>Proveedor</h1>
                
                            <div class="text-center m-t-md">

                                <div class="row">

                                    <div class="col-sm-12">
                                        <label for="nombre_proveedor">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre_proveedor"
                                            id="nombre_proveedor">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <label for="contacto_proveedor">Contacto:</label>
                                        <input type="text" class="form-control" name="contacto_proveedor"
                                            id="contacto_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="tel_1_proveedor">Tel 1:</label>
                                        <input type="text" class="form-control" name="tel_1_proveedor"
                                            id="tel_1_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="ext_1_proveedor">Ext 1:</label>
                                        <input type="text" class="form-control" name="ext_1_proveedor"
                                            id="ext_1_proveedor">
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-sm-4">
                                        <label for="tel_2_proveedor">Tel 2:</label>
                                        <input type="text" class="form-control" name="tel_2_proveedor"
                                            id="tel_2_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="ext_2_proveedor">Ext 2:</label>
                                        <input type="text" class="form-control" name="ext_2_proveedor"
                                            id="ext_2_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="direccion_proveedor">Direccion:</label>
                                        <input type="text" class="form-control" name="direccion_proveedor"
                                            id="direccion_proveedor">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <label for="cp_proveedor">CP:</label>
                                        <input type="number" class="form-control" name="cp_proveedor"
                                            id="cp_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="municipio_proveedor">Municipo:</label>
                                        <input type="text" class="form-control" name="municipio_proveedor"
                                            id="municipio_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="entidad_proveedor">Entidad:</label>
                                        <input type="text" class="form-control" name="entidad_proveedor"
                                            id="entidad_proveedor">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <label for="pais_proveedor">Pais:</label>
                                        <input type="text" class="form-control" name="pais_proveedor"
                                            id="pais_proveedor">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="email_proveedor">Email:</label>
                                        <input type="text" class="form-control" name="email_proveedor"
                                            id="email_proveedor">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer ">
                    <button type="button " class="btn btn-secondary " onclick="cerrarModalProveedor_Id();" >Cerrar</button>
                    <button type="button" class="btn btn-primary btn-guardar-proveedor">Guardar</button>
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
                    <h2>Administrador Rutas</h2>
                </div>
            </div>

            <div class="row wrapper wrapper-content mx-auto">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">

                            <h6 class="card-title">Listado Rutas</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <button class="btn btn-success " id="btn_agregar" onclick="abrirproveedor('')">Agregar proveedor</button> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped nowrap" id="tabla_vendedores_ruta">
                                        <thead>
                                            <th>Nombre</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <th>Nombre</th>
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
    <!--Datatables-->
    <script src="/js/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/js/dataTables.bootstrap4.js"></script>
    <script src="/js/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/js/datatables/js/jszip.min.js"></script>
    <script src="/js/datatables/js/pdfmake.min.js"></script>
    <script src="/js/datatables/js/vfs_fonts.js"></script>
    <script src="/js/datatables/js/dataTables.buttons.min.js"></script>
    <script src="/js/datatables/js/buttons.html5.min.js"></script>
    <script src="/js/datatables/js/dataTables.select.min.js" type="text/javascript"></script>
    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>
    <!-- Steps -->
    <script src="/js/plugins/steps/jquery.steps.min.js"></script>
    <!-- Jquery Validate -->
    <script src="/js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Personal JS -->
    <script src="js/Rutas.js"></script>
    <script src="/js/end.js" type="text/javascript"></script>
    <script src="/js/ayudante.js" type="text/javascript"></script>

    <script>
    var nuser = JSON.parse(<?php echo "'".json_encode($us)."'"; ?>);
    if (!nuser) {
        alert("La sesion a caducado.");
        location = "https://remex.kerveldev.com";
    }
    localStorage.setItem("user", nuser);
    //console.log(nuser);
    </script>

</body>

</html>