<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: red;" class="fas fa-user" aria-hidden="true"></i> Source
                <hr>
            </div>
            <div>

                    <form action="../controllers/rapportage/rapportageController.php" method="POST">
                        <div class="row">
                            <div class="col">
                            
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Contact</label>
                                    <input class="form-control" type="text" name="tb_contact">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Location</label>
                                    <input class="form-control" type="text" name="tb_adresse" value="City, Village, District">
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
                                    <label class="control-label" for="my-select">Civil Statut</label>
                                    <input class="form-control" type="text" name="tb_etatcivil">
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="h4">Event details</p>
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Date</label>
                                    <input class="form-control" type="date" name="tb_date">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Time</label>
                                    <input class="form-control" type="time" name="tb_heure">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Location</label>
                                    <input class="form-control" type="text" name="tb_lieu">
                                </div>
                                
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Data</label>
                                    <textarea class="form-control" name="tb_donnee">
                                    </textarea>
                                </div>
                                <hr>
                            
                                <div class="form-group">
                                    <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                                    <button class="btn btn-success" name="bt_add" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                
            </div>
            
        </div>
        
    </div>