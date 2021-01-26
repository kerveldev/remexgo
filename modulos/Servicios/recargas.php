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

    <title>REMEX | Recargas</title>

    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../../../css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="../../../css/animate.css" rel="stylesheet">
    <link href="../../../css/style.css" rel="stylesheet">

    <link rel="icon" href="../../../img/ico.png">

</head>

<body>

    <div id="wrapper">



        <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/menu.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>

        <div id="page-wrapper" class="gray-bg">
        

        <?php  if(!(include_once($_SERVER["DOCUMENT_ROOT"]."/modulos/Secciones/header.php"))) echo "<p>No se ha podido cargar la cabecera.</p>";  ?>


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><span class="text-navy">RECARGAS</span></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Ano en curso</a>
                        </li>
                        <li>
                            <a>Dos meses</a>
                        </li>
                        <li class="active">
                            <strong>Un mes
                            </strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">



            <div class="row">
                <div class="col-md-9">

                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">(<strong>5</strong>) Total</span>
                            <h5>Productos</h5>
                        </div>
                        <div class="ibox-content">


                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                            <a href="#" class="text-navy" onclick="mostrarInformacionCliente('1')">
                                                Desktop publishing software
                                            </a>
                                            </h3>
                                            <p class="small">
                                                It is a long established fact that a reader will be distracted by the readable
                                                content of a page when looking at its layout. The point of using Lorem Ipsum is
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            $180,00
                                            <s class="small text-muted">$230,00</s>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1">
                                        </td>
                                        <td>
                                            <h4>
                                                $180,00
                                            </h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy" onclick="mostrarInformacionCliente('1')">
                                                    Text editor
                                                </a>
                                            </h3>
                                            <p class="small">
                                                There are many variations of passages of Lorem Ipsum available
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <dd>List is perfect for defining terms.</dd>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            $50,00
                                            <s class="small text-muted">$63,00</s>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="2">
                                        </td>
                                        <td>
                                            <h4>
                                                $100,00
                                            </h4>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    CRM software
                                                </a>
                                            </h3>
                                            <p class="small">
                                                Distracted by the readable
                                                content of a page when looking at its layout. The point of using Lorem Ipsum is
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            $110,00
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1">
                                        </td>
                                        <td>
                                            <h4>
                                                $110,00
                                            </h4>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    PM software
                                                </a>
                                            </h3>
                                            <p class="small">
                                                Readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            $130,00
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1">
                                        </td>
                                        <td>
                                            <h4>
                                                $130,00
                                            </h4>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">

                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    Photo editor
                                                </a>
                                            </h3>
                                            <p class="small">
                                                Page when looking at its layout. The point of using Lorem Ipsum is
                                            </p>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            $700,00
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1">
                                        </td>
                                        <td>
                                            <h4>
                                                $70,00
                                            </h4>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="ibox-content">

                            <button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                            <button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button>

                        </div>
                    </div>

                </div>
                <div class="col-md-3">

         
                    <div class="contact-box center-version" id="div_info_cliente" style="display: none">

                        <a href="profile.html">

                            <h3 class="m-b-xs text-navy"><strong>Información cliente</strong></h3>
                        
                               <img alt='image' class='img-circle' src='../../../img/a2.jpg'>;

                            <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                            <div class="font-bold">Graphics designer</div>
                            <address class="m-t-md">
                                <strong>Twitter, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>

                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                                <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                                <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                            </div>
                        </div>

                    </div>
          

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Support</h5>
                        </div>
                        <div class="ibox-content text-center">



                            <h3><i class="fa fa-phone"></i> +43 100 783 001</h3>
                            <span class="small">
                                Please contact with us if you have any questions. We are avalible 24h.
                            </span>


                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">

                            <p class="font-bold">
                            Other products you may be interested
                            </p>

                            <hr/>
                            <div>
                                <a href="#" class="product-name"> Product 1</a>
                                <div class="small m-t-xs">
                                    Many desktop publishing packages and web page editors now.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <hr/>
                            <div>
                                <a href="#" class="product-name"> Product 2</a>
                                <div class="small m-t-xs">
                                    Many desktop publishing packages and web page editors now.
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
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
        <script src="../../../js/jquery-3.1.1.min.js"></script>
        <script src="../../../js/bootstrap.min.js"></script>
        <script src="../../../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../../../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="../../../js/inspinia.js"></script>
        <script src="../../../js/plugins/pace/pace.min.js"></script>
        
        <!-- Toastr -->
    	<script src="../../../js/plugins/toastr/toastr.min.js"></script>
        <script src="/js/end.js" type="text/javascript"></script>
        <script src="/js/ayudante.js" type="text/javascript"></script>
        
        <!-- Personal Scripts -->
        <script src="js/recargas.js"></script>

        <script>
       
        nuser = JSON.parse(<?php echo "'".json_encode($us)."'"; ?>);
        
        if(!nuser){
            alert("La sesion a caducado.");
            location = "https://remex.izelfk.com/modulos/login_erp.php";
        }

        console.log(nuser)

        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 2500
                };
                toastr.success(nuser.Nombramiento,nuser.Nombre_completo);

        }, 1300);

              }); 
    </script>

</body>

</html>
