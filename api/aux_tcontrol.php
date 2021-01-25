<?php


/***************************
 *	Guardar una peticion   *
 ***************************/
/* Almacena una peticion en el historial de peticiones.
 * Parametros:
 * - id = Id del usuario (RFC)
 * - modulo: Departamento o area.
 * - recurso: Seccion del modulo sobre la que se trabaja.
 * - peticion: Accion a realizar en esa seccion.
 * - peticion_detalle: (Explicacion breve de la accion ejecutada).
 *
 * La fecha y hora son las del servidor
*/
function guarda_peticion_historial($_id_elemento,$_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL){
    $rz = [
       'status' => FALSE,
       'msj' => "Error al conectar con la base datos -guarda peticion historial. ",
       'data' => NULL
    ];
   $voyager = new nauta(IREK,USUARIOS['base']);

   if($voyager->conectado==TRUE){
       // Se verifican los parametros
       if(empty($_id_elemento)){$rz['msj']="Error -Id_Elemento. ";return $rz;}
       if(empty($_modulo)){$rz['msj']="Error -Modulo. ";return $rz;}
       if(empty($_recurso)){$rz['msj']="Error -Recurso. ";return $rz;}
       if(empty($_peticion)){$rz['msj']="Error -Peticion. ";return $rz;}
       // El parametro peticion_detalle puede ser null
       $i = $voyager->consultaSQL("SELECT save_hist('$_id_elemento','$_modulo','$_recurso','$_peticion','$_peticion_detalle');");
       if(!empty($i)){
           $rz['status'] = TRUE;
           $rz['msj'] = "Historial guardado con exito.";
           $rz['data'] = $i['data'][0][0];// Se retorna el Id del registro creado en el historial
       }else{
           $rz['status'] = FALSE;
           $rz['msj'] = "Error al guardar el historial. ";
           $rz['data'] = $i;
       }
   }else{
       $rz['status'] = FALSE;
       $rz['msj'] = "Error al conectar con la base datos -guarda peticion historial. ";
       $rz['data'] = NULL;
   }
   return $rz;
}


/************************************
*	Procesa una peticion estandar   *
***********************************/
/* Procesa una peticion que devuelve un conjunto de datos, guardando el historial.
* esta funcion no sirve para insertar, actualizar o eliminar.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - sql = Consulta a procesar en la base de datos.
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_estandar($_nick, $_token, $_bd, $_sql, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
   // Estructura de la respuesta
   $resp = array();
   $_id_elemento = NULL;

   // Se obtiene el rfc a partir del nick
   if(empty($_id_elemento= getUser($_nick))){
       $resp['status']=FALSE;
       $resp['msj']='Nombre de usuario incorrecto -peticion estandar.';
       $resp['data']=NULL;
       return $resp;
   }

   // Se valida el usuario
   $uchk = logger::UserCheck($_nick, $_token);
   if($uchk['status_sesion']==FALSE){return $uchk;}

   // SQL no debe estar vacio
   if(empty($_sql)){
       $resp['status']=FALSE;
       $resp['status_sesion']=$uchk['status_sesion'];
       $resp['msj']='Falta la consulta a procesar.';
       $resp['data']=NULL;
       return $resp;
    }

   // Se conecta a la base de datos
   $nave = new nauta(IREK,$_bd);
   if($nave->conectado==TRUE){
       $t = $nave->consultaSQL_asociativo($_sql);

       // Si la consulta fue un exito
       if($t['status']==TRUE){
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj']=$t['msj'];
           $resp['data']=$t['data'];
           $resp['data_t']=NULL;
           
           // Se guarda la peticion en el historial
           $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
           if(!$h==FALSE){
               $resp['msj'].=" Historial guardado.";
           }else{
               $resp['msj'].=" Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
               //$resp['data2']=$h;
           }
       }else{
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj'] = $t['msj'];
           $resp['data']=NULL;
       }

   }else{
       $resp['status'] = FALSE;
       $resp['status_sesion'] = $uchk['status_sesion'];
       $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
       $resp['data'] = NULL;
   }
   return $resp;
}

/*************************
*	Actualizar registro  *
*************************/
/* Procesa una peticion para actualizar un registro, guardando el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla a actualizar.
* - id_tabla = Nombre del campo Id de la tabla.
* - valor_id = Valor del campo Id de la tabla.
* - datos = arreglo de campos que seran actualizados en la tabla. (Campo=>Valor)
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_actualizar($_nick, $_token, $_bd, $_tabla ,$_id_tabla, $_valor_id, $_datos, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
   // Estructura de la respuesta
   $resp = array();
   $_id_elemento = NULL;

   // Se obtiene el rfc a partir del nick
   if(empty($_id_elemento= getUser($_nick))){
       $resp['status']=FALSE;
       $resp['msj']='Nombre de usuario incorrecto -peticion actualizar.';
       $resp['data']=NULL;
       return $resp;
   }

   // Se valida el usuario
   $uchk = logger::UserCheck($_nick, $_token);
   if($uchk['status_sesion']==FALSE){return $uchk;}

   // Datos no debe estar vacio
   if(empty($_datos)){
       $resp['status']=FALSE;
       $resp['status_sesion']=$uchk['status_sesion'];
       $resp['msj']='Faltan los datos a procesar.';
       $resp['data']=NULL;
       return $resp;
    }

   // Se conecta a la base de datos
   $nave = new nauta(IREK,$_bd);
   if($nave->conectado==TRUE){
       $t = $nave->actualizar($_tabla ,$_id_tabla, $_valor_id, $_datos);
       // Si la consulta fue un exito
       if($t['status']==TRUE){
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj']=$t['msj'];
           $resp['data']=$t['data'];
           // Se guarda la peticion en el historial
           $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
           if(!$h==FALSE){
               $resp['msj'].=" Historial guardado.";
           }else{
               $resp['msj'].=" Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
               //$resp['data2']=$h;
           }
       }else{
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj'] = $t['msj'];
           $resp['data']=NULL;
       }

   }else{
       $resp['status'] = FALSE;
       $resp['status_sesion'] = $uchk['status_sesion'];
       $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
       $resp['data'] = NULL;
   }
   return $resp;
}


/************************
*	Insertar registro   *
***********************/
/* Procesa una peticion para insertar un registro, guardando el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla donde se insertara el registro.
* - datos = arreglo de campos que seran actualizados en la tabla. (Campo=>Valor)
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_insertar($_nick, $_token, $_bd, $_tabla, $_datos, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
   // Estructura de la respuesta
   $resp = array();
   $_id_elemento = NULL;

   // Se obtiene el rfc a partir del nick
   if(empty($_id_elemento= getUser($_nick))){
       $resp['status']=FALSE;
       $resp['msj']='Nombre de usuario incorrecto -peticion insertar.';
       $resp['data']=NULL;
       return $resp;
   }

   // Se valida el usuario
   $uchk = logger::UserCheck($_nick, $_token);
   if($uchk['status_sesion']==FALSE){return $uchk;}

   // Datos no debe estar vacio
   if(empty($_datos)){
       $resp['status']=FALSE;
       $resp['status_sesion']=$uchk['status_sesion'];
       $resp['msj']='Faltan los datos a procesar.';
       $resp['data']=NULL;
       return $resp;
    }

   // Se conecta a la base de datos
   $nave = new nauta(IREK,$_bd);
   if($nave->conectado==TRUE){
       $t = $nave->insertar($_tabla, $_datos);
       // Si la consulta fue un exito
       if($t['status']==TRUE){
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj']=$t['msj'];
           $resp['data']=$t['data'];
           // Se guarda la peticion en el historial
           $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
           if(!$h==FALSE){
               $resp['msj'].=" Historial guardado.";
           }else{
               $resp['msj'].=" Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
               //$resp['data2']=$h;
           }
       }else{
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj'] = $t['msj'];
           $resp['data']=$t['data'];
       }

   }else{
       $resp['status'] = FALSE;
       $resp['status_sesion'] = $uchk['status_sesion'];
       $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
       $resp['data'] = NULL;
   }
   return $resp;
}


/************************************
*	Insertar registro con carpeta   *
***********************************/
/* Procesa una peticion para insertar un registro y crea una carpeta 
* en la ruta indicada, nombrada con el id del registro, guardando el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla donde se insertara el registro.
* - ruta = ruta que contendra la nueva carpeta.
* - datos = arreglo de campos que seran actualizados en la tabla. (Campo=>Valor)
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_insertar_carpeta($_nick, $_token, $_bd, $_tabla, $_datos, $_ruta, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
   // Estructura de la respuesta
   $resp = array();
   $_id_elemento = NULL;

   // Se obtiene el rfc a partir del nick
   if(empty($_id_elemento= getUser($_nick))){
       $resp['status']=FALSE;
       $resp['msj']='Nombre de usuario incorrecto -peticion insertar carpeta.';
       $resp['data']=NULL;
       return $resp;
   }

   // Se valida el usuario
   $uchk = logger::UserCheck($_nick, $_token);
   if($uchk['status_sesion']==FALSE){return $uchk;}

   // Datos no debe estar vacio
   if(empty($_datos)){
       $resp['status']=FALSE;
       $resp['status_sesion']=$uchk['status_sesion'];
       $resp['msj']='Faltan los datos a procesar.';
       $resp['data']=NULL;
       return $resp;
    }

   // Se conecta a la base de datos
   $nave = new nauta(IREK,$_bd);
   if($nave->conectado==TRUE){
       $t = $nave->insertar($_tabla, $_datos);
       // Si la consulta fue un exito
       if($t['status']==TRUE){
           $ar = $nave->crea_carpeta($_ruta);// Se crea la carpeta fisica del expediente
           if($ar['status']==TRUE){
               // Se guarda la peticion en el historial
               $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
               if(!$h==FALSE){
                   $resp['status']=$t['status'];
                   $resp['status_sesion']=$uchk['status_sesion'];
                   $resp['msj']= "Registro y carpeta creados con exito. Historial guardado. ";
                   $resp['data']= $ar;
               }else{
                   $resp['status']=$t['status'];
                   $resp['status_sesion']=$uchk['status_sesion'];
                   $resp['msj']= "Registro y carpeta creados con exito. Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
                   $resp['data']=$h;
               }
           }else{
               $resp['status']=$t['status'];
               $resp['status_sesion']=$uchk['status_sesion'];
               $resp['msj']= "Registro creado con exito. Error al crear la carpeta. ".$ar['msj'];
               $resp['data']=$ar;
           }
       }else{
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj'] = $t['msj'];
           $resp['data']=$t;
       }

   }else{
       $resp['status'] = FALSE;
       $resp['status_sesion'] = $uchk['status_sesion'];
       $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
       $resp['data'] = NULL;
   }
   return $resp;
}


/***********************************
*	Cargar un archivo y registro   *
***********************************/
/* Procesa una peticion para cargar un archivo en el disco duro,
*  crear el registro en la base de datos y guardar el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla a la que pertenece el registro. Ejem Generales.
* - rfc = El RFC del elemento al que se relaciona el archivo.
* - id = Id de la tabla a la pertenece el registro.Ejem Id_Generales.
* - ruta = ruta que contendra el archivo.
* - ruta_vista_prev = Es la ruta de la imagen pero en la forma https://www.parp.mx/imagen.jpg
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_insertar_archivo($_nick, $_token, $_bd, $_id_elemento, $_tabla, $_id, $_nom, $_ruta, $_ruta_vista_prev, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
    // Estructura de la respuesta
    $resp = array();
    $_id_elemento_us = NULL;
 
    // Se obtiene el rfc a partir del nick
    if(empty($_id_elemento_us= getUser($_nick))){
        $resp['status']=FALSE;
        $resp['msj']='Nombre de usuario incorrecto -peticion insertar carpeta.';
        $resp['data']=NULL;
        return $resp;
    }
 
    // Se valida el usuario
    $uchk = logger::UserCheck($_nick, $_token);
    if($uchk['status_sesion']==FALSE){return $uchk;}
 
    // Datos no debe estar vacio
    /*if(empty($_datos)){
        $resp['status']=FALSE;
        $resp['status_sesion']=$uchk['status_sesion'];
        $resp['msj']='Faltan los datos a procesar.';
        $resp['data']=NULL;
        return $resp;
     }*/
 
    // Se conecta a la base de datos
    $nave = new nauta(IREK,$_bd);
    if($nave->conectado==TRUE){
        $d=array("Tabla"=>$_tabla,"Id_tabla"=>$_id,"Usuario"=>$_id_elemento_us);
        $t = $nave->carga_archivos($_ruta, $_ruta_vista_prev, "multimedia", "RFC" ,$_id_elemento, FALSE, $_nom, $d);
        //$t = $nave->insertar($_tabla, $_datos);
        // Si la consulta fue un exito
        if($t['status']==TRUE){
            
                // Se guarda la peticion en el historial
                $h = guarda_peticion_historial($_id_elemento_us, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
                if(!$h==FALSE){
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Registro y archivo guardados con exito. Historial guardado.";
                    $resp['data']=NULL;
                }else{
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Registro y archivo guardados con exito. Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
                    $resp['data']=$h;
                }
            
        }else{
            $resp['status']=$t['status'];
            $resp['status_sesion']=$uchk['status_sesion'];
            $resp['msj'] = $t['msj'];
            $resp['data']=NULL;
        }
 
    }else{
        $resp['status'] = FALSE;
        $resp['status_sesion'] = $uchk['status_sesion'];
        $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
        $resp['data'] = NULL;
    }
    return $resp;
 }



/************************
*	Eliminar registro   *
***********************/
/* Procesa una peticion para eliminar un registro, guardando el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla donde se insertara el registro.
* - id_tabla = Nombre del campo Id de la tabla.
* - valor_id = Valor del campo Id de la tabla.
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_eliminar($_nick, $_token, $_bd, $_tabla, $_id_tabla, $_valor_id, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
   // Estructura de la respuesta
   $resp = array();
   $_id_elemento = NULL;

   // Se obtiene el rfc a partir del nick
   if(empty($_id_elemento= getUser($_nick))){
       $resp['status']=FALSE;
       $resp['msj']='Nombre de usuario incorrecto -peticion eliminar.';
       $resp['data']=NULL;
       return $resp;
   }

   // Se valida el usuario
   $uchk = logger::UserCheck($_nick, $_token);
   if($uchk['status_sesion']==FALSE){return $uchk;}

   
   // Se conecta a la base de datos
   $nave = new nauta(IREK,$_bd);
   if($nave->conectado==TRUE){
       $t = $nave->eliminar($_tabla, $_id_tabla,$_valor_id);
       // Si la consulta fue un exito
       if($t['status']==TRUE){
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj']=$t['msj'];
           $resp['data']=$t['data'];
           // Se guarda la peticion en el historial
           $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
           if(!$h==FALSE){
               $resp['msj'].=" Historial guardado.";
           }else{
               $resp['msj'].=" Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
               //$resp['data2']=$h;
           }
       }else{
           $resp['status']=$t['status'];
           $resp['status_sesion']=$uchk['status_sesion'];
           $resp['msj'] = $t['msj'];
           $resp['data']=NULL;
       }

   }else{
       $resp['status'] = FALSE;
       $resp['status_sesion'] = $uchk['status_sesion'];
       $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
       $resp['data'] = NULL;
   }
   return $resp;
}


/************************************
*	Eliminar registro con carpeta   *
***********************************/
/* Procesa una peticion para eliminar un registro y su carpeta en la ruta indicada, 
* nombrada con el id del registro, guardando el historial.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla donde se insertara el registro.
* - id_tabla = Nombre del campo Id de la tabla.
* - valor_id = Valor del campo Id de la tabla.
* - ruta = ruta donde se encuentra la carpeta carpeta.
* - datos = arreglo de campos que seran actualizados en la tabla. (Campo=>Valor)
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_eliminar_carpeta($_nick, $_token, $_bd, $_tabla, $_id_tabla, $_valor_id, $_ruta, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
    // Estructura de la respuesta
    $resp = array();
    $_id_elemento = NULL;
 
    // Se obtiene el rfc a partir del nick
    if(empty($_id_elemento= getUser($_nick))){
        $resp['status']=FALSE;
        $resp['msj']='Nombre de usuario incorrecto -peticion eliminar carpeta.';
        $resp['data']=NULL;
        return $resp;
    }
 
    // Se valida el usuario
    $uchk = logger::UserCheck($_nick, $_token);
    if($uchk['status_sesion']==FALSE){return $uchk;}
 
    // Se conecta a la base de datos
    $nave = new nauta(IREK,$_bd);
    $nave->set_ruta_inicio($_ruta);// Se establece $_ruta como ruta de inicio. Esta carpeta se borrara.
    if($nave->conectado==TRUE){
        $t = $nave->eliminar($_tabla, $_id_tabla,$_valor_id);
        // Si la consulta fue un exito
        if($t['status']==TRUE){
            $ar = $nave->borra_carpeta();// Se borra la carpeta fisica del expediente
            if($ar['status']==TRUE){
                // Se guarda la peticion en el historial
                $h = guarda_peticion_historial($_id_elemento, $_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
                if(!$h==FALSE){
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Registro y carpeta eliminados con exito. Historial guardado.";
                    $resp['data']=NULL;
                }else{
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Registro y carpeta eliminados con exito. Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
                    $resp['data']=$h;
                }
            }else{
                $resp['status']=$t['status'];
                $resp['status_sesion']=$uchk['status_sesion'];
                $resp['msj']= "Registro eliminado con exito. Error al eliminar la carpeta. ".$ar['msj'];
                $resp['data']=$ar;
            }
        }else{
            $resp['status']=$t['status'];
            $resp['status_sesion']=$uchk['status_sesion'];
            $resp['msj'] = $t['msj'];
            $resp['data']=$t;
        }
 
    }else{
        $resp['status'] = FALSE;
        $resp['status_sesion'] = $uchk['status_sesion'];
        $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
        $resp['data'] = NULL;
    }
    return $resp;
 }



/**************************
*	Eliminar un archivo   *
**************************/
/* Procesa una peticion para eliminar un archivo y su registro
* de la base de datos, por medio de la ruta Vista previa, guardando el historial.
* Esta funcion se basa en que la estructura de la tabla multimedia cuenta
* por lo menos con los siguientes campos: Id_mm, RFC_m, Nombre, Ruta, Vista_previa.
* Parametros:
* - nick = Con el nick se obtiene el RFC del usuario.
* - token = token valido del usario, para tenerlo debe estar logueado.
* - bd = base de datos sobre la que se esta trabajando.
* - tabla = El nombre de la tabla donde se insertara el registro.
* - id_tabla = Nombre del campo de la tabla que se tomara como campo Clave.
* - _ruta = Valor del campo_id, en este caso se recomienda la ruta/ruta_web del archivo.
* - modulo: Departamento o area.
* - recurso: Seccion del modulo sobre la que se trabaja.
* - peticion: Accion a realizar en esa seccion.
* - peticion_detalle: (Explicacion breve de la accion ejecutada).
*/
function peticion_eliminar_archivo($_nick, $_token, $_bd, $_tabla, $_id_tabla, $_ruta, $_modulo, $_recurso, $_peticion, $_peticion_detalle= NULL){
    // Estructura de la respuesta
    $resp = array();
    $_id_elemento = NULL;
 
    // Se obtiene el rfc a partir del nick
    if(empty($_id_elemento= getUser($_nick))){
        $resp['status']=FALSE;
        $resp['msj']='Nombre de usuario incorrecto -peticion eliminar carpeta.';
        $resp['data']=NULL;
        return $resp;
    }
 
    // Se valida el usuario
    $uchk = logger::UserCheck($_nick, $_token);
    if($uchk['status_sesion']==FALSE){return $uchk;}
 
    // Se conecta a la base de datos
    $nave = new nauta(IREK,$_bd,$_ruta);
    if($nave->conectado==TRUE){
        $ar = $nave->borra_archivo('');// Se borra el archivo
        if($ar['status']==TRUE){
            // Se elimina el registro de la base de datos
            $t = $nave->eliminar($_tabla, $_id_tabla, $_ruta);
            // Si la consulta fue un exito
            if($t['status']==TRUE){
                // Se guarda la peticion en el historial
                $h = guarda_peticion_historial($_id_elemento,$_modulo,$_recurso,$_peticion,$_peticion_detalle= NULL);
                if(!$h==FALSE){
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Archivo y registro eliminados con exito. Historial guardado.";
                    $resp['data']=NULL;
                }else{
                    $resp['status']=$t['status'];
                    $resp['status_sesion']=$uchk['status_sesion'];
                    $resp['msj']= "Archivo y registro eliminados con exito. Ocurrio un error al intentar guardar en el historial. ".$h['msj'];
                    $resp['data']=$h;
                }
            }else{
                $resp['status']=$t['status'];
                $resp['status_sesion']=$uchk['status_sesion'];
                $resp['msj'] = $t['msj'];
                $resp['data']=$t;
            }
            
        }else{
            $resp['status']=$t['status'];
            $resp['status_sesion']=$uchk['status_sesion'];
            $resp['msj']= $ar['msj'];
            $resp['data']=$ar;
        }
    }else{
        $resp['status'] = FALSE;
        $resp['status_sesion'] = $uchk['status_sesion'];
        $resp['msj'] = "No se pudo conectar a la base de datos. ".$nave->conx_error_msj;
        $resp['data'] = NULL;
    }
    return $resp;
 }

// Obtener el RFC del empleado
function getUser($_nick){
       $nave = new nauta(IREK,USUARIOS['base']);
       $u = $nave->consultaSQL_asociativo("CALL usuario_nick('$_nick');");
       return $u['data'][0]['Id_Elemento'];
}
?>