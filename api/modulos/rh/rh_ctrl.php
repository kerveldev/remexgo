<?php
    switch($recurso){

        case 'clientes':
            $v = include_once(RH['clientes']);

            if($v == TRUE){
                $l = clientes::recurso($peticion);
                $l['status']?$vista->est=200:$vista->est=401;
                $vista->imprimir($l);
            }else{
                $vista->estado = 400;
                $cuerpo = RECURSO_NO_IMPLEMENTADO;
            }
            break;

            case 'alta':
                $v = include_once(RH['alta']);
    
                if($v == TRUE){
                    $l = rh::recurso($peticion);
                    $l['status']?$vista->est=200:$vista->est=401;
                    $vista->imprimir($l);
                }else{
                    $vista->estado = 400;
                    $cuerpo = RECURSO_NO_IMPLEMENTADO;
                }
            break;
        
    default:
    $vista->estado = 400;
    $cuerpo = RECURSO_NO_EXISTE;
}
?>