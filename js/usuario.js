$(document).ready(function() {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    buscar_usuario(id_usuario);

    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        $.post('../controlador/usuarioController.php', { dato, funcion }, (response) => {
            let nombre = '';
            let usuario_nombre = '';
            let tipo = '';
            let email = '';
            const usuario = JSON.parse(response);

            nombre += `${usuario.nomyape_usuario}`,
                usuario_nombre += `${usuario.nombre_usuario}`,
                tipo += `${usuario.rol_usuario}`,
                email += `${usuario.usuario_email}`,
                $('#nombreyape').html(nombre);
            $('#correo_usuario').html(email);
            $('#rol').html(tipo);
            $('#nombre_de_usuario').html(usuario_nombre);
        })

    }

    $('#frmChangePass').submit(e => {

        let actual = $('#actual').val();
        let nueva = $('#nueva').val();
        let confirmar = $('#confirmar').val();

        funcion = 'cambiar_contra';
        $.post('../controlador/usuarioController.php', { id_usuario, funcion, actual, nueva, confirmar }, (response) => {

            if (response == 'update') {
                $('#modificado').show;
                toastr["success"]("La contraseña se cambio correctamente", "Contraseña Actualizada");
                $('#frmChangePass').trigger('reset');
            } else if (response == 'nocoinciden') {
                $('#distintas').show;
                toastr["warning"]("Las contraseñas no coinciden", "Error al actualizar");
                $('#frmChangePass').trigger('reset');
            } else {
                $('#erroneas').show;
                toastr["error"]("La contraseña actual es incorrecta", "Error al actualizar");
                $('#frmChangePass').trigger('reset');

            }

        });
        e.preventDefault()
    })

})