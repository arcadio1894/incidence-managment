$(document).on('ready', principal);

function principal()
{
    $modal = $('#ver-modal');

    $('#all').on('click', getAll);
    $('#new').on('click', getNew);
    $('#info').on('click', getInfo);
    $('#accept').on('click', getAccept);
    $('#assign').on('click', getAssign);
    $('#result').on('click', getResult);
    $('#close').on('click', getClose);
    $('.botoncito').on('click', showModal);
    $('[data-name]').on('click', showModal);

    $('#btnSearch').on('click', getSearch);

    $('#btnSearchDates').on('click', getSearchDates);

    $.ajax({
        url: 'php/incidencia/traer_incidencias2.php',
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

var $modal;

function showModal() {
    console.log('Entre');
    alert('Lo');
    /*var id = $(this).data('id');
    var resumen = $(this).data('name');
    console.log(id);
    console.log(name);
    $.ajax({
        url: 'php/incidencia/traer_seguimiento.php',
        data: { id:id },
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $modalVer.find("#body-seguimiento").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
    $modalVer.find("#resumen-incidencia").val(resumen);

    $modalVer.modal('show');*/
}

function getSearchDates () {
    var start = $("#start").val();
    var end = $("#end").val();
    console.log("start: "+start);
    console.log("end: "+end);
    $.ajax({
        url: 'php/incidencia/dates_incidencia2.php',
        data: {start:start, end:end},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
            
        }else{
            if(response.message){
                
                $("#body-incidencia").html(response.message);
            } else {
                alert('Lo sentimos no hay incidencias registradas. :(');
            }
            
            //location.reload();
        }

    });
}

function getSearch () {
    var idIncidencia = $("#idSearch").val();
    $.ajax({
        url: 'php/incidencia/search_incidencia2.php',
        data: {idIncidencia:idIncidencia},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getAll () {
    var state = 'Todos';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getNew () {
    var state = 'Nuevo';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getInfo () {
    var state = 'Mas datos';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getAccept () {
    var state = 'Aceptado';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getAssign () {
    var state = 'Asignado';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getResult () {
    var state = 'Resuelto';
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}

function getClose () {
    var state = 'Cerrado'
    $.ajax({
        url: 'php/incidencia/filter_incidencias2.php',
        data: {state:state},
        method: 'POST'
    })
    .done(function( response ) {
        //console.log(response);
        if(response.message) {
            //console.log(response.message);
            $("#body-incidencia").html('');
            $("#body-incidencia").html(response.message);
        }else{
            alert('Lo sentimos no hay incidencias registradas. :(');
            //location.reload();
        }

    });
}