<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
?>
<div class="card m-2 p-2">
    <div class="card-header h5" style="color: #5B8C9E;">
        <i class="fa fa-clock" style="color: red; font-family: Arial, Helvetica, sans-serif;"></i> TPM REPORTING PHASES
    </div>
    <div class="card-body row">
        <div class="card col-6" style="height: 70vh; overflow: scroll;">
            <div class="card-header h5" style="color: #5B8C9E;">SETTING NEW TPM REPORTING PHASE</div>
            <div class="card-body">
                <form action="../controllers/tpmphase/tpmphaseController.php" method="POST">
                    <div class="form-group m-1 p-2">
                        <label class="control-label" for="my-select">Project to monitore</label>
                        <select class="form-control select2" name="projectId" required>
                            <option value="0">Choose the project</option>
                            <?php
                            $bdProject = new Project();
                            $projects = $bdProject->getProjectAll();
                            foreach ($projects as $project) {
                            ?>
                                <option value="<?= $project['prId'] ?>"><?= $project['ogDesignation'] ?> / <?= $project['prDesignation'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group m-1 p-2">
                        <label class="control-label" for="name">Phase name</label>
                        <select class="form-control" name="name" id="name" required>
                            <option value="0">Select the name of phase</option>
                            <option value="Phase 1">Phase 1</option>
                            <option value="Phase 2">Phase 2</option>
                            <option value="Phase 3">Phase 3</option>
                            <option value="Phase 4">Phase 4</option>
                            <option value="Phase 5">Phase 5</option>
                            <option value="Phase 6">Phase 6</option>
                            <option value="Phase 7">Phase 7</option>
                            <option value="Phase 8">Phase 8</option>
                            <option value="Phase 9">Phase 9</option>
                            <option value="Phase 10">Phase 10</option>
                            <option value="Phase 11">Phase 11</option>
                            <option value="Phase 12">Phase 12</option>
                        </select>
                        
                    </div>

                    <div class="form-group m-1 p-2">
                        <label class="control-label" for="type">Phase level</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="0">Select level of phase</option>
                            <option value="Initial">Initial</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Final">Final</option>
                        </select>
                        
                    </div>
                    <div class="form-group m-1 p-2">
                        <label class="control-label" for="start">Start date</label>
                        <input type="date" class="form-control" name="start" required>
                    </div>
                    <div class="form-group m-1 p-2">
                        <label class="control-label" for="end">End date</label>
                        <input type="date" class="form-control" name="end" required>
                    </div>
                    <div class="form-group m-1 p-2">
                        <button class="btn btn-success" name="add_phase" type="submit">
                        <i class="fas fa-save" aria-hidden="true"></i> Save the phase
                        </button>
                    </div>   
                </form>
                
            </div>
        </div>

        <div class="card col-6" style="height: 70vh; overflow: scroll;">
            <div class="card-header h5" style="color: #5B8C9E;">LIST OF TPM REPORTING PHASES</div>
            <div class="card-body">
                <table class="table table-bordered table-condensed table-responsive">
                    <thead>
                        <th>N°</th>
                        <th>Project</th>
                        <th>Phase name</th>
                        <th>Level</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                    $n = 0;
                    $bdPhase = new Phase();
                    $phases = $bdPhase->getPhaseAll();
                    foreach ($phases as $phase) {
                        $n++;
                    ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $phase['proj'] ?> of <?= $phase['org'] ?></td>
                            <td><?= $phase['name'] ?></td>
                            <td><?= $phase['type'] ?></td>
                            <td><?= $phase['start'] ?></td>
                            <td><?= $phase['end'] ?></td>
                            <td><?= $phase['status'] ?></td>
                            
                            <td>
                                <?php
                                if ($phase['status'] == "Disabled") {
                                    ?>
                                        <form action="../controllers/tpmphase/tpmphaseController.php" method="POST">
                                            <input type="hidden" name="phaseId" value="<?= $phase['id'] ?>">
                                            <button class="btn btn-success btn-sm" name="bt_activate" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Activate ?</button>
                                        </form>
                                
                                <?php 
                                }
                                if ($phase['status'] == "Active") {
                                    ?>
                                        <form action="../controllers/tpmphase/tpmphaseController.php" method="POST">
                                            <input type="hidden" name="phaseId" value="<?= $phase['id'] ?>">
                                            <button class="btn btn-danger btn-sm" name="bt_disable" type="submit"><i class="fa fa-window-close" aria-hidden="true"></i> Disable ?</button>
                                        </form>
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
        </div>
    </div>
    
</div>
<?php
}
