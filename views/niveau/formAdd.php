<div class="m-4 p-4 sectionPanel">
    <div>
        <i style="color: red;" class="fas fa-asterisk" aria-hidden="true"></i> Add
        <hr>
    </div>
    <div>
        <form action="../controllers/niveau/niveauController.php" method="POST">

            <div class="form-group">
                <label class="control-label" for="my-select">Level Id</label>
                <input class="form-control" type="text" name="tb_level">
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Name</label>
                <input class="form-control" type="text" name="tb_designation">
            </div>
            <hr>
            <div class="form-group">
                <label class="control-label" for="my-select">For validation</label>
                <input  type="radio" name="rb_forValidation" value="no" checked>No
                <input  type="radio" name="rb_forValidation" value="yes">Yes
                
            </div>
            
            <hr>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">Save</button>
            </div>
        </form>
    </div>


</div>