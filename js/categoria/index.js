$(document).on('ready', principal);

function principal()
{
    $modalEliminar = $('#delete-modal');
    $('#btnAdd').on('click', registerCategory);
    $('[data-delete]').on('click', showModal);
    $('#btnEliminar').on('click', deleteCategoria);
}
var $modalEliminar;
// $modalShow.find('[id="meta"]').html(metaAlineada);
// $modalShow.modal('show');
// $modalEliminar.modal('hide');

function registerCategory () {
	event.preventDefault();
    var idProyecto = $('#idProyecto').val();
	var categoria = $('#namecategory').val();
	console.log(categoria);
    console.log(idProyecto);
	$.ajax({
        url: 'php/categoria/guardar_categoria.php',
        data: {idProyecto:idProyecto, categoria:categoria},
        method: 'POST'
    })
    .done(function( response ) {
    	console.log(response);
        if(response.error) {
        	console.log(response.message);
            alert(response.message);
        }else{
            alert('Categoría registrada correctamente.');
            location.reload();
        }

    });
}

function showModal () {
    console.log('Entre');
    var id = $(this).data('id');
    var categoria = $(this).data('categoria');
    console.log(id);
    console.log(categoria);
    $modalEliminar.find('[id="idEliminado"]').val(id);
    $modalEliminar.find('[id="categoria"]').val(categoria);

    $modalEliminar.modal('show');
}

function deleteCategoria (argument) {
    var id = $('#idEliminado').val();
    $.ajax({
        url: 'php/categoria/eliminar_categoria.php',
        data: {id:id},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Categoría eliminada correctamente.');
            location.reload();
        }

    });

}