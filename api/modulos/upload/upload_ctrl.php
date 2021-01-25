<?php
switch($recurso){

    case 'up':
        $v= include_once(UPLOAD['up']);
        if($v==TRUE){
            $l = upload::recurso($peticion);
            $l['status']?$vista->est=200:$vista->est=400;
            $vista->imprimir($l);
        }else{
            $vista->estado = 400;
            $cuerpo = RECURSO_NO_IMPLEMENTADO;
        }
        
    break;   

    // ******* Recursos no existente para 'rh' *******
    default:
        $vista->estado = 400;
        $cuerpo = RECURSO_NO_EXISTE;
        //$vista->imprimir($cuerpo);
}// Fin switch
?>