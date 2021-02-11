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

    <title>REMEX | Servicios & Productos</title>

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

    <div class="modal dark_bg" id="modal_producto" data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="titulo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Datos del Producto: <span id="nProducto"></span></h5>
                    <button type="button" class="close" onclick="cerrarModalProducto_Id();" aria-label="Close"> <span
                            aria-hidden="true">×</span> </button>
                </div>

                <div class="modal-body">
                    <div class="card">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-sm-12">
                                    <label for="f_ingreso_producto">F. Ingreso Elemento:</label>
                                    <input type="date" class="form-control" name="f_ingreso_producto"
                                        id="f_ingreso_producto">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="num_emp_producto">NoEmp_RH:</label>
                                    <input type="text" class="form-control" name="num_emp_producto"
                                        id="num_emp_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="rfc_producto">RFC:</label>
                                    <input type="text" class="form-control" name="rfc_producto"
                                        id="rfc_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="curp_producto">CURP:</label>
                                    <input type="text" class="form-control" name="curp_producto"
                                        id="curp_producto">
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="A_Paterno_producto">A. Paterno:</label>
                                    <input type="text" class="form-control" name="A_Paterno_producto"
                                        id="A_Paterno_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="A_Materno_producto">A. Materno:</label>
                                    <input type="text" class="form-control" name="A_Materno_producto"
                                        id="A_Materno_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="Nombre_producto">Nombre:</label>
                                    <input type="text" class="form-control" name="Nombre_producto"
                                        id="Nombre_producto">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="f_nacimiento_producto">Fecha Nacimiento:</label>
                                    <input type="date" class="form-control" name="f_nacimiento_producto"
                                        id="f_nacimiento_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="edad_producto">Edad:</label>
                                    <input type="text" class="form-control" name="edad_producto"
                                        id="edad_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="nacionalidad_producto">Nacionalidad:</label>
                                    <input type="text" class="form-control" name="nacionalidad_producto"
                                        id="nacionalidad_producto">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="entidad_nac_producto">Entidad Nacimiento:</label>
                                    <input type="text" class="form-control" name="entidad_nac_producto"
                                        id="entidad_nac_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="municipio_nac_producto">Municipio Nacimiento:</label>
                                    <input type="text" class="form-control" name="municipio_nac_producto"
                                        id="municipio_nac_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="genero_producto">Genero:</label>
                                    <input type="text" class="form-control" name="genero_producto"
                                        id="genero_producto">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="tipo_sangre_producto">Tipo Sangre:</label>
                                    <input type="text" class="form-control" name="tipo_sangre_producto"
                                        id="tipo_sangre_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="edo_civil_producto">Estado Civil:</label>
                                    <input type="text" class="form-control" name="edo_civil_producto"
                                        id="edo_civil_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="e_mail_producto">Correo Electronico:</label>
                                    <input type="text" class="form-control" name="e_mail_producto"
                                        id="e_mail_producto">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="telefono_producto">Telefono:</label>
                                    <input type="text" class="form-control" name="telefono_producto"
                                        id="telefono_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="cel_producto">Celular:</label>
                                    <input type="text" class="form-control" name="cel_producto"
                                        id="cel_producto">
                                </div>

                                <div class="col-sm-4">
                                    <label for="tel_2_producto">Otro Telefono:</label>
                                    <input type="text" class="form-control" name="tel_2_producto"
                                        id="tel_2_producto">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                  <div class="modal-footer ">
                        <button type="button " class="btn btn-secondary " onclick="cerrarModalProducto_Id();" >Cerrar</button>
                        <button type="button" class="btn btn-primary btn-guardar-producto">Guardar</button>
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
                                    <!-- <button class="btn btn-success " id="btn_agregar" onclick="abrirProducto('')">Agregar Producto</button> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped nowrap" id="tabla_productos">
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
    <script src="js/Servicios_Productos.js"></script>
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