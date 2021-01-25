<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 class upload{
 	private $cuerpo = array();
    private $nave = NULL;	
 	
 	static public function recurso($peticion)
 	{

 		switch ($GLOBALS['metodo']) {
 			case 'post':

 				switch ($peticion) {

					case 'visualiza_csv':
		    	        $fields = array("nick","token");// Lista de parametros por recibir
	                    $box = new Storer($fields,true);
                        if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
                        $uchk = logger::UserCheck($x->nick, $x->token);
                        if($uchk['status']==TRUE){
                            
                            $fila = 1;
                            $cadena = "";
							$csv = array();
							
                            if (($gestor = fopen($_FILES['archivo_csv']['tmp_name'], "r")) !== FALSE) {
                                while (($datos = fgetcsv($gestor, 5000,',','"')) !== FALSE) {
                                    
                                    if($fila==1){// Nombres de los campos en la BD
                                        $csv['cabecera'] = $datos;
                                    }else{// Datos de los campos
                                        for ($c=0; $c < count($datos); $c++) {
                                           $csv['campos'][$fila-1][$c] =  utf8_encode($datos[$c]);
                                        }
                                    }
                                    
                                    $fila++;

                                }
                                fclose($gestor);
                            }
                            
                            $cuerpo['status'] = TRUE;
                            $cuerpo['msj'] = $uchk['msj'];
                            $cuerpo['data'] = $csv;
                        }else{
                            $cuerpo['status'] = $uchk['status'];
                            $cuerpo['msj'] = $uchk['msj'];
                            $cuerpo['data'] = NULL;
                        }
                        
					break; 
					
					case 'procesa_csv':
		    	        $fields = array("nick","token");// Lista de parametros por recibir
	                    $box = new Storer($fields,true);
						if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
						
                        $uchk = logger::UserCheck($x->nick, $x->token);
                        if($uchk['status']==TRUE){
                            $nauta = new nauta(IREK,UPLOAD['base']);
                            $fila = 1;
							$columnas_tabla = [
								"Id_ARS",
								"IPH",
								"Id_CEINCO",
								"Fecha",
								"Hora",
								"id_Motivo",
								"Incidente",
								"Actualizado",
								"Sector",
								"Cuadrante",
								"Calle",
								"Num_ext",
								"Num_int",
								"Cruces",
								"Colonia",
								"Longitud_repo",
								"Latitud_repo",
								"Descripcion",
								"Narrativa",
								"ARS_link",
								"UnidadPR",
								"InstrArribo"
							];
							$csv = array();
							$csv_error = array();
							$res_proc = array();
							$res_proc['exitosos'] = NULL;
							$res_proc['erroneos'] = NULL;
							$st_final = TRUE;
							// Al procesar el archivo siempre se va a omitir la primera fila del mismo, al suponerse que en ésta
							// estan los encabezados de columna o titulos
                            if (($gestor = fopen($_FILES['archivo_csv']['tmp_name'], "r")) !== FALSE) {
								while (($datos = fgetcsv($gestor, 5000,',','"')) !== FALSE) {
									if($fila==1){
										// Numero de columnas correctos --------------------------
										if(count($datos)<>count($columnas_tabla)){
											return $cuerpo= [
												'status'=> FALSE,
												'msj'=>'No se puede procesar el archivo, cantidad de columnas erroneas. Deben ser '.count($columnas_tabla). ', en archivo hay '.count($datos),
												'data'=>NULL];
										}// ------------------------------------------------------

										// Nombres de columnas correctos -------------------------
										$st = TRUE;
										$error_cols = "";

										foreach ($datos as $k => $v) {
											if(in_array($v,$columnas_tabla)){
												$csv[0][$v] = NULL;
											}else{
												$error_cols.='['.$v.']';
												$st = FALSE;
											}
										}

										if(!$st){										
											return $cuerpo= [
												'status'=> FALSE,
												'msj'=>'No se puede procesar el archivo, error en el nombre de las columnas: '.$error_cols,
												'data'=>NULL];
										}// ------------------------------------------------------

										// Si los nombres de columnas son correctos tendremos al final un arreglo $csv['nomb_columna']
										

									}else{
										$csv_error = $csv;

										// Numero de columnas correctos --------------------------
										if(count($datos)<>count($columnas_tabla)){
											$csv_error[$fila-2] = $datos;
											$csv_error[$fila-2]['error'] = TRUE;
											$csv_error[$fila-2]['fila'] = $fila;
											$st_final = FALSE;
											return $cuerpo= [
												'status'=> FALSE,
												'msj'=>'No se puede procesar el archivo, numero columnas no corresponde. ',
												'data'=>$csv_error
											];
										}else{
											
											$csv[$fila-2]['Id_ARS']=utf8_encode($datos[0]);
											$csv[$fila-2]['IPH']=utf8_encode($datos[1])."-".date("y");
											$csv[$fila-2]['Id_CEINCO']=utf8_encode($datos[2]);
											//Se verifica la fecha y del formato (dd/mm/aaaa) lo convierte a (aaaa-mm-dd)
											$f = explode("/",utf8_encode($datos[3]));
											if(strlen($f[0])==2){	
												$csv[$fila-2]['Fecha']=$f[2]."-".$f[1]."-".$f[0];
											}elseif(strlen($f[0])==4){
												$csv[$fila-2]['Fecha']=$f[0]."-".$f[1]."-".$f[2];
											}
											$csv[$fila-2]['Hora']=utf8_encode($datos[4]);
											$csv[$fila-2]['id_Motivo']=utf8_encode($datos[5]);
											$csv[$fila-2]['Incidente']=utf8_encode($datos[6]);
											$csv[$fila-2]['Actualizado']=utf8_encode($datos[7]);
											$csv[$fila-2]['Sector']=utf8_encode($datos[8]);
											$csv[$fila-2]['Cuadrante']=utf8_encode($datos[9]);
											$csv[$fila-2]['Calle']=utf8_encode($datos[10]);
											$csv[$fila-2]['Num_ext']=utf8_encode($datos[11]);
											$csv[$fila-2]['Num_int']=utf8_encode($datos[12]);
											$csv[$fila-2]['Cruces']=utf8_encode($datos[13]);
											$csv[$fila-2]['Colonia']=utf8_encode($datos[14]);
											$csv[$fila-2]['Longitud_repo']=utf8_encode($datos[15]);
											$csv[$fila-2]['Latitud_repo']=utf8_encode($datos[16]);
											$csv[$fila-2]['Descripcion']=utf8_encode($datos[17]);
											$csv[$fila-2]['Narrativa']=utf8_encode($datos[18]);
											$csv[$fila-2]['ARS_link']=utf8_encode($datos[19]);
											$csv[$fila-2]['UnidadPR']=utf8_encode($datos[20]);
											$csv[$fila-2]['InstrArribo']=utf8_encode($datos[21]);
											$st_final = TRUE;

										}// ------------------------------------------------------
									}
									
									$fila++;
								}
								if($st_final){
									// Se guardan las filas en la base de datos en caso de error se guardan
									// en el arreglo de errores
									$ex = 0;
									$er = 0;
									foreach ($csv as $key => $value) {
										$r = $nauta->insertar('ad_concentrador_iph',$value);
										if($r['status']==FALSE){
											$res_proc['erroneos'][$er]['Id_ARS']=$value['Id_ARS'];
											$res_proc['erroneos'][$er]['IPH']=substr($value['IPH'], 0, -3);
											$res_proc['erroneos'][$er]['Id_CEINCO']=$value['Id_CEINCO'];
											$res_proc['erroneos'][$er]['Fecha']=$value['Fecha'];
											$res_proc['erroneos'][$er]['Hora']=$value['Hora'];
											$res_proc['erroneos'][$er]['id_Motivo']=$value['id_Motivo'];
											$res_proc['erroneos'][$er]['Incidente']=$value['Incidente'];
											$res_proc['erroneos'][$er]['Actualizado']=$value['Actualizado'];
											$res_proc['erroneos'][$er]['Sector']=$value['Sector'];
											$res_proc['erroneos'][$er]['Cuadrante']=$value['Cuadrante'];
											$res_proc['erroneos'][$er]['Calle']=$value['Calle'];
											$res_proc['erroneos'][$er]['Num_ext']=$value['Num_ext'];
											$res_proc['erroneos'][$er]['Num_int']=$value['Num_int'];
											$res_proc['erroneos'][$er]['Cruces']=$value['Cruces'];
											$res_proc['erroneos'][$er]['Colonia']=$value['Colonia'];
											$res_proc['erroneos'][$er]['Longitud_repo']=$value['Longitud_repo'];
											$res_proc['erroneos'][$er]['Latitud_repo']=$value['Latitud_repo'];
											$res_proc['erroneos'][$er]['Descripcion']=$value['Descripcion'];
											$res_proc['erroneos'][$er]['Narrativa']=$value['Narrativa'];
											$res_proc['erroneos'][$er]['ARS_link']=$value['ARS_link'];
											$res_proc['erroneos'][$er]['UnidadPR']=$value['UnidadPR'];
											$res_proc['erroneos'][$er]['InstrArribo']=$value['InstrArribo'];
											$res_proc['erroneos'][$er]['Error']=$r['msj'];
											
											$er++;
										}else{
											$res_proc['exitosos'][$ex]['Id_ARS']=$value['Id_ARS'];
											$res_proc['exitosos'][$ex]['IPH']=$value['IPH'];
											$res_proc['exitosos'][$ex]['Id_CEINCO']=$value['Id_CEINCO'];
											$res_proc['exitosos'][$ex]['Fecha']=$value['Fecha'];
											$res_proc['exitosos'][$ex]['Hora']=$value['Hora'];
											$res_proc['exitosos'][$ex]['id_Motivo']=$value['id_Motivo'];
											$res_proc['exitosos'][$ex]['Incidente']=$value['Incidente'];
											$res_proc['exitosos'][$ex]['Actualizado']=$value['Actualizado'];
											$res_proc['exitosos'][$ex]['Sector']=$value['Sector'];
											$res_proc['exitosos'][$ex]['Cuadrante']=$value['Cuadrante'];
											$res_proc['exitosos'][$ex]['Calle']=$value['Calle'];
											$res_proc['exitosos'][$ex]['Num_ext']=$value['Num_ext'];
											$res_proc['exitosos'][$ex]['Num_int']=$value['Num_int'];
											$res_proc['exitosos'][$ex]['Cruces']=$value['Cruces'];
											$res_proc['exitosos'][$ex]['Colonia']=$value['Colonia'];
											$res_proc['exitosos'][$ex]['Longitud_repo']=$value['Longitud_repo'];
											$res_proc['exitosos'][$ex]['Latitud_repo']=$value['Latitud_repo'];
											$res_proc['exitosos'][$ex]['Descripcion']=$value['Descripcion'];
											$res_proc['exitosos'][$ex]['Narrativa']=$value['Narrativa'];
											$res_proc['exitosos'][$ex]['ARS_link']=$value['ARS_link'];
											$res_proc['exitosos'][$ex]['UnidadPR']=$value['UnidadPR'];
											$res_proc['exitosos'][$ex]['InstrArribo']=$value['InstrArribo'];
											
											$ex++;
										}
										
									}
									$mensaje = "Archivo procesado. Exitosos = ".count($res_proc['exitosos']).". Erroneos = ".count($res_proc['erroneos']);
										
									return $cuerpo= [
										'status'=> TRUE,
										'msj'=>$mensaje,
										'data'=>$res_proc
									];
								}else{
									return $cuerpo= [
										'status'=> FALSE,
										'msj'=>'No se puede procesar el archivo. Estas filas estan mal.',
										'data'=>$csv_error
									];
								}
								
								fclose($gestor);
								$cuerpo['status'] = TRUE;
                            	$cuerpo['msj'] = "El archivo ha sido procesado.";
                            	$cuerpo['data'] = $csv;
                            }else{
								$cuerpo['status'] = FALSE;
								$cuerpo['msj'] = "No se ha podido procesar el archivo.";
								$cuerpo['data'] = NULL;
							}
                            
                            
                        }else{
                            $cuerpo['status'] = $uchk['status'];
                            $cuerpo['msj'] = $uchk['msj'];
                            $cuerpo['data'] = NULL;
                        }
                        
		    	    break; 

 					default:
 						// No existe la peticion
	                    $cuerpo = PETICION_INVALIDA;
 						break;
 				}
 				
 				break;
 			
 			case 'put':
 			
 				switch ($peticion) {

 					case 'crea':

						$fields = array("nick","token","folios","datos");// Lista de parametros por recibir
						$box = new Storer($fields);
						if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion
						$_rfc = getUser($x->nick);// Se obtiene el rfc apartir del nick para agregar campo usuario 
                        $x->datos->UsuarioCrea = $_rfc; 
                        $cap = array();
                        $valida = array();

                        $cap = explode(",", $x->folios);  
						$fin = count($cap);
                            
                            for($y=0;$y<$fin;$y++){
                                        
                                $x->datos->RFC = $cap[$y];
                                $r =peticion_insertar($x->nick, $x->token, RH['base'], "ke_renovaciones",$x->datos, $GLOBALS['modulo'],  $GLOBALS['recurso'], $peticion);

                            }
                            
                        return  $r; 
                            			
					break;
 					
 					default:
 						// No existe la peticion
 						$cuerpo = PETICION_INVALIDA;
 						break;
 				}
 				break;

 			case 'delete':
 			    switch ($peticion){
 			       	case 'elimina':
 			        	$fields = array("nick","token","Id_Renovacion");// Lista de parametros por recibir
					 	$box = new Storer($fields);
					 	if(empty($x = $box->stocker)){return $cuerpo = FALTAN_PARAMETROS;}// Si retorna null sale de la peticion

						return peticion_eliminar($x->nick, $x->token, RH['base'], "ke_renovaciones","Id_Renovacion", $x->Id_Renovacion,$GLOBALS['modulo'], $GLOBALS['recurso'], $GLOBALS['recurso']);
							
 			     		
 			     	break;	
 			default:
 			   //Peticion no aceptada
 			   $cuerpo = PETICION_INVALIDA;     
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