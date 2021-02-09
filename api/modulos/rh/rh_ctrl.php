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

            case 'altas':
                $v = include_once(RH['altas']);

                if($v == TRUE){
                    $l = altas::recurso($peticion);
                    $l['status']?$vista->est=200:$vista->est=401;
                    $vista->imprimir($l);
                }else{
                    $vista->estado = 400;
                    $cuerpo = RECURSO_NO_IMPLEMENTADO;
                }
            break;

            case 'ventas':
                $v = include_once(RH['ventas']);

                if($v == TRUE){
                    $l = ventas::recurso($peticion);
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