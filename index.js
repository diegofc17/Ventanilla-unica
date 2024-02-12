// wwwroot/js/index.js
$(document).ready(function () {
    $('#formRegistro').submit(function (e) {
        e.preventDefault(); // Evita que el formulario se envíe normalmente
        var registro = $('#txtRegistro').val();
        
        // Envía el registro al servidor utilizando AJAX
        $.post('/VentanillaUnica/GuardarRegistro', { registro: registro })
            .done(function () {
                // Recarga la página después de guardar el registro
                location.reload();
            })
            .fail(function () {
                alert('Error al guardar el registro');
            });
    });
});
