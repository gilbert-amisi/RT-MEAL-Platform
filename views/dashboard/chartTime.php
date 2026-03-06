
<?php

$bdDonnee = new Donnee();
$sommeDonnee = 0;
$nb = 0;

$recentADateExacte = "";
$donnees = $bdDonnee->getRecentDonneeByIndicateurByDateActivite($indicateurId);
foreach ($donnees as $donnee) {
    $recentADateExacte = $donnee['recentADateExacte'];
}

$dataPoints = [];

$donnees = $bdDonnee->getDonneeByIndicateurOrderByADate($indicateurId);
foreach ($donnees as $donnee) {

    array_push($dataPoints, array("y" => $donnee['valeur'], "label" => dateFrench($donnee['aDateExacte'])));

    if ($donnee['aDateExacte'] == $recentADateExacte) {
        $nb++;
        $sommeDonnee = $sommeDonnee + $donnee['valeur'];
    }
}

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