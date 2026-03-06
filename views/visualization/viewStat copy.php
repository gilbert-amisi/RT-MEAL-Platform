<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <h5><i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Complaints Reports Dashboard</h5>
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col">
                    <div>
                        <h4 style="color:#2A6EAA" class="myCenter"><strong><i class="fa fa-chevron-down" aria-hidden="true"></i> Case of fraud</strong></h4>
                        <hr>
                        <!-- <div class="row">
                            <div class="col-lg-4">
                                <img height="350px" width="400px" src="../media/input/carte_fraude_RT_IES.png" alt="noFile">
                            </div>
                            <div class="col-lg-8">
                                <img height="350px" width="1000px" src="../media/input/chart_fraud_case_IES.png" alt="noFile">
                            </div>
                        </div> -->
                        <div>
                            <table class="table table-bordered">
                                <?php
                                $bdGeo = new Geodata();
                                $geos = $bdGeo->getGeodata();
                                $n = 0;
                                $ths = ['name', 'place', 'is_in:territoire', 'is_in:groupement', 'is_in:collectivit'];
                                foreach ($geos as $geo) {
                                    $n++;
                                    // echo $n . " " . $geo['proprerties'];
                                    // echo "<hr>";
                                    $is1 = explode(';', $geo['proprerties']);
                                ?>

                                    <tr>
                                        <td><?= $is1[0] ?></td>
                                        <?php

                                        $is2 = explode(',', $is1[1]);

                                        for ($t = 0; $t < 5; $t++) {
                                            $forEchoing = "";
                                            $echoIt = False;
                                            foreach ($is2 as $i2) {

                                                $is3 = explode('=>', trim($i2));

                                                // echo ('"' . $ths[$t] . '"');
                                                if (trim($is3[0]) == trim('"' . trim($ths[$t]) . '"')) {
                                                    $echoIt = true;
                                                    $forEchoing = $is3[1];
                                                }
                                            }

                                            if ($echoIt) {
                                        ?>
                                                <td>
                                                    <?= $forEchoing ?>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>

                                                </td>
                                        <?php
                                            }
                                        }




                                        ?>

                                    </tr>


                                <?php
                                }


                                ?>
                            </table>
                        </div>

                    </div>
                    <?php

                    ?>
                </div>

            </div>

        </div>
    </div>
</div>