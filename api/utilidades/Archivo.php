<?php
/************************************
 *  Clase manejadora de archivos    *
 ************************************/
class archivos{
    // Globales
    private static $TIPOS_PERMITIDOS = array(
        'jpg'=>'image/jpeg',
        'png'=>'image/png',
        'pdf'=>'application/pdf',
        'avi'=>'video/x-msvideo',
        'wav'=>'audio/x-wav',
        'mpeg'=>'video/x-mpeg');
	private static $PESO_MAX = 105000000; //10.5MB
    private $dirIni = NULL;
	private static $rf = array();
    private $_folder2 = "";

	function __construct($_rutaInicio=ESTRUCTURA_GENERAL) {
        $this->dirIni = $_rutaInicio;
	}


    public function get_dirIni(){
        return $this->dirIni;
    }

    public function get_tipos_permitidos(){
        return $this->TIPOS_PERMITIDOS;
    }

	// Para copiar las carpetas y subcarpetas
	public static function copiar( $orig, $dest ) {
	    if ( is_dir( $orig ) ) {
	        @mkdir( $dest,0777,TRUE );
	        $d = dir( $orig );
	        while ( FALSE !== ( $dentro = $d->read() ) ) {
	            if ( $dentro == '.' || $dentro == '..' ) {
	                continue;
	            }
	            $Dentro = $orig . '/' . $dentro;
	            if ( is_dir( $Dentro ) ) {
	                archivo::copiar( $Dentro, $dest . '/' . $dentro );
	                continue;
	            }
	            copy( $Dentro, $dest . '/' . $dentro );
	        }

	        $d->close();

	    }else {
	    	copy( $orig, $dest );
	    }
	}

	// Crea la estructura de carpetas del expediente electronico
	public static function crea_estructura($nombre_carpeta){
		$origen = archivo::$dirIni."PLANTILLA";
		$destino = archivo::$dirIni."$nombre_carpeta";
		archivo::copiar($origen, $destino);
		if(file_exists($destino)===TRUE){
			archivo::$rf['status'] = TRUE;
			archivo::$rf['msj']="Carpeta creada con exito!.";
		}else{
			archivo::$rf['status'] = FALSE;
			archivo::$rf['msj']="Fallo al crear la carpeta.";
		}

		return archivo::$rf;
	}

    // Crea una carpeta con la ruta otorgada
    public static function crea_carpeta($_ruta){
        // Validamos si la ruta de destino existe, en caso de no existir la creamos
        if(!file_exists($_ruta)){
            if(mkdir($_ruta, 0777)){
                self::$rf['status'] = TRUE;
                self::$rf['msj'] = 'Carpeta creada con exito.';
                return self::$rf;
            }else{
                self::$rf['status'] = FALSE;
                self::$rf['msj'] = 'La carpeta '.$_ruta.' no pudo ser creada, verifiquela.';
                return self::$rf;
            }
        }else{
            self::$rf['status'] = FALSE;
            self::$rf['msj'] = 'La carpeta '.$_ruta.' ya existe.';
            return self::$rf;
        }
    }

	// Renombra una carpeta o archivo
	public static function renombrar($viejo_nom,$nuevo_nom){
		if(rename($viejo_nom, $nuevo_nom)===TRUE){
			archivo::$rf['status'] = TRUE;
			archivo::$rf['msj']="Archivo o Carpeta renombrados con exito!.";
		}else{
			archivo::$rf['status'] = FALSE;
			archivo::$rf['msj']="Error al intentar renombrar el archivo o carpeta.";
		}
		return archivo::$rf;
	}


	/*******************************
	*  CARGAR ARCHIVO AL SERVIDOR  *
	********************************
	* Parametros de la funcion:
    *
	* $obj_input = nombre del objeto input file enviado via POST
	* $ruta = lugar en el directorio donde se guardara la foto
	* $nom_archivo= nombre con el se va a guardar la imagen
	*
	* Esta funcion copia la imagen a la carpeta que indica la variable $ruta.
	* Y retorna TRUE hubo exito y FALSE en caso contrario
	* */
	public static function carga_archivos($obj_input, $ruta, $nom_archivo){

        // Validacion de ruta y nombre de archivo  ///////////////////////////////////////
        // Validamos si la ruta de destino existe
        if(!file_exists($ruta)){
            self::$rf['status'] = FALSE;
            self::$rf['msj'] = 'La ruta '.$ruta.' destino no existe.';
            return self::$rf; // Se interrumpe la funcion
        }

        // Validamos el tamaño del nombre del archivo
        if(strlen($nom_archivo)<=0){
            self::$rf['status'] = FALSE;
            self::$rf['msj'] = 'Nombre de archivo vacio.';
            return self::$rf; // Se interrumpe la funcion
        }

        // Verificar el nombre del archivo por seguridad
        if(!preg_match("`^[-0-9A-Z_\.]+$`i",$nom_archivo)){
            self::$rf['status'] = FALSE;
            self::$rf['msj'] = 'Nombre de archivo '.$nom_archivo.' invalido.';
            return self::$rf; // Se interrumpe la funcion
        }
        ////////////////////////////////////////////////////////////////////////////////


        // Se valida(n) el(los) archivo(s)
        $vf = self::valida_archivo($obj_input);

        if($vf['status']===TRUE){

            // Se carga el archivo
            $trozos=explode(".", $_FILES[$obj_input]['name']);
            $ext = end($trozos);
            $nombre_temp = $_FILES[$obj_input]["tmp_name"];
            $dir=opendir($ruta);
            $rDestino_nArchivo_Ext = $ruta.$nom_archivo.'.'.$ext;
            if(move_uploaded_file($nombre_temp, $rDestino_nArchivo_Ext)) {
                self::$rf['status'] = TRUE;
                self::$rf['msj'] = 'El archivo '.$nom_archivo.' cargado exitosamente.';
            } else {
                self::$rf['status'] = FALSE;
                self::$rf['msj'] = 'Error al intentar cargar el archivo '.$nom_archivo;
            }
            closedir($dir);

        }else{
            self::$rf['status'] = FALSE;
            self::$rf['msj'] = $vf['msj'];
        }

        // Se retorna el resultado
        return self::$rf;


	}



    /**************************
     *	VERIFICA EL ARCHIVO   *
     **************************
     * Parametros de la funcion:
     *
     * $_input = objeto $_FILE
     *
     * Esta funcion verifica que el objeto input file
     * contenga archivos validos. Existencia, carga, peso, tipo.
     * */
    public static function valida_archivo($_input){
        $resp = array();
        try {
            // Se verifica que el parametro $_input sea string
            if(!is_string($_input)){
                $resp['status'] = FALSE;
                $resp['msj'] = 'Error al intentar validar la variable file.';
                return $resp;
            }
            // Se verifica si existe la variable
            if ( !isset($_FILES[$_input]['error']) ) {
                $resp['status'] = FALSE;
                $resp['msj'] = 'Variable archivo no existe.';
                return $resp;
            }
            // Se verifica que no existan multiples archivos
            if(is_array($_FILES[$_input]['error'])){
                $resp['status'] = FALSE;
                $resp['msj'] = 'No se permite carga de multiples archivos.';
                return $resp;
            }

            // Verifica si existe un error al cargar el archivo
            switch ($_FILES[$_input]['error']) {
                case UPLOAD_ERR_OK:
                    $resp['status'] = FALSE;
                    $resp['msj'] = 'Error al cargar el archivo. '.UPLOAD_ERR_OK;
                    return $resp;
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $resp['status'] = FALSE;
                    $resp['msj'] = 'No se ha enviado un archivo. ' .UPLOAD_ERR_NO_FILE;
                    return $resp;
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    $resp['status'] = FALSE;
                    $resp['msj'] = 'El peso del archivo excede el limite permitido por el servidor. ' .UPLOAD_ERR_INI_SIZE;
                    return $resp;
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $resp['status'] = FALSE;
                    $resp['msj'] = 'El peso del archivo no es permitido. ' .UPLOAD_ERR_FORM_SIZE;
                    return $resp;
                    break;
                default:
                    $resp['status'] = FALSE;
                    $resp['msj'] = 'Error desconocido al cargar el archivo.';
                    return $resp;
            }

            // Verificar que no exceda el peso maximo permitido.
            if (($_FILES[$_input]['size'] > self::$PESO_MAX)||($_FILES[$_input]['size'] <= 0)) {
                $resp['status'] = FALSE;
                $resp['msj'] = 'El peso del archivo'.$_FILES[$_input]['size'].' NO es permitido. Max = '.self::$PESO_MAX;
                return $resp;
            }

            // Verificar el nombre del archivo por seguridad
            if(!preg_match("`^[-0-9A-Z_\.]+$`i",$_FILES[$_input]['name'])){
                $resp['status'] = FALSE;
                $resp['msj'] = 'Nombre de archivo invalido, intente cambiar el nombre.';
                return $resp;
            }

            // Verificar que el tipo sea permitido
            $_tipo = $_FILES[$_input]['type'];
            if(!in_array($_tipo,self::$TIPOS_PERMITIDOS)) {
                $resp['status'] = FALSE;
                $resp['msj'] = 'Tipo de archivo no permitido. ';
                return $resp;
            }

            // En caso de no ocurrir ningun error se retorna valido
            $resp['status'] = TRUE;
            $resp['msj'] = 'Archivo permitido.';
            $resp['Files_obj'] = $_FILES;

            // Se retorna el resultado
            return $resp;

        } catch (RuntimeException $e) {
            $resp['status'] = FALSE;
            $resp['msj'] = 'Error: '.$e->getMessage();
            return $resp;
        }
    }



	/******************************************
	 *	BORRA EL ARCHIVO DEL SERVIDOR  *
	 ******************************************
	 * Parametros de la funcion:
	 *
	 * $r = lugar en el directorio donde se guardara el archivo
	 *
	 * Esta funcion borra el archivo del disco duro segun la ruta pasada
	 * como parametro
	 * */
	 function borra_archivo($r){
	 	if(unlink($this->dirIni.$r)){
            self::$rf['status'] = TRUE;
            self::$rf['msj'] = 'Archivo eliminado con exito.';
			return self::$rf;
		}else{
            self::$rf['status'] = FALSE;
			self::$rf['msj'] = 'Error al intentar borrar el archivo.';
			self::$rf['ruta'] = 'La ruta destino es ='.$this->dirIni.$r;
			return self::$rf;
		}

	 }

     /******************************************
      *	BORRA EL DIRECTORIO DEL SERVIDOR  *
      ******************************************
      * Parametros de la funcion:
      *
      * $_folder = lugar en el directorio donde se guardara el archivo
      *
      * Esta funcion borra el direcorio con los archivos incluidos
      * del disco duro segun la ruta pasada como parametro
      * */
	 function borra_carpeta($_folder){
         if(is_dir($this->dirIni.$_folder)){
             rmdir($this->dirIni.$_folder);
             self::$rf['status'] = TRUE;
             self::$rf['msj'] = 'Archivo eliminado con exito.';
             return self::$rf;
         }else{
             self::$rf['status'] = FALSE;
             self::$rf['msj'] = 'La carpeta no existe.';
             self::$rf['ruta'] = 'La ruta destino es ='.$this->dirIni.$_folder;
             return self::$rf;
         }
	 }

}//Fin de Clase

?>