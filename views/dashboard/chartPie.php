
<?php

$valeurObjectif = 0;
$valeurConstatInitial = 0;

$bdPlanification = new Planification();
$planifications = $bdPlanification->getPlanificationByIndicateur($indicateurId);
foreach ($planifications as $planification) {

    if ($planification['typePlanification'] == "objectif") {
        $valeurObjectif = $planification['valeur'];
    } else {
        $valeurConstatInitial = $planification['valeur'];
    }
}

$bdDonnee = new Donnee();
$sommeDonnee = 0;
$nb = 0;

$recentADateExacte = "";
$donnees = $bdDonnee->getRecentDonneeByIndicateurByDateActivite($indicateurId);
foreach ($donnees as $donnee) {
    $recentADateExacte = $donnee['recentADateExacte'];
}

$dataPoints = [];

$donnees = $bdDonnee->getDonneeByIndicateur($indicateurId);
foreach ($donnees as $donnee) {


    if ($donnee['aDateExacte'] == $recentADateExacte) {
        $nb++;
        $sommeDonnee = $sommeDonnee + $donnee['valeur'];
    }
}

$moyenneProp=0;
if ($nb>0) {
    $moyenneProp=($sommeDonnee/$nb);
}

echo $moyenneProp;

array_push($dataPoints, array("label" => $designationIndicateur, "y" => ($moyenneProp)));
array_push($dataPoints, array("label" => "Population saine", "y" => (100-$moyenneProp)));

?>

<script>
    window.onload = function() {
        var nameChart = $("#nameC").val();
        
        var chart = new CanvasJS.Chart("myChart1", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: nameChart
            },
            subtitles: [{
                text: 'en %'
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>