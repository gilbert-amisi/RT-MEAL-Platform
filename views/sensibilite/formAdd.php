<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i style="color: red;" class="fas fa-asterisk" aria-hidden="true"></i> Set report sensibility for project
        <hr>
    </div>
    <div>
        <form action="../controllers/sensibilite/sensibiliteController.php" method="POST">

            <div class="form-group">
                <label class="control-label" for="my-select">Sensibility level</label>
                <select class="form-control select2" name="tb_level">
                    <option value="none">Choose the level</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                    <option value="5">Level 5</option>
                    <option value="6">Level 6</option>
                </select>
                <!-- <input class="form-control" type="text" name="tb_level"> -->
            </div> <br>
            <div class="form-group">
                <label class="control-label" for="my-select">Level description</label>
                <!-- <input class="form-control" type="text" name="tb_designation"> -->
                <select class="form-control select2" name="tb_designation">
                    <option value="none">Choose the description</option>
                    <option value="Positive feedback, suggestions or inquiries">Positive feedback, suggestions or inquiries</option>
                    <option value="Request for assistance">Request for assistance</option>
                    <option value="Minor dissatisfaction with project activities">Minor dissatisfaction with project activities</option>
                    <option value="Major dissatisfaction with project activities">Major dissatisfaction with project activities</option>
                    <option value="Fraud or corruption of members or partners">Fraud or corruption of members or partners</option>
                    <option value="Sexual Exploitation and Abuse or Maltreatment of Children">Sexual Exploitation and Abuse or Maltreatment of Children</option>
                </select>
            </div> <br>
            <div class="form-group">
                <label class="control-label" for="my-select">Emergency ?</label>
                <select class="form-control select2" name="tb_emergency">
                    <option value="0">Choose</option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div> <br>
            <div class="form-group">
                <label class="control-label" for="my-select">Project / Organization</label>
                <select class="form-control select2" name="cb_project">
                    <option value="0">Choose</option>
                    <?php
                    $bdProject = new Project();
                    $projects = $bdProject->getProjectAllActive();
                    foreach ($projects as $project) {
                    ?>
                        <option value="<?= $project['prId'] ?>"><?= $project['prDesignation']." / Organization: ".$project['ogDesignation'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            
            <hr>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save sensibility
                </button>
            </div>
        </form>
    </div>


</div>