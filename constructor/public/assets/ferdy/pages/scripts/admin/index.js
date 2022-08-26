
    
$(document).ready(function () {

    var t = $("#tabla-data").DataTable({        
        autoWidth   :  true,
        pageLength  : 10,
        lengthMenu: [
            [ 10, 20, 50, -1 ],
            [ '10', '20', '50', 'todos' ]
        ],
        dom         : 'Bfrtip',
        order       : [[ 1, 'asc' ]],
        language: {
            buttons: {
                pageLength: {
                    _: '<button class="btn btn-light">Mostrar <b>%d</b> por página</button>',
                    '-1': "Todos"
                }
            },
            info: "Mostrando <b> _START_ </b> de <b> _END_ </b> de <b> _TOTAL_ </b> Entrada(s)",
        },
        buttons: [
            'pageLength', 
            {
                extend: 'colvis',
                text: '<button class="btn btn-light">Mostrar columnas</button>',
                collectionLayout: 'two-column',
                className: 'btn'
            },
            {
                extend: 'excelHtml5',
                autoFilter: true,
                text:      '<i class="fas fa-file-excel text-success fa-2x"></i>',
                titleAttr: 'Excel'
            },
            {
                extend: 'pdfHtml5',
                autoFilter: true,
                text:      '<i class="fas fa-file-pdf text-danger fa-2x"></i>',
                titleAttr: 'PDF'
            }
        ],

        // columnDefs: [
        //     {   "width": "10%", "targets": 0 },
        //     {   "width": "25%", "targets": 1 },
        //     {   "width": "25%", "targets": 2 },
        //     {   "width": "5%", "targets": 3 },
        //     {   "width": "15%", "targets": 4 },
        //     {   "width": "15%", "targets": 5 },
        //     {   "width": "5%", "targets": 6 },
        //     {
        //         "targets": [  ],
        //         "visible": false
        //     }
        // ],
        initComplete: function () {
            this.api().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                });
            });
        },
    }); 
    $('#tabla-data thead tr').clone(true).appendTo( '#tabla-data thead' );

    $('#tabla-data thead tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna    
        $(this).html( '<input type="text" style="border: 0;outline: none; width:100%; font-size: 1em;" class="fa " placeholder="&#xf002; Buscar por: '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( t.column(i).search() !== this.value ) {
                t
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );   

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $("#tabla-data").on('submit', '.form-eliminar', function () {
        event.preventDefault();
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea Eliminar ?',
            text: "Esta acción sera registrada!",
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            },
        }).then((value) => {
            if (value) {
                ajaxRequest(form, "ELIMINADO CORRECTAMENTE");
            }
        });
    });
    $("#tabla-data").on('submit', '.form-activar', function () {
        event.preventDefault();
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea activar el USUARIO ?',
            text: "Esta acción sera registrada!",
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            },
        }).then((value) => {
            if (value) {
                ajaxRequest(form, "USUARIO ACTIVADO CORRECTAMENTE");
            }
        });
    });

    function ajaxRequest(form, mensaje) {
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    // form.parents('tr').remove();
                    // Biblioteca.notificaciones(mensaje, 'Mensaje del Sistema', 'success');
                    location.reload();
                } else {
                    // Biblioteca.notificaciones('Error favor de comunicarse con sistemas', 'Mensaje del Sistema', 'error');
                    location.reload();
                }
            },
            error: function () {

            }
        });
    }    
});

function abrir_modal_permisos_rol(id_rol){
    $('#id_rol').val(id_rol);
    $('#tabla_permisos').empty();
    var html = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: "/../permissions/permiso_ver",
        method: 'POST',
        data: {"id_rol": $('#id_rol').val()},
        success: function(respuesta){
            console.log(respuesta);
            cont = 0;
            // cargar("tabla_permisos2", true);
            respuesta.forEach(function(valor, indice, array){
                // console.log("indice:"+indice + "---valor:" + valor.name + "---array"+array);
                cont++;

                html = html + "<tr><td>" + cont + "</td>" + 
                "<td><center><input class='form-check-input' type='checkbox' value='" + valor.id + "' name='asigna[]' style='width: 25px; height: 25px'";
                if(valor.rol==true){html += " checked "}
                html = html + "></center></td>" +                 
                "<td><span>" + valor.name + "</span></td>" + 
                "<td><span>" + valor.descripcion + "</span></td></tr>";
            });
            $('#tabla_permisos').append(html); 
            // cargar("tabla_permisos2", false);
        },
        error: function(response) {
            if(response.status === 422) {
                
            }else if(response.status === 419){
                
            }
        }
    });  
}

function cargar(elemento_id,incluir){
    if(incluir == true){
        html = "<div wire:loading.delay id='loading_elemento'>" + 
                "<div style='display: flex; justify-content:center; align-items:center; " + 
                "background-color:black; position: fixed; top: 0px; left: 0px; " + 
                "z-index:9999; width: 100%; height: 100%; opacity: .35;'>" + 
                    "<div class='la-ball-spin-clockwise la-dark la-3x' style='color:white;'>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                        "<div></div>" + 
                    "</div>" + 
                "</div>" + 
            "</div>";
        $('#'+elemento_id).append(html);
    }else{
        $('#loading_elemento').remove();
    }    
}

function abrir_modal_roles_usuario(id_usuario){
    $('#id_usuario2').val(id_usuario);
    $('#tabla_roles').empty();
    var html = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: "/../usuarios/usuario/actualiza_roles_ver",
        method: 'POST',
        data: {"id_usuario": $('#id_usuario2').val()},
        success: function(respuesta){
            console.log(respuesta);
            cont = 0;
            // cargar("tabla_roles2", true);
            respuesta.forEach(function(valor, indice, array){
                // console.log("indice:"+indice + "---valor:" + valor.name + "---array"+array);
                cont++;

                html = html + "<tr><td>" + cont + "</td>" + 
                "<td><center><input class='form-check-input checks_roles' type='checkbox' value='" + valor.id + "' name='asigna_rol[]' style='width: 25px; height: 25px'";
                if(valor.rol==true){html += " checked "}
                html = html + "></center></td>" +                 
                "<td><span>" + valor.name + "</span></td>" + 
                "<td><span>" + valor.descripcion + "</span></td></tr>";
            });
            $('#tabla_roles').append(html); 
            $("#todos_roles").append("<td><center>" + 
                    "<input class='form-check-input' type='checkbox'  style='width: 25px; height: 25px' " + 
                    "onclick='seleccionar_todos(this, &#34;checks_roles&#34;)'>" + 
                "</center></td>" + 
                "<td  colspan='3'><span>Seleccionar todos</span></td>");
            // cargar("tabla_roles2", false);
        },
        error: function(response) {
            if(response.status === 422) {
                
            }else if(response.status === 419){
                
            }
        }
    });  
}

function abrir_modal_permisos_usuario(id_usuario){
    $('#id_usuario').val(id_usuario);
    document.getElementsByClassName("id_usuario").value=id_usuario;
    $('#tabla_permisos').empty();
    var html = "";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: "/../usuarios/usuario/actualiza_permisos_ver",
        method: 'POST',
        data: {"id_usuario": $('#id_usuario').val()},
        success: function(respuesta){
            console.log(respuesta);
            cont = 0;
            // cargar("tabla_permisos2", true);
            respuesta.forEach(function(valor, indice, array){
                // console.log("indice:"+indice + "---valor:" + valor.name + "---array"+array);
                cont++;

                html = html + "<tr><td>" + cont + "</td>" + 
                "<td><center><input class='form-check-input checks_permisos' type='checkbox' value='" + valor.id + "' name='asigna_permiso[]' style='width: 25px; height: 25px'";
                if(valor.rol==true){html += " checked "}
                html = html + "></center></td>" +                 
                "<td><span>" + valor.name + "</span></td>" + 
                "<td><span>" + valor.descripcion + "</span></td></tr>";
            });
            $('#tabla_permisos').append(html); 
            $("#todos_permisos").append("<td><center>" + 
                    "<input class='form-check-input' type='checkbox'  style='width: 25px; height: 25px' " + 
                    "onclick='seleccionar_todos(this, &#34;checks_permisos&#34;)'>" + 
                "</center></td>" + 
                "<td  colspan='3'><span>Seleccionar todos</span></td>");
            // cargar("tabla_permisos2", false);
        },
        error: function(response) {
            if(response.status === 422) {
                
            }else if(response.status === 419){
                
            }
        }
    });  
}

function seleccionar_todos(val, clase){
    if (val.checked) {
        $('.' + clase).attr('checked', 'checked');
    } else {
        $('.' + clase).removeAttr('checked', 'checked');
    }
}

// $("#roles").on("hidden.bs.modal", function () {
//     alert();
// });