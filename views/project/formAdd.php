<div class="m-4 p-4 sectionPanel">
    <h5 style="color: cadetblue;"><i class="fa fa-share-alt" style="color: cadetblue;"></i> Adding new project</h5>
    <hr>
    <div>
        <form action="../controllers/project/projectController.php" method="POST" class="row">

            <div class="col card" style="height: 50vh;overflow:scroll;">
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="my-select">Organization owner</label>
                    <select class="form-control select2" name="cb_organization" require style="width: 100%;">
                        <option value="0">Choose</option>
                        <?php
                        $bdOrganization = new Organization();
                        $organizations = $bdOrganization->getOrganizationAllActive();
                        foreach ($organizations as $organization) {
                        ?>
                            <option value="<?= $organization['id'] ?>"><?= $organization['designation'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="my-select">Project name</label>
                    <input class="form-control" type="text" name="tb_designation" require>
                </div>
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="cb_focalpoint">TPM Focal Point of partner</label>
                    <select class="form-control select2" name="cb_focalpoint" require style="width: 100%;">
                        <option value="0">Choose</option>
                        <?php
                        $bdPointfocal = new Pointfocal();
                        $pointfocals = $bdPointfocal->getPointFocalbyOrg();
                        foreach ($pointfocals as $pointfocal) {
                        ?>
                            <option value="<?= $pointfocal['id'] ?>"><?= $pointfocal['identite'] ?> / <?= $pointfocal['designation'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="my-select">Project description</label>
                    <textarea class="form-control" name="tb_comment" rows="5">
                    </textarea>
                </div>
            </div>
            <div class="col card" style="height: 50vh;overflow:scroll;">
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="tb_projectDuration">Project duration in months</label>
                    <input class="form-control" type="number" placeholder="e.g. 12" name="tb_projectDuration">
                </div> 
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="tb_yearDebut">Starting year</label>
                    <input class="form-control" placeholder="e.g. 2022" type="number" name="tb_yearDebut">
                </div> 
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="tb_monthDebut">Starting month</label>
                    <!-- <input class="form-control" type="number" name="tb_monthDebut"> -->
                    <select class="form-control select2" name="tb_monthDebut">
                        <option value="none">Choose</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="form-group m-1 p-1"">
                    <label class="control-label" for="my-select">Reporting frequency</label>
                    <select class="form-control select2" name="cb_frequency">
                        <option value="none">Choose</option>
                        <option value="Annually">Annually</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Half-yearly">Half-yearly</option>
                    </select>
                </div>
                <div class="form-group m-1 p-1"">
                <button class="btn btn-success" name="bt_add" type="submit">
                <i class="fas fa-save" aria-hidden="true"></i> Save the project
                </button>
            </div>
            </div>    
        </form>
    </div>


</div>