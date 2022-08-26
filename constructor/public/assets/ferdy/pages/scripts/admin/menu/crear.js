$(document).ready(function () {
    Biblioteca.validacionGeneral('form-general');
    $('#icono').on('blur', function () {
        $('#mostrar-icono').removeClass().addClass('fa fa-fw ' + $(this).val());
    });
});
function cargar_icono(valor){
    $('#icon_logo').val(valor);
    $('#muestra_icono_form').empty();
    $('#muestra_icono_form').append("<i class='" + valor + " fa-2x'></i>");
    $('#modal_iconos').modal('hide');
}
function cargar_color_icono(){    
    var color = $('#icon_logo_color').val();
    $('#muestra_icono_form').removeClass("text-primary");
    $('#muestra_icono_form').removeClass("text-secondary");
    $('#muestra_icono_form').removeClass("text-danger");
    $('#muestra_icono_form').removeClass("text-warning");
    $('#muestra_icono_form').removeClass("text-success");
    $('#muestra_icono_form').removeClass("text-info");
    $('#muestra_icono_form').removeClass("text-dark");
    $('#muestra_icono_form').removeClass("text-white");
    $('#muestra_icono_form').removeClass("text-light");
    $('#muestra_icono_form').addClass(color);
}