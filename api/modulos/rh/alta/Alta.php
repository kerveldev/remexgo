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
                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);


					break;

					case'lst_regiones':
                        $fields = array("nick","token");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL regimss_lst();";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion); 
					break;

					case'lst_entidades_region':
                        $fields = array("nick","token","Region");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL regimss_entidades_idRI('".$x->Region."');";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion); 
					break;


					case'act_grales_elemento':
                        $fields = array("nick","token","Id_Perfil","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
						if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

						$_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
						$x->datos->Usuario_Cap = $_rfc;

						$sql = "CALL act_grales_elemento('".$x->datos->Id_Elemento."',
														 '".$x->datos->APaterno."',
														 '".$x->datos->AMaterno."',
														 '".$x->datos->Nombre."',
														 '".$x->datos->EntidadNac."',
														 '".$x->datos->MpioNac."',
														 '".$x->datos->Nacionalidad."',
														 '".$x->datos->FNacimiento."',
														 '".$x->datos->CURP."',
														 '".$x->datos->SexoElmento."',
														 '".$x->datos->TipoSangre."',
														 '".$x->datos->EdoCivilElemento."',
														 '".$x->datos->Calle."',
														 '".$x->datos->Numero."',
														 '".$x->datos->NInterior."',
														 '".$x->datos->CP."',
														 '".$x->datos->Colonia."',
														 '".$x->datos->Mpio."',
														 '".$x->datos->DomEntidadElemento."',
														 '".$x->datos->Tel."',
														 '".$x->datos->Cel."',
														 '".$x->datos->RFC."',
														 '".$x->datos->NERH."',
														 '".$x->datos->FInicioTramite."',
														 '".$x->datos->NSS."',
														 '".$x->datos->Licencia."',
														 '".$x->datos->EdoAdmtvo."',
														 '".$x->datos->TLS."',
														 '".$x->datos->NumVolante."',
														 '".$x->datos->FInscripcion."',
														 '".$x->datos->CUIP."',
														 '".$x->datos->Solicitud_Empleo."',
														 '".$x->datos->Acta_Nacimiento."',
														 '".$x->datos->Comprobante_Estudios."',
														 '".$x->datos->Ant_nPenales."',
														 '".$x->datos->R_Personales."',
														 '".$x->datos->R_Laborales."',
														 '".$x->datos->Baja_Laboral."',
														 '".$x->datos->Cartilla_Militar."',
														 '".$x->datos->C_Medico."',
														 '".$x->datos->Alta_IMSS."',
														 '".$x->datos->D_CURP."',
														 '".$x->datos->INE."',
														 '".$x->datos->RFC_Elemento."',
														 '".$x->datos->Ret_infonavit."',
														 '".$x->datos->Reconocimientos."',
														 '".$x->datos->Licencia_manejo."',
														 '".$x->datos->Observaciones_doc."',
														 '".$x->datos->SE_fecha."',
														 '".$x->datos->SE_resultado."',
														 '".$x->datos->SE_observacion."',
														 '".$x->datos->EMedico_fecha."',
														 '".$x->datos->EMedico_hora."',
														 '".$x->datos->Medico_resultado."',
														 '".$x->datos->EM_IMSS."',
														 '".$x->datos->EM_VDRL."',
														 '".$x->datos->EM_Peso."',
														 '".$x->datos->EM_Estatura."',
														 '".$x->datos->EM_Sanguineo."',
														 '".$x->datos->EM_observacion."',
														 '".$x->datos->EFA_fecha."',
														 '".$x->datos->EFA_hora."',
														 '".$x->datos->EFA_resultado."',
														 '".$x->datos->EFA_observacion."',
														 '".$x->datos->EP_fecha."',
														 '".$x->datos->EP_hora."',
														 '".$x->datos->EP_resultado."',
														 '".$x->datos->Check_DHF."',
														 '".$x->datos->E_DHF."',
														 '".$x->datos->Check_BENDER."',
														 '".$x->datos->E_BENDER."',
														 '".$x->datos->Check_RAVEN."',
														 '".$x->datos->E_RAVEN."',
														 '".$x->datos->Check_MMPI2."',
														 '".$x->datos->E_MMPI2."',
														 '".$x->datos->EP_observacion."',
														 '".$x->datos->ETX_fecha."',
														 '".$x->datos->ETX_hora."',
														 '".$x->datos->ETX_resultado."',
														 '".$x->datos->ETX_observacion."',
														 '".$x->datos->C_fecha."',
														 '".$x->datos->C_hora."',
														 '".$x->datos->C_resultado."',
														 '".$x->datos->C_observacion."',
														 '".$x->datos->ANSS."'														 
														);";

						$f = peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
						
						if($f['status'] == true){
							
							$y = array();
							$perfiles = $x->Id_Perfil;
							// print_r($perfiles);
							$y['datos']['Id_Elemento']=$x->datos->Id_Elemento;
							$y['datos']['RFC']=$x->datos->RFC;
							$y['datos']['Usuario_Cap']=$_rfc;
							
							for($i = 0; $i< sizeof($perfiles); $i++ ){
								
								$y['datos']['Id_Perfil'] = $perfiles[$i];
								
								$resultado=  peticion_insertar($x->nick, $x->token, SERVICIOS['base'], "elemento_perfil", $y['datos'], $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
							}
						}
						else{
							print_r($f);
						}						
						return $resultado;
					break;

					case'lst_generales':
                        $fields = array("nick","token","valor");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL generales_x_base_aspirante('".$x->valor."');";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion); 
					break;
					
					case'expediente_elemento_x_id':
                        $fields = array("nick","token","id");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL expediente_elemento_x_id('".$x->id."');";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                    break;

                    case'elemento_x_id':
                        $fields = array("nick","token","Id_Elemento");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL buscar_elemento_id_elemento('".$x->Id_Elemento."');";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                    break;

                    case'cat_municipios_x_id':
                        $fields = array("nick","token","Id_Entidad");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $sql = "CALL mun_x_id_entidad('".$x->Id_Entidad."');";

                        return peticion_estandar($x->nick, $x->token, RH['base'], $sql, $GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
                    break;


                    case'elemento_act':
                        $fields = array("nick","token","Id_Elemento","datos");// Lista de parametros por recibir
                        $box = new Storer($fields);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $_id_elemento = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->Usuario= $_id_elemento; 

                        return peticion_actualizar($x->nick,$x->token,RH['base'],"ke_generales","Id_Elemento",$x->Id_Elemento,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
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