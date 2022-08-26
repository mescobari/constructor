$(document).ready(function () {
    // $('#persona_id').select2();
    // const reglas = {
    //     re_password: {
    //         equalTo: "#password"
    //     }
    // };
    // const mensajes = {
    //     re_password:
    //     {
    //         equalTo: 'Las contraseñas no coinciden'
    //     }
    // };
    // Biblioteca.validacionGeneral('form-general', reglas, mensajes);
    $('#password').on('change', function(){
        const valor = $(this).val();
        if(valor != ''){
            $('#re_password').prop('required', true);
        }else{
            $('#re_password').prop('required', false);
        }
    });
        

    // $('#ver-password').click(function (e){
    //     alert();
    // });
    
    $('#ver-password').on('click', function(e){
        // alert();
        e.preventDefault();
        var current = $(this).attr('action');
        if(current == 'hide'){
            $(this).prev().attr('type', 'text');
            $(this).empty();
            $(this).append('<i class="m-1 fas fa-eye-slash fa-2x"></i>');
            $(this).attr('action', 'show');
        }
        if(current == 'show'){
            $(this).prev().attr('type', 'password');
            $(this).empty();
            $(this).append('<i class="m-1 fas fa-eye fa-2x"></i>');
            $(this).attr('action', 'hide');
        }
    });
    $('#ver-password2').on('click', function(e){
        // alert();
        e.preventDefault();
        var current = $(this).attr('action');
        if(current == 'hide'){
            $(this).prev().attr('type', 'text');
            $(this).empty();
            $(this).append('<i class="m-1 fas fa-eye-slash fa-2x"></i>');
            $(this).attr('action', 'show');
        }
        if(current == 'show'){
            $(this).prev().attr('type', 'password');
            $(this).empty();
            $(this).append('<i class="m-1 fas fa-eye fa-2x"></i>');
            $(this).attr('action', 'hide');
        }
    });
});
