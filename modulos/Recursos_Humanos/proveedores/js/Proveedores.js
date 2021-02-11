$(document).ready(function() {

    InicializarDatatable("tabla_proveedores");
        
    setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 2500
            };
            toastr.success(nuser.Nombre_completo);
    }, 1300);  
    
    listadoProveedores();
    
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
    
    
function listadoProveedores(){
        var tabla = "tabla_proveedores";
        //Se piden los datos
        $.ajax({
            url : 'https://remex.kerveldev.com/api/proveedores/proveedores/proveedores_lst',
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
                var color = "";
                var botonInactivar = "";
                var botonActivar = "";
               
                lst.forEach(reg => {

                    if(reg.Estatus == null || reg.Estatus == ''){
                        color="text-danger";
                        botonInactivar = "";
                        botonActivar = "<button type='button' class='btn btn-sm btn-outline btn-info p-2' onclick='activarProveedor_Id(\"" +  reg.Id_Proveedor + "\",\"" +  reg.Nombre + "\")'; title='Activar Proveedor: "+reg.Nombre+"'><i class='fa fa-check'></i></button>&nbsp;"; 
                    }else{
                        color = "text-info";
                        botonInactivar = "<button type='button' class='btn btn-sm btn-outline btn-danger p-2' onclick='inactivarProveedor_Id(\"" +  reg.Id_Proveedor + "\",\"" +  reg.Nombre + "\")'; title='Desactivar Proveedor: "+reg.Nombre+"'><i class='fa fa-check'></i></button>&nbsp;"; 
                        botonActivar = "";
                    }

                    tbody += 
                        "<tr class='"+color+"'>"+
                        "<td>"+checarNulos(reg.Id_Proveedor)+"</td>"+
                        "<td>"+checarNulos(reg.Nombre)+"</td>"+
                        "<td>"+checarNulos(reg.Tel1)+"</td>"+
                        "<td>"+checarNulos(reg.Tel2)+"</td>"+
                        "<td>"+checarNulos(reg.Municipio)+"</td>"+
                        "<td>"+

                            "<button type='button' class='btn btn-sm btn-outline btn-success p-2' onclick='abrirProveedor_Id(\"" +  reg.Id_Proveedor + "\",\"" +  reg.Nombre + "\")'; title='Abrir Informacion Proveedor: "+reg.Nombre+"'><i class='fa fa-user'></i></button>&nbsp;"+
                            // "<button type='button' class='btn btn-sm btn-outline btn-danger p-2' onclick='eliminarProveedor_Id(\"" +  reg.Id_Proveedor + "\",\"" +  reg.Nombre + "\")'; title='Eliminar Proveedor: "+reg.Nombre+"'><i class='fa fa-trash'></i></button>&nbsp;"+
                            botonInactivar+
                            botonActivar+
                            
                        

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
                                        {   text: 'Agregar Proveedor',
                                            className: 'btn btn-success',
                                            action: function(e, dt, node, config) {
                                                
                                                abrirNuevoProveedor();
                                                
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

    function limpiarModalProveedor(){

        $("#nombre_proveedor").val("");
        $("#contacto_proveedor").val("");
        $("#tel_1_proveedor").val("");
        $("#ext_1_proveedor").val("");
        $("#tel_2_proveedor").val("");
        $("#ext_2_proveedor").val("");
        $("#direccion_proveedor").val("");
        $("#cp_proveedor").val("");
        $("#municipio_proveedor").val("");
        $("#entidad_proveedor").val("");
        $("#pais_proveedor").val("");
        $("#email_proveedor").val("");

    }
    
    function abrirNuevoProveedor(){
        
    
        $("#modal_proveedor").modal({"backdrop":"static"});
        $(".btn-guardar-proveedor").attr('onClick', 'guardarNuevoProveedor();');
        $("#nProveedor").text("Nuevo Proveedor");
   
   }
    
    function abrirProveedor_Id(_id_proveedor, _nombre_proveedor){
    
        $("#modal_proveedor").modal({"backdrop":"static"});
        $(".btn-guardar-proveedor").attr('onClick', 'actualizarProveedor('+_id_proveedor+');');
        $("#nProveedor").text(_nombre_proveedor);
    
        fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/proveedores_id', {  
                method: 'POST',
                headers:{
            'Content-Type': 'application/json'
          },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    Id: _id_proveedor
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if(resJson.status_sesion){
                            
                    respuesta = resJson.data;

                    $("#nombre_proveedor").val(respuesta[0].Nombre);
                    $("#contacto_proveedor").val(respuesta[0].Contacto);
                    $("#tel_1_proveedor").val(respuesta[0].Tel1);
                    $("#ext_1_proveedor").val(respuesta[0].Ext1);
                    $("#tel_2_proveedor").val(respuesta[0].Tel2);
                    $("#ext_2_proveedor").val(respuesta[0].Ext2);
                    $("#direccion_proveedor").val(respuesta[0].Direccion);
                    $("#cp_proveedor").val(respuesta[0].CP);
                    $("#municipio_proveedor").val(respuesta[0].Municipio);
                    $("#entidad_proveedor").val(respuesta[0].Entidad);
                    $("#pais_proveedor").val(respuesta[0].Pais);
                    $("#email_proveedor").val(respuesta[0].Email);
                   
                }
            })
    
    }
    
function cerrarModalProveedor_Id(){
    $("#modal_proveedor").modal("hide");
    limpiarModalProveedor();
}
    
function guardarNuevoProveedor(){

    var Nombre = $("#nombre_proveedor").val();
    var Contacto = $("#contacto_proveedor").val();
    var Tel1 = $("#tel_1_proveedor").val();
    var Ext1 = $("#ext_1_proveedor").val();
    var Tel2 = $("#tel_2_proveedor").val();
    var Ext2 = $("#ext_2_proveedor").val();
    var Direccion = $("#direccion_proveedor").val();
    var CP	 = $("#cp_proveedor").val();
    var Municipio = $("#municipio_proveedor").val();
    var Entidad = $("#entidad_proveedor").val();
    var Pais = $("#pais_proveedor").val();
    var Email = $("#email_proveedor").val();
   
    fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/crea_proveedor',{  
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

            cerrarModalProveedor_Id();
            listadoProveedores();

            if (respApi.status) {
                swal({
                    type: 'success',
                    title: 'Creacion exitosa.',
                    text: respuesta,
                })

                
               
                
            }else{
                $("#modal_proveedor").modal("hide");
                swal({
                    type: 'error',
                    html: '<h2>Error</h2><p>'+respApi.msj+'</p>',
                    showConfirmButton: true,
                });
               
            }
            
        });

}

function actualizarProveedor(_id_proveedor){

    var Nombre = $("#nombre_proveedor").val();
    var Contacto = $("#contacto_proveedor").val();
    var Tel1 = $("#tel_1_proveedor").val();
    var Ext1 = $("#ext_1_proveedor").val();
    var Tel2 = $("#tel_2_proveedor").val();
    var Ext2 = $("#ext_2_proveedor").val();
    var Direccion = $("#direccion_proveedor").val();
    var CP	 = $("#cp_proveedor").val();
    var Municipio = $("#municipio_proveedor").val();
    var Entidad = $("#entidad_proveedor").val();
    var Pais = $("#pais_proveedor").val();
    var Email = $("#email_proveedor").val();

    fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/modifica_proveedor',{  
        method: 'POST',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                Id:_id_proveedor,
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

            cerrarModalProveedor_Id();
            listadoProveedores();

            if (respApi.status) {
                swal({
                    type: 'success',
                    title: 'Actualización exitosa.',
                    text: respuesta,
                })

            }else{
                $("#modal_proveedor").modal("hide");
                swal({
                    type: 'error',
                    html: '<h2>Error</h2><p>'+respApi.msj+'</p>',
                    showConfirmButton: true,
                });
               
            }
            
        });

}


function eliminarProveedor_Id(_id_proveedor, nombre){
    
    swal({
        title: 'Deseas eliminar a '+nombre+' ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.value) {
    fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/elimina_proveedor', {  
    method: 'DELETE',   
    headers:{
    'Content-Type': 'application/json'
    },
        body: JSON.stringify({
            nick: nuser.Nick,
            token: nuser.Token,
            Id: _id_proveedor
        })
    }).then((res)=> res.json())
        .then((resdelJson)=>{
            console.log(resdelJson)

                if (resdelJson.status) {
                   
                    swal({
                        type: 'success',
                        title: 'El Proveedor ha sido eliminado.!',
                        confirmButtonText: 'Ok'
                    })
                              
                    listadoProveedores();

                }else{
                   
                    swal(
                        'Error!',
                        'El Proveedor no fue eliminado.',
                        'error'
                        )
                }

            })

        }
    });
}



function inactivarProveedor_Id(_id_proveedor,nombre){

    swal({
        title: 'Deseas inactivar a '+nombre+' ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, inactivar!'
    }).then((result) => {
        if (result.value) {
    fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/modifica_proveedor', {  
    method: 'POST',   
    headers:{
    'Content-Type': 'application/json'
    },
        body: JSON.stringify({
            nick: nuser.Nick,
            token: nuser.Token,
            Id: _id_proveedor,
            datos:{
                Estatus:"0"
            }
        })
    }).then((res)=> res.json())
        .then((resdelJson)=>{
            console.log(resdelJson)

                if (resdelJson.status) {
                   
                    swal({
                        type: 'success',
                        title: 'El Proveedor ha sido inactivado.!',
                        confirmButtonText: 'Ok'
                    })
                              
                    listadoProveedores();

                }else{
                   
                    swal(
                        'Error!',
                        'El Proveedor no fue inactivado.',
                        'error'
                        )
                }

            })

        }
    });

}


function activarProveedor_Id(_id_proveedor,nombre){

    swal({
        title: 'Deseas activar a '+nombre+' ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, activar!'
    }).then((result) => {
        if (result.value) {
    fetch ('https://remex.kerveldev.com/api/proveedores/proveedores/modifica_proveedor', {  
    method: 'POST',   
    headers:{
    'Content-Type': 'application/json'
    },
        body: JSON.stringify({
            nick: nuser.Nick,
            token: nuser.Token,
            Id: _id_proveedor,
            datos:{
                Estatus:"1"
            }
        })
    }).then((res)=> res.json())
        .then((resdelJson)=>{
            console.log(resdelJson)

                if (resdelJson.status) {
                   
                    swal({
                        type: 'success',
                        title: 'El Proveedor ha sido activado.!',
                        confirmButtonText: 'Ok'
                    })
                              
                    listadoProveedores();

                }else{
                   
                    swal(
                        'Error!',
                        'El Proveedor no fue activado.',
                        'error'
                        )
                }

            })

        }
    });

}


