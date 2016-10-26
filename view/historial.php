<?php require_once('../model/historialModel.php');
   $row = get_historial();
?>
<div class="mate padding-top">
    <h1 class="titleMat padding-top">Historial de Operaciones</h1>
    <div class="cont-fillter form-inline">
    <table id="resultTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nº </th>
                <th>Pagina</th>
                <th>Operacion</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $number =0;
                foreach ($row as $item) {
                  $number++;
                ?>
                <tr>
                    <td><?php echo $number;  ?>  </td>
                    <td><?php echo $item["evento"]; ?> </td>
                    <td><?php echo $item["mensaje"]; ?> </td>
                    <td><?php echo $item["user"]; ?></td>
                    <td><?php echo $item["date"]; ?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    <div class="resetTable">
        <button class="btn btn-success btn-refresh" onclick="listar();" type="">Vaciar Registros <i class="fa fa-refresh" aria-hidden="true"></i></button>
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

function listar(){

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/filterMateController.php",
        data: { 'opt':2},
        success: function(data) {
            $("#resultTable").html(data.dat);
        },
        error: function(data) {
            swal({
                confirmButtonText: 'Error',
                title: 'Error al listar',
                type: 'error'
            })
        }
    });
}
</script>
