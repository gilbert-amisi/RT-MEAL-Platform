<div">
    <form action="../controllers/feedback/feedbackController.php" method="POST">
        <div class="form-group">    
            <textarea class="form-control" rows="6" name="tb_donnee" placeholder="Write your feed back here"></textarea>
        </div>
        <hr>

        <div class="form-group">
            <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
            <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageSelected) ?>">
            <input type="hidden" name="tb_remonteId" value="<?= ($_GET['use_remonte']) ?>">
            <input type="hidden" name="tb_soumissionId" value="<?= ($soumissionSelected) ?>">
            <input type="hidden" name="tb_pointfocalId" value="<?= ($pointfocalId) ?>">
            <button class="btn btn-warning" name="bt_add" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Save and Submit to IES Call-center</button>
        </div>
    </form>          
                                                
</div>