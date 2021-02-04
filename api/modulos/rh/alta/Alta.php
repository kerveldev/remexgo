<?php
class alta {
    private $cuerpo = array();
    private $nave = NULL;

    static public function recurso($peticion){

        $nave = new nauta(IREK,RH['base'],RH['ruta']);
        switch($GLOBALS['metodo']){
            case 'post':
                switch ($peticion) {

                    /*listado ke Generales Modulo Sistema De Usuarios*/
                    case 'navegantes_lst':
                        $fields = array("nick","token");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick
                        $sql = "CALL usuarios_lst()";
                        return peticion_estandar($x->nick, $x->token, USUARIOS['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);
                    break;

                    case 'modifica_elemento':
                        $fields = array("nick","token","Id_Elemento","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_actualizar($x->nick,$x->token,RH['base'],"ke_generales","Id_Elemento",$x->Id_Elemento,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

                    default:
                        $cuerpo = PETICION_INVALIDA;
                   
                }
                break;

            case 'put':
                switch ($peticion) {
                    case 'crea_elemento':
                        $fields = array("nick","token","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->Usuario = $_rfc;                         
                        
                        return peticion_insertar($x->nick, $x->token, RH['base'], "ke_generales",$x->datos, $GLOBALS['modulo'],  $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = PETICION_INVALIDA;
                }
                break;
            case 'delete':
                switch ($peticion) {
                    case 'elimina_elemento':
                        $fields = array("nick","token","Id_Elemento");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_eliminar($x->nick, $x->token, RH['base'], "ke_generales","Id_Elemento", $x->Id, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;
                    
                    default:
                        $cuerpo = PETICION_INVALIDA;
                    break;
                }
                break;
            default:
            $cuerpo = METODO_NO_PERMITIDO;
        }
        return $cuerpo;
    }
    
}


?>