<?php require_once('../model/materiaModel.php');
   $row = show_user();
?>
<table id="resultTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nº </th>
            <th>Materia</th>
            <th>PNF</th>
            <th>Semestre</th>
            <th>Trayecto</th>
            <th>Status</th>
            <th>Opciones</th>
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
                    <?php echo $item["materia"]; ?>
                </td>
                <td>
                    <?php echo string_stroupper($item["pnfs"]); ?>
                </td>
                <td>
                    <?php echo string_stroupper($item["nombre_semestre"]); ?>
                </td>
                <td>
                    <?php echo $item["trayecto"]; ?>
                </td>
                <td>
                    <?php echo $item["apert"]; ?>
                </td>
                <td>
                    <!--  -->
                    <a href="#" data-toggle="modal" data-target="#myModal" class="btn_edit" id="<?php echo $item['id_materias']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Materia</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Materia:</label>
                    <input type="text" class="form-control" id="mateM">
                    <input type="hidden" class="form-control" id="idMateM">
                    <input type="hidden" class="form-control" id="idSemM">
                </div>
                <div class="form-group">
                    <label for="pwd">PNF:</label>
                    <select name="pnf" id="pnfM">
                        <option value="1">PNF en Electricidad</option>
                        <option value="2">PNF en Ingeniería de Mantenimiento</option>
                        <option value="3">PNF en Mecánica</option>
                        <option value="4">PNF en Informática</option>
                        <option value="5">PNF en Geociencia</option>
                        <option value="6">PNF en Sistemas de Calidad y Ambiente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Semestre:</label>
                    <input type="text" class="form-control" id="semestreM">
                </div>
                <div class="Trayecto">
                    <label for="pwd">Trayecto:</label>
                    <input type="text" class="form-control" id="trayectoM">
                </div>
            </div>
            <div class="modal-footer">
            <div class="col-xs-6">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div class="col-xs-6">
                <button type="button" id="modificarM" class="btn btn-default" >Modificar</button>
            </div>
            </div>
        </div>
    </div>
</div>
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
    $("a.btn_edit").on('click', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "controller/editMateController.php",
            data: { 'id': id },
            success: function(data) {
                $('#idMateM').val(data.id);
                $('#mateM').val(data.materia);
                $('#semestreM').val(data.semestre);
                $('#trayectoM').val(data.trayecto);
                $('#pnfM').val(data.pnf);
                $('#idSemM').val(data.idSemestre);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

        $("#modificarM").on('click', function() {
        var ids  = $('#idMateM').val();
        var mat  = $('#mateM').val();
        var sem  = $('#semestreM').val();
        var tra  = $('#trayectoM').val();
        var pnf  = $('#pnfM').val();
        var idSem= $('#idSemM').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "controller/modiMateController.php",
            data: { 'id': ids, 'mat': mat, 'sem': sem, 'tra':tra, 'pnf': pnf, 'idSem': idSem },
            success: function(data) {
              $('#myModal').modal("hide");
                if(data.status == true){
                    swal({
                        confirmButtonText: 'OK',
                        title: 'Datos Actualizados',
                        type: 'success'
                    }).then(
                        function(result) {
                          $(".container-page").load('../app/view/data-materias.php');
                        })


                }else{
                  swal({
                      confirmButtonText: 'OK',
                      title: 'Error al Actualizar',
                      type: 'error'
                  })
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
