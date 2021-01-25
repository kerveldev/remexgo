<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include_once('../api/datos/ApiConfig.php');
    include_once(NAUTA);
    include_once(STORER);
    include_once(AUXCTRL);
    include_once(USUARIOS['logger']);
    $m=strtolower($_SERVER['REQUEST_METHOD']);
    
   
    if($m=='post'){// Solo metodo post
        $bx = new storer(array("nick","pass"));
        
        if(empty($x=$bx->stocker)){exit("Faltan parametros");};
        
        $r = logger::Login($x->nick,$x->pass);// Se solicita el acceso
        $rd = $r['data'];

        //print_r($rd);
            if( $r['status']==TRUE){
                
                // Se tiene que buscar el modulo principal al que esta enlazado el usuario
                $nav = new nauta(IREK,USUARIOS['base']);
                $sql = "CALL modulo_principal('".$rd['Id_Elemento']."');";
                $dt = $nav->consultaSQL_asociativo($sql);
                
                //$ruta = $dt['data'][0]['URL'];
                if($dt['data']!=NULL){
                    $ruta = $dt['data'][0]['URL'];
                    $_SESSION['user'] = $r;
                    
                    
                    header('Status: 301 Moved Permanently', false, 301);
                    //header("Location: $ruta?user=".base64_encode(json_encode($r,JSON_BIGINT_AS_STRING)));
                     $_SESSION['msj_login'] = "";
                    header("Location: $ruta");
                    exit();
                }else{
                    $_SESSION['shot'] += 1;
                    $_SESSION['msj_login'] = "Usuario sin asignación. Consulta con tu administrador.";
                    header('Status: 301 Moved Permanently', false, 301);
                    header('Location: login_erp.php');
                    exit();
                }
                //$ruta = $dt['data'][0]['URL'];
                
            }else{
                $_SESSION['shot'] += 1;
                $_SESSION['msj_login'] = $r['msj'];
                header('Status: 301 Moved Permanently', false, 301);
                header('Location: login_erp.php');
                exit();
            }
            
    }else{
        $_SESSION['shot'] += 1;
        $_SESSION['msj_login'] = $r['msj'];
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: login_erp.php');
        exit();
    }
    
    
?>