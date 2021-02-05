<?php
    switch($recurso){

        case 'proveedores':
            $v = include_once(PROVEEDOR['proveedores']);

            if($v == TRUE){
                $l = proveedor::recurso($peticion);
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