<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: red;" class="fas fa-asterisk" aria-hidden="true"></i> Add
                <hr>
            </div>
            <div>
                <div class="row">
                    
                    <div class="col-lg-12">
                        <form action="../controllers/organization/organizationController.php" method="POST">

                            <div class="form-group">
                                <label class="control-label" for="my-select">Name</label>
                                <input class="form-control" type="text" name="tb_designation">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="my-select">Color</label>
                                <input class="form-control" type="text" name="tb_color" value="whitesmoke">
                            </div>

                            <hr>
                            <div class="form-group">
                                <button class="btn btn-success" name="bt_add" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>