<div>
    <div>
        <div class="h5">
            <span><i style="color: red;" class="fas fa-plus" aria-hidden="true"></i> New report </span>
            <hr>
        </div>
        <div class="card m-2 p-2">
            <form action="../controllers/rapportage/rapportageController.php" method="POST">
                <div class="row">
                    <div class="h6">
                        <span><i style="color: red;" class="fas fa-user" aria-hidden="true"></i> Source's information </span>
                        <hr>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="control-label" for="my-select">Contact</label>
                            <input class="form-control" type="tel" name="tb_contact">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Location</label>
                            <input class="form-control" type="text" name="tb_adresse" placeholder="City, Village, District">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="control-label" for="my-select">Name</label>
                            <input class="form-control" type="text" name="tb_identite">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Gender</label>
                            <select class="form-control" name="cb_genre">
                                <option value="none">Choose</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>

                    </div>
                    <div class="col">

                        <div class="form-group">
                            <label class="control-label" for="my-select">Occupation</label>
                            <input class="form-control" type="text" name="tb_profession">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Civil Status</label>
                            <select class="form-control" name="tb_etatcivil">
                                <option value="none">Choose</option>
                                <option value="Single">Single</option>
                                <option value="Maried">Maried</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>

                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="h6">
                        <span><i style="color: teal;" class="fas fa-calendar" aria-hidden="true"></i> Event's details </span>
                        <hr>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="control-label" for="my-select">Subject</label>
                            <input class="form-control" type="text" name="tb_subject">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tb_donnee">Content</label>
                            <textarea class="form-control" name="tb_donnee" placeholder="Write report content here">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Event's place (Groupement or district)</label>
                            <select class="form-control select2" name="cb_groupement">
                                <option value="none">Choose</option>
                                <?php
                                $bdGroupement = new Groupement();
                                $bdTerritoire = new Territoire();

                                $groupements = $bdGroupement->getGroupementAll();
                                foreach ($groupements as $groupement) {
                                    $territoires = $bdTerritoire->getTerritoireByName($groupement['territoire']);
                                    foreach ($territoires as $territoire) {
                                ?>
                                        <option value="<?= $groupement['groupm'] ?>"><?= $groupement['groupm'] . " / " . $groupement['chefferie'] . " / " . $territoire['terr'] . " / " . $territoire['province'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label class="control-label" for="my-select">Event's Date</label>
                                <input class="form-control" type="date" name="tb_date">
                            </div>
                            <div class="form-group col">
                                <label class="control-label" for="my-select">Event's Time</label>
                                <input class="form-control" type="time" name="tb_heure">
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                            <button class="btn btn-success" name="bt_add" type="submit">
                                <i class="fa fa-save" aria-hidden="true"></i> Save the report
                        </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>