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

    <title>REMEX | Proveedores</title>

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

    <div class="modal dark_bg" id="modal_usuario" data-backdrop="false" tabindex="-1" role="dialog"
        aria-labelledby="titulo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Datos del Usuario: <span id="nUsuario"></span></h5>
                    <button type="button" class="close" onclick="cerrarModalUsuario_Id();" aria-label="Close"> <span
                            aria-hidden="true">×</span> </button>
                </div>

                <div class="modal-body">
                    <div class="card">

                        <div class="card-body">

                            <!-- <div class="ibox float-e-margins"> -->

                            <div id="wizard">
                                <h1>Personales</h1>
                                <div class="step-content">
                                    <div class="text-center m-t-md">

                                        <div class="row">

                                            <div class="col-sm-12">
                                                <label for="f_ingreso_usuario">F. Ingreso Elemento:</label>
                                                <input type="date" class="form-control" name="f_ingreso_usuario"
                                                    id="f_ingreso_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="num_emp_usuario">NoEmp_RH:</label>
                                                <input type="text" class="form-control" name="num_emp_usuario"
                                                    id="num_emp_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="rfc_usuario">RFC:</label>
                                                <input type="text" class="form-control" name="rfc_usuario"
                                                    id="rfc_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="curp_usuario">CURP:</label>
                                                <input type="text" class="form-control" name="curp_usuario"
                                                    id="curp_usuario">
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="A_Paterno_usuario">A. Paterno:</label>
                                                <input type="text" class="form-control" name="A_Paterno_usuario"
                                                    id="A_Paterno_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="A_Materno_usuario">A. Materno:</label>
                                                <input type="text" class="form-control" name="A_Materno_usuario"
                                                    id="A_Materno_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="Nombre_usuario">Nombre:</label>
                                                <input type="text" class="form-control" name="Nombre_usuario"
                                                    id="Nombre_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="f_nacimiento_usuario">Fecha Nacimiento:</label>
                                                <input type="date" class="form-control" name="f_nacimiento_usuario"
                                                    id="f_nacimiento_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="edad_usuario">Edad:</label>
                                                <input type="text" class="form-control" name="edad_usuario"
                                                    id="edad_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="nacionalidad_usuario">Nacionalidad:</label>
                                                <input type="text" class="form-control" name="nacionalidad_usuario"
                                                    id="nacionalidad_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="entidad_nac_usuario">Entidad Nacimiento:</label>
                                                <input type="text" class="form-control" name="entidad_nac_usuario"
                                                    id="entidad_nac_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="municipio_nac_usuario">Municipio Nacimiento:</label>
                                                <input type="text" class="form-control" name="municipio_nac_usuario"
                                                    id="municipio_nac_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="genero_usuario">Genero:</label>
                                                <input type="text" class="form-control" name="genero_usuario"
                                                    id="genero_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="tipo_sangre_usuario">Tipo Sangre:</label>
                                                <input type="text" class="form-control" name="tipo_sangre_usuario"
                                                    id="tipo_sangre_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="edo_civil_usuario">Estado Civil:</label>
                                                <input type="text" class="form-control" name="edo_civil_usuario"
                                                    id="edo_civil_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="e_mail_usuario">Correo Electronico:</label>
                                                <input type="text" class="form-control" name="e_mail_usuario"
                                                    id="e_mail_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="telefono_usuario">Telefono:</label>
                                                <input type="text" class="form-control" name="telefono_usuario"
                                                    id="telefono_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="cel_usuario">Celular:</label>
                                                <input type="text" class="form-control" name="cel_usuario"
                                                    id="cel_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="tel_2_usuario">Otro Telefono:</label>
                                                <input type="text" class="form-control" name="tel_2_usuario"
                                                    id="tel_2_usuario">
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <h1>Domicilio</h1>
                                <div class="step-content">
                                    <div class="text-center m-t-md">

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="calle_usuario">Calle:</label>
                                                <input type="text" class="form-control" name="calle_usuario"
                                                    id="calle_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="nexterior_usuario">N° Exterior:</label>
                                                <input type="text" class="form-control" name="nexterior_usuario"
                                                    id="nexterior_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="ninterior_usuario">N° Interior:</label>
                                                <input type="text" class="form-control" name="ninterior_usuario"
                                                    id="ninterior_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="cp_usuario">C.P.:</label>
                                                <input type="text" class="form-control" name="cp_usuario"
                                                    id="cp_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="cruce1_usuario">Cruce 1:</label>
                                                <input type="text" class="form-control" name="cruce1_usuario"
                                                    id="cruce1_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="cruce2_usuario">Cruce 2:</label>
                                                <input type="text" class="form-control" name="cruce2_usuario"
                                                    id="cruce2_usuario">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="colonia_usuario">Colonia.:</label>
                                                <input type="text" class="form-control" name="colonia_usuario"
                                                    id="colonia_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="entidad_dom_usuario">Entidad:</label>
                                                <input type="text" class="form-control" name="entidad_dom_usuario"
                                                    id="entidad_dom_usuario">
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="municipio_dom_usuario">Municipio:</label>
                                                <input type="text" class="form-control" name="municipio_dom_usuario"
                                                    id="municipio_dom_usuario">
                                            </div>

                                        </div>





                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->

                        </div>

                    </div>

                </div>

                  <div class="modal-footer ">
                        <button type="button " class="btn btn-secondary " onclick="cerrarModalUsuario_Id();" >Cerrar</button>
                        <button type="button" class="btn btn-primary btn-guardar-usuario">Guardar</button>
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
                    <h2>Proveedores</h2>
                </div>
            </div>

            <div class="row wrapper wrapper-content mx-auto">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">

                            <h6 class="card-title">Listado Proveedores</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <button class="btn btn-success " id="btn_agregar" onclick="abrirUsuario('')">Agregar Usuario</button> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped nowrap" id="tabla_proveedores">
                                        <thead>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tel 1</th>
                                            <th>Tel 2</th>
                                            <th>Municipio</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Tel 1</th>
                                            <th>Tel 2</th>
                                            <th>Municipio</th>
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
    <script src="js/Alta.js"></script>
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