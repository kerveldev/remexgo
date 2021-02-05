<?php
/* ******************************************
 *      Internas                            *
 * ******************************************/
define('IREK',[
    'serv' => 'localhost',
    'us' => 'irek',
    'pass' => '123ilich@irek'
    ]);

define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/');
define('ROOT_WEB','https://remex.kerveldev.com/');

//define('MULTIMEDIA',ROOT.'mmx/');
//define('MULTIMEDIA_WEB',ROOT_WEB.'mmx/');

define('API',ROOT.'api/');
define('DATOS',API.'datos/');
define('MODULOS',API.'modulos/');

define('UTILIDADES',API.'utilidades/');
define('AUXCTRL',API.'aux_tcontrol.php');
define('NAUTA',UTILIDADES.'Nauta.php');
define('STORER',UTILIDADES.'Storer.php');
define('EXCEPCIONES',UTILIDADES.'ExcepcionApi.php');
define('QRLIB',UTILIDADES.'/phpqrcode/qrlib.php');

define('VISTA',API.'vistas/VistaApi.php');
define('VISTA_JSON',API.'vistas/VistaJson.php');
define('VISTA_XML',API.'vistas/VistaXML.php');


/* **************************************
 *      Constantes de estado            *
 * **************************************/
const ESTADO_URL_INCORRECTA = 2;
//const ESTADO_EXISTENCIA_RECURSO = 3;
const MODULO_NO_IMPLEMENTADO = [
            'status' => FALSE,
            'status_sesion'=> FALSE,
            'msj' => 'Modulo no implementado.',
            'data' => NULL
     ];
const MODULO_NO_EXISTENTE = [
            'status' => FALSE,
            'status_sesion'=> FALSE,
            'msj' => 'Modulo no existente.',
            'data' => NULL
     ];
const RECURSO_NO_IMPLEMENTADO = [
            'status' => FALSE,
            'status_sesion'=> FALSE,
            'msj' => 'Recurso no implementado.',
            'data' => NULL
     ];
const RECURSO_NO_EXISTE = [
            'status' => FALSE,
            'status_sesion'=> FALSE,
            'msj' => 'Recurso no existente.',
            'data' => NULL
     ];
const METODO_NO_IMPLEMENTADO = [
            'status' => FALSE,
            'status_sesion'=> FALSE,
            'msj' => 'Metodo no implementado.',
            'data' => NULL
     ];

const METODO_NO_PERMITIDO = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'Metodo no permitido.',
        'data' => NULL
     ];

const CONTENIDO_NO_PERMITIDO = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'El contenido no es permitido solo: JSON o FORM-DATA.',
        'data' => NULL
     ];

const FALTAN_PARAMETROS = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'Faltan parametros para procesar la peticion.',
        'data' => NULL
     ];

const FALTAN_PARAMETROS_ACTIVO = [
          'status' => FALSE,
          'status_sesion'=> TRUE,
          'msj' => 'Faltan parametros para procesar la peticion.',
          'data' => NULL
     ];

const PETICION_INVALIDA = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'La peticion es invalida o no es compatible con el metodo solicitado.',
        'data' => NULL
     ];

const PETICION_NO_IMPLEMENTADA = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'La peticion no implementada.',
        'data' => NULL
     ];

const NO_HAY_ARCHIVOS = [
        'status'=>FALSE,
        'status_sesion'=> FALSE,
        'msj'=>"No existen archivos a procesar.",
        'data'=>NULL
     ];

const SESION_CADUCADA = [
        'status'=>TRUE,
        'status_sesion'=> FALSE,
        'msj'=>"La sesion ha caducado. Ingrese nuevamente.",
        'data'=>NULL
     ];

const SESION_ACTIVA = [
        'status'=>TRUE,
        'status_sesion'=> TRUE,
        'msj'=>"La sesion sigue activa.",
        'data'=>NULL
     ];

const NICK_INVALIDO = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'Falta el nombre de usuario.',
        'data' => NULL
     ];

const PASS_INVALIDO = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'Falta la contraseña.',
        'data' => NULL
     ];

const TOKEN_INVALIDO = [
        'status' => FALSE,
        'status_sesion'=> FALSE,
        'msj' => 'API-Key invalida.',
        'data' => NULL
     ];
const ERROR_CONTROLADOR = [
          'status' => FALSE,
          'status_sesion'=> FALSE,
          'msj' => 'Error al cargar el controlador.',
          'data' => NULL
     ];


/* ***************************************
 *      MODULOS
 * ***************************************/

define('USUARIOS',[
        'base' => 'rmx',
        'ruta' => ROOT.'remex/modulos/doc_usuarios',
        'ruta_web' => ROOT_WEB.'remex/modulos/doc_usuarios',
        'logger' => MODULOS.'login/Logger.php',
     ]);

define('IPH',[
          'base'=> 'stkparp_iphk',
          'ruta'=>ROOT.'mmx/',
          'ruta_web'=> ROOT_WEB.'mmx/',
          'controlador'=>MODULOS.'iph/iph_ctrl.php',
          'iph'=>MODULOS.'iph/iph/IPH.php',
          'secc1'=>MODULOS.'iph/secc1_pd/Secc1_PD.php',
          'secc2'=>MODULOS.'iph/secc2_pr/Secc2_PR.php',
          'secc3'=>MODULOS.'iph/secc3_seg/Secc3_Seg.php',
          'secc4'=>MODULOS.'iph/secc4_lug/Secc4_Lug.php',
          'secc5'=>MODULOS.'iph/secc5_narra/Secc5_Narra.php',
          'anxa_det'=>MODULOS.'iph/anexoA_detenciones/AnxA_Det.php',
          'anxa_per'=>MODULOS.'iph/anexoA_pertenencias/AnxA_Per.php',
          'anxb_ufza'=>MODULOS.'iph/anexoB_ufza/AnxB_UFza.php',
          'anxc_iv'=>MODULOS.'iph/anexoC_iv/AnxC_IV.php',
          'anxd_invao'=>MODULOS.'iph/anexoD_invarmobj/AnxD_InvArmObj.php',
          'anxd_test'=>MODULOS.'iph/anexoD_testigos/AnxD_Testigos.php',
          'anxe_ent'=>MODULOS.'iph/anexoE_entrevistas/AnxE_Ent.php',
          'anxf_er'=>MODULOS.'iph/anexoF_entrega_recepcion/AnxF_Ent_Recp.php',
          'anxf_ing'=>MODULOS.'iph/anexoF_ingresos/AnxF_Ing.php',
          'datos_pr_firma_anx'=>MODULOS.'iph/datos_pr_firma_anexos/Datos_PR_Firma_Anexos.php',
          'multimedia'=>MODULOS.'iph/multimedia/Multimedia.php',
          'reportes'=>MODULOS.'iph/reportes/Reportes.php'
     ]);


define('RH',[
          'base'=> 'rmx',
          'ruta'=>NULL,
          'ruta_web'=> NULL,
          'controlador'=>MODULOS.'rh/rh_ctrl.php',
          'clientes'=>MODULOS.'rh/clientes/Clientes.php',
          'altas'=>MODULOS.'rh/alta/Alta.php'
     ]);

define('QR',[
          'base'=> 'stkparp_kqr',
          'ruta'=>ROOT.'stk_QR/qrs_img/',
          'ruta_web'=> ROOT_WEB.'stk_QR/qrs_img/',
          'controlador'=>MODULOS.'qr/qr_ctrl.php',
          'servicios'=>MODULOS.'qr/servicios/Servicios.php',
          'logo_estrella'=>MODULOS.'qr/servicios/logoZ.png',
          'notas'=>MODULOS.'qr/notas/Notas.php',
          'visitas'=>MODULOS.'qr/visitas/Visitas.php'
     ]);

define('HDIGITAL',[
          'base'=>'stkparp_kdets',
          'ruta'=>ROOT.'fmd_hd/',
          'ruta_web'=>ROOT_WEB.'fmd_hd/',
          'controlador'=>MODULOS.'hdigital/hd_ctrl.php',
          'hdigital'=>MODULOS.'hdigital/hd/Hd.php',
          'multimedia'=>MODULOS.'hdigital/multimedia/Multimedia.php',
          'eventos'=>MODULOS.'hdigital/eventos/Eventos.php'
     ]);


define('CAT',[
          'base'=> 'stkparp_Catalogos',
          'ruta'=>ROOT.'ESTRUCTURA_SELECCION_PERSONAL',
          'ruta_web'=> ROOT_WEB.'ESTRUCTURA_SELECCION_PERSONAL',
          'controlador'=>MODULOS.'catalogos/catalogos_ctrl.php',
          'multimedia'=>MODULOS.'catalogos/multimedia/Multimedia.php',
          'catalogos'=>MODULOS.'catalogos/catalogos/Catalogos.php'
     ]);

define('UPLOAD',[
          'base'=> 'stkparp_adelictivo',
          'ruta'=>'NULL',
          'ruta_web'=>'NULL',
          'controlador'=>MODULOS.'upload/upload_ctrl.php',
          'up'=>MODULOS.'upload/up/Up.php'          
     ]);

define('MPIPH',[
          'base'=> 'stkparp_iphk',
          'ruta'=>'NULL',
          'ruta_web'=>'NULL',
          'controlador'=>MODULOS.'mp_iph/mp_iph_ctrl.php',
          'mpiph'=>MODULOS.'mp_iph/mp_iph/MP_IPH.php'     
     ]);

define('MPUSUARIOS',[
          'base'=> 'stkparp_kusers',
          'ruta'=>'NULL',
          'ruta_web'=>'NULL',
          'controlador'=>MODULOS.'mp_usuarios/mp_user_ctrl.php',
          'mpusuarios'=>MODULOS.'mp_usuarios/mp_usuarios/MP_USUARIOS.php'      
     ]);



define('PROVEEDOR',[
          'base'=> 'rmx',
          'ruta'=>NULL,
          'ruta_web'=> NULL,
          'controlador'=>MODULOS.'proveedores/proveedores_ctrl.php',
          'proveedores'=>MODULOS.'proveedores/proveedor/Proveedor.php'
     ]);
?>