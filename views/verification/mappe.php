<?php

$bdTerritoire = new Territoire();
$territoires = $bdTerritoire->getTerritoireAll();
$terrs = [];
$nbs = [];


$bdVerification = new Verification();
$verifications = $bdVerification->getVerificationDash();
?>
<!-- MAP -->

<div class="card" style="float: left; width: 50%; overflow: scroll;">
    <div style="height: 90vh; width: 100%;" id="map"></div>

    <script src="../dependencies/leaflet/leaflet.js"></script>
    <script src="../dependencies/turf/turf.min.js"></script>
    <script src="../dependencies/geojson/osm_rd_congo_localitiesFinishedCVS.js"></script>
    <script src="../dependencies/geojson/Territoires_limites_coordonneesCSV.js"></script>
    <!-- <script src="https://leafletjs.com/SlavaUkraini/examples/choropleth/us-states.js"></script> -->

    <?php


    $bdInformation = new Information();
    $bdSoumission = new Soumission();

    $groupementNb = [];

    $useCategory = 0;

    if (isset($_GET['use_category'])) {
        $useCategory = $_GET['use_category'];
    }

    $gpms = [];

    foreach ($territoires as $territoire) {
        foreach ($verifications as $verification) {
            if ($verification['territoireid'] == $territoire['id']) {
                $t++;
                if (!in_array($territoire['terr'], $terrs)) {
                    array_push($terrs, $territoire['terr']);
                }
                array_push($nbs, $t);
            }
        }

        $t = 0;
    }

    ?>

    <script>
        // Map initialization 

        // var drcGeoJSONP=JSON.parse(drcGeoJSON);

        var myTabTerr = <?php echo json_encode($groupementNb, JSON_NUMERIC_CHECK)  ?>;
        var myNewTerrs = <?php echo json_encode($terrs, JSON_NUMERIC_CHECK)  ?>;
        var myNbs = <?php echo json_encode($nbs, JSON_NUMERIC_CHECK)  ?>;

        var nbTerr = [];

        Object.entries(myTabTerr).forEach(entry => {
            const [key, value] = entry;
            var nn = 0;

            Object.entries(value).forEach(entry2 => {
                const [key2, value2] = entry2;
                nn++;

            });

            nbTerr[key] = (nn);

        });

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

        copyDRC = {
            "type": "FeatureCollection",
            "features": []
        };

        lters = [];

        myTerritory.forEach(nav);

        function nav(navi) {
            lters[navi] = [];
        }

        newTerritories.features.forEach(decoup1);

        function decoup1(itm) {

            if (myTerritory.includes(itm.properties.NOM)) {
                if (1) {
                    lters[itm.properties.NOM].push([itm.geometry.coordinates[0], itm.geometry.coordinates[1]]);
                }
            }
        }

        var map = L.map('map').setView([-1.88697817664, 29.0916695847], 8);

        // var map = L.map('map').setView([-4.038333, 21.758663999999953], 6);
        // var map = L.map('map').setView([-7.257704, 19.624432], 6);
        // var map = L.map('map').setView([-3.000000000000796, 27.999999999999204], 6);


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

        myTerritory.forEach(nav);

        function nav(navi) {

            if ((1) || (dsp.features != [] && listPoly1[il] != [])) {

                max = 0;

                tf = [];

                tf2 = [];

                tft = [];

                l = 0;

                var max2 = 0;

                var k = 0;

                indexMax2 = 0;

                k++;

                l++;

            }

            lpts = [];

            lters[navi].forEach(ltf);

            function ltf(lt) {
                lpts.push(turf.point(lt));
            }

            var points = turf.featureCollection(lpts);

            var hull = turf.convex(points);

            if (hull != null) {

                ttft.push(hull.geometry.coordinates);

                cdts = [];

                for (p = 0; p < hull.geometry.coordinates.length; p++) {

                    var cdt = [];

                    for (g = 0; g < hull.geometry.coordinates[p].length; g++) {

                        cdt.push([hull.geometry.coordinates[p][g][1], hull.geometry.coordinates[p][g][0]]);
                    }

                    cdts.push(cdt);

                }

                // console.log(cdts);

                lters[navi].push(lters[navi][0]);

                statesData3.features.push({
                    "type": "Feature",
                    "id": il,
                    "properties": {
                        "name": myTerritory[il],
                        "density": nbTerr[navi]
                    },
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [lters[navi]]
                    }
                });

                geojson = L.geoJson(statesData3, {
                    style: style,
                    onEachFeature: onEachFeature
                });

                geojson.addTo(map);
                // L.maker([-2.14362955343,28.8582755491]).addTo(map);

                var layer = L.marker([-2.14362955343,28.8582755491])
                .bindTooltip("-1-",{permanent:true}).openTooltip();
                layer.addTo(map);

                var layer = L.marker([-1.88505175571,29.0900195627999])
                .bindTooltip("-2-",{permanent:true}).openTooltip();
                layer.addTo(map);

                var layer = L.marker([-2.34260171903,28.9521507504])
                .bindTooltip("-3-",{permanent:true}).openTooltip();
                layer.addTo(map);

                

                // var tooltip1 = L.tooltip()
                //     .setLatLng([-2.14362955343, 28.8582755491])
                //     .setContent('-1-')
                //     .addTo(map);

                // var tooltip2 = L.tooltip()
                //     .setLatLng([-1.88505175571,29.0900195627999])
                //     .setContent('-2-')
                //     .addTo(map);
                // var tooltip2 = L.tooltip()
                //     .setLatLng([-2.34260171903,28.9521507504])
                //     .setContent('-3-')
                //     .addTo(map);


            }


            // }


            il++;
        }
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


<!-- Phase -->