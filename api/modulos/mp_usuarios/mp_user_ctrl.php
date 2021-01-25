<?php
switch($recurso){

    case 'mpiph':
        $v= include_once(MPIPH['mpiph']);
        if($v==TRUE){
            $l = mpiph::recurso($peticion);
            $l['status']?$vista->est=200:$vista->est=400;
            $vista->imprimir($l);
        }else{
            $vista->estado = 400;
            $cuerpo = RECURSO_NO_IMPLEMENTADO;
        }
        
    break;
    
    case 'mpusuarios':
        $v= include_once(MPUSUARIOS['mpusuarios']);
        if($v==TRUE){
            $l = mpusuarios::recurso($peticion);
            $l['status']?$vista->est=200:$vista->est=400;
            $vista->imprimir($l);
        }else{
            $vista->estado = 400;
            $cuerpo = RECURSO_NO_IMPLEMENTADO;
        }
        
    break;

    // ******* Recursos no existente para 'iph' *******
    default:
        $vista->estado = 400;
        $cuerpo = RECURSO_NO_EXISTE;

}// Fin switch
?>