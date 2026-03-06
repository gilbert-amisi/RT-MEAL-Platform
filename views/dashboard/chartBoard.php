<?php
$designationIndicateur = "Les procès"
?>
<input type="hidden" id="nameC" name="" value="<?= $designationIndicateur ?>">

<div class=" myCenter p-4">
    <div id="myChart1" style="height: 400px; width: 100%;"></div>
</div>


<?php

if (1) {
    include 'chartTimeAverage.php';
}

?>