<div class="card mt-4">
    <div class="card-header">
        Programmes par an
    </div>
    <div class="card-body">
        <div id="myChart1" style="height: 400px; width: 90%;"></div>
    </div>
</div>

<?php

$bdDonnee = new Donnee();
$sommeDonnee = 0;
$nb = 0;

$recentADateExacte = "";
$donnees = $bdDonnee->getRecentDonneeByIndicateurByDateActivite($indicateur['id']);
foreach ($donnees as $donnee) {
    $recentADateExacte = $donnee['recentADateExacte'];
}

$dataPoints=[];

$donnees = $bdDonnee->getDonneeByIndicateur($indicateur['id']);
foreach ($donnees as $donnee) {

    array_push($dataPoints,array("x" => $donnee['aDateExacte'], "y" => $donnee['valeur']));

    if ($donnee['aDateExacte'] == $recentADateExacte) {
        $nb++;
        $sommeDonnee = $sommeDonnee + $donnee['valeur'];
    }
}

?>

<script>
    window.onload = function() {

        var chart1 = new CanvasJS.Chart("myChart1", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Variation de l'indicateur"
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();

    }
</script>