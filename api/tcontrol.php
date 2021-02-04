<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('date.timezone','MEXICO/GENERAL');
include_once("datos/ApiConfig.php");
include_once(NAUTA);
include_once(STORER);
include_once(EXCEPCIONES);
include_once(VISTA);
include_once(VISTA_JSON);
include_once(VISTA_XML);
include_once(USUARIOS['logger']);
include_once(AUXCTRL);

$vista = NULL;
$noemp = NULL;
$modulo = NULL;
$recurso = NULL;
$peticion = NULL;
$accion = NULL;
$nick = NULL;
$token = NULL;
//Se prepara la vista si es que existe un formato solicitado
$formato = isset($_GET['formato']) ? $_GET['formato'] : 'json';
switch ($formato) {
    case 'xml':
        $vista = new VistaXML();
        break;
    case 'json':
        $vista = new VistaJson();
        break;
    default:
        $vista = new VistaJson();
}

// Preparar manejo de excepciones
set_exception_handler(function ($exception) use ($vista) {
    $cuerpo = array(
        "status" => $exception->estado,
        "msj" => $exception->getMessage()
    );
    if ($exception->getCode()) {
        $vista->estado = $exception->getCode();
    } else {
        $vista->estado = 500;
    }

    $vista->imprimir($cuerpo);
}
);

$url = array();

// Extraer segmento de la url
if (isset($_GET['PATH_INFO']))
    $url = explode('/', $_GET['PATH_INFO']);
else
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la peticion"));

// Se obtiene el metodo
$metodo = strtolower($_SERVER['REQUEST_METHOD']);

// GET no es permitido
if ($metodo=='get') {
    $vista->estado=405;
    $vista->imprimir(METODO_NO_PERMITIDO);
    exit();
    /*throw new ExcepcionApi(ESTADO_EXISTENCIA_RECURSO,
       "Metodo no permitido.");
    exit();*/
};

// Obtener modulo
$modulo = strtolower(array_shift($url));

// Obtener recurso
$recurso = array_shift($url);

// Obtener peticion
$peticion = array_shift($url);

//$i = implode($peticion); -DEBUG-
//echo "Modulo = $modulo, Recurso = $recurso, Resto = ".$i; -DEBUG-


/* **************************************************************************************
 * ************************* Se procesa el modulo ***************************************
 * **************************************************************************************/
switch($modulo){

    // ----------------------------------------------------------------------------
    // ----- LOGGER ---------------------------------------------------------------
    // ----------------------------------------------------------------------------
    case 'logger':
        $l = logger::control($recurso,$metodo);
        $l['status']?$vista->est=200:$vista->est=400;
        $vista->imprimir($l);
        break;

    // ----------------------------------------------------------------------------
    // ----- RH -----------------------------------------------------------------
    // ----------------------------------------------------------------------------
    case 'rh':
        $v = include_once(RH['controlador']);
        if($v==FALSE){
            $vista->est = 400;
            $vista->imprimir(ERROR_CONTROLADOR);
        }
        break;

    // ----------------------------------------------------------------------------
    // ----- SELECCION DE PERSONAL -----------------------------------------------------------------
    // ----------------------------------------------------------------------------
    case 'spersonal':
        $v = include_once(PERSONAL['controlador']);
        if($v==FALSE){
            $vista->est = 400;
            $vista->imprimir(ERROR_CONTROLADOR);
        }
        break;

    // ----------------------------------------------------------------------------
    // ----- SELECCION DE PERSONAL ------------------------------------------------
    // ----------------------------------------------------------------------------
    case 'catalogos':
        $v = include_once(CAT['controlador']);
        if($v==FALSE){
            $vista->est = 400;
            $vista->imprimir(ERROR_CONTROLADOR);
        }
        break;
    
    // ----------------------------------------------------------------------------
    // ----- Upload ---------------------------------------------------------------
    // ----------------------------------------------------------------------------
    case 'upload':
        $v = include_once(UPLOAD['controlador']);
        if($v==FALSE){
            $vista->est = 400;
            $vista->imprimir(ERROR_CONTROLADOR);
        }
        break;

    // ----------------------------------------------------------------------------
    // ----- Upload all -----------------------------------------------------------
    // ----------------------------------------------------------------------------

    case 'upload_all':
        $v = include_once(UPLOAD_ALL['controlador']);
        if($v==FALSE){
            $vista->est = 400;
            $vista->imprimir(ERROR_CONTROLADOR);
        }
        break;

        
    // ----------------------------------------------------------------------------
    // ----- No existe el MODULO --------------------------------------------------
    // ----------------------------------------------------------------------------
    default:
        $vista->est = 400;
        $vista->imprimir(MODULO_NO_EXISTENTE);

}// Fin switch

?>