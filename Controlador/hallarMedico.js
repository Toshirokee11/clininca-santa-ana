$(document).ready(function(){
    $('#slcEspecialidad').change(function(){
        recargarLista();
    });
})
function recargarLista(){
    $.ajax({
        type:"POST",
        url:"../Controlador/hallarEspecialidad.php",
        data:"id_especialidad=" + $('#slcEspecialidad').val(),
        success:function(r){
            $('#slcMedico').html(r);
        }
    });
}