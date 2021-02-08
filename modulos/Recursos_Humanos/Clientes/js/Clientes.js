$(document).ready(function() {

    InicializarDatatable("tabla_clientes");
    
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 2500
            };
            toastr.success(nuser.Nombre_completo);
    }, 1300);  
    
    $('#btn_status').change(function(){
        if($(this).prop("checked") == true){
            va = 1;
            $("#Estatus").val(va);
        }else{
            va = 0;
            $("#Estatus").val(va);
        }
    });

        listadoClientes();

         $("#wizard").steps();
         $("#form").steps({
             bodyTag: "fieldset",
             onStepChanging: function (event, currentIndex, newIndex)
             {
                 // Always allow going backward even if the current step contains invalid fields!
                 if (currentIndex > newIndex)
                 {
                     return true;
                 }

                 // Forbid suppressing "Warning" step if the user is to young
                 if (newIndex === 3 && Number($("#age").val()) < 18)
                 {
                     return false;
                 }

                 var form = $(this);

                 // Clean up if user went backward before
                 if (currentIndex < newIndex)
                 {
                     // To remove error styles
                     $(".body:eq(" + newIndex + ") label.error", form).remove();
                     $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                 }

                 // Disable validation on fields that are disabled or hidden.
                 form.validate().settings.ignore = ":disabled,:hidden";

                 // Start validation; Prevent going forward if false
                 return form.valid();
             },
             onStepChanged: function (event, currentIndex, priorIndex)
             {
                 // Suppress (skip) "Warning" step if the user is old enough.
                 if (currentIndex === 2 && Number($("#age").val()) >= 18)
                 {
                     $(this).steps("next");
                 }

                 // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                 if (currentIndex === 2 && priorIndex === 3)
                 {
                     $(this).steps("previous");
                 }
             },
             onFinishing: function (event, currentIndex)
             {
                 var form = $(this);

                 // Disable validation on fields that are disabled.
                 // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                 form.validate().settings.ignore = ":disabled";

                 // Start validation; Prevent form submission if false
                 return form.valid();
             },
             onFinished: function (event, currentIndex)
             {
                 var form = $(this);

                 // Submit form input
                 form.submit();
             }
         }).validate({
                     errorPlacement: function (error, element)
                     {
                         element.before(error);
                     },
                     rules: {
                         confirm: {
                             equalTo: "#password"
                         }
                     }
                 });
    
    }); 
    function comprobarCheck(var_check){

        if ($("#"+var_check+"").prop("checked")) {
            var checkIP = 1;
        } else {
            var checkIP = "false";
        }
    
        return checkIP;
    }
    
    function pintarCheckOtroTrabajo(var_check,respuesta_valor){
        if (respuesta_valor == 1) {
           $("#"+var_check+"").prop("checked", true);
           $("#divOTrabj").css("display", "block");
       }else{ 
           $("#"+var_check+"").prop("checked", false);
           $("#divOTrabj").css("display", "none");
       }
   }

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
    
    function listadoClientes(){
        var tabla = "tabla_clientes";
        //Se piden los datos
        $.ajax({
            url : 'https://remex.kerveldev.com/api/rh/clientes/lst_clientes',
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
                        "<td>"+checarNulos(reg.Id_Cliente)+"</td>"+
                        "<td>"+checarNulos(reg.Nombre)+"</td>"+
                        "<td>"+checarNulos(reg.Entidad)+"</td>"+
                        "<td>"+checarNulos(reg.Estatus)+"</td>"+
                        "<td>"+
    
                        "<button type='button' class='btn btn-sm btn-outline btn-primary p-2' onclick='abrirClientes_Id(\"" +  reg.Id_Cliente + "\",\"" +  reg.Nombre + "\")'; title='Informacion del cliente'><i class='fa fa-user'></i></button>&nbsp;"+
                        
                        // botones+
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
                console.log(xhr);
            }
        });
    }
    
    function abrirClientes_Id(_id_cliente, _nombre){
    
        $("#modal_clientes").modal({"backdrop":"static"});
    
        $("#nUsuario").text(_nombre);
    
        fetch ('https://remex.kerveldev.com/api/rh/clientes/id_cliente', {  
                method: 'POST',
                headers:{
            'Content-Type': 'application/json'
          },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    id: _id_cliente
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if(resJson.status_sesion){
                            
                    respuesta = resJson.data;
    
                    $("#Id_cliente").val(respuesta[0].Id_Cliente);
                    $("#Nombre").val(respuesta[0].Nombre);
                    $("#RFC").val(respuesta[0].RFC);
                    $("#Calle").val(respuesta[0].Calle);
                    $("#Numero").val(respuesta[0].Numero);
                    $("#CP").val(respuesta[0].CP);
                    $("#Municipio").val(respuesta[0].Municipio);
                    $("#Entidad").val(respuesta[0].Entidad);
                    $("#Pais").val(respuesta[0].Pais);
                    $("#Tel1").val(respuesta[0].Tel1);
                    $("#Ext1").val(respuesta[0].Ext1);
                    $("#Tel2").val(respuesta[0].Tel2);
                    $("#Ext2").val(respuesta[0].Ext2);
                    pintarCheckOtroTrabajo("btn_status",respuesta[0].Estatus);
                    $("#Estatus").val(respuesta[0].Estatus);
                  
                }
            })
    
    }
    
    function cerrarModalClientes(){
     $("#modal_clientes").modal("hide");
    }
    
    function guardar_cliente(){
        
        var Id_cliente = $("#Id_cliente").val();
        var Nombre = $("#Nombre").val();
        var RFC = $("#RFC").val();
        var Calle= $("#Calle").val();
        var Numero = $("#Numero").val();
        var CP = $("#CP").val();
        var Municipio = $("#Municipio").val();
        var Entidad = $("#Entidad").val();
        var Pais = $("#Pais").val();
        var Tel1 = $("#Tel1").val();
        var Ext1 = $("#Ext1").val();
        var Tel2 = $("#Tel2").val();
        var Ext2 = $("#Ext2").val();
        var Estatus = $("#Estatus").val();

        if(Estatus != 1 || Estatus != 0){
            Estatus = $("#Estatus").val();
        }else{
            Estatus = 0;
        }
    
        fetch ('https://remex.kerveldev.com/api/rh/clientes/modifica_clientes', {  
                    method: 'POST',
                    headers:{
                        'Content-Type': 'application/json'
                        },
                                body: JSON.stringify({
                                        nick:nuser.Nick,
                                        token: nuser.Token,
                                        Id: Id_cliente,
                                        datos:{
                                            Nombre: Nombre,
                                            RFC: RFC,
                                            Calle: Calle,
                                            Numero: Numero,
                                            CP: CP,
                                            Municipio: Municipio,
                                            Entidad: Entidad,
                                            Pais: Pais,
                                            Tel1: Tel1,
                                            Ext1: Ext1,
                                            Tel2: Tel2,
                                            Ext2: Ext2,
                                            Estatus: Estatus
                                        }
                                            
                                        })
                                    }).then((res)=> res.json())
                                        .then((respApi)=>{
                                            console.log(respApi);
    
                                            if(respApi.status_sesion){
    
                                                        if(respApi.status){
                                                            swal({
                                                                  timer: 2000,
                                                                  type: 'success',
                                                                  title: 'Actualizado',
                                                                  text:'Modificacion de información Exitosa',
                                                                  showConfirmButton: false,
                                                                });
                                                            
                                                        }else{
                                                             swal({
                                                                  type: 'error',
                                                                  title: 'Error al modificar información',
                                                                  text: respApi.msj,
                                                                });
                                                        }
                                            }else{//Status false
                                                swal({
                                                          type: 'error',
                                                          title: 'Sesión expiró',
                                                          text: respApi.msj,
                                                          showConfirmButton: false,
                                                        });
                                                
                                            }
                                        })
    }
    
    function cerrarcontraseña(){
        $("#modal_contraseñas").modal("hide");
        
    }
    
    function eliminarUsuario(rfc, nombre){
    
        swal({
            title: 'Deseas eliminar a '+nombre+' ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminalo!'
        }).then((result) => {
            if (result.value) {
        fetch ('https://remex.kerveldev.com/api/logger/elimina_usuario', {  
        method: 'DELETE',   
        headers:{
        'Content-Type': 'application/json'
        },
            body: JSON.stringify({
                nick: nuser.Nick,
                token: nuser.Token,
                rfc: rfc
            })
        }).then((res)=> res.json())
            .then((resdelJson)=>{
                console.log(resdelJson)
    
                if(resdelJson.status_sesion){
    
                    if (resdelJson.status) {
                        cerrarmodal_Usuarios();
                        swal({
                            type: 'success',
                            title: 'El Usuario ha sido eliminada.!',
                            confirmButtonText: 'Ok'
                        }).then((result)=>{
                            if(result.value){
                               document.location.reload();
    
                            }
                        })
                    }else{
                        cerrarmodal_Usuarios();
                        swal(
                                    'Error!',
                                    'El Usuario no fue eliminado.',
                                    'error'
                                )
                    }
                   
    
                }else{
                     swal({
                           title: 'La sesion a caducado, inicie sesion nuevamente',
                            
                            confirmButtonText: 'Ok'
                        }).then((result)=>{
                            if(result.value){
                            document.location.reload();
                            }
                        })
                }
            })
    
            }
        });
    }
    
    function agregar_usu(){
        $("#modal_clientes").modal();
        $("#Pasword").prop("disabled",false);
    
        var actualiza = "nuevo";
        $("#accion").val(actualiza);
    }
    
    function abrirmodal(rfc, nombre){
        $("#modal_clientes").modal();
    
        $("#nombre_usuario").text(nombre);
    
        fetch ('https://remex.kerveldev.com/api/logger/navegante_rfc', {  
                method: 'POST',
                headers:{
            'Content-Type': 'application/json'
          },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    rfc: rfc
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if(resJson.status_sesion){
                            
                    respuesta = resJson.data;
                    var actualiza = "actualiza";
                    $("#accion").val(actualiza);
                    $("#RFC").val(respuesta[0].RFC);
                    $("#Nombre").val(respuesta[0].Nombre);
                    $("#Apaterno").val(respuesta[0].Apaterno);
                    $("#Amaterno").val(respuesta[0].Amaterno);
                    $("#Nombramiento").val(respuesta[0].Nombramiento);
                    $("#U_Fisica").val(respuesta[0].U_Fisica);
                    $("#Email").val(respuesta[0].Email);
                    $("#Niv_acceso").val(respuesta[0].Niv_acceso);
                    $("#Nick_user").val(respuesta[0].Nick);
                    $("#Pasword").val(respuesta[0].Pasword);
                    $("#Pasword").prop("disabled",true);
    
                    var status = respuesta[0].Status;
                    if (status == 1) {
                        val = 1;
                        $("#Status").attr('checked', true);
                        $("#Status").val(val);
                    }else{
                        val = 0;
                        $("#Status").attr('checked', false);
                        $("#Status").val(val);
                    }
                    
                }
            })
    
    }
    
    $("#Status").on('change', function(){
            var v = document.getElementById("Status");
            if(v.checked===true){
                var val = 1;
                $("#Status").val(val);
            }else{
                var val= 0;
                $("#Status").val(val);
            }
        });
    
    
    function cerrarmodal_Usuarios(){
        $("#modal_clientes").modal("hide");
        limpiar_mUsuarios();
    }
    
    function limpiar_mUsuarios(){
        $("#RFC").val();
        $("#Nombre").val();
        $("#APaterno").val();
        $("#AMaterno").val();
        $("#Nombramiento").val();
        $("#U_Fisica").val();
        $("#Email").val();
        $("#Niv_acceso").val();
        $("#Nick_user").text();
        $("#Pasword").val();
        $("#Status").val();
    
    }
    
    function guardarDatos(){
    
    
        var accion = $("#accion").val();
        var RFC = $("#RFC").val();
        var Nombre = $("#Nombre").val();
        var Apaterno = $("#Apaterno").val();
        var Amaterno = $("#Amaterno").val();
        var Nombramiento = $("#Nombramiento").val();
        var U_Fisica = $("#U_Fisica").val();
        var Email = $("#Email").val();
        var Nick = $("#Nick_user").val();
        var Pasword = $("#Pasword").val();
        var Niv_acceso = $("#Niv_acceso").val();
        var Status = $("#Status").val();
    
    
      if((accion == "nuevo")){
        
    
         fetch ('https://remex.kerveldev.com/api/logger/crea_usuario', {  
                method: 'PUT',
                headers:{
            'Content-Type': 'application/json'
            },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    datos: {
                        RFC: RFC,
                        Apaterno: Apaterno,
                        Amaterno: Amaterno,
                        Nombre: Nombre,
                        Nick: Nick,
                        Pasword: Pasword,
                        Email: Email,
                        Status: Status,
                        Niv_acceso: Niv_acceso
    
                                        }
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if (resJson.status_sesion) {
    
                        if (resJson.status) {
                            
                            cerrarmodal_Usuarios();
                             swal({
                                        type: 'success',
                                        title: 'Usuario Creado con Exito',
                                        confirmButtonText: 'Ok'
                                
                                        });
                
                        }else{
                            cerrarmodal_Usuarios();
                            swal(
                                    'Error!',
                                    'El Usuario no fue creado.',
                                    'error'
                                )
                        }
                    }else{
                         swal({
                           title: 'La sesion a caducado, inicie sesion nuevamente',
                            
                            confirmButtonText: 'Ok'
                        }).then((result)=>{
                            if(result.value){
    
                                //carga_mod(id);
                               
                            }
                        })
                    }
    
                })
    }else{
            fetch ('https://remex.kerveldev.com/api/logger/act_usuario', {  
                method: 'POST',
                headers:{
            'Content-Type': 'application/json'
            },
                body: JSON.stringify({
                    nick: nuser.Nick,
                    token: nuser.Token,
                    datos: {
                        RFC: RFC,
                        Apaterno: Apaterno,
                        Amaterno: Amaterno,
                        Nombre: Nombre,
                        Nombramiento: Nombramiento,
                        U_Fisica: U_Fisica,
                        Email: Email,
                        Status: Status,
                        Niv_acceso: Niv_acceso
    
                                        }
                })
            }).then((res)=> res.json())
                .then((resJson)=>{
                    console.log(resJson)
    
                    if (resJson.status_sesion) {
    
                        if (resJson.status) {
                         
                            cerrarmodal_Usuarios();
                             swal({
                                        type: 'success',
                                        title: 'Usuario Modificado con Exito',
                                        confirmButtonText: 'Ok'
                                
                                        });
                            
                        }else{
                            cerrarmodal_Usuarios();
                            swal(
                                    'Error!',
                                    'El Usuario no Modificado.',
                                    'error'
                                )
                        }
                    }else{
                         swal({
                           title: 'La sesion a caducado, inicie sesion nuevamente',
                            
                            confirmButtonText: 'Ok'
                        }).then((result)=>{
                            if(result.value){
    
                                //carga_mod(id);
                               
                            }
                        })
    
                    }
    
                })
    }
    }