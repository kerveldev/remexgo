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
            url : 'https://remex.kerveldev.com/api/producto/producto/producto_lst',
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
                        "<td>"+checarNulos(reg.Id_Producto)+"</td>"+
                        "<td>"+checarNulos(reg.Nombre)+"</td>"+
                        "<td>"+checarNulos(reg.Tel1)+"</td>"+
                        "<td>"+checarNulos(reg.Tel2)+"</td>"+
                        "<td>"+checarNulos(reg.Municipio)+"</td>"+
                        "<td>"+

                            "<button type='button' class='btn btn-sm btn-outline btn-primary p-2' onclick='abrirProducto_Id(\"" +  reg.Id_Producto + "\",\"" +  reg.Nombre + "\")'; title='Abrir Informacion Producto: "+reg.Nombre+"'><i class='fa fa-user'></i></button>&nbsp;"+
                            
                            "<button type='button' class='btn btn-sm btn-outline btn-danger p-2' onclick='eliminarProducto_Id(\"" +  reg.Id_Producto + "\",\"" +  reg.Nombre + "\")'; title='Eliminar Producto: "+reg.Nombre+"'><i class='fa fa-trash'></i></button>&nbsp;"+
                        

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
                                { responsivePriority: 2, targets: 5 }
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

        $("#nombre_producto").val("");
        $("#contacto_producto").val("");
        $("#tel_1_producto").val("");
        $("#ext_1_producto").val("");
        $("#tel_2_producto").val("");
        $("#ext_2_producto").val("");
        $("#direccion_producto").val("");
        $("#cp_producto").val("");
        $("#municipio_producto").val("");
        $("#entidad_producto").val("");
        $("#pais_producto").val("");
        $("#email_producto").val("");

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
    
        fetch ('https://remex.kerveldev.com/api/producto/producto/producto_id', {  
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

                    $("#nombre_producto").val(respuesta[0].Nombre);
                    $("#contacto_producto").val(respuesta[0].Contacto);
                    $("#tel_1_producto").val(respuesta[0].Tel1);
                    $("#ext_1_producto").val(respuesta[0].Ext1);
                    $("#tel_2_producto").val(respuesta[0].Tel2);
                    $("#ext_2_producto").val(respuesta[0].Ext2);
                    $("#direccion_producto").val(respuesta[0].Direccion);
                    $("#cp_producto").val(respuesta[0].CP);
                    $("#municipio_producto").val(respuesta[0].Municipio);
                    $("#entidad_producto").val(respuesta[0].Entidad);
                    $("#pais_producto").val(respuesta[0].Pais);
                    $("#email_producto").val(respuesta[0].Email);
                   
                }
            })
    
    }
    
function cerrarModalProducto_Id(){
    $("#modal_producto").modal("hide");
    limpiarModalProducto();
}
    
function guardarNuevoProducto(){

    var Nombre = $("#nombre_producto").val();
    var Contacto = $("#contacto_producto").val();
    var Tel1 = $("#tel_1_producto").val();
    var Ext1 = $("#ext_1_producto").val();
    var Tel2 = $("#tel_2_producto").val();
    var Ext2 = $("#ext_2_producto").val();
    var Direccion = $("#direccion_producto").val();
    var CP	 = $("#cp_producto").val();
    var Municipio = $("#municipio_producto").val();
    var Entidad = $("#entidad_producto").val();
    var Pais = $("#pais_producto").val();
    var Email = $("#email_producto").val();
   
    fetch ('https://remex.kerveldev.com/api/producto/producto/crea_producto',{  
        method: 'PUT',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                datos:{ 
                    Nombre:Nombre,
                    Contacto:Contacto,
                    Tel1:Tel1,
                    Ext1:Ext1,
                    Tel2:Tel2,
                    Ext2:Ext2,
                    Direccion:Direccion,
                    CP:CP,
                    Municipio:Municipio,
                    Entidad:Entidad,
                    Pais:Pais,
                    Email:Email
                        
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

    var Nombre = $("#nombre_producto").val();
    var Contacto = $("#contacto_producto").val();
    var Tel1 = $("#tel_1_producto").val();
    var Ext1 = $("#ext_1_producto").val();
    var Tel2 = $("#tel_2_producto").val();
    var Ext2 = $("#ext_2_producto").val();
    var Direccion = $("#direccion_producto").val();
    var CP	 = $("#cp_producto").val();
    var Municipio = $("#municipio_producto").val();
    var Entidad = $("#entidad_producto").val();
    var Pais = $("#pais_producto").val();
    var Email = $("#email_producto").val();

    fetch ('https://remex.kerveldev.com/api/producto/producto/modifica_producto',{  
        method: 'POST',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                Id:_id_producto,
                datos:{ 
                    Nombre:Nombre,
                    Contacto:Contacto,
                    Tel1:Tel1,
                    Ext1:Ext1,
                    Tel2:Tel2,
                    Ext2:Ext2,
                    Direccion:Direccion,
                    CP:CP,
                    Municipio:Municipio,
                    Entidad:Entidad,
                    Pais:Pais,
                    Email:Email
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
    fetch ('https://remex.kerveldev.com/api/producto/producto/elimina_producto', {  
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
