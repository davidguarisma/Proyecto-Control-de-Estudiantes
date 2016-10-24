$(function() {
    // validate signup form on keyup and submit
    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });
    $(".login").validate({
        rules: {
            'usuario': {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            'clave': {
                required: true,
                minlength: 2,
                maxlength: 50
            }
        },
        highlight: function(element) {
            if (!($(element).hasClass('optional') && $(element).is(':blank'))) {
                $(element).closest('.input-group').removeClass('has-success').addClass('has-error');
            }
        },
        unhighlight: function(element) {
            if (!($(element).hasClass('optional') && $(element).is(':blank'))) {
                $(element).closest('.input-group').removeClass('has-error').addClass('has-success');
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            $('#floatingBarsG,.msj').css('display', 'block');
            $.ajax({
                type: "POST",
                url: "controller/loginController.php",
                data: $('.login').serialize(),
                success: function(data) {
                    if (data == 1) {
                        setTimeout(function() {
                            clearInpust();
                            swal({
                                confirmButtonText: 'OK',
                                title: 'El usuario no esta registrado',
                                type: 'info'
                            })
                            $('#floatingBarsG,.msj').show(0).delay(1000).hide(0);
                        }, 1000);
                    } else if (data == 2) {
                        clearInpust();
                        $(location).attr('href', '../app/?action=dashboard');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            $('#floatingBarsG,.msj').show(0).delay(5000).hide(0);
        }
    });
    validator = $(".form_registro").validate({
        rules: {
            'nombre': {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            'apellido': {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            'cedula': {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 10
            },
            'email': {
                required: true,
                minlength: 5,
                maxlength: 50
            },
            'telefono': {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 11
            },
            'clave': {
                required: true,
                minlength: 5,
                maxlength: 10
            },
            'pnf': {
                required: true
            },
            'trayecto': {
                required: true
            },
            'Semestre': {
                required: true
            }
        },
        highlight: function(element) {
            if (!($(element).hasClass('optional') && $(element).is(':blank'))) {
                $(element).closest('.input-group').removeClass('has-success').addClass('has-error');
            }
        },
        unhighlight: function(element) {
            if (!($(element).hasClass('optional') && $(element).is(':blank'))) {
                $(element).closest('.input-group').removeClass('has-error').addClass('has-success');
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            $('#floatingBarsG,.msj').css('display', 'block');
            $.ajax({
                type: "POST",
                url: "controller/registroController.php",
                data: $('.form_registro').serialize(),
                success: function(data) {
                    if (data == 1) {
                        setTimeout(function() {
                            clearInpust();
                            swal({
                                confirmButtonText: 'OK',
                                title: 'Registro exitoso!',
                                type: 'success'
                            }).then(
                                function(result) {
                                    $(location).attr('href', '../app/?action=dashboard');
                                })
                        }, 1000);
                    } else if (data == 2) {
                        setTimeout(function() {
                            clearInpust();
                            swal({
                                confirmButtonText: 'OK',
                                title: 'Ocurrio un error,con el servidor',
                                type: 'error'
                            })
                        }, 1000);
                    } else if (data == 3) {
                        setTimeout(function() {
                            clearInpust();``
                            swal({
                                confirmButtonText: 'OK',
                                title: 'Este usuario esta registrado',
                                type: 'info'
                            })
                        }, 1000);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            $('#floatingBarsG,.msj').show(0).delay(5000).hide(0);
        }
    });
    $('#clave').hidePassword('focus', {
        show: 'infer',
        toggle: {
            className: 'my-toggle-password'
        },
        states: {
            shown: {
                toggle: {
                    content: '<i class="fa fa-eye-slash" aria-hidden="true"></i>',
                    attr: {
                        'aria-pressed': 'false',
                        title: 'Mostrar clave',
                    }
                }
            },
            hidden: {
                toggle: {
                    content: '<i class="fa fa-eye " aria-hidden="true"></i>',
                    attr: {
                        'aria-pressed': 'false',
                        title: 'Ocultar clave',
                    }
                }
            }
        }
    });
    $("#cerrar_sesion").on('click', function() {
        swal({
            title: '¿Esta seguro de salir?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar'
        }).then(function() {
            window.location.href = '../app/config/session_destroy.php';
        }, function(dismiss) {})
    });

    function clearInpust() {
        $('form :input').val('');
        $('.input-group').removeClass('has-success');
    }

    function load_url(page) {
        $(".container-page").load('../app/view/' + page + '.php');
    }
    $("a.menu").on('click', function() {
        var page = $(this).attr('id');
        if (page === "respaldo") {
            window.location.href = '../app/config/respaldo_bd.php';
        }else{
          load_url(page);
        }
    });
    $("a#edit_user_session").on('click', function() {
          $(".container-page").load('../app/view/edit_user_session.php');
    });
    $('#resultTable').DataTable({
        "processing": true,
        "language": {
            "lengthMenu": "Entradas por página _MENU_",
            "zeroRecords": "No hay materias activadas para este periodo",
            "info": "Paginas _PAGE_ de _PAGES_",
            "infoEmpty": "",
            "infoFiltered": "Filtrando registros _MAX_ en total",
            "sSearch": "Buscar: ",
            "sSearchPlaceholder": "Buscar...",
            "oPaginate": {
                "sLast": "Última página",
                "sFirst": "Primera",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
});
function setSemestre(v,v2){
    var tray = $(v).val(); var sem;
    if(tray == 1){
       sem = '        <option selected disabled value="">Seleccione</option><option value="1">Semestre I</option><option value="2">Semestre II</option>';
    }else if(tray == 2){
       sem = '        <option selected disabled value="">Seleccione</option><option value="3">Semestre III</option><option value="4">Semestre IV</option>';
    }else if(tray == 3){
       sem = '        <option selected disabled value="">Seleccione</option><option value="5">Semestre V</option><option value="6">Semestre VI</option>';
    }else if(tray == 4){
       sem = '<option value="7">Semestre VII</option><option value="8">Semestre VIII</option>';
    }else{
       sem = '<option value="">Seleccione: </option>';
    }
    $(v2).html(sem);
    $(v2).attr('disabled', false);
}
/* acteve pnf */
function setactive(v){
    $(v).attr('disabled', false);
}
/* filter registro */
function setRegis(){
    var t = $("#trayectoS").val();
    var s = $("#semestreS").val();
    var p = $("#pnfS").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/filterMateController.php",
        data: { 'opt':1, 't':t, 's':s, 'p':p },
        success: function(data) {
            $("#resultTable").html(data.dat);
        },
        error: function(data) {
            swal({
                confirmButtonText: 'Error',
                title: 'Error al listar materias',
                type: 'error'
            })
        }
    });
}
