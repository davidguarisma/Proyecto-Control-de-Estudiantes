<?php require_once('../model/usuariosModel.php');
   $row = show_user();
?>
<table id="resultTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" >&times;</button> -->
                <!-- class="close" data-dismiss="modal" -->
                <a href="#" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                <h2 class="text-center">Actualizar Información</h2>
            </div>
            <div class="modal-body">
                <!-- <div id="registro" class="tab-pane fade"> -->
                <form class="form-horizontal " id="form_edit_user">
                    <div class="form-group">
                        <label for="Nombres" class="control-label col-xs-3">Nombres: </label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <input type="hidden" id="id" name="id_user">
                                <input type="text" class="form-control" readonly id="nombre" name="nombre" placeholder="Ingresa tus Nombres">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Apellidos" class="control-label col-xs-3">Apellidos: </label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly id="apellido" name="apellido" placeholder="Ingresa tus Apellidos">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cedula" class="control-label col-xs-3">Cedula:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <input type="text" class="form-control" minlenght="6" maxlength="10" id="cedula" name="cedula" placeholder="Ingresa Cedula">
                                <span class="input-group-addon"><i class="fa fa-indent" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label col-xs-3">Email:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <input type="email" class="form-control" minlenght="6" maxlength="30" id="email" name="email" placeholder="Ingresa Email">
                                <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clave" class="control-label col-xs-3">Clave:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <input type="password" class="form-control" minlenght="5" maxlength="20" id="clave" name="clave" placeholder="Ingresa Clave">
                                <span class="input-group-addon"><i class="fa fa-unlock-alt fa-lg" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="clave" class="control-label col-xs-3">Tipo usuario:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                                  <option value=""> --Selecciona-- </option>
                                  <option value="3">Remover permisos</option>
                                  <option value="2">Administrador</option>
                                  <option value="1">Estudiante</option>
                                </select>
                                <span class="input-group-addon"><i class="fa fa-user-secret fa-lg" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-md registro">Guardar</button>
                        </div>
                    </div>
                </form>
                <!-- </div> -->
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
<script type="text/javascript" src="script/js/main.js" charset="utf-8"></script>
<script type="text/javascript">
    $('#resultTable').DataTable({
        "processing": true,
        "language": {
            "lengthMenu": " Mostrar Registros _MENU_",
            "zeroRecords": "No hay registros relacionados",
            "info": "Paginas _PAGE_ de _PAGES_",
            "infoEmpty": "",
            "infoFiltered": "Filtrando registros _MAX_ en total",
            "sSearch": "Buscar: ",
            "sSearchPlaceholder": "Buscar registros",
            "oPaginate": {
                "sLast": "Última página",
                "sFirst": "Primera",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
    // table usuario
    $("a.btn_edit").on('click', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "controller/edituserController.php",
            data: {
                'id': id,
                'action':'set_id'
            },
            success: function(data) {
                $("#myModal").modal();
                $("#id").val(data.id);
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
           $('#floatingBarsG,.msj').css('display', 'block');
           $.ajax({
               type: "POST",
               url: "controller/edituserController.php",
               data: $('form').serialize(),
               success: function(data) {
                 console.log(data);
                  //  if (data == 1) {
                  //      setTimeout(function() {
                  //          clearInpust();
                  //          swal({
                  //              confirmButtonText: 'OK',
                  //              title: 'Registro exitoso!',
                  //              type: 'success'
                  //          }).then(
                  //              function(result) {
                  //                  $(location).attr('href', '../app/?action=dashboard');
                  //              })
                  //      }, 1000);
                  //  } else if (data == 2) {
                  //      setTimeout(function() {
                  //          clearInpust();
                  //          swal({
                  //              confirmButtonText: 'OK',
                  //              title: 'Ocurrio un error,con el servidor',
                  //              type: 'error'
                  //          })
                  //      }, 1000);
                  //  } else if (data == 3) {
                  //      setTimeout(function() {
                  //          clearInpust();
                  //          swal({
                  //              confirmButtonText: 'OK',
                  //              title: 'Este usuario esta registrado',
                  //              type: 'info'
                  //          })
                  //      }, 1000);
                  //  }
               },
               error: function(data) {
                   console.log(data);
               }
           });
           $('#floatingBarsG,.msj').show(0).delay(5000).hide(0);
       }
   });
</script>
