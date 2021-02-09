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
  

    <div class="modal dark_bg" id="modal_clientes" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Información General del Cliente</h5>
                    <button type="button" class="close" onclick="cerrarModalClientes();" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <div class="text-center m-t-md">
                                                
                                                    <div class="row">
                                                        <input type="hidden" id="Id_cliente" name="Id_cliente"></input>
                                                        <input type="hidden" id="Estatus" name="Estatus"></input>
                                                          <div class="col-sm-6">
                                                            <label for="Nombre">Nombre del Cliente:</label>
                                                            <input type="text" class="form-control" name="Nombre" id="Nombre"> 
                                                          </div>
                      
                                                          <div class="col-sm-6">
                                                            <label for="RFC">RFC:</label>
                                                            <input type="text" class="form-control" name="RFC" id="RFC"> 
                                                          </div>
                        
                                                      </div>

                                                      <div class="row">

                                                            <div class="col-sm-6">
                                                              <label for="Calle">Calle:</label>
                                                              <input type="text" class="form-control" name="Calle" id="Calle"> 
                                                            </div>
                        
                                                            <div class="col-sm-6">
                                                              <label for="Numero">Numero:</label>
                                                              <input type="text" class="form-control" name="Numero" id="Numero"> 
                                                            </div>
                          
                                                      </div>

                                                      <div class="row">

                                                            <div class="col-sm-6">
                                                              <label for="CP">Codigo Postal:</label>
                                                              <input type="text" class="form-control" name="CP" id="CP"> 
                                                            </div>
                        
                                                            <div class="col-sm-6">
                                                              <label for="Municipio">Municipio:</label>
                                                              <input type="text" class="form-control" name="Municipio" id="Municipio"> 
                                                            </div>
                        
                                                    </div>

                                                    <div class="row">

                                                            <div class="col-sm-6">
                                                              <label for="Entidad">Entidad:</label>
                                                              <input type="text" class="form-control" name="Entidad" id="Entidad"> 
                                                            </div>
                        
                                                            <div class="col-sm-6">
                                                              <label for="Pais">Pais:</label>
                                                              <input type="text" class="form-control" name="Pais" id="Pais"> 
                                                            </div>
                        
                                                    </div>

                                                    <div class="row">

                                                            <div class="col-sm-4">
                                                              <label for="Tel1">Tel1:</label>
                                                              <input type="text" class="form-control" name="Tel1" id="Tel1"> 
                                                            </div>

                                                            <div class="col-sm-2">
                                                              <label for="Ext1">Ext1:</label>
                                                              <input type="text" class="form-control" name="Ext1" id="Ext1"> 
                                                            </div>
                        
                                                            <div class="col-sm-4">
                                                              <label for="Tel2">Tel2:</label>
                                                              <input type="text" class="form-control" name="Tel2" id="Tel2"> 
                                                            </div>

                                                            <div class="col-sm-2">
                                                              <label for="Ext2">Ext1:</label>
                                                              <input type="text" class="form-control" name="Ext2" id="Ext2"> 
                                                            </div>
                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-3">  
                                                            <br> 

                                                            <label class="checkbox-inline"> 
                                                                <input type="checkbox" value="btn_status" id="btn_status" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%;">
                                                                Status
                                                            </label>
                                                            <!--<div class="icheckbox_square-green" style="position: relative;">
                                                                <input type="checkbox" id="btn_status" name="btn_status" class="i-checks" style="position: absolute; opacity: 0;">
                                                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                                                </ins>
                                                            </div> 
                                                            Remember me </label>-->
                                                            
                                                        </div>  
                                                    </div>

              
                              </div>
              
                            </div>
                        </div>
                  </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" onclick="cerrarModalClientes();">Cerrar</button>
                    <button class="btn btn-primary" type="button"  id="botonGuardar">Guardar</button>

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
                        <div class="ibox-title">
                            <h5>Dual Listbox</h5>
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
                                Bootstrap Dual Listbox is a responsive dual listbox widget optimized for Twitter Bootstrap. It works on all modern browsers and on touch devices.
                            </p>

                            <form id="form" action="#" class="wizard-big">
                                <div class="bootstrap-duallistbox-container row moveonselect"> <div class="box1 col-md-6">   <label for="bootstrap-duallistbox-nonselected-list_" style="display: none;"></label>   <span class="info-container">     <span class="info">Showing all 11</span>     <button type="button" class="btn clear1 pull-right btn-default btn-xs">show all</button>   </span>   <input class="filter form-control" type="text" placeholder="Filter">   <div class="btn-group buttons">     <button type="button" class="btn moveall btn-default" title="Move all">       <i class="glyphicon glyphicon-arrow-right"></i>       <i class="glyphicon glyphicon-arrow-right"></i>     </button>     <button type="button" class="btn move btn-default" title="Move selected">       <i class="glyphicon glyphicon-arrow-right"></i>     </button>   </div>   <select multiple="multiple" id="bootstrap-duallistbox-nonselected-list_" class="form-control" name="_helper1" style="height: 162px;"><option value="United States">United States</option><option value="United Kingdom">United Kingdom</option><option selected="" value="Austria">Austria</option><option selected="" value="Bahamas">Bahamas</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Brazil">Brazil</option><option value="Bulgaria">Bulgaria</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option></select> </div> <div class="box2 col-md-6">   <label for="bootstrap-duallistbox-selected-list_" style="display: none;"></label>   <span class="info-container">     <span class="info">Showing all 1</span>     <button type="button" class="btn clear2 pull-right btn-default btn-xs">show all</button>   </span>   <input class="filter form-control" type="text" placeholder="Filter">   <div class="btn-group buttons">     <button type="button" class="btn remove btn-default" title="Remove selected">       <i class="glyphicon glyphicon-arrow-left"></i>     </button>     <button type="button" class="btn removeall btn-default" title="Remove all">       <i class="glyphicon glyphicon-arrow-left"></i>       <i class="glyphicon glyphicon-arrow-left"></i>     </button>   </div>   <select multiple="multiple" id="bootstrap-duallistbox-selected-list_" class="form-control" name="_helper2" style="height: 162px;"><option value="Australia" data-sortindex="10">Australia</option></select> </div></div><select class="form-control dual_select" multiple="" style="display: none;">
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Australia" data-sortindex="10">Australia</option>
                                    <option selected="" value="Austria">Austria</option>
                                    <option selected="" value="Bahamas">Bahamas</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </form>
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
