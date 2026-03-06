<?php
if (isset($_SESSION['identite'])) {
    $bdProject = new Project();
    $projects = $bdProject->getProjectAll();
    $bdPhase = new Phase();
    $phases = $bdPhase->getPhaseAll();

    $bdTerritoire = new Territoire();
    $territoires = $bdTerritoire->getTerritoireAll();
    $terrs = [];
    $nbs = [];

    $bdVerification = new Verification();
    $verifications = $bdVerification->getVerificationDash();
?>
<div class="card m-2 p-2">
    <div class="card-header" style="color: #305286;">
        <?php
        if ($_SESSION['typeCompte'] == "TPM Coordinator") {
            ?>
            <h5><i class="fa fa-database" aria-hidden="true" style="color: #305286;"></i> DASHBOARD FOR THIRD PARTY MONITORING REPORTS</h5>
            <?php
        }
        if ($_SESSION['typeCompte'] == "Partner") {
            ?>
            <h5><i class="fa fa-database" aria-hidden="true" style="color: #305286;"></i> DASHBOARD FOR THIRD PARTY MONITORING REPORTS FROM IES-CONGO</h5>
            <?php
        }
        ?>
        <hr>
        <form method="POST">
            <div class="form-group" style="float: left; width:80%;">
                <select name="projectId" class="form-control select2" id="projectId" style="width:98%;">
                
                    <option value="0">Select the project to visualize here</option>
                    <?php
                        foreach ($projects as $project) {
                            if ($_SESSION['typeCompte'] == "Partner") {
                                if ($_SESSION['compteId'] == $project['compteId']) {
                                    ?>
                                        <option value="<?= $project['prId'] ?>">Project <?= $project['prDesignation'] ?> of <?= $project['ogDesignation'] ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="<?= $project['prId'] ?>">Project <?= $project['prDesignation'] ?> of <?= $project['ogDesignation'] ?></option>
                            <?php
                            }
                        
                        }
                        ?>
                </select>
            </div>
            <div class="form-group" style="float: left; width:20%;">
                <button class="btn btn-outline-info btn-sm" name="filter_tpm_project" type="submit" title="Filter reports by project">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
            </div>
        </form> <br> <br>
        <?php
        if (isset($_POST['filter_tpm_project'])) {
            $getProject = $_POST['projectId'];
            // $verifications = $bdVerification->getVerificationByProject($getProject);
        }
        ?>

        <form method="POST">
            <div class="form-group" style="float: left; width:80%;">
                <select name="phaseId" class="form-control select2" id="phaseId" style="width:98%;">
                    <option value="0">Then select the reporting phase </option>
                        <?php
                        foreach ($phases as $phase) {
                            if ($phase['projectId']== $getProject) {
                                ?>
                                    <option value="<?= $phase['id'] ?>"><?= $phase['name'] ?> (<?= $phase['type'] ?>)</option>
                                <?php
                            }
                        }
                        ?>
                </select>
            </div>
            <div class="form-group" style="float: left; width:20%;">
                <button class="btn btn-outline-primary btn-sm" name="filter_tpm_phase" type="submit" title="Filter reports by reporting phase">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
            </div>
        </form> <br> <br>

    </div>

    <div class="card-body list-group">
        <?php
            if (isset($_POST['filter_tpm_phase'])) {
                $getPhase = $_POST['phaseId'];
                $verifications = $bdVerification->getVerificationDashPhase($getPhase);

                if (empty($verifications)) {
                    ?>
                    <h5 class="text-center text-danger"> <i class="fa fa-exclamation-triangle"></i> No data for your selection</h5>
            
                    <?php
                } else {

                if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "Partner")) {
                    $n = 0;
                    $nbred = 0;
                    $nborange = 0;
                    $nbgreen = 0;
                    ?> 
                        <div class="card">
                            <div class="card-body">
                                <?php
                                
                                $nbred=0;
                                $nborange=0;
                                $nbgreen=0;
                                foreach ($verifications as $verification) {
                                    $nph = $verification['phasename'];
                                    $npr = $verification['proj'];
                                    $nor = $verification['org'];
                                    $tph = $verification['phasetype'];
                                    if ($verification['rating'] == 'red') {
                                        $nbred++;
                                    }
                                    if ($verification['rating'] == 'orange') {
                                        $nborange++;
                                    }
                                    if ($verification['rating'] == 'green') {
                                        $nbgreen++;
                                    }

                                }
                                $nbtot=$nbred+$nborange+$nbgreen+0.000001;
                                $pred= round($nbred*100/$nbtot, 2);
                                $porange= round($nborange*100/$nbtot, 2);
                                $pgreen= round($nbgreen*100/$nbtot, 2);

                                ?>
                                
                                <!-- Map -->

                                <div class="card" style="float: left; width: 50%; overflow: scroll;">
                                    <div class="card-header" style="color: #305286; font-family: Georgia, 'Times New Roman', Times, serif;">
                                        <h4>Global situation of project <?= $npr ?> of <?= $nor ?> at <?= $nph ?> (<?= $tph ?>)</h4>
                                    </div>
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
                                        
                                        var map = L.map('map').setView([-1.88697817664, 29.0916695847], 7);

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

                                                // var layer = L.marker([-2.14362955343,28.8582755491])
                                                // .bindTooltip("-1-",{permanent:true}).openTooltip();
                                                // layer.addTo(map);

                                                // var layer = L.marker([-2.34260171903,28.9521507504])
                                                // .bindTooltip("-3-",{permanent:true}).openTooltip();
                                                // layer.addTo(map);

                                                // var layer = L.marker([-2.34260171903,28.9521507504])
                                                // .bindTooltip("-2-",{permanent:true}).openTooltip();
                                                // layer.addTo(map);

                                                

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

                                <div class="card" style="float: left; width: 50%; overflow: scroll; height: 100%;">
                                    <div class="card-header d-flex w-100 justify-content-between h5">
                                        <nav class="navbar navbar-expand-sm navbar-light bg-light" style=" border-radius: 3px; background-color: #FFE7BF; font-family: Arial, Helvetica, sans-serif;" >
                                            <ul class="navbar-nav">

                                                <li class="nav-item">
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle btn btn-outline-primary btn-lg" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-plus" aria-hidden="true"></i> Get details
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                            <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmtable") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                            <i class="fa fa-share-alt" aria-hidden="true"></i> Activties Rating Table</a></li>
                                                            <li><a class="dropdown-item" href="home.php?render=<?= sha1("ratingip") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                            <i class="fa fa-university" aria-hidden="true"></i> Implementors Rating Table</a></li>
                                                            <li><a class="dropdown-item" href="home.php?render=<?= sha1("ratingterritory") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i> Territories Rating Table</a></li>         
                                                        </ul>
                                                    </li>
                                                </li>
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="card-body">
                                        <div class="progress" style="height: 60px;">
                                            
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$pred?>%" aria-valuenow="<?= $pred ?>" aria-valuemin="0" aria-valuemax="100" title="Percent of activities with serious issue identified that could impact programming">
                                                <h4><?= $pred ?>%</h4>
                                            </div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?=$porange?>%" aria-valuenow="<?=$porange?>" aria-valuemin="0" aria-valuemax="100" title="Percent of activities with important problem identified, but could not seriously affect the programming">
                                                <h4><?= $porange ?>%</h4>
                                            </div>
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?=$pgreen?>%" aria-valuenow="<?=$pgreen?>" aria-valuemin="0" aria-valuemax="100" title="Percent of activities with excellent performance, no issues requiring intervention were identified">
                                                <h4><?= $pgreen ?>%</h4>
                                            </div>
                                        </div> <br>
                                        <div class="row container">
                                            <div class="col-1"></div>
                                            <div class="card col-3" style="border-left: solid red 15px; color: #305286; text-align: center;">
                                                <h1><?= $nbred?></h1> <br>
                                                <h5>Activitie(s)</h5>
                                            </div>
                                            <div class="col-1"></div>

                                            <div class="card col-3" style="border-left: solid orange 15px; color: #305286; text-align: center;">
                                                <h1><?= $nborange?></h1> <br>
                                                <h5>Activitie(s)</h5>
                                            </div>
                                            <div class="col-1"></div>

                                            <div class="card col-3" style="border-left: solid green 15px; color: #305286; text-align: center;">
                                                <h1><?= $nbgreen?></h1> <br>
                                                <h5>Activitie(s)</h5>
                                            </div>
                                        </div> <br>
                                        <div class="card container" style="border-left: grey accent 15px; color: #305286; text-align: center;">
                                            <div class="card-body">
                                                <h5>Total of Activities monitored</h5><br>
                                                <h1><?= $nbred+$nborange+$nbgreen ?></h1>
                                            </div>
                                            
                                            <div class="card-footer align-items-center" sy>
                                                <nav class="navbar navbar-expand-sm navbar-light bg-light" style=" border-radius: 3px; background-color: #FFE7BF; font-family: Arial, Helvetica, sans-serif;" >
                                                    <ul class="navbar-nav">

                                                        <li class="nav-item">
                                                            <li class="nav-item dropdown">
                                                                <a class="nav-link dropdown-toggle btn btn-outline-primary btn-lg" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-plus" aria-hidden="true"></i> Get details
                                                                </a>
                                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmtable") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                                    <i class="fa fa-share-alt" aria-hidden="true"></i> Activties Rating Table</a></li>
                                                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("ratingip") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                                    <i class="fa fa-university" aria-hidden="true"></i> Implementors Rating Table</a></li>
                                                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("ratingterritory") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                                                                    <i class="fa fa-map-marker" aria-hidden="true"></i> Territories Rating Table</a></li>         
                                                                </ul>
                                                            </li>
                                                        </li>
                                                        
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h6>Legend</h6><hr>
                                        <p><i class="fa fa-circle" style="color: red;"></i> Serious issue identified that could impact programming</p>
                                        <p><i class="fa fa-circle" style="color: orange;"></i> Important problem identified, but does not seriously affect the programming</p>
                                        <p><i class="fa fa-circle" style="color: green;"></i> Excellent performance, No issues requiring intervention were identified</p>

                                    </div>
                                </div>
                                
                            </div>   

                        </div>
                    <?php
                }
                }
            }
            # Displaying All

            else {
                ?>
                <h5 class="text-center text-secondary"> Select the project then the reporting phase you need to visualize !!!</h5>
                <p class="text-center text-secondary"> After every selection, you need to clic on <b>Search</b> button aside to validate</p>
                <?php
            }
        ?>
    </div>

</div>
<?php
}
