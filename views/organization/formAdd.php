<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i style="color: red;" class="fas fa-plus" aria-hidden="true"></i> Add new organization or partner
        <hr>
    </div>
    <div>
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
                <button class="btn btn-success form-control" name="bt_add" type="submit">
                <i class="fas fa-save" aria-hidden="true"></i> Save organization
                </button>
            </div>
        </form>
    </div>


</div>