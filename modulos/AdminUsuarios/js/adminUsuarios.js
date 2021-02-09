$(document).ready(function() {

InicializarDatatable("tabla_usuarios");

    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2500
        };
        toastr.success(nuser.Nombre_completo);
}, 1300);  

     listadoUsuarios();

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

function listadoUsuarios(){
    var tabla = "tabla_usuarios";
    //Se piden los datos
    $.ajax({
        url : 'https://remex.kerveldev.com/api/logger/navegantes_lst',
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
                    "<td>"+checarNulos(reg.NoEmp_RH)+"</td>"+
                    "<td>"+checarNulos(reg.Nombre_Completo)+"</td>"+
                    "<td>"+checarNulos(reg.EdoAdmtvo)+"</td>"+
                    "<td>"+

                    "<button type='button' class='btn btn-sm btn-outline btn-primary p-2' onclick='abrirUsuario_Id(\"" +  reg.Id_Elemento + "\",\"" +  reg.Nombre_Completo + "\")'; title='Abrir Contraseña & Nick: "+reg.Nombre_Completo+"'><i class='fa fa-user'></i></button>&nbsp;"+
                    // "<button type='button' class='btn btn-sm btn-outline btn-success p-2' onclick='asignaModulo(\"" +  reg.Id_Elemento + "\",\"" +  reg.Nombre_Completo + "\")'; title='Asignar Modulo a Usuario: "+reg.Nombre_Completo+"'><i class='fa fa-list-alt'></i></button>&nbsp;</td>"+
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
                            { responsivePriority: 2, targets: 3 }
                        ],
                        // select: {
                        //     'style': 'multi',
                        //     'selector': 'td:not(.control)'
                        // },
                        order: [
                            [0, "asc"]
                        ],
                        buttons: [

                            {   extend: 'excel', 
                                className: 'btn btn-info',
                            }
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
            
        }
    });
}

function cerrarModalUsuario_Id(){

    $("#modal_usuario").modal("hide");

}
   

function abrirUsuario_Id(_id_elemento, _nombre_usuario){

    $("#modal_usuario").modal({"backdrop":"static"});

    $("#nUsuario").text(_nombre_usuario);

    $(".btn-guardar-usuario").attr('onClick', 'actualizarUsuario('+_id_elemento+');');

    fetch ('https://remex.kerveldev.com/api/logger/navegante_id', {  
            method: 'POST',
            headers:{
        'Content-Type': 'application/json'
      },
            body: JSON.stringify({
                nick: nuser.Nick,
                token: nuser.Token,
                Id_Elemento: _id_elemento
            })
        }).then((res)=> res.json())
            .then((resJson)=>{
                console.log(resJson)

                if(resJson.status_sesion){
                        
                respuesta = resJson.data;

                $("#Nombre_usuario").val(respuesta[0].Nombre);
                $("#A_Paterno_usuario").val(respuesta[0].Apaterno);
                $("#A_Materno_usuario").val(respuesta[0].Amaterno);
                $("#Nick_cam").val(respuesta[0].Nick);
                $("#Pasword_cam").val(respuesta[0].Pasword);
              
            }
        })

}



function actualizarUsuario(_id_elemento){
    //Datos Personales
    
    var Nick = $("#Nick_cam").val();
    var Pasword = $("#Pasword_cam").val();

    fetch ('https://remex.kerveldev.com/api/rh/altas/modifica_navegantes',{  
        method: 'POST',
        headers:{
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token,
                Id:_id_elemento,
                datos:{ 
                        Nick:Nick,
                        Pasword:Pasword
                    }  
            })
        }).then((res)=> res.json()).then((respApi)=>{
            var respuesta = respApi.data;

            if (respApi.status) {
                swal({
                    type: 'success',
                    title: 'Actualización exitosa.',
                    text: respuesta,
                })

                listadoUsuarios();
                
            }else{
                swal({
                    type: 'error',
                    html: '<h2>Error</h2><p>'+respApi.msj+'</p>',
                    showConfirmButton: true,
                });
                $("#modal_usuario").modal("hide");
            }
            
        });

}
