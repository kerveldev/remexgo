<?php
class sp {
    private $cuerpo = array();
    private $nave = NULL;

    static public function recurso($peticion){
        //Comentario en el codigo

        $nave = new nauta(IREK,SP['base'],SP['ruta']);
        switch($GLOBALS['metodo']){
            case 'post':
                switch ($peticion) {
                    case 'sp_lst':
                        $fields = array("nick","token");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $sql = "CALL servicios_productos_lst();";
                        $cuerpo = peticion_estandar($x->nick, $x->token, SP['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    case 'sp_id':
                        $fields = array("nick","token", "Id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $sql = "CALL servicios_productos_id('".$x->Id."');";
                        $cuerpo = peticion_estandar($x->nick, $x->token, SP['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    case 'modifica_sp':
                        $fields = array("nick","token","Id","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $cuerpo = peticion_actualizar($x->nick,$x->token,SP['base'],"servicios_productos","Id_SP",$x->Id,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion (POST) INVALIDA, peticion - '.$peticion,
                            'data' => NULL
                        ];
                        //$cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;

            case 'put':
                switch ($peticion) {
                    case 'crea_sp':
                        $fields = array("nick","token","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->Usuario = $_rfc;                         
                        
                        $cuerpo = peticion_insertar($x->nick, $x->token, SP['base'], "servicios_productos",$x->datos, $GLOBALS['modulo'],  $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion (PUT) INVALIDA, peticion - '.$peticion,
                            'data' => NULL
                        ];
                        //$cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;
            case 'delete':
                switch ($peticion) {
                    case 'elimina_sp':
                        $fields = array("nick","token","Id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_eliminar($x->nick, $x->token, SP['base'], "servicios_productos","Id_SP", $x->Id, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = [
                            'status' => TRUE,
                            'status_sesion'=> TRUE,
                            'msj' => 'Peticion (DELETE) INVALIDA, peticion - '.$peticion,
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