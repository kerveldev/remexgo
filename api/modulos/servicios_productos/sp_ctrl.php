<?php
    switch($recurso){

        case 'sp':
            $v = include_once(SP['sp']);

            if($v == TRUE){
                $l = sp::recurso($peticion);
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