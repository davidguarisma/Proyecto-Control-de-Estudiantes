<div class="row padding-top">
  <div class="col-md-6 col-xs-offset-3">
    <div class="form_user_session">
      <div class="title_form_user">
        <h4 class="text-center">Actualizar Información</h4>
      </div>
        <form class="form-horizontal" id="form_user_sesion">
             <div class="form-group">
                 <label for="inputName" class="control-label col-xs-3">Nombres:</label>
                 <div class="col-xs-9">
                   <div class="input-group">
                       <input type="text" class="form-control" id="nombre" name="nombres" placeholder="Ingresa tus Nombres">
                       <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                   </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="inputName" class="control-label col-xs-3">Apellidos:</label>
                 <div class="col-xs-9">
                   <div class="input-group">
                       <input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Ingresa tus Apellidos">
                       <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                   </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="inputName" class="control-label col-xs-3">Cedula:</label>
                 <div class="col-xs-9">
                   <div class="input-group">
                       <input type="text" class="form-control" minlenght="6" maxlength="8" id="cedula" name="cedula" placeholder="Ingresa Cedula">
                       <span class="input-group-addon"><i class="fa fa-indent" aria-hidden="true"></i></span>
                   </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="inputEmail" class="control-label col-xs-3">Email:</label>
                 <div class="col-xs-9">
                   <div class="input-group">
                       <input type="email" class="form-control" minlenght="6" autocomplete="off" maxlength="30" id="email" name="correo" placeholder="Ingresa Email">
                       <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                   </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="inputPassword" class="control-label col-xs-3">Clave:</label>
                 <div class="col-xs-9">
                   <div class="input-group">
                       <input type="password" class="form-control" minlenght="5" maxlength="20" id="clave" name="clave" placeholder="Ingresa Clave">
                       <span class="input-group-addon"><i class="fa fa-unlock-alt fa-lg" aria-hidden="true"></i></span>
                   </div>
                 </div>
             </div>
             <div class="form-group">
                 <div class="col-xs-offset-2 col-xs-10">
                     <button type="submit" class="btn btn-primary">Enviar</button>
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
<script type="text/javascript">
function filter(){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/listar_userController.php",
        data: {
            'action': "listar"
        },
        success: function(data) {
          $("#nombre").val(data.nombres);
          $("#apellido").val(data.apellidos);
          $("#cedula").val(data.cedula);
          $("#email").val(data.correo);
          $("#clave").val(data.clave);
        },
        error: function(data) {
            console.log(data);
        }
    });
  }
 filter();

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

    $("#form_user_sesion").validate({
        rules: {
            'nombres': {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            'apellidos': {
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
                url: "controller/Update_set_user_session.php",
                data: $('#form_user_sesion').serialize(),
                success: function(data) {
                    if (data == 1) {
                        setTimeout(function() {
                            swal({
                                confirmButtonText: 'OK',
                                title: 'Datos actualizados!',
                                type: 'success'
                            })
                        }, 1000);
                    } else if (data == 2) {
                        setTimeout(function() {
                            swal({
                                confirmButtonText: 'OK',
                                title: 'Ocurrio un error,con el servidor',
                                type: 'error'
                            })
                        }, 1000);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            $('#floatingBarsG,.msj').show(0).delay(4000).hide(0);
        }
    });

</script>
