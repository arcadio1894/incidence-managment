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
    var proyecto = $(this).data('proyecto');
    console.log(id);
    console.log(proyecto);
    $modalEliminar.find('[id="idEliminado"]').val(id);
    $modalEliminar.find('[id="proyecto"]').val(proyecto);

    $modalEliminar.modal('show');
}

function deleteProject () {
    var id = $('#idEliminado').val();
    $.ajax({
        url: 'php/proyecto/eliminar_proyecto.php',
        data: {id:id},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Proyecto eliminado correctamente.');
            location.reload();
        }

    });

}