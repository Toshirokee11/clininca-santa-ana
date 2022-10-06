$(document).ready(function(){
    $('#dtpFechaCita').change(function(){
        recargarHorario();
    });
    $('#slcMedico').change(function(){
        recargarHorario();
    });
})
function recargarHorario(){
    $.ajax({
        type:"POST",
        url:"../Controlador/hallarDisponible.php",
        data: {
            fechaCita: $('#dtpFechaCita').val(),
            id_medico: $('#slcMedico').val()
        },
        success:function(r){
            $('#horarioDisponible').html(r);
        }
    });
}