<?php
class proveedor {
    private $cuerpo = array();
    private $nave = NULL;

    static public function recurso($peticion){

        $nave = new nauta(IREK,RH['base'],RH['ruta']);
        switch($GLOBALS['metodo']){
            case 'post':
                switch ($peticion) {
                    case 'proveedores_lst':
                        $fields = array("nick","token");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $sql = "CALL proveedores_lst();";
                        $cuerpo = peticion_estandar($x->nick, $x->token, PROVEEDOR['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    case 'proveedores_id':
                        $fields = array("nick","token", "Id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $sql = "CALL proveedores_id(".$x->id.");";
                        $cuerpo = peticion_estandar($x->nick, $x->token, PROVEEDOR['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    case 'modifica_proveedor':
                        $fields = array("nick","token","Id","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $cuerpo = peticion_actualizar($x->nick,$x->token,PROVEEDOR['base'],"proveedores","Id_Proveedor",$x->Id,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion POST - '.$peticion,
                            'data' => NULL
                        ];
                        //$cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;

            case 'put':
                switch ($peticion) {
                    case 'crea_proveedor':
                        $fields = array("nick","token","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->Usuario = $_rfc;                         
                        
                        return "come popo rapido ssss";//peticion_insertar($x->nick, $x->token, RH['base'], "clientes",$x->datos, $GLOBALS['modulo'],  $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion PUT - '.$peticion,
                            'data' => NULL
                        ];
                        //$cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;
            case 'delete':
                switch ($peticion) {
                    case 'elimina_proveedor':
                        $fields = array("nick","token","Id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_eliminar($x->nick, $x->token, PROVEEDOR['base'], "clientes","Id_Cliente", $x->Id, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion DELETE - '.$peticion,
                            'data' => NULL
                        ];
                        //$cuerpo = PETICION_INVALIDA;
                        break;
                }                
                break;
            default:
                $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Metodo no permitido - '.$GLOBALS['metodo'],
                            'data' => NULL
                        ];
                //$cuerpo = METODO_NO_PERMITIDO;
                break;
        }
        
        return $cuerpo;
    }
    
}


?>