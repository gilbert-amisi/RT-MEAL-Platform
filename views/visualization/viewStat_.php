<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Visualisation
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col-lg-8">
                    <div>

                        <?php

                        $projectId = 0;
                        $levelSensibilite = 0;
                        $bdPointfocal = new Pointfocal();
                        $pointfocals = $bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                        foreach ($pointfocals as $pointfocal) {
                            $levelSensibilite = $pointfocal['levelSensibilite'];
                            $projectId = $pointfocal['prId'];
                        }


                        ?>

                        <form action="../controllers/visualization/visualizationController.php" method="POST">

                            <table class="table">
                                <tr>
                                    <td>
                                        <label class="control-label" for="my-select" style="font-weight: 600;">Filter by Category</label>
                                    </td>
                                    <td>
                                        <div class="form-group">

                                            <select id="category" class="form-control" name="cb_sensibilite">
                                                <option value="0">Choose</option>
                                                <?php
                                                $bdSensibilite = new Sensibilite();
                                                $sensibilites = $bdSensibilite->getSensibiliteByProjectId($projectId);
                                                foreach ($sensibilites as $sensibilite) {
                                                    if ($sensibilite >= $levelSensibilite) {
                                                ?>
                                                        <option value="<?= $sensibilite['seId'] ?>"><?= "Level: " . $sensibilite['levelSensibilite'] . " / " . $sensibilite['seDesignation'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            
                                            <button type="submit" name="bt_for_selectCategory" class="btn btn-primary"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </form>



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
                            <div style="height: 50vh; width: 100%;" id="map"></div>

                            <script src="../dependencies/leaflet/leaflet.js"></script>
                            <script src="../dependencies/turf/turf.min.js"></script>
                            <script src="../dependencies/geojson/osm_rd_congo_localitiesFinishedCVS.js"></script>
                            <script src="../dependencies/geojson/Territoires_limites_coordonneesCSV.js"></script>
                            <script src="https://leafletjs.com/SlavaUkraini/examples/choropleth/us-states.js"></script>

                            <?php

                            $bdTerritoire = new Territoire();
                            $bdInformation = new Information();
                            $bdSoumission = new Soumission();


                            $territoires = $bdTerritoire->getTerritoireAll();
                            $terrs = [];
                            $nbs = [];
                            $groupementNb = [];

                            $useCategory = 0;

                            if (isset($_GET['use_category'])) {
                                $useCategory = $_GET['use_category'];
                            }

                            foreach ($territoires as $territoire) {

                                $t = 0;

                                $informations = $bdInformation->getInformationByTerritoireId($territoire['id']);

                               

                                foreach ($informations as $information) {

                                    if (($useCategory != 0)) {
                                        $soumissions = $bdSoumission->getSoumissionByProjectIdBySensibiliteId($projectId, $useCategory);
                                    } else {
                                        $soumissions = $bdSoumission->getSoumissionByProjectId($projectId);
                                    }


                                    foreach ($soumissions as $soumission) {
                                        if ($information['id'] == $soumission['infId']) {
                                            if (!isset($groupementNb[$territoire['terr']][$information['lieu']])) {
                                                $groupementNb[$territoire['terr']][$information['lieu']] = 0;
                                            }
                                            $groupementNb[$territoire['terr']][$information['lieu']] = $groupementNb[$territoire['terr']][$information['lieu']] + 1;

                                            $t++;
                                            array_push($terrs, $territoire['terr']);
                                            array_push($nbs, $t);
                                        }
                                    }
                                }
                            }

                            ?>

                            <script>
                                // Map initialization 

                                // var drcGeoJSONP=JSON.parse(drcGeoJSON);


                                var myNewTerrs = <?php echo json_encode($terrs, JSON_NUMERIC_CHECK)  ?>;
                                var myNbs = <?php echo json_encode($nbs, JSON_NUMERIC_CHECK)  ?>;



                                // console.log(myNbs);

                                var myTerritory = myNewTerrs;
                                var myTerritoryValue = myNbs;

                                var copyDRC = {
                                    "type": "FeatureCollection",
                                    "features": []
                                };

                                var poly1 = [];

                                var n = 0;

                                var ar = [];

                                var lst1 = "";
                                var lst2 = "";

                                listCopy = [];
                                listPoly1 = [];

                                myTerritory.forEach(nav);

                                function nav(navi) {

                                    poly1 = [];

                                    copyDRC = {
                                        "type": "FeatureCollection",
                                        "features": []
                                    };

                                    newTerritories.features.forEach(decoup1);

                                    function decoup1(itm) {

                                        if ((itm.properties.NOM) == navi) {
                                            n++;

                                            // console.log("ici");

                                            // console.log(navi);

                                            // console.log(itm.properties.territory);

                                            // console.log(itm);

                                            copyDRC.features.push(itm);
                                            if (1) {
                                                // alert(itm.properties.territory);
                                                poly1.push([itm.geometry.coordinates[0], itm.geometry.coordinates[1]]);

                                            }

                                        }
                                    }

                                    // console.log("");

                                    listCopy.push(copyDRC);
                                    listPoly1.push(poly1);

                                }

                                // console.log(listCopy);

                                var map = L.map('map').setView([listCopy[2].features[0].geometry.coordinates[0], listCopy[2].features[0].geometry.coordinates[1]], 8);

                                //osm layer
                                var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                });
                                osm.addTo(map);
                            </script>

                            <?php
                            include 'interaction.php';
                            ?>

                            <script>
                                // var clrs = ['#2A6EAA', '#CA6EAA', '#3ACDA4', '#15502E', '#E1922E'];

                                il = 0;

                                ttft = [];

                                var geoj = {
                                    "type": "FeatureCollection",
                                    "features": [],
                                }

                                var statesData3 = {
                                    "type": "FeatureCollection",
                                    "features": []
                                };


                                listCopy.forEach(displ);

                                function displ(dsp) {

                                    if (dsp.features != [] && listPoly1[il] != []) {

                                        // var features = turf.points(listPoly1[il]);

                                        // var center = turf.center(features);

                                        // // console.log(center)

                                        // var from = turf.point(center.geometry.coordinates);

                                        max = 0;

                                        tf = [];

                                        tf2 = [];

                                        tft = [];

                                        l = 0;

                                        excludeIt = [];

                                        listPoly1[il].forEach(ford);

                                        function ford(fd) {


                                            // console.log(fd);

                                            // if (!excludeIt.includes()) {

                                            // }

                                            var to = turf.point(fd);
                                            var options = {
                                                units: 'miles'
                                            };

                                            // var distance = turf.distance(from, to, options);

                                            var max2 = 0;

                                            var k = 0;

                                            indexMax2 = 0;

                                            listPoly1[il].forEach(ford2);

                                            function ford2(fd2) {

                                                if (!excludeIt.includes(fd2)) {

                                                    var to2 = turf.point(fd2);
                                                    var options2 = {
                                                        units: 'miles'
                                                    };

                                                    // var distance2 = turf.distance(from, to2, options2);

                                                    // console.log(distance2);

                                                    tf.push(turf.point(fd2))

                                                    // if (distance2 > distance) {
                                                    //     max2 = distance2;
                                                    //     indexMax2 = k;
                                                    // }

                                                    // if (distance2 < distance) {
                                                    //     excludeIt.push(fd2);
                                                    // }

                                                    k++;

                                                    // var explode = turf.explode(polygon);
                                                }


                                                tft.push(listPoly1[il][indexMax2]);



                                            }

                                            tf2.push(listPoly1[il][indexMax2]);

                                            l++;

                                        }



                                        var points = turf.featureCollection(tf);

                                        var hull = turf.convex(points);

                                        // console.log(hull);

                                        //     geojson = L.geoJson(statesData, {
                                        //     // style: style,
                                        //     onEachFeature: onEachFeature
                                        // }).addTo(map);



                                        // var ter = {
                                        //     "type": "Feature",
                                        //     "geometry": {
                                        //         "type": "Polygon",
                                        //         "coordinates": [hull.geometry.coordinates]
                                        //     }
                                        // }

                                        if (hull != null) {

                                            ttft.push(hull.geometry.coordinates);

                                            cdts = [];

                                            for (p = 0; p < hull.geometry.coordinates.length; p++) {

                                                // console.log(hull.geometry.coordinates[p]);

                                                var cdt = [];

                                                for (g = 0; g < hull.geometry.coordinates[p].length; g++) {

                                                    cdt.push([hull.geometry.coordinates[p][g][1], hull.geometry.coordinates[p][g][0]]);
                                                }

                                                cdts.push(cdt);

                                            }

                                            // console.log(cdts);

                                            statesData3.features.push({
                                                "type": "Feature",
                                                "id": il,
                                                "properties": {
                                                    "name": myTerritory[il],
                                                    "density": myTerritoryValue[il]
                                                },
                                                "geometry": {
                                                    "type": "Polygon",
                                                    "coordinates": cdts
                                                }
                                            });

                                            // var polyline1 = L.polygon(hull.geometry.coordinates);

                                            // console.log(polyline1);

                                            // geoj.features.push(hull);

                                            // console.log(polyline1);

                                            // map.fitBounds(polyline1.getBounds());



                                            var drcLocalities = L.geoJSON(dsp, {
                                                style: stylePoint,
                                                onEachFeature: onEachFeaturePoint
                                            });

                                            // drcLocalities.addTo(map);

                                        }


                                    }


                                    il++;
                                };

                                geojson = L.geoJson(statesData3, {
                                    style: style,
                                    onEachFeature: onEachFeature
                                });

                                geojson.addTo(map);

                                // console.log(geoj);
                            </script>

                            <style>
                                .info {
                                    padding: 6px 8px;
                                    font: 14px/16px Arial, Helvetica, sans-serif;
                                    background: white;
                                    background: rgba(255, 255, 255, 0.8);
                                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                                    border-radius: 5px;
                                }

                                .info3 {
                                    /* padding: 6px 8px; */
                                    font: 14px/16px Arial, Helvetica, sans-serif;
                                    background: white;
                                    background: rgba(255, 255, 255, 0.8);
                                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                                    border-radius: 5px;
                                }

                                .info2 {
                                    padding: 6px 8px;
                                    font: 14px/16px Arial, Helvetica, sans-serif;
                                    background: white;
                                    background: rgba(255, 255, 255, 0.8);
                                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                                    border-radius: 5px;
                                }

                                .info h4 {
                                    margin: 0 0 5px;
                                    color: #777;
                                }

                                .legend {
                                    line-height: 18px;
                                    color: #555;
                                }

                                .legend i {
                                    width: 18px;
                                    height: 18px;
                                    float: left;
                                    margin-right: 8px;
                                    opacity: 0.7;
                                }
                            </style>


                        </div>

                    </div>
                    <?php

                    ?>
                </div>

                <div class="col-lg-4">
                    <?php
                    include 'chartGeo.php';
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>