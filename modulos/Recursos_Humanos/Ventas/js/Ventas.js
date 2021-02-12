$(document).ready(function() {

    //InicializarDatatable("tabla_clientes");
    
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
                "emptyTable": "Sin productos agregados",
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
    
    function listadoClientes(Id,Nombre,Cantidad,Descuento,Precio){
       // var tabla = "tabla_clientes";
        
        cerrarModalArticulos();
        
        if(Id == "" || Id == undefined){

            InicializarDatatable("tabla_clientes");
        }else{
            var t = $('#tabla_clientes').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                    );
                }
            }).fnAddData([]);
            rep = Id.length;
            for(i=0;i<rep; i++){
                t.row.add( [
                    Id[i],
                    Nombre[i],
                    Cantidad[i],
                    Descuento[i],
                    Precio[i],
                    "<button type='button' class='btn btn-sm btn-outline btn-info p-2' onclick='abrirClientes_Id()'; title='Informacion del cliente'><i class='fa fa-refresh'></i></button>&nbsp;",
                ] ).draw( false );
                
            }
        }
     
    }
    
    function abrirClientes_Id(_id_cliente, _nombre){
    
        $("#modal_clientes").modal({"backdrop":"static"});
    
        $("#nUsuario").text(_nombre);

        var _botonGuardar = '<button id="botonGuardar" type="button" class="btn btn-success" onclick="guardar_cliente();" >Guardar</button>';
        $(".modal-footer").html(_botonGuardar);


        cargar_datos(_id_cliente, _nombre);
    
    }
    
    function cargar_datos(_id_cliente, _nombre){
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

    function nuevo_cliente(){
        $("#modal_clientes").modal({"backdrop":"static"});
        var _botonGuardar = '<button id="botonGuardar" type="button" class="btn btn-success" onclick="guarda_nuevo();" >Guardar</button>';
        $(".modal-footer").html(_botonGuardar);
    }

    function guarda_nuevo(){
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

        if(Estatus == 1 || Estatus == 0){
            Estatus = $("#Estatus").val();
        }else{
            Estatus = 0;
        }
    
        fetch ('https://remex.kerveldev.com/api/rh/clientes/crea_clientes', {  
                    method: 'PUT',
                    headers:{
                        'Content-Type': 'application/json'
                        },
                                body: JSON.stringify({
                                        nick:nuser.Nick,
                                        token: nuser.Token,
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
                                                                  title: 'Nuevo',
                                                                  type: 'success',
                                                                  text:'Cliente creado exitosamente',
                                                                  showConfirmButton: true,
                                                                  confirmButtonColor: "#8CD4F5",
                                                                  confirmButtonText: "OK",
                                                                  closeOnConfirm: false
                                                                });
                                                            cerrarModalClientes();
                                                        }else{
                                                             swal({
                                                                  type: 'error',
                                                                  title: 'Error al modificar información',
                                                                  text: respApi.msj,
                                                                });
                                                            cerrarModalClientes();
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

        if(Estatus == 1 || Estatus == 0){
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
                                                                  title: 'Actualizado',
                                                                  type: 'success',
                                                                  text:'Modificacion de información Exitosa',
                                                                  showConfirmButton: true,
                                                                  confirmButtonColor: "#8CD4F5",
                                                                  confirmButtonText: "OK",
                                                                  closeOnConfirm: false
                                                                });
                                                            cerrarModalClientes();
                                                        }else{
                                                             swal({
                                                                  type: 'error',
                                                                  title: 'Error al modificar información',
                                                                  text: respApi.msj,
                                                                });
                                                            cerrarModalClientes();
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
    
    function cerrarModalArticulos(){
        $("#modal_articulos").modal("hide");
    }
       
    function limpia_clientes(){
   
           $("#Id_cliente").val("");
           $("#Nombre").val("");
           $("#RFC").val("");
           $("#Calle").val("");
           $("#Numero").val("");
           $("#CP").val("");
           $("#Municipio").val("");
           $("#Entidad").val("");
           $("#Pais").val("");
           $("#Tel1").val("");
           $("#Ext1").val("");
           $("#Tel2").val("");
           $("#Ext2").val("");
           pintarCheckOtroTrabajo("btn_status",0);
           $("#Estatus").val("");
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
    
    setTimeout(function(){
        fetch ('https://remex.kerveldev.com/api/rh/clientes/lst_clientes', {  
            method: 'POST',
            headers:{
            'Content-Type': 'application/json'
        },
            body: JSON.stringify({
                nick : nuser.Nick,
                token: nuser.Token
            })
            }).then((res)=> res.json())
                .then((resJson)=>{
                console.log(resJson);
        
                    if (resJson.status_sesion == true) {
                        if (resJson.status == true) {
                            var respuesta = resJson.data;
                            var option = "";
        
                            for (var i = 0; i < respuesta.length; i++) {
                                option += "<option value='" + respuesta[i].Id_Cliente + "'>" + respuesta[i].Nombre + "</option>";
                            }
        
                            $("#Sel_clientes").html(option);
                        }else{
                            swal(
                                'Error!',
                                'No se pudo cargar el registro.',
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
    }, 400);
    
    function nuevo_articulo(){
        $("#modal_articulos").modal({"backdrop":"static"});
        var tabla = "tabla_articulos";
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
                    estado = "";
                    if(reg.Estatus == 1){
                        estado = "<span class='label label-primary'>ACTIVO</span>";
                    }else{
                        estado = "<span class='label label-danger'>INACTIVO</span>";
                    }
                    tbody += 
                        "<tr>"+
                        "<td>"+checarNulos(reg.Id_SP)+"</td>"+
                        "<td>"+checarNulos(reg.Nombre_SP)+"</td>"+
                        "<td>"+checarNulos(reg.Cantidad)+"</td>"+
                        "<td>"+checarNulos(reg.Descuento)+"</td>"+
                        "<td>"+checarNulos(reg.Precio)+"</td>"+
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
    
                            dom: "<'row'<'col-sm-12 col-sm-4 col-xl-4'i><'col-sm-12 col-sm-2 col-xl-2'><' col-sm-12 col-sm-4 col-xl-4 floatRight'f>>" +
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
                            select: {
                                'style': 'multi',
                                'selector': 'td:not(.control)'
                            },
                            order: [
                                [0, "asc"]
                            ],
                            buttons: [
    
                                {   extend: 'excel', 
                                    className: 'btn btn-info',
                                },

                                {   text: 'Agregar',
                                        className: 'btn btn-info',
                                        titleAttr: 'Agregar',
                                        action: function(e, dt, node, config) {

                                            //Enviar datos del articulo a pantalla principal              
                                            var Id = new Array();
                                            var Nombre = new Array();
                                            var Cantidad = new Array();
                                            var Descuento = new Array();
                                            var Precio = new Array();

                                            Id = [];
                                            Nombre = [];
                                            Cantidad = [];
                                            Descuento = [];
                                            Precio = [];

                                            for (i = 0; i < table.rows('.selected').data().length; i++) {

                                                Id[i] = table.rows('.selected').data()[i][0];
                                                Nombre[i] = table.rows('.selected').data()[i][1];
                                                Cantidad[i] = table.rows('.selected').data()[i][2];
                                                Descuento[i] = table.rows('.selected').data()[i][3];
                                                Precio[i] = table.rows('.selected').data()[i][4];

                                            }

                                            listadoClientes(Id,Nombre,Cantidad,Descuento,Precio);
                                            
                                        }
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