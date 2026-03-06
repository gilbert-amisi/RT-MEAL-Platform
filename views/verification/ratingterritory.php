<?php
if (isset($_SESSION['identite'])) {
    $phaseId = $_GET['phaseId'];
    $bdPhase = new Phase();
    $phases = $bdPhase->getPhaseAll();

    $bdTerritoire = new Territoire();
    $territoires = $bdTerritoire->getTerritoireAll();
    $terrs = [];
    $nbs = [];
    foreach ($phases as $phase) {
        if ($phase['id'] == $_GET['phaseId']) {
            $phaseId = $phase['id'];
            $phaseName = $phase['name'];
            $project = $phase['proj'];
            $phaseType = $phase['type'];
            $org = $phase['org'];
        }
    }

    $bdVerification = new Verification();
    $verifications = $bdVerification->getVerificationByPhase($phaseId);
?>
<div class="m-2 p-2">
    <div class="card container-fluid p-1 m-1">
        <div class="card-header d-flex w-100 justify-content-between h5"> 
            Perfomance Rating by territory : Project <?= $project ?> of <?= $org ?> - <?= $phaseName ?> (<?= $phaseType ?>)
            <div>
                <a class="btn btn-outline-primary btn-sm" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>"> <i class="fa fa-bookmark"></i> View Reports content</a>
            </div>
        </div>
        <div class="card-body container">
            <table class="table table-bordered table-condensed">
                <thead>
                    <th>Province</th>
                    <th>Territory</th>
                    <th>Red</th>
                    <th>Orange</th>
                    <th>Green</th>
                </thead>
                <tbody>
                <?php
                $bdRating = new Verification();
                $ratings = $bdRating->getRatingTerritory($phaseId);
                $nt=0;
                foreach ($ratings as $rat) {
                    ?>
                        <tr>
                            
                            <td>
                                <?=$rat['province'] ?>
                            </td>
                            <td>
                                <?=$rat['terr'] ?>
                            </td>
                            <td>
                            <?php
                                if($rat['rating']=='red'){
                                    ?>
                                    <span class="badge bg-danger"><?=$rat['nred'] ?></span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="badge bg-danger"></span>
                                    <?php    
                                }
                            ?>
                            </td>
                            <td>
                            <?php
                                if($rat['rating']=='orange'){
                                    ?>
                                    <span class="badge bg-warning"><?=$rat['nred'] ?></span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="badge bg-warning"></span>
                                    <?php    
                                }
                            ?>
                            </td>
                            <td>
                            <?php
                                if($rat['rating']=='green'){
                                    ?>
                                    <span class="badge bg-success"><?=$rat['nred'] ?></span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="badge bg-success"></span>
                                    <?php    
                                }
                            ?>
                            </td>
                        </tr>
                    <?php
                    

                }
                ?>
                </tbody>
            </table>

        </div>
        <div class="card-footer">
        <h6>Legend</h6><hr>
            <p><i class="fa fa-circle" style="color: red;"></i> Serious issue identified that could impact programming</p>
            <p><i class="fa fa-circle" style="color: orange;"></i> Important problem identified, but does not seriously affect the programming</p>
            <p><i class="fa fa-circle" style="color: green;"></i> Excellent performance, No issues requiring intervention were identified</p>
        </div>

    </div>
</div>


<?php
}