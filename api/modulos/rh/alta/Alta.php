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
                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $peticion, $peticion);

                    break;
                    
                    case'navegante_id':

                        $fields = array("nick","token","Id_Elemento");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        $sql = "CALL navegante_id('$x->Id_Elemento');";
                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $peticion, $peticion);
                        
					break;

					case 'modifica_navegantes':
                        $fields = array("nick","token","Id","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        
                        return peticion_actualizar($x->nick,$x->token,RH['base'],"ke_generales","Id_Elemento",$x->Id,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                        break;

 					default:
 						// No existe la peticion
	                    $cuerpo = PETICION_INVALIDA;
 					break;
 				}
 				
 				break;
 			
 			case 'put':
 				switch ($peticion) {
					case 'crea_usuario':
								$fields = array("nick","token","datos");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

								// Estructura de la respuesta
								$resp = array();
								$_id_elemento = getUser($x->nick);

								// Se valida el usuario
								$uchk = logger::UserCheck($x->nick, $x->token);
								if($uchk['status_sesion']==FALSE){return $uchk;}


								
								// Se conecta a la base de datos
								$nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
								if($nave->conectado==TRUE){
									
									$sql = "CALL inserta_usuario('"
									.$x->datos->FIngreso."','"
									.$x->datos->NoEmp_RH."','"
									.$x->datos->RFC."','"
									.$x->datos->CURP."','"
									.$x->datos->APaterno."','"
									.$x->datos->AMaterno."','"
									.$x->datos->Nombre."','"
									.$x->datos->FNacimiento."','"
									.$x->datos->Nacionalidad."','"
									.$x->datos->Entidad."','"
									.$x->datos->MunicipioNac."','"
									.$x->datos->Genero."','"
									.$x->datos->TipoSangre."','"
									.$x->datos->EdoCivil."','"
									.$x->datos->Email."','"
									.$x->datos->Tel."','"
									.$x->datos->Cel."','"
									.$x->datos->OtroTel."','"
									.$x->datos->Calle."','"
									.$x->datos->Num."','"
									.$x->datos->NInterior."','"
									.$x->datos->CP."','"
									.$x->datos->Cruce1."','"
									.$x->datos->Cruce2."','"
									.$x->datos->Colonia."','"
									.$x->datos->Estado."','"
									.$x->datos->Municipio."','"
									.$_id_elemento.
									"');";

									$t = $nave->consultaSQL_asociativo($sql);
					
									if ($t['status']==TRUE){
										$cuerpo['status']=$t['status'];
										$cuerpo['status_sesion']=$uchk['status_sesion'];
										$cuerpo['msj']= "Registro creados con exito. Historial guardado. ";
										$cuerpo['data']= NULL;

										return $cuerpo;
									}else{
										$cuerpo['status']=$t['status'];
										$cuerpo['status_sesion']=$uchk['status_sesion'];
										$cuerpo['msj']= "Registro creados sin exito. Historial guardado. ";
										$cuerpo['data']= NULL;
										
										return $cuerpo;
									}

								}else{
									$cuerpo['status'] = FALSE;
									$cuerpo['status_sesion'] = $uchk['status_sesion'];
									$cuerpo['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
									$cuerpo['data'] = NULL;

									return $cuerpo;
								}
								
								//peticion_estandar($_nick, $_token, $_bd, $_sql, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL)
								//$nombre_carpeta = USUARIOS['ruta'].$x->datos->RFC;
								//return peticion_insertar_carpeta($x->nick, $x->token, USUARIOS['base'], "navegantes",$x->datos, $nombre_carpeta, $GLOBALS['modulo'], $recurso, $recurso);
					                    
							break;
 					
 					
 					default:
 						// No existe la peticion
 						$cuerpo = PETICION_INVALIDA;
 						break;
 				}
 				break;

 			case 'delete':
 				switch ($peticion) {

 					case 'elimina_usuario':
						$fields = array("nick","token","Id");// Lista de parametros por recibir
						$box = new Storer($fields);
						if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

						return peticion_eliminar($x->nick, $x->token, RH['base'], "ke_generales","Id_Elemento", $x->Id,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
							
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