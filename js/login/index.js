$(document).on('ready', principal);

function principal()
{
    $('#register-form').on('submit', registerUser);
}

function registerUser () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/login/guardar_usuario.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Usuario registrado correctamente.');
            location.reload();
        }

    });
}