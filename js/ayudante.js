/**
 * @author Irek_Pelaez
 */



var d = new Date();
//Funcion para la fecha
function getFecha_aa_mm_dd() {
    dd = d.getDate();
    mm = d.getMonth() + 1;
    if (mm < 10) {
        mm = "0" + mm;
    }

    aaaa = d.getFullYear();
    f = aaaa + "-" + mm + "-" + dd;
    return f;
}


//Funcion para la fecha
function getFecha_dd_mm_aa() {
    dd = d.getDate();
    mm = d.getMonth() + 1;
    if (mm < 10) {
        mm = "0" + mm;
    }
    aaaa = d.getFullYear();
    f = dd + "-" + mm + "-" + aaaa;
    return f;
}


//Funcion para la hora
function getHora_hh_mm_ss() {
    h = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
    return h;
}



//Cambia el formato de la fecha: dd-mm-aaaa -> AÑO-Mes-DIA
//recibe una cadena de texto dividida por "-"
function FechaAAmmDD(_fecha) {

    if ((_fecha.length > 0) && (_fecha)) {
        var temp = _fecha.split("-");
        return (temp[2] + "-" + temp[1] + "-" + temp[0]);
    } else {
        return false;
    }
}



//Cambia el formato de la fecha: aaaa-mm-dd -> DIA-Mes-AÑO
//recibe una cadena de texto dividida por "-"
function FechaDDmmAA(_fecha) {

    if ((_fecha.length > 0) && (_fecha)) {
        var temp = _fecha.split("-");
        return (temp[2] + "-" + temp[1] + "-" + temp[0]);
    } else {
        return false;
    }
}

//Da formato a un numero para mostrar decimales
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}


//Codifica una cadena en UTF8
function encode_uri_utf8(s) {
    return unescape(encodeURIComponent(s));
}

//Descodifica una cadena desde UTF8
function decode_uri_utf8(s) {
    return decodeURIComponent(escape(s));
}
// function menu_elemento(){

//         $.ajax({
//             method: "POST",
//             data : 
//             { 
//                 nick:       nuser.Nick,
//                 token:      nuser.Token,
//                 Id_Elemento: nuser.Id_Elemento,
//                 Dev: nuser.Developer
//             },
//             url: "https://remex.parp/api/logger/modulos_asignados_menu",
//             success: function(respApi) {

//                     console.log(respApi);

//                     var respuesta = respApi.data;

//                    if (respApi.data == null){
                        
//                         $("#menu_modulos").val("");

//                     }else{
                        
//                         $("#menu_modulos").empty();
//                         for (var i = 0; i < respuesta.length; i++) {
//                         // $("#menu_modulos").append("<option value='" + respuesta[i].Submarca + "'>" + respuesta[i].Submarca + "</option>");
//                         $("#menu_modulos").append('<li class="nav-item"> <a class="nav-link" href="'+respuesta[i].URL+'"><i class="fa fa-table left-icon square"></i>'+respuesta[i].Nombre_menu+'</a> </li>');

//                         }

//                     }
//             }
//         });
// }
// $( document ).ready(function() {
//     menu_elemento();
// });
