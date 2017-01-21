$(document).on('ready', principal);

function principal()
{
    $('#cboproyectos').on('change', showCategory)
    $('#register-incidence').on('submit', registerIncidence);
    var proyecto = $('#cboproyectos').val();
    console.log(proyecto);
    $.ajax({
        url: 'php/incidencia/traer_categorias.php',
        data: {proyecto:proyecto},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            $("#cboCategorias").html(response.message);
            //location.reload();
        }

    });
}

function showCategory () {
    var proyecto = $('#cboproyectos').val();
    console.log(proyecto);
    $.ajax({
        url: 'php/incidencia/traer_categorias.php',
        data: {proyecto:proyecto},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            $("#cboCategorias").html(response.message);
            //location.reload();
        }

    });
}

function registerIncidence () {
	event.preventDefault();
    var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/incidencia/guardar_incidencia.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Incidencia registrada correctamente.');
            location.reload();
        }
    });
}
