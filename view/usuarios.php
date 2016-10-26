<?php require_once('../model/usuariosModel.php');
   $row = show_user();
?>
<div class="container-fluid">
    <div class="row">
        <h1 class=" padding-top-2">Usuarios</h1>
        <div class="col-md-3 pull-right padding-top-2 text-right paddingBottom">
            <button data-toggle="modal" data-target="#new_user" class="btn btn-primary btn-new" type="">Nuevo <i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
        <div class="col-md-12">
            <table id="resultTable" class="table table-striped ">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    $number =0;
                    foreach ($row as $item) {
                      $number++;
                    ?>
                        <tr>
                            <td>
                                <?php echo $number; ?>
                            </td>
                            <td>
                                <?php echo $item["cedula"]; ?>
                            </td>
                            <td>
                                <?php echo string_ucfirst($item["nombres"]); ?>
                            </td>
                            <td>
                                <?php echo string_ucfirst($item["apellidos"]); ?>
                            </td>
                            <td>
                                <?php echo $item["correo"]; ?>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" class="btn_edit" id="<?php echo $item['id_user']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                <a href="javascript:void(0)" class="btn_trash" id="<?php echo $item['id_user']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                <h4 class="text-center">Actualizar Información</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal " id="form_edit_user" autocomplete="off">
                    <label for="Nombres" class="control-label">Nombres: </label>
                    <div class="input-group">
                        <input type="hidden" name="id_user" id="id_user">
                        <input type="text" class="form-control" readonly id="nombre" name="nombres" placeholder="Ingresa tus Nombres">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>

                    <label for="Apellidos" class="control-label">Apellidos: </label>
                    <div class="input-group">
                        <input type="text" class="form-control" readonly id="apellido" name="apellidos" placeholder="Ingresa tus Apellidos">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>

                    <label for="cedula" class="control-label">Cedula:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" minlenght="6" maxlength="8" id="cedula" name="cedula" placeholder="Ingresa Cedula">
                        <span class="input-group-addon"><i class="fa fa-indent" aria-hidden="true"></i></span>
                    </div>

                    <label for="email" class="control-label">Email:</label>
                    <div class="input-group">
                        <input type="email" class="form-control" minlenght="6" autocomplete="off" maxlength="30" id="email" name="correo" placeholder="Ingresa Email">
                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>

                    <label for="clave" class="control-label">Clave:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" minlenght="5" maxlength="20" id="clave" name="clave" placeholder="Ingresa Clave">
                        <span class="input-group-addon"><i class="fa fa-unlock-alt fa-lg" aria-hidden="true"></i></span>
                    </div>

                    <label for="clave" class="control-label">Tipo usuario:</label>
                    <div class="input-group">
                        <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                            <option value=""> --Selecciona-- </option>
                            <option value="3">Remover permisos</option>
                            <option value="2">Administrador</option>
                            <option value="1">Estudiante</option>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-user-secret fa-lg" aria-hidden="true"></i></span>
                    </div>

                    <div class="modal-footer">
                        <div class="col-xs-6">
                            <button type="button" data-dismiss="modal" class="btn btn-danger btn-modal closeM">Cerrar</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary registro btn-modal">Actualizar</button>
                        </div>
                    </div>
                </form>
                <div class="msj text-center">
                    <div id="floatingBarsG">
                        <div class="blockG" id="rotateG_01"></div>
                        <div class="blockG" id="rotateG_02"></div>
                        <div class="blockG" id="rotateG_03"></div>
                        <div class="blockG" id="rotateG_04"></div>
                        <div class="blockG" id="rotateG_05"></div>
                        <div class="blockG" id="rotateG_06"></div>
                        <div class="blockG" id="rotateG_07"></div>
                        <div class="blockG" id="rotateG_08"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  MODAL PARA REGISTRAR NUEVOS USUARIOS-->

<div class="modal fade" id="new_user" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                <h4 class="text-center">Registrar Información</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal " id="form_new_user">
                    <label for="cedula" class="control-label">Cedula:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" minlenght="6" maxlength="10" id="cedula" name="cedula" placeholder="Ingresa Cedula">
                        <span class="input-group-addon"><i class="fa fa-indent" aria-hidden="true"></i></span>
                    </div>

                    <label for="email" class="control-label">Email:</label>
                    <div class="input-group">
                        <input type="email" class="form-control" minlenght="6" maxlength="30" id="email" name="correo" placeholder="Ingresa Email">
                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>

                    <label for="clave" class="control-label">Clave:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" minlenght="5" maxlength="20" id="clave_1" name="clave" placeholder="Ingresa Clave">
                        <span class="input-group-addon"><i class="fa fa-unlock-alt fa-lg" aria-hidden="true"></i></span>
                    </div>

                    <label for="clave" class="control-label">Tipo usuario:</label>
                    <div class="input-group">
                        <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                            <option value=""> --Selecciona-- </option>
                            <option value="2">Administrador</option>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-user-secret fa-lg" aria-hidden="true"></i></span>
                    </div>

                    <div class="modal-footer">
                        <div class="col-xs-6">
                            <button type="button" data-dismiss="modal" class="btn btn-danger btn-modal closeM">Cerrar</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary registro btn-modal">Guardar</button>
                        </div>
                    </div>
                </form>
                <div class="msj text-center">
                    <div id="floatingBarsG">
                        <div class="blockG" id="rotateG_01"></div>
                        <div class="blockG" id="rotateG_02"></div>
                        <div class="blockG" id="rotateG_03"></div>
                        <div class="blockG" id="rotateG_04"></div>
                        <div class="blockG" id="rotateG_05"></div>
                        <div class="blockG" id="rotateG_06"></div>
                        <div class="blockG" id="rotateG_07"></div>
                        <div class="blockG" id="rotateG_08"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript" src="script/js/main.js" charset="utf-8"></script> -->
<script type="text/javascript">
    $('#resultTable').DataTable({
        "processing": true,
        "language": {
            "lengthMenu": "Entradas por página _MENU_",
            "zeroRecords": "No hay registros relacionados",
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
    // Buscar por id el ususario
    $("a.btn_edit").on('click', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "controller/edituserController.php",
            data: {
                'id': id
            },
            success: function(data) {
                $("#myModal").modal();
                $("#id_user").val(data.id);
                $("#nombre").val(data.nombres);
                $("#apellido").val(data.apellidos);
                $("#cedula").val(data.cedula);
                $("#email").val(data.correo);
                $("#tipo_usuario").val(data.tipo_usuario);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#clave, #clave_1').hidePassword('focus', {
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
    // POST DE USUARIOS

    $("#form_new_user").validate({
        rules: {
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
            $.ajax({
                type: "POST",
                url: "controller/Post_set_user.php",
                data: $('#form_new_user').serialize(),
                success: function(data) {
                    if (data == 1) {
                        clearInpust();
                        $("#new_user").modal('hide');
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Registro exitoso!',
                            type: 'success'
                        }).then(function(result) {
                            $(".container-page").load('../app/view/usuarios.php');
                        })
                    } else if (data == 2) {
                        clearInpust();
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Ocurrio un error,con el servidor',
                            type: 'error'
                        })
                    } else if (data == 3) {
                        clearInpust();
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Este usuario esta registrado',
                            type: 'info'
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            $('#floatingBarsG,.msj').show(0).delay(4000).hide(0);
        }
    });
    // UPDATE DEL USUARIO
    $("#form_edit_user").validate({
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
            $.ajax({
                type: "POST",
                url: "controller/Update_set_user.php",
                data: $('#form_edit_user').serialize(),
                success: function(data) {
                    if (data == 1) {
                        $("#myModal").modal('hide');
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Datos actualizados!',
                            type: 'success'
                        }).then(function() {
                            $(".container-page").load('../app/view/usuarios.php');
                        })
                    } else if (data == 2) {
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Ocurrio un error,con el servidor',
                            type: 'error'
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            $('#floatingBarsG,.msj').show(0).delay(4000).hide(0);
        }
    });
    // DELETE DEL USUARIO
    $(".btn_trash").on('click', function() {
        var id = $(this).attr('id');
        swal({
            title: '¿Esta seguro de eliminar ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar'
        }).then(function() {
            $.ajax({
                type: "POST",
                url: "controller/delete_userController.php",
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data == 1) {
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Registro eliminado!',
                            type: 'success'
                        }).then(function() {
                            $(".container-page").load('../app/view/usuarios.php');
                        })
                    } else if (data == 2) {
                        swal({
                            confirmButtonText: 'OK',
                            title: 'Ocurrio un error,con el servidor',
                            type: 'error'
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }, function(dismiss) {})
    });

    function clearInpust() {
        $('form :input').val('');
        $('.input-group').removeClass('has-success');
    }

    function filter() {
        $.ajax({
            type: "POST",
            url: "controller/listar_userController.php",
            data: {
                'action': "listar"
            },
            success: function(data) {
                $('.tbody').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
