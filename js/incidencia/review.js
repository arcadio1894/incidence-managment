$(document).on('ready', principal);

function principal()
{
    $('#btnSave').on('click', saveIncidence)
    $('#btnDerive').on('click', deriveIncidence);
}

function saveIncidence () {
	event.preventDefault();
    var data = $("#review-incidence").serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/incidencia/modificar_incidencia.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Incidencia modificada correctamente.');
            location.reload();
        }
    });
}

function deriveIncidence () {
    event.preventDefault();
    var data = $("#review-incidence").serializeArray();
    console.log(data);
    $.ajax({
        url: 'php/incidencia/derive_incidencia.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Incidencia derivada correctamente.');
            location.reload();
        }
    });
}