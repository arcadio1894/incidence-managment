$(document).on('ready', principal);

function principal()
{

    $modalEliminar = $('#delete-modal');
    console.log($modalEliminar);
    $(document).on('click', '[data-delete]', showModal);
    $('#btnEliminar').on('click', deleteNivel);
    $('#btnAddLevel').on('click', addLevel);
    $('#categorias').on('change', showLevel);
    var categoria = $('#categorias').val();
    console.log(categoria);
    $('#table-nivel').html('');
    $.ajax({
        url: 'php/nivel/mostrar_level.php',
        data: {categoria:categoria},
        method: 'POST'
    })
    .done(function( result ) {
        console.log(result);
        if (result.array) {
            for (var i = 0; i < result.array.length; i++) {
                renderTemplateNivel(result.array[i].id, result.array[i].category, result.array[i].profile, result.array[i].user);
            };
        }
    });
}
var $modalEliminar;

function showModal () {
    
    var id = $(this).data('id');
    console.log(id);
    $modalEliminar.find('[id="idEliminado"]').val(id);

    $modalEliminar.modal('show');
}

function showLevel () {
    var categoria = $('#categorias').val();
    $('#table-nivel').html('');
    $.ajax({
        url: 'php/nivel/mostrar_level.php',
        data: {categoria:categoria},
        method: 'POST'
    })
    .done(function( result ) {
        console.log(result);
        if (result.array) {
            for (var i = 0; i < result.array.length; i++) {
                renderTemplateNivel(result.array[i].id, result.array[i].category, result.array[i].profile, result.array[i].user);
            };
        }
    });
}

function addLevel () {
    // Ajax para guardar y mostrar
    var categoria = $('#categorias').val();
    var perfil = $('#perfiles').val();
    var usuario = $('#usuarios').val();
    console.log("Categoria: "+categoria);
    console.log("Perfil: "+perfil);
    console.log("Usuario: "+usuario);

    $.ajax({
        url: 'php/nivel/guardar_level.php',
        data: {categoria:categoria, perfil:perfil, usuario:usuario},
        method: 'POST'
    })
    .done(function( result ) {
        console.log(result);
        if(result.error) {
            console.log(result.message);
            alert(result.message);
        }else{
            if (result.array) {
                //items.push({id: data.id, series: data.code, quantity: 1, price:price, originalprice:price, type:'paq'})
                //console.log(result.array.length);
                for (var i = 0; i < result.array.length; i++) {
                    renderTemplateNivel(result.array[i].id, result.array[i].category, result.array[i].profile, result.array[i].user);
                };
                //
            } else {
                alert('No hay datos para mostrar.');
            }
            //location.reload();
        }
        
    });
}

function deleteNivel () {
    var id = $('#idEliminado').val();
    $.ajax({
        url: 'php/nivel/eliminar_nivel.php',
        data: {id:id},
        method: 'POST'
    })
    .done(function( response ) {
        console.log(response);
        if(response.error) {
            console.log(response.message);
            alert(response.message);
        }else{
            alert('Nivel eliminado correctamente.');
            location.reload();
        }

    });
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

function renderTemplateNivel(id, category, profile, user) {
    var clone = activateTemplate('#template-nivel');

    clone.querySelector("[data-idlevel]").innerHTML = id;
    clone.querySelector("[data-category]").innerHTML = category;
    clone.querySelector("[data-profile]").innerHTML = profile;
    clone.querySelector("[data-user]").innerHTML = user;
    clone.querySelector("[data-delete]").setAttribute('data-id', id);

    $('#table-nivel').append(clone);
}

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

