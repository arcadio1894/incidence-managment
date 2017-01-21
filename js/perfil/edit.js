$(document).on('ready', principal);

function principal()
{
    $('#edit-perfil').on('submit', editPerfil);
}

function editPerfil () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/perfil/editar_perfil.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Perfil modificado correctamente.');
            window.location="listarPerfiles.php";
        }

    });
}