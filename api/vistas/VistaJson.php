<?php
if(!require_once ("VistaApi.php")){
    exit;
}

/**
 * Clase para imprimir en la salida respuestas con formato JSON
 */
class VistaJson extends VistaApi
{
    public function __construct($estado = 400)
    {
        $this->est = $estado;
    }

    /**
     * Imprime el cuerpo de la respuesta y setea el codigo de respuesta
     * @param mixed $cuerpo de la respuesta a enviar
     */
    public function imprimir($cuerpo)
    {
        if ($this->est) {
            http_response_code($this->est);
        }
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        //header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Content-Type: application/json; charset=utf8');
		
		header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
        
		echo json_encode($cuerpo, JSON_BIGINT_AS_STRING);
        exit;
    }
}
?>