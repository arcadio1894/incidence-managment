$(document).on('ready', principal);

function principal()
{
    $('#edit-user').on('submit', editUsuario);
}

function editUsuario () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/usuario/editar_usuario.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Usuario modificado correctamente.');
            window.location="listarUsuarios.php";
        }

    });
}