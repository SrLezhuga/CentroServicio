<?php include_once "assets/common/header.php"; 

$date = strtotime(date("Y-m-d"));

$first = strtotime('Monday 53w');
$last = strtotime('Sunday');

echo date('Y-m-d', $first);
echo '<br>';
echo date('Y-m-d', $last);
echo '<br>';
echo '<br>';
echo '<br>';
$fecha = new DateTime("NOW");
$semana = $fecha->format('W');
echo "Semana: $semana";
echo '<br>';
echo '<br>';
echo strftime("%V");
echo '<br>';
echo '<br>';
echo '<br>';
?>

<input type="file" class="custom-file-input" id="txt_archivo" lang="es" accept=".xml">
<button type="button" class="btn btn-outline-secondary btn-block" onclick="CargarExcel()"><i class="fas fa-file-excel"></i> Cargar Excel</button>
<div id="demo"></div>
<script>
function CargarExcel() {
    var xml = $("txt_archivo");
    markers=JSON.stringify(xml);
    alert(markers);

    $.ajax({
        url: 'xml_ajax.php',
        type: "post",
        data: markers,
        success: function(resp) {
            alert(resp);
            $("demo").html(resp);
        }
    });
}
</script>


