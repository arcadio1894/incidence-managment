$(document).on('ready', principal);

function principal()
{
    $.ajax({
        url: 'php/panel/traer_incidencias.php',
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.asignadas) {
            $("#asignadas").html(response.asignadas);
        }
        if(response.reportadas) {
            $("#reportadas").html(response.reportadas);
        }
        if(response.resueltas) {
            $("#resueltas").html(response.resueltas);
        }
        if(response.cerradas) {
            $("#cerradas").html(response.cerradas);
        }

    });
}