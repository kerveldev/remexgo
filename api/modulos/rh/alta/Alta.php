<?php
 
 class altas{
 	private $cuerpo = array();
    private $nave = NULL;	
 	
 	static public function recurso($peticion)
 	{

 		switch ($GLOBALS['metodo']) {
 			case 'post':

 				switch ($peticion) {

                    case'navegantes_lst':

                        $fields = array("nick","token");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick
                        $sql = "CALL usuarios_lst()";
                        //return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);
                        return "Hola";

					break;

 					default:
 						// No existe la peticion
	                    $cuerpo = PETICION_INVALIDA;
 					break;
 				}
 				
 				break;
 			
 			case 'put':
 				switch ($peticion) {
 					
 					
 					default:
 						// No existe la peticion
 						$cuerpo = PETICION_INVALIDA;
 						break;
 				}
 				break;

 			case 'delete':
 				switch ($peticion) {

 					case 'elimina':
						$fields = array("nick","token","rfc");// Lista de parametros por recibir
						$box = new Storer($fields);
						if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

						return peticion_eliminar($x->nick, $x->token, RH['base'], "ke_altas","RFC", $x->rfc,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
							
						break;
                		
 					default:
 						//No existe la peticion
 						$cuerpo = PETICION_INVALIDA;
 						break;
 				}
 				
 				break;
 			default:
 				// Metodo no aceptado
                $cuerpo = METODO_NO_PERMITIDO;
 				break;
 		}
 		return $cuerpo;
 	}
 }

?>