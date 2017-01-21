$(document).on('ready', principal);

function principal()
{
    $('#project-form').on('submit', registerProject);
}

function registerProject () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/proyecto/guardar_proyecto.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Proyecto registrado correctamente.');
            location.reload();
        }

    });
}