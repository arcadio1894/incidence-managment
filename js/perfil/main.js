$(document).on('ready', principal);
function principal()
{
    $modalEliminar = $('#delete-modal');
    $('[data-eliminar]').on('click', showModal);
    $('#btnEliminar').on('click', deleteProject);
}
var $modalEliminar;

function showModal () {
	var id = $(this).data('id');
    var perfil = $(this).data('perfil');
    console.log(id);
    console.log(perfil);
    $modalEliminar.find('[id="idEliminado"]').val(id);
    $modalEliminar.find('[id="profile"]').val(perfil);

    $modalEliminar.modal('show');
}

function deleteProject () {
    var id = $('#idEliminado').val();
    $.ajax({
        url: 'php/perfil/eliminar_perfil.php',
        data: {id:id},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Perfil eliminado correctamente.');
            location.reload();
        }

    });

}