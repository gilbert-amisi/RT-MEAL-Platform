<?php

$dataPoints2 = array(
    array("label" => "Food + Drinks", "y" => 590),
    array("label" => "Activities and Entertainments", "y" => 261),
    array("label" => "Health and Fitness", "y" => 158),
    array("label" => "Shopping & Misc", "y" => 72),
    array("label" => "Transportation", "y" => 191),
    array("label" => "Rent", "y" => 573),
    array("label" => "Travel Insurance", "y" => 126)
);

?>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("myChart2", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Average Expense Per Day  in Thai Baht"
            },
            subtitles: [{
                text: "Currency Used: Thai Baht (฿)"
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>