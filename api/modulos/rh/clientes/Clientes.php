<?php
class clientes {
    private $cuerpo = array();
    private $nave = NULL;

    static public function recurso($peticion){

        $nave = new nauta(IREK,RH['base'],RH['ruta']);
        switch($GLOBALS['metodo']){
            case 'post':
                switch ($peticion) {
                    
                    case 'lst_clientes':
                            $fields = array("nick","token");// Lista de parametros por recibir
                            $box = new Storer($fields,true);
                            if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                            $sql = "Call clientes_lst(1);";
                            $cuerpo = peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break; 

                    case 'id_cliente':
                            $fields = array("nick","token","id");// Lista de parametros por recibir
                            $box = new Storer($fields,true);
                            if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                            $sql = "Call id_cliente('"$x->id"');";
                            $cuerpo = peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break; 

                    case 'modifica_clientes':
                        $fields = array("nick","token","Id","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_actualizar($x->nick,$x->token,RH['base'],"clientes","Id_Cliente",$x->Id,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                        default:
                        $cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;

            case 'put':
                switch ($peticion) {
                    case 'crea_clientes':
                        $fields = array("nick","token","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->Usuario = $_rfc;                         
                        
                        return "come popo rapido ssss";//peticion_insertar($x->nick, $x->token, RH['base'], "clientes",$x->datos, $GLOBALS['modulo'],  $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;
            case 'delete':
                switch ($peticion) {
                    case 'elimina_clientes':
                        $fields = array("nick","token","Id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_eliminar($x->nick, $x->token, RH['base'], "clientes","Id_Cliente", $x->Id, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = PETICION_INVALIDA;
                        break;
                }
                break;
                break;
            default:
                $cuerpo = METODO_NO_PERMITIDO;
                break;
        }
        return $cuerpo;
    }
    
}


?>