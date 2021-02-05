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

    <title>REMEX | Clientes</title>

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

  

    <link rel="icon" href="../../../img/ico.png">

</head>

<body>
     
   

    <div class="modal dark_bg" id="modal_usuario" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Respaldo Documental</h5>
                    <button type="button" class="close" onclick="cerrarModalImgAsignacion();" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-md-16 col-sm-16">
                                <!-- Inicio del Card -->
                                <div class="card">
                                    <!-- Card Body -->
                                    <div class="card-body"> 

                                       
                          
                                           <div class="form-row">
                                            <div class="form-group col-sm-16 col-md-16 col-xl-16">
                                                <form>
                                                  <div class="file-loading">
                                                      <input id="input-1" name="input-1" type="file" multiple="">
                                                 </div>
                                                </form>
                                            </div> 
                                          </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" onclick="cerrarModalImgAsignacion();">Cerrar</button>

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
                            <h2>Clientes</h2>
                        </div>
                    </div>

                      <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-content">
                                <div class="card">
                            <div class="card-block">
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
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-content">

                                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                        <thead>
                                        <tr>

                                            <th>Order ID</th>
                                            <th data-hide="phone">Customer</th>
                                            <th data-hide="phone">Amount</th>
                                            <th data-hide="phone">Date added</th>
                                            <th data-hide="phone,tablet" >Date modified</th>
                                            <th data-hide="phone">Status</th>
                                            <th class="text-right">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                              3214
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $500.00
                                            </td>
                                            <td>
                                                03/04/2015
                                            </td>
                                            <td>
                                                03/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3214
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $500.00
                                            </td>
                                            <td>
                                                03/04/2015
                                            </td>
                                            <td>
                                                03/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-danger">Canceled</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-warning">Expired</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3214
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $500.00
                                            </td>
                                            <td>
                                                03/04/2015
                                            </td>
                                            <td>
                                                03/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3214
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $500.00
                                            </td>
                                            <td>
                                                03/04/2015
                                            </td>
                                            <td>
                                                03/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                324
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $320.00
                                            </td>
                                            <td>
                                                12/04/2015
                                            </td>
                                            <td>
                                                21/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                546
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $2770.00
                                            </td>
                                            <td>
                                                06/07/2015
                                            </td>
                                            <td>
                                                04/08/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                6327
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $8560.00
                                            </td>
                                            <td>
                                                01/12/2015
                                            </td>
                                            <td>
                                                05/12/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                642
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $6843.00
                                            </td>
                                            <td>
                                                10/04/2015
                                            </td>
                                            <td>
                                                13/07/2015
                                            </td>
                                            <td>
                                                <span class="label label-success">Shipped</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                7435
                                            </td>
                                            <td>
                                                Customer example
                                            </td>
                                            <td>
                                                $750.00
                                            </td>
                                            <td>
                                                04/04/2015
                                            </td>
                                            <td>
                                                14/05/2015
                                            </td>
                                            <td>
                                                <span class="label label-primary">Pending</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button class="btn-white btn btn-xs">View</button>
                                                    <button class="btn-white btn btn-xs">Edit</button>
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </div>
                                            </td>
                                        </tr>



                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>

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

    <!-- Steps -->
    <script src="/js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="/js/plugins/validate/jquery.validate.min.js"></script>
    
    
    <script src="js/Clientes.js"></script>
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
