<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class logger{
    private $cuerpo = NULL;

    public static function control($recurso,$metodo){
        $nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
        // Primero se obtienen las variables para procesar las distintas peticiones de esta clase ('multipart/form-data')
        $_nick = NULL;
        $_pass = NULL;
        $_token = NULL;
        
        	switch($metodo){
	        	case 'post':
				        switch($recurso){


							case 'login':
									$fields = array("nick","pass");// Lista de parametros por recibir
									$box = new Storer($fields);
									if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
									$cuerpo = self::Login($x->nick, $x->pass);
					            break;

							case 'scheck':
									$fields = array("nick","token");// Lista de parametros por recibir
									$box = new Storer($fields);
									if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
									$cuerpo = self::UserCheck($x->nick, $x->token);
					            break;

							case 'logout':
									$fields = array("nick");// Lista de parametros por recibir
									$box = new Storer($fields);
									if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
					                $cuerpo = self::Logout($x->nick);
					            break;

							/*listado ke Generales Modulo Sistema De Usuarios*/
							case 'navegantes_lst':
								$fields = array("nick","token");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
								$_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick
								$sql = "CALL usuarios_lst()";
								return peticion_estandar($x->nick, $x->token, USUARIOS['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);
							break;

							/*Usuario ke_generales Por ID Modulo Sistema De Usuarios*/	
							case 'navegante_id':
								$fields = array("nick","token","Id_Elemento");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
								
								$sql = "CALL navegante_id('$x->Id_Elemento');";
								return peticion_estandar($x->nick, $x->token, USUARIOS['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);
								
							break;

							case 'modifica_navegantes':
								$fields = array("nick","token","Id","datos");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
								
								return peticion_actualizar($x->nick,$x->token,RH['base'],"ke_generales","Id_Elemento",$x->Id,(array)$x->datos,$GLOBALS['modulo'], $GLOBALS['recurso'], $peticion);
							break;
		

							case 'act_nick_pass':
								$fields = array("nick","token","Id_Elemento","nick_mod","pass");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
									
								$sql = "Select cambiar_pass_x_id('$x->Id_Elemento','$x->pass','$x->nick_mod');";
								return peticion_estandar($x->nick, $x->token, USUARIOS['base'], $sql, $GLOBALS['modulo'], $recurso, $recurso);
								

							break;   
							
						
              	

							default:
								$cuerpo['status']=FALSE;
								$cuerpo['status_sesion']=NULL;
								$cuerpo['msj']="No existe <$recurso>";
								$cuerpo['data'] = NULL;
				        }

                	break;

                case 'put':
                	switch ($recurso) {
						case 'crea_usuario':
								$fields = array("nick","token","datos");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
								if(is_null($x->datos->RFC)){return $cuerpo = FALTAN_PARAMETROS;}
								if(is_null($x->datos->Nick)){return $cuerpo = FALTAN_PARAMETROS;}
								if(is_null($x->datos->Pasword)){return $cuerpo = FALTAN_PARAMETROS;}

								// Estructura de la respuesta
								$resp = array();
								$_rfc = NULL;

								// Se obtiene el rfc a partir del nick
								if(empty($_rfc= getUser($x->nick))){
									$resp['status']=FALSE;
									$resp['msj']='Nombre de usuario incorrecto -peticion insertar carpeta.';
									$resp['data']=NULL;
									return $resp;
								}

								// Se valida el usuario
								$uchk = logger::UserCheck($x->nick, $x->token);
								if($uchk['status_sesion']==FALSE){return $uchk;}
								

								// Se conecta a la base de datos
								$nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
								
								if($nave->conectado==TRUE){
									//"RFC", "Apaterno", "Amaterno", "Nombre", "Nombramiento", "Nick", "Pasword", "Email", "Status", "Niv_acceso"  
									$sql = "CALL inserta_usuario('"
									.$x->datos->RFC."','"
									.$x->datos->Apaterno."','"
									.$x->datos->Amaterno."','"
									.$x->datos->Nombre."','"
									.$x->datos->Nick."','"
									.$x->datos->Pasword."','"
									.$x->datos->Email."','"
									.$x->datos->Status."','"
									.$x->datos->Niv_acceso."','"
									.$_rfc."');";

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
                			$cuerpo['status']=FALSE;
					        $cuerpo['status_sesion']=NULL;
					        $cuerpo['msj']="No existe <$recurso>";
					        $cuerpo['data'] = NULL;
                	}
                	break;
				    	
				case 'delete':
				    switch ($recurso) {
						case 'elimina_usuario':
								$fields = array("nick","token","rfc");// Lista de parametros por recibir
								$box = new Storer($fields);
								if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
								
								$nombre_carpeta = USUARIOS['ruta'].$x->rfc;
								return peticion_eliminar_carpeta($x->nick, $x->token, USUARIOS['base'], "navegantes","RFC", $x->rfc,$nombre_carpeta,$GLOBALS['modulo'], $recurso, $recurso);
							
							break;

					
					    default:
		                			$cuerpo['status']=FALSE;
					                $cuerpo['status_sesion']=NULL;
					                $cuerpo['msj']="No existe <$recurso>";
					                $cuerpo['data'] = NULL;
	                }
	            
	            break;
	            
	            default:
	            $cuerpo['status']=FALSE;
	            $cuerpo['status_sesion'] = NULL;
	            $cuerpo['msj'] = "Metodo <$metodo> no admitido.";
	            $cuerpo['data'] = NULL;
		        
		    }
        

        return $cuerpo;

	}


	/******************************************************************************
	 * ***************** Metodos de la clase **************************************
	 ******************************************************************************/


	// Logea al usuario segun el nick y pass
	public static function Login($_nick, $_pass){
		$resp = array();
		$nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
		$sql = "CALL login('".$_nick."','".$_pass."');";
		$t = $nave->consultaSQL_asociativo($sql);
		// Si la consulta fue un exito
		if($t['status']==TRUE){
			$r = $t['data'][0];                
			// Si el acceso es autorizado
			if($r['status']==TRUE){
				$resp['status']=$r['status'];
				$resp['status_sesion']=TRUE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
			}else{
				$resp['status']=$r['status'];
				$resp['status_sesion']=FALSE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
			}               
		}else{
			$resp['status']=$t['status'];
			$resp['status_sesion']=FALSE;
			$resp['msj'] = $t['msj'];
			$resp['data']=NULL;
		}
		return $resp;
	}

	// Checa si el usuario tiene un token de sesion
	public static function UserCheck($_nick, $_token){
		$resp = array();

		$nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
		$sql = "CALL checkuser('$_nick','$_token');";
		$t = $nave->consultaSQL_asociativo($sql);

		// Si la consulta fue un exito
		if($t['status']==TRUE){
			$r = $t['data'][0];
			// Si el acceso es autorizado
			if($r['status']==TRUE){
				$resp['status']=$r['status'];
				$resp['status_sesion']=TRUE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
			}else{
				$resp['status']=$r['status'];
				$resp['status_sesion']=FALSE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
			}
		}else{
			$resp['status']=$t['status'];
			$resp['status_sesion']=FALSE;
			$resp['msj'] = $t['msj'];
			$resp['data']=NULL;
		}
		return $resp;
	}

	// Finaliza la sesion del usuario
	public static function Logout($_nick){
		$resp = array();
		$nave = new nauta(IREK,USUARIOS['base'], USUARIOS['ruta']);
		$sql = "CALL logout('$_nick');";
		$t = $nave->consultaSQL_asociativo($sql);

		// Si la consulta fue un exito
		if($t['status']==TRUE){
			$r = $t['data'][0];
			// Logout exitoso
			if($r['status']==TRUE){
				$resp['status']=$r['status'];
				$resp['status_sesion']=FALSE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
					                                    
			}else{
				$resp['status']=$r['status'];
				$resp['status_sesion']=FALSE;
				$resp['msj'] = $r['msj'];
				$resp['data'] = $r;
			}
					                                
		}else{
			$resp['status']=$t['status'];
			$resp['status_sesion']=FALSE;
			$resp['msj'] = $t['msj'];
			$resp['data']=NULL;
		}
		return $resp;
	}

	
	
}// Fin de la clase
?>