<?php

$dataPoints = [];

$actualYear = dateFrenchItem(date('Y-m-d'), 0);

$months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
$monthsDescriptive = ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];

$bdProces = new Proces();
$k=0;
foreach ($months as $month) {
    
    $nProcesYM=0;
    $process = $bdProces->getProcesLikeMonthYear($actualYear . '-' . $month . '-');
    foreach ($process as $proces) {
        $nProcesYM++;
    }
    
    array_push($dataPoints, ["y" => $nProcesYM, "label" => $monthsDescriptive[$k] . " " . $actualYear]);
    $k++;
}





// $donnees = $bdDonnee->getDonneeByIndicateurAvgValeurGroupADate($indicateurId);
// foreach ($donnees as $donnee) {

//     array_push($dataPoints, array());

// }

?>

<script>
    window.onload = function() {
        var nameChart = $("#nameC").val();
        var chart = new CanvasJS.Chart("myChart1", {
            title: {
                text: nameChart
            },
            axisY: {
                title: "Nombre"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>