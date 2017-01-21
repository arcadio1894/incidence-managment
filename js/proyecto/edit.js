$(document).on('ready', principal);

function principal()
{
    $('#editProject-form').on('submit', EditProject);
}

function EditProject () {
	event.preventDefault();
	var data = $(this).serializeArray();
	console.log(data);
	$.ajax({
        url: 'php/proyecto/editar_proyecto.php',
        data: data,
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Proyecto modificado correctamente.');
            window.location="listarProyectos.php";
        }

    });
}