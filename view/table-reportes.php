<?php require_once('../model/materiaModel.php');
   $row = show_mate();
?>
<div class="repo mate padding-top">

    <h1 class="titleMat padding-top">Reportes</h1>
    <div class="cont-fillter form-inline">
        <select name="pnf" id="pnfS"  class="form-control" onchange="setactive('#trayectoS')" >
                <option selected disabled value="">Filtrar por PNF: </option>
                <option value="1">PNF en Electricidad</option>
                <option value="2">PNF en Ingeniería de Mantenimiento</option>
                <option value="3">PNF en Mecánica</option>
                <option value="4">PNF en Informática</option>
                <option value="5">PNF en Geociencia</option>
                <option value="6">PNF en Sistemas de Calidad y Ambiente</option>
        </select>
        <select name="trayecto" id="trayectoS" class="form-control"  disabled onchange="setSemestre('#trayectoS','#semestreS')">
            <option selected disabled value="">Seleccione Trayecto: </option>
            <option value="1">Trayecto I</option>
            <option value="2">Trayecto II</option>
            <option value="3">Trayecto III</option>
            <option value="4">Trayecto IV</option>
        </select>
        <select name="Semestre" id="semestreS"  class="form-control" disabled onchange="mate(),setactive('#mate')">
            <option selected disabled value="">Seleccione Semestre</option>
        </select>
        <select name="mate" id="mate"  class="form-control" disabled onchange="repor()">
            <option selected disabled value="">Seleccione la Materia</option>
        </select>
          <button class="btn btn-success btn-refresh" onclick="refresh();" type="">Refresh <i class="fa fa-refresh" aria-hidden="true"></i></button>
    </div>

</div>

<?php
    $cont = array(0,0,0,0,0,0);
    $mysqli = crearConexion();
    $consulta = 'SELECT pnf_user, case pnf_user WHEN 1 THEN  "PNF en Electricidad"
        WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
            WHEN 3 THEN  "PNF en Mecánica"
            WHEN 4 THEN  "PNF en Informática"
            WHEN 5 THEN  "PNF en Geociencia"
            WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
        END AS pnf,count(*) as contador FROM usuarios GROUP BY pnf_user';

    $resultado = $mysqli->query($consulta);


  $data = array();
  $i = 0;
    while ( $row = $resultado->fetch_array()) {
  $cont[$i] = $row["contador"];
  $i++;
  }
 ?>

<script>
  var pnf1 = <?php echo $cont[0]; ?>;
  var pnf2 = <?php echo $cont[1]; ?>;
  var pnf3 = <?php echo $cont[2]; ?>;
  var pnf4 = <?php echo $cont[3] ?>;
  var pnf5 = <?php echo $cont[4] ?>;
  var pnf6 = <?php echo $cont[5] ?>;
</script>




<script type="text/javascript">

function refresh(){
    $(".container-page").load('../app/view/table-reportes.php');
}

function mate(){
  var t = $("#trayectoS").val();
  var s = $("#semestreS").val();
  var p = $("#pnfS").val();
  $.ajax({
      type: "POST",
      dataType: 'json',
      url: "controller/reportMateController.php",
      data: { 't':t, 's':s, 'p':p },
      success: function(data) {
        var valor = '<option selected disabled value="">Seleccione la Materia</option>'
        if(data['valor'] != 0){
          for (var i = 0; i < data['valor']; i++) {
            valor = valor + '<option   value="'+data[i].id_materias+'">'+data[i].materia+'</option>';
          }
          $('#mate').html(valor);
        }else{
          var valor = '<option selected disabled value="">No hay</option>'
          $('#mate').html(valor);
        }
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

function repor(){
  var t = $("#trayectoS").val();
  var s = $("#semestreS").val();
  var p = $("#pnfS").val();
  var m = $("#mate").val();
  window.location.href = '../app/report/index.php?curso='+m+'&tra='+t+'&sem='+s+'&pnf='+p;
}


$(function () {

    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Alumnos Inscritos por PNF'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        lang: {
           loading: 'Aguarde...',
           exportButtonTitle: "Exportar",
           printChart: "Imprimir",
           downloadPNG: 'Descargar en formato  PNG',
           downloadJPEG: 'Descargar en formato PEG',
           downloadPDF: 'Descargar en formato  PDF',
           downloadSVG: 'Descargar en formato em SVG'
           },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Electricidad',
                y: pnf1
            }, {
                name: 'Mantenimiento',
                y: pnf2,
                sliced: true,
                selected: true
            }, {
                name: 'Mecánica',
                y: pnf3
            }, {
                name: 'Informática',
                y: pnf4
            }, {
                name: 'Geociencia',
                y: pnf5
            }, {
                name: 'Calidad y Ambiente',
                y: pnf6
            }]
        }]
    });

});

</script>
<br>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
