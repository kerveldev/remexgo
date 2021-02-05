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
    
    function getEdad(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var edad = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            edad--;
        }
        return edad;
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
    
    
    function listadoUsuarios(){
        var tabla = "tabla_usuarios";
        //Se piden los datos
        $.ajax({
            url : 'https://remex.kerveldev.com/api/rh/altas/navegantes_lst',
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
                                        {   text: 'Agregar Elemento',
                                            className: 'btn btn-success',
                                            action: function(e, dt, node, config) {
                                                
                                                abrirNuevoUsuario();
                                                
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

    function limpiarModalUsuario(){

            //Datos Personales
            $("#A_Paterno_usuario").val("");
            $("#A_Materno_usuario").val("");
            $("#Nombre_usuario").val("");
            $("#f_nacimiento_usuario").val("");
            $("#edad_usuario").val("");
            $("#nacionalidad_usuario").val("");
            $("#entidad_nac_usuario").val("");
            $("#municipio_nac_usuario").val("");
            $("#genero_usuario").val("");
            $("#tipo_sangre_usuario").val("");
            $("#edo_civil_usuario").val("");
            $("#e_mail_usuario").val("");
            $("#telefono_usuario").val("");
            $("#cel_usuario").val("");
            $("#tel_2_usuario").val("");
            
            //Domicilio
            $("#calle_usuario").val("");
            $("#nexterior_usuario").val("");
            $("#ninterior_usuario").val("");
            $("#cp_usuario").val("");
            $("#cruce1_usuario").val("");
            $("#cruce2_usuario").val("");
            $("#colonia_usuario").val("");
            $("#entidad_dom_usuario").val("");
            $("#municipio_dom_usuario").val("");


    }
    
    function abrirNuevoUsuario(){
        
        limpiarModalUsuario();
        $("#modal_usuario").modal({"backdrop":"static"});
   
        $("#nUsuario").text("Nuevo Usuario");
   
   }
    
    function abrirUsuario_Id(_id_elemento, _nombre_usuario){
    
         $("#modal_usuario").modal({"backdrop":"static"});
    
        $("#nUsuario").text(_nombre_usuario);
    
        fetch ('https://remex.kerveldev.com/api/rh/altas/navegante_id', {  
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
                    
                    //Datos Personales
                    $("#A_Paterno_usuario").val(respuesta[0].Apaterno);
                    $("#A_Materno_usuario").val(respuesta[0].Amaterno);
                    $("#Nombre_usuario").val(respuesta[0].Nombre);
                    $("#f_nacimiento_usuario").val(respuesta[0].FNacimiento);

                    $("#edad_usuario").val(getEdad(respuesta[0].FNacimiento));
                    // $("#edad_usuario").val(respuesta[0].Apaterno);
                    $("#nacionalidad_usuario").val(respuesta[0].Nacionalidad);
                    $("#entidad_nac_usuario").val(respuesta[0].Entidad);
                    $("#municipio_nac_usuario").val(respuesta[0].MunicipioNac);
                    $("#genero_usuario").val(respuesta[0].Genero);
                    $("#tipo_sangre_usuario").val(respuesta[0].TipoSangre);
                    $("#edo_civil_usuario").val(respuesta[0].EdoCivil);
                    $("#e_mail_usuario").val(respuesta[0].Email);
                    $("#telefono_usuario").val(respuesta[0].Tel);
                    $("#cel_usuario").val(respuesta[0].Cel);
                    $("#tel_2_usuario").val(respuesta[0].OtroTel);
                    
                    //Domicilio
                    $("#calle_usuario").val(respuesta[0].Calle);
                    $("#nexterior_usuario").val(respuesta[0].Num);
                    $("#ninterior_usuario").val(respuesta[0].NInterior);
                    $("#cp_usuario").val(respuesta[0].CP);
                    $("#cruce1_usuario").val(respuesta[0].Cruce1);
                    $("#cruce2_usuario").val(respuesta[0].Cruce2);
                    $("#colonia_usuario").val(respuesta[0].Colonia);
                    $("#entidad_dom_usuario").val(respuesta[0].Estado);
                    $("#municipio_dom_usuario").val(respuesta[0].Municipio);
                  
                }
            })
    
    }
    
    function cerrarModalUsuario_Id(){
     $("#modal_usuario").modal("hide");
    }
    
    
    function modificaContraseña(rfc){
    
        $("#modal_contraseñas").modal();
    
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
                    $("#Nick_cam").val(respuesta[0].Nick);
                    $("#Pasword_cam").val(respuesta[0].Pasword);
                    $("#Pasword").prop("disabled",false);
    
                }
            })
    
    }
    
    function guardarcambio(){
    
        var Nick_cam = $("#Nick_cam").val();
        var Pasword_cam = $("#Pasword_cam").val();
    
        fetch ('https://remex.kerveldev.com/api/logger/act_contraseña', {  
                    method: 'POST',
                    headers:{
                        'Content-Type': 'application/json'
                        },
                                body: JSON.stringify({
                                        nick:nuser.Nick,
                                        token: nuser.Token,
                                        nick_mod: Nick_cam,
                                        pass: Pasword_cam
                                            
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
                                                                  text:'Cambio de Contraseña Exitosa',
                                                                  showConfirmButton: false,
                                                                });
                                                            cerrarcontraseña();
                                                            
    
                                                        }else{
                                                             swal({
                                                                  type: 'error',
                                                                  title: 'Error al Intentar Cambiar la Contraseña',
                                                                  text: respApi.msj,
                                                                });
                                                             cerrarcontraseña();
                                                        }
                                            }else{//Status false
                                                swal({
                                                          type: 'error',
                                                          title: 'Sesión expiró',
                                                          text: respApi.msj,
                                                          showConfirmButton: false,
                                                        });
                                                //location = "https://lab.parp.mx";
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
        $("#modal_usuarios").modal();
        $("#Pasword").prop("disabled",false);
    
        var actualiza = "nuevo";
        $("#accion").val(actualiza);
    }
    
    function abrirmodal(rfc, nombre){
        $("#modal_usuarios").modal();
    
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
        $("#modal_usuarios").modal("hide");
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