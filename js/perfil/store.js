$(document).on('ready', principal);

function principal()
{
    $('#register-perfil').on('submit', registerPerfil);
}

function registerPerfil () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/perfil/guardar_perfil.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Perfil registrado correctamente.');
            location.reload();
        }

    });
}