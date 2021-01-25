<?php  
error_reporting(E_ALL);
ini_set('display_errors', '1'); 

class mpusuarios{

  private $cuerpo = array();
  private $nave = NULL;

  static public function recurso($peticion) {
    //$nave = new nauta(IREK,MPUSUARIOS['base'],MPUSUARIOS['ruta']);

    switch ($GLOBALS['metodo']) {
      case 'post':
        switch ($peticion) {
          case 'navegantes_mp_lst':
            $fields = array("nick","token");// Lista de parametros por recibir
            $box = new Storer($fields);
            if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
            $sql = "CALL usuarios_mp_lst();";

            $cuerpo = peticion_estandar($x->nick, $x->token, MPUSUARIOS['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
          break;
        } 
      break;

      case 'put':
        switch ($peticion) {
          case 'nvo_user_mp':
            $fields = array("nick","token","datos");// Lista de parametros por recibir
            $box = new Storer($fields);
          if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

          $sql = "CALL inserta_usuario_mp('" . 
              $x->datos->RFC          . "', '" . 
              $x->datos->Apaterno     . "', '" . 
              $x->datos->Amaterno     . "', '" . 
              $x->datos->Nombre       . "', '" . 
              $x->datos->Nombramiento . "', '" . 
              $x->datos->U_Fisica     . "', '" . 
              $x->datos->Niv_acceso   . "', '" . 
              $x->datos->Nick         . "', '" . 
              $x->datos->Pasword      . "', '" . 
              $x->datos->Status       . "', '" . 
              $x->datos->Usuario      . "'" . 
          ");";

          $cuerpo = peticion_estandar($x->nick, $x->token, MPUSUARIOS['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
            
          //return peticion_insertar($x->nick, $x->token, MPUSUARIOS['base'], "navegantes", (array)$x->datos, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);

          break;
          
          default:
            // No existe la peticion
            $cuerpo = PETICION_INVALIDA;
          break;
        }
      break;

      case 'delete':
        switch ($peticion) {

          case 'eliminar_usurio_mp':
            $fields = array("nick","token","RFC");// Lista de parametros por recibir
            $box = new Storer($fields);
            if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

            return peticion_eliminar($x->nick, $x->token, MPUSUARIOS['base'], "navegantes","RFC", $x->RFC,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
              
            break;
                    
          default:
            //No existe la peticion
            $cuerpo = PETICION_INVALIDA;
            break;
        }
      break;
    }
    
    return $cuerpo;
  }
}
?>