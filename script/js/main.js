$(function() {
    // validate signup form on keyup and submit
    $.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
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
                data: $('form').serialize(),
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
                            clearInpust();
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
        })
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
        load_url(page);
    });
});
