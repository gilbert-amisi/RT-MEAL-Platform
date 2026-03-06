<div class="col-lg-8">
    <div class="row">
        <?php

        $selectedT = [];
        $selectedG = [];
        $selectedS = [];

        if (isset($_GET['filter'])) {
            $itemsF = explode('$', $_GET['filter']);
            $itemsT = explode('-', $itemsF[0]);
            $itemsG = explode('-', $itemsF[1]);
            $itemsS = explode('-', $itemsF[2]);

            foreach ($itemsT as $itemT) {
                if ($itemT != "") {
                    array_push($selectedT, $itemT);
                    // echo $itemT;
                }
            }

            foreach ($itemsG as $itemG) {
                if ($itemG != "") {
                    // echo $itemG;
                    array_push($selectedG, $itemG);
                    // echo $itemT;
                }
            }

            foreach ($itemsS as $itemS) {
                if ($itemS != "") {
                    // echo $itemG;
                    array_push($selectedS, $itemS);
                    // echo $itemT;
                }
            }
        }

        

        ?>

        <script>
            var selectedT = <?php echo json_encode($selectedT, JSON_NUMERIC_CHECK); ?>;
            var selectedG = <?php echo json_encode($selectedG, JSON_NUMERIC_CHECK); ?>;
            var selectedS = <?php echo json_encode($selectedS, JSON_NUMERIC_CHECK); ?>;
            // console.log(selectedG);

        </script>

        <?php

        foreach ($terrs as $terr) {
            // echo $terr."-";
            if (in_array($terr, $selectedT)) {
        ?>
                <div class="col m-2" id="chartContainer<?= $terr ?>" style="width: 100%; height: 50vh;"></div>
        <?php
            }
        }
        ?>
    </div>
</div>