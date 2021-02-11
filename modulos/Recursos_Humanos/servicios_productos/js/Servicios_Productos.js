$(document).ready(function() {

    InicializarDatatable("tabla_productos");
        
    setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 2500
            };
            toastr.success(nuser.Nombre_completo);
    }, 1300);  
    
    listadoProductos();
    
});
    
    function checarNulos(_valor){
        var regresarValor = "";
        if (_valor == '' || _valor == null) {
            regresarValor = "-";
        }else{
            regresarValor = _valor;
        }
        return regresarValor;
    }
    function InicializarDatatable(_nombre_tabla){
       $("#"+_nombre_tabla+"").dataTable({ 
                "language": {
                "emptyTable": "Cargando....... ",
                "loadingRecords": "&nbsp;",
                "processing": "Cargando...",
                "search": " Buscar:",
                "info": "Mostrando _START_ / _END_ de _TOTAL_ registros",
                "infoEmpty": "No hay registros",
                "lengthMenu": " _MENU_ ",
                "bProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                },
                responsive: true,
                destroy: true,
                bProcessing: true,
                processing: true,
                searching: true,
                dom: "<'row'<'col-sm-16 col-md-5 col-xl-6'><'col-sm-16 col-md-3 col-xl-3'><'col-sm-16  col-md-4 col-xl-4'>>" +
                "<'row'<'col-sm-16'tr>>" +
                "<'row'<'#divisor.col-md-16'>>" +
                "<'row'<'col-sm-6 '><'col-sm-4 '><'col-sm-6 floatRight'>>" +
                "<'row'<'#divisor2.col-md-16'>>" +
                "<'row'<'col-sm-16'>>",
             });
    
    }
    
    
function listadoProductos(){
        var tabla = "tabla_productos";
        //Se piden los datos
        $.ajax({
            url : 'https://remex.kerveldev.com/api/servicios_productos/sp/sp_lst',
            data : 
            { 
                nick : nuser.Nick,
                token: nuser.Token
            },
            type : 'POST',
            dataType : 'json',
            success : function(resp) {
                console.log(resp);
                $("#" + tabla + " tbody").remove();
                var tbody = "<tbody>";
                var lst = resp.data;
               
                lst.forEach(reg => {
                    
                    tbody += 
                        "<tr>"+
                        "<td>"+checarNulos(reg.Id_Proveedor)+"</td>"+
                        "<td>"+checarNulos(reg.Nombre_SP)+"</td>"+
                        "<td>"+checarNulos(reg.Tipo)+"</td>"+
                        "<td>"+checarNulos(reg.Precio)+"</td>"+
                        "<td>"+

                            "<button type='button' class='btn btn-sm btn-outline btn-primary p-2' onclick='abrirProducto_Id(\"" +  reg.Id_SP + "\",\"" +  reg.Nombre_SP + "\")'; title='Abrir Informacion Producto: "+reg.Nombre_SP+"'><i class='fa fa-user'></i></button>&nbsp;"+
                            
                            "<button type='button' class='btn btn-sm btn-outline btn-danger p-2' onclick='eliminarProducto_Id(\"" +  reg.Id_SP + "\",\"" +  reg.Nombre_SP + "\")'; title='Eliminar Producto: "+reg.Nombre_SP+"'><i class='fa fa-trash'></i></button>&nbsp;"+
                        

                        "</tr>";
                });
                //Se dibuja la tabla
                tbody += "</tbody>";
                $("#" + tabla + "").append(tbody);
    
    
                //Se asigna el plugin DataTables
                var table = $("#" + tabla + "").DataTable({
                //var table = $("#tabla").DataTable({
                            responsive: true,
                            destroy: true,
                            processing: true,
                            searching: true,
    
                            dom: "<'row'<'col-sm-12 col-md-4 col-xl-4'i><'col-sm-12 col-md-4 col-xl-4'><' col-sm-12 col-md-4 col-xl-4 floatRight'f>>" +
                                "<'row'<'col-sm-12'tr>>" +
                                "<'row'<'#divisor.col-md-12'>>" +
                                "<'row'<'col-sm-4 'l><'col-sm-4 '><'col-sm-4 floatRight'p>>" +
                                "<'row'<'#divisor2.col-md-12'>>" +
                                "<'row'<'col-sm-12'B>>",
                            columnDefs: [{
                                    'className': 'control',
                                },
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: 4 }
                            ],
                            // select: {
                            //     'style': 'multi',
                            //     'selector': 'td:not(.control)'
                            // },
                            order: [
                                [0, "asc"]
                            ],
                            buttons: [
                                        {   text: 'Agregar Producto',
                                            className: 'btn btn-success',
                                            action: function(e, dt, node, config) {
                                                
                                                abrirNuevoProducto();
                                                
                                            }
                                        },
                                        {   extend: 'excel', 
                                            className: 'btn btn-info',
                                        },
                                ],
    
                            language: {
    
                                "loadingRecords": "&nbsp;",
                                "processing": "Cargando...",
                                "search": " Buscar:",
                                "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                                "infoEmpty": "No hay registros",
                                "lengthMenu": " _MENU_ ",
                                "emptyTable": "No se han encontrado registros para la tabla.",
                                "paginate": {
                                    "next": "Siguiente",
                                    "previous": "Atras"
                                }
                            }
    
                });
    
            },
            error : function(xhr, status) {
                alert('Error al recibir los datos ( '+status.toString()+' ).');
                console.log(xhr);
            },
            complete : function(xhr, status) {
                console.log(xhr);
            }
        });
    }

    function limpiarModalProducto(){

        $("#id_proveedor").val("");
        $("#tipo_producto").val("");
        $("#nombre_producto").val("");
        $("#caracteristica_producto").val("");
        $("#precio_producto").val("");
        $("#descuento_producto").val("");
        $("#cantidad_producto").val("");
        $("#min_producto").val("");
        $("#unidad_producto").val("");

    }
    
    function abrirNuevoProducto(){
        
    
        $("#modal_producto").modal({"backdrop":"static"});
        $(".btn-guardar-producto").attr('onClick', 'guardarNuevoProducto();');
        $("#nProducto").text("Nuevo Producto");
   
   }
    
    function abrirProducto_Id(_id_producto, _nombre_producto){
    
        $("#modal_producto").modal({"backdrop":"static"});
        $(".btn-guardar-producto").attr('onClick', 'actualizarProducto('+_id_producto+');');
        $("#nProducto").text(_nombre_producto);
    
        fetch ('https://remex.kerveldev.com/api/servicios_productos/sp/sp_id', {  
                method: 'POST',
                headers:{
            'Content-Type': 'application/json'
          },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    Id: _id_producto
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if(resJson.status_sesion){
                            
                    respuesta = resJson.data;

                    $("#id_proveedor").val(respuesta[0].Id_Proveedor);
                    $("#tipo_producto").val(respuesta[0].Tipo);
                    $("#nombre_producto").val(respuesta[0].Nombre_SP);
                    $("#caracteristica_producto").val(respuesta[0].Caracteristicas);
                    $("#precio_producto").val(respuesta[0].Precio);
                    $("#descuento_producto").val(respuesta[0].Descuento);
                    $("#cantidad_producto").val(respuesta[0].Cantidad);
                    $("#min_producto").val(respuesta[0].Min);
                    $("#unidad_producto").val(respuesta[0].Unidad);
                  
                }
            })
    
    }
    
function cerrarModalProducto_Id(){
    $("#modal_producto").modal("hide");
    limpiarModalProducto();
}
    
function guardarNuevoProducto(){

    var Id_Proveedor = $("#id_proveedor").val();
    var Tipo = $("#tipo_producto").val();
    var Nombre_SP = $("#nombre_producto").val();
    var Caracteristicas = $("#caracteristica_producto").val();
    var Precio = $("#precio_producto").val();
    var Descuento = $("#descuento_producto").val();
    var Cantidad = $("#cantidad_producto").val();
    var Min	 = $("#min_producto").val();
    var Unidad	 = $("#unidad_producto").val();

   
    fetch ('https://remex.kerveldev.com/api/servicios_productos/sp/crea_sp',{  
        method: 'PUT',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                datos:{ 
                    Id_Proveedor:Id_Proveedor,
                    Tipo:Tipo,
                    Nombre_SP:Nombre_SP,
                    Caracteristicas:Caracteristicas,
                    Precio:Precio,
                    Descuento:Descuento,
                    Cantidad:Cantidad,
                    Min:Min,
                    Unidad:Unidad
                        
                }
                
            })
        }).then((res)=> res.json()).then((respApi)=>{
            var respuesta = respApi.data;

            cerrarModalProducto_Id();
            listadoProductos();

            if (respApi.status) {
                swal({
                    type: 'success',
                    title: 'Creacion exitosa.',
                    text: respuesta,
                })

                
               
                
            }else{
                $("#modal_producto").modal("hide");
                swal({
                    type: 'error',
                    html: '<h2>Error</h2><p>'+respApi.msj+'</p>',
                    showConfirmButton: true,
                });
               
            }
            
        });

}

function actualizarProducto(_id_producto){

    var Id_Proveedor = $("#id_proveedor").val();
    var Tipo = $("#tipo_producto").val();
    var Nombre_SP = $("#nombre_producto").val();
    var Caracteristicas = $("#caracteristica_producto").val();
    var Precio = $("#precio_producto").val();
    var Descuento = $("#descuento_producto").val();
    var Cantidad = $("#cantidad_producto").val();
    var Min	 = $("#min_producto").val();
    var Unidad	 = $("#unidad_producto").val();

    fetch ('https://remex.kerveldev.com/api/servicios_productos/sp/modifica_sp',{  
        method: 'POST',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                Id:_id_producto,
                datos:{ 
                    Id_Proveedor:Id_Proveedor,
                    Tipo:Tipo,
                    Nombre_SP:Nombre_SP,
                    Caracteristicas:Caracteristicas,
                    Precio:Precio,
                    Descuento:Descuento,
                    Cantidad:Cantidad,
                    Min:Min,
                    Unidad:Unidad
                }
                
            })
        }).then((res)=> res.json()).then((respApi)=>{
            var respuesta = respApi.data;

            cerrarModalProducto_Id();
            listadoProductos();

            if (respApi.status) {
                swal({
                    type: 'success',
                    title: 'Actualización exitosa.',
                    text: respuesta,
                })

            }else{
                $("#modal_producto").modal("hide");
                swal({
                    type: 'error',
                    html: '<h2>Error</h2><p>'+respApi.msj+'</p>',
                    showConfirmButton: true,
                });
               
            }
            
        });

}


function eliminarProducto_Id(_id_producto, nombre){
    
    swal({
        title: 'Deseas eliminar a '+nombre+' ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.value) {
    fetch ('https://remex.kerveldev.com/api/servicios_productos/sp/elimina_sp', {  
    method: 'DELETE',   
    headers:{
    'Content-Type': 'application/json'
    },
        body: JSON.stringify({
            nick: nuser.Nick,
            token: nuser.Token,
            Id: _id_producto
        })
    }).then((res)=> res.json())
        .then((resdelJson)=>{
            console.log(resdelJson)

                if (resdelJson.status) {
                   
                    swal({
                        type: 'success',
                        title: 'El Producto ha sido eliminado.!',
                        confirmButtonText: 'Ok'
                    })
                              
                    listadoProductos();

                }else{
                   
                    swal(
                        'Error!',
                        'El Producto no fue eliminado.',
                        'error'
                        )
                }

            })

        }
    });
}
