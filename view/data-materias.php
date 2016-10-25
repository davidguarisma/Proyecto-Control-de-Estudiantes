<?php require_once('../model/materiaModel.php');
   $row = show_mate();
?>
<div class="mate padding-top">

    <h1 class="titleMat padding-top">Materias</h1>
    <div class="cont-fillter form-inline">
        <select name="pnf" id="pnfS"  class="form-control" onchange="setactive('#trayectoS')" >
                <option selected disabled value="">Filtrar por: </option>
                <option value="1">PNF en Electricidad</option>
                <option value="2">PNF en Ingeniería de Mantenimiento</option>
                <option value="3">PNF en Mecánica</option>
                <option value="4">PNF en Informática</option>
                <option value="5">PNF en Geociencia</option>
                <option value="6">PNF en Sistemas de Calidad y Ambiente</option>
        </select>
        <select name="trayecto" id="trayectoS" class="form-control"  disabled onchange="setSemestre('#trayectoS','#semestreS')">
            <option selected disabled value="">Seleccione: </option>
            <option value="1">Trayecto I</option>
            <option value="2">Trayecto II</option>
            <option value="3">Trayecto III</option>
            <option value="4">Trayecto IV</option>
        </select>
        <select name="Semestre" id="semestreS"  class="form-control" disabled onchange="setRegis()">
            <option selected disabled value="">Seleccione</option>
        </select>

        <button data-toggle="modal" data-target="#myModal2" class="btn btn-primary btn-new" type="">Nueva <i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <table id="resultTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nº </th>
                <th>Materia</th>
                <th>PNF</th>
                <th>Trayecto</th>
                <th>Semestre</th>
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
                        <?php echo string_ucfirst( $item["materia"]); ?>
                    </td>
                    <td>
                        <?php echo string_ucfirst($item["pnfs"]); ?>
                    </td>
                    <td>
                        <?php echo $item["tray"]; ?>
                    </td>
                    <td>
                        <?php echo string_ucfirst($item["semestre"]); ?>
                    </td>
                    <td>
                        <?php echo $item["apert"]; ?>
                    </td>
                    <td>
                        <!--  -->
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn_edit optTable" onclick="edit(<?php echo $item['id_materias']; ?>)" id="<?php echo $item['id_materias']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)"  class="btn_trash optTable" id="<?php echo $item['id_semestre']; ?>"><i class="fa fa-trash-o" onclick="trash(<?php echo $item['id_semestre']; ?>)" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)"  class="btn_power optTable" id="<?php echo $item['id_materias']; ?>"><i class="fa fa-power-off" onclick="power(<?php echo $item['id_materias']; ?>)" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php } ?>
        </tbody>
    </table>

    <div class="resetTable">
        <button class="btn btn-success btn-refresh" onclick="listar();" type="">Refresh <i class="fa fa-refresh" aria-hidden="true"></i></button>
    </div>

</div>

<?php include 'modal.php'; ?>


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

function closeM(v){
    $(v).modal('hide');
};

/* activar materia  */
function power(id){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/powerMateController.php",
        data: { 'id': id },
        success: function(data) {
          if(data.status == true){
            swal({
                confirmButtonText: 'OK',
                title: 'ok',
                type: 'success'
            }).then(
                function(result) {
                  listar();
                })
          }else{
            swal({
                confirmButtonText: 'OK',
                title: 'Error al modificar Apertura',
                type: 'error'
            })
          }
        },
        error: function(data) {

        }
    });
};

/* Guardar */
function guardarN() {
    var mat  = $('#mateN').val();
    var pnf  = $('#pnfN').val();
    var tra  = $('#trayectoN').val();
    var sem  = $('#semestreN').val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/saveMateController.php",
        data: { 'mat': mat, 'pnf': pnf, 'tra': tra, 'sem':sem },
        success: function(data) {
          if(data.status == true){
            $('#myModal2').modal('hide');
            swal({
                confirmButtonText: 'OK',
                title: 'Materia registrada',
                type: 'success'
            }).then(
                function(result) {
                  listar();
                })
          }else{
            swal({
                confirmButtonText: 'OK',
                title: 'Error',
                type: 'error'
            })
          }
        },
        error: function(data) {
            swal({
                confirmButtonText: 'OK',
                title: 'Error',
                type: 'error'
            })
        }
    });
};


/* eliminar */
function trash(id) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "controller/trashMateController.php",
        data: { 'id': id },
        success: function(data) {
          if(data.status == true){
            swal({
                confirmButtonText: 'OK',
                title: 'Materia Eliminada',
                type: 'success'
            }).then(
                function(result) {
                  listar();
                })
          }else{
            swal({
                confirmButtonText: 'OK',
                title: 'Error al eliminar Materia',
                type: 'error'
            })
          }
        },
        error: function(data) {

        }
    });
};


function edit(id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "controller/editMateController.php",
            data: { 'id': id },
            success: function(data) {
                $('#trayectoM').val(data.trayecto);
                setSemestre('#trayectoM','#semestreM');
                $('#idMateM').val(data.id);
                $('#mateM').val(data.materia);
                $('#pnfM').val(data.pnf);
                $('#idSemM').val(data.idSemestre);
                $('#semestreM').val(data.semestre);
            },
            error: function(data) {
                console.log(data);
            }
        });
    };

    function modificarM() {

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
                if(data.status == true){
                    $('#myModal').modal('hide');
                  swal({
                      confirmButtonText: 'OK',
                      title: 'Materia Actualizada',
                      type: 'success'
                  }).then(
                      function(result) {
                        listar();
                      })

                }else{
                  $('#myModal').modal('hide');
                  swal({
                      confirmButtonText: 'OK',
                      title: 'Error al Actualizar Materia',
                      type: 'error'
                  })
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    };
</script>
