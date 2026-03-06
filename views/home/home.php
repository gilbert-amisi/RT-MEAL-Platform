
<?php

$bdProject=new Project();

if (isset($_SESSION['identite'])) {
    $projectId=0;
    $bdProject=new Project();
    $projects=$bdProject->getProjectAllActive();
    $levelSensibilite=0;
    $bdPointfocal=new Pointfocal();
    $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
    foreach ($pointfocals as $pointfocal) {
        $levelSensibilite=$pointfocal['levelSensibilite'];
        $projectId=$pointfocal['prId'];
    }

    // if ($_SESSION['typeCompte']=="Partner") {
    //     // $projects=$bdProject->getProjectById($projectId);
    //     $projects=$bdProject->getProjectByPF($_SESSION['compteId']);
    // } else {
    //     $projects=$bdProject->getProjectAllActive();
    // }

}

?>

        <div class="container card m-2 p-2" style="color: #1E3D57; font-family:Georgia, 'Times New Roman', Times, serif;">
            <div class="card-header h4">IES - Third Party Monitoring and Accountability Services </div>
            <div class="card-body row m-4 p-4">
                <?php
                if ($_SESSION['typeCompte']== "Call-Center Agent") {
                    foreach ($projects as $project) {
                ?>
                    <div class="col-lg-4 mt-5">
                        <div class="card" style="border-left: solid <?= $project['ogColor'] ?> 15px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10" >
                                        <p class="h2"><?= $project['ogDesignation'] ?></p>
                                        <p class="h4" class="mt-2"><strong><?= $project['prDesignation'] ?></strong></p>
                                    </div>
                                        
                                    <a class="btn btn" href="home.php?render=<?= sha1("rapportage") ?>&sub=<?= sha1("start") ?>&use_project=<?= sha1($project['prId']) ?>"> 
                                        <div class="col-lg-2" style="background-color:<?= $project['ogColor'] ?>; color:white; border-radius:5px; padding:10px;" >
                                            Select
                                        </div>
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>

                <?php
                if ($_SESSION['typeCompte']== "Partner" || $_SESSION['typeCompte']== "TPM Coordinator" || $_SESSION['typeCompte']== "admin") {
                    ?>
                <div class="col-lg-6 mt-5">
                    <div class="card" style="border-left: solid <?= $project['ogColor'] ?> 15px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10" >
                                    <p class="h2">IES TPM Services</p> <hr>
                                    
                                    <a class="btn btn-lg btn-outline-success" href="home.php?render=<?= sha1("tpmdashboard") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-database"></i> Get Dashboard</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-5">
                    <div class="card" style="border-left: solid <?= $project['ogColor'] ?> 15px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <p class="h2">IES Accountability Services</p> <hr>
                                    
                                    <a class="btn btn-lg btn-outline-danger" href="home.php?render=<?= sha1("visualization") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-database"></i> Get Dashboard</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }

                if ($_SESSION['typeCompte']== "TPM Proxy Monitor") {
                    $bdval=new Tpm();
                    $validated=$bdval->getValidatedByProxy($_SESSION['compteId']);
                    if(!empty($validated)) {
                        foreach($validated as $val) {
                            $nbval=$val['nbval'];
                        }
                    } else {
                        $nbval=0;
                    }
                    
                    $unvalidated=$bdval->getUnvalidatedByProxy($_SESSION['compteId']);
                    if(!empty($unvalidated)) {
                        foreach($unvalidated as $unval) {
                            $nbunval=$unval['nbunval'];
                        }
                    } else {
                        $nbunval=0;
                    }
                    $unchecked=$bdval->getUncheckedByProxy($_SESSION['compteId']);
                    if(!empty($unchecked)) {
                        foreach($unchecked as $uncheck) {
                            $nbunchecked=$uncheck['nbunchecked'];
                        }
                    } else {
                        $nbunchecked=0;
                    }
                   
                    $bdaf = new Affectation();
                    $nbaffect=0;
                    $affectations=$bdaf->getAffectationByProxy($_SESSION['compteId']);
                    foreach($affectations as $af) {
                        $nbaffect=$af['nbaf'];
                    }
                    ?>
                    <div class="col mt-5">
                        <div class="card" style="border-left: solid whitesmoke 15px; height: 250px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10" >
                                        <p class="h4">My New TPM Assignments</p>
                                        <p class="h6 text-center">(Not performed yet) <?= $nbaffect ?></p> <hr>
                                        <table class="table table-bordered table-condensed table-responsive-sm">
                                            <tbody>
                                                <tr>
                                                    <td>Due assignments </td>
                                                    <td><span class="badge bg-warning"><?= $nbaffect ?></span></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                        
                                        <a class="btn btn-lg btn-outline-secondary" style="font-size: 16px;" title="View your new tasks assignments" href="home.php?render=<?= sha1("affectation") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-share-alt"></i> Get details</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-5">
                        <div class="card" style="border-left: solid teal 15px; height: 250px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p class="h4">My Submitted TPM reports</p> 
                                        <p class="h6 text-center">(To supervisor)</p>
                                            <hr>

                                        <table class="table table-bordered table-condensed table-responsive-sm">
                                            <tbody>
                                                <tr>
                                                    <td>Validated <span class="badge bg-success"><?= $nbval ?></span></td>
                                                    <td>Unvalidated<span class="badge bg-danger"><?= $nbunval ?></span></td>
                                                    <td>Not checked<span class="badge bg-warning"><?= $nbunchecked ?></span></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                        <a class="btn btn-lg btn-outline-success" title="View reports submitted to supervisor" style="font-size: 16px;"  href="home.php?render=<?= sha1("tpmreport") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-share-square"></i> Get details</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mt-5">
                        <div class="card" style="border-left: solid orange 15px; height: 250px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p class="h4">Feedbacks to my reports</p> 
                                        <p class="h6 text-center">(From supervisor)</p><hr>
                                        
                                        <a class="btn btn-lg btn-outline-warning" style="font-size: 16px;" title="View feedbacks from Supervisor" href="home.php?render=<?= sha1("listtpmfeedback") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-reply"></i> Get details</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }



                if ($_SESSION['typeCompte']== "TPM Supervisor") {
                    ?>
                    <div class="col mt-5">
                    <div class="card" style="border-left: solid whitesmoke 15px; height: 200px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10" >
                                    <p class="h2">My TPM Assignments</p> 
                                    <p class="h6 text-center">(From Coordinator)</p><hr>
                                    
                                    <a class="btn btn-lg btn-outline-secondary" href="home.php?render=<?= sha1("affectation") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-share-alt"></i> View assignments</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col mt-5">
                    <div class="card" style="border-left: solid green 15px; height: 200px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <p class="h2">Incoming TPM Reports</p>
                                    <p class="h6 text-center">(From Proxy Monitors)</p><hr>
                                    
                                    <a class="btn btn-lg btn-outline-success" href="home.php?render=<?= sha1("tpmreport") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-download"></i> View Reports</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-5">
                    <div class="card" style="border-left: solid red 15px; height: 200px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <p class="h2">Submitted TPM Reports</p>
                                    <p class="h6 text-center">(To Coordinator)</p><hr>
                                    
                                    <a class="btn btn-lg btn-outline-danger" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>"><i class="fa fa-upload"></i> View Reports</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }

                ?>
                

            </div>
</div>




