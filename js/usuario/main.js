$(document).on('ready', principal);
function principal()
{
    $modalEliminar = $('#delete-modal');
    $('[data-eliminar]').on('click', showModal);
    $('#btnEliminar').on('click', deleteUsuario);
}
var $modalEliminar;

function showModal () {
	var id = $(this).data('id');
    var name = $(this).data('name');
    var usuario = $(this).data('usuario');
    console.log(id);
    console.log(name);
    $modalEliminar.find('[id="idEliminado"]').val(id);
    $modalEliminar.find('[id="name"]').val(name);
    $modalEliminar.find('[id="usuario"]').val(usuario);

    $modalEliminar.modal('show');
}

function deleteUsuario () {
    var id = $('#idEliminado').val();
    $.ajax({
        url: 'php/usuario/eliminar_usuario.php',
        data: {id:id},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Usuario eliminado correctamente.');
            location.reload();
        }

    });

}