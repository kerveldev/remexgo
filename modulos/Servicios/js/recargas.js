function mostrarInformacionCliente(_id_producto){
	$("#div_info_cliente").css({"display": "none"});
	
/*
	fila = $(this);   
	console.log(fila);        
    user_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		                    
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, user_id:user_id},    
          success: function() {
              tablaUsuarios.row(fila.parents('tr')).remove().draw();
                             
           }
        });	
    }*/

 $("#div_info_cliente").removeAttr("style");  
	
}