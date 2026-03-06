<div class="col-lg-6">

    <?php
        $bdAjuste=new Ajuste();
        $ajusteId=0;
        $dateHeureAjuste="";
        $ajustes=$bdAjuste->getAjusteByFeedbackId($_GET['use_feedback']);
        foreach ($ajustes as $ajuste) {
            $ajusteId=$ajuste['afId'];
            $dateHeureAjuste=$ajuste['afDateHeure'];
            $donneeAjuste=$ajuste['doafValeur'];
        }

        if ($ajusteId==0) {
            ?>
                <form action="../controllers/feedback/feedbackController.php" method="POST">
                    <p class="h4">Feedback data</p>
                    <div class="form-group">
                        
                        <textarea class="form-control" name="tb_donnee"><?= $donneeFeedback ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label" for="my-select">Level</label>
                        <select class="form-control select2" name="cb_niveau">
                            <option value="0">Choose</option>
                            <?php
                            $bdNiveau = new Niveau();
                            $niveaus = $bdNiveau->getNiveauActiveAll();
                            foreach ($niveaus as $niveau) {
                            ?>
                                <option value="<?= $niveau['id'] ?>"><?= "Level Id: ".$niveau['levelNiveau']." / ".$niveau['designation'] ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <hr>
                    <div class="form-group">

                        <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                        <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageSelected) ?>">
                        <input type="hidden" name="tb_remonteId" value="<?= ($_GET['use_remonte']) ?>">
                        <input type="hidden" name="tb_soumissionId" value="<?= ($soumissionSelected) ?>">
                        <input type="hidden" name="tb_feedbackId" value="<?= ($_GET['use_feedback']) ?>">
                        <button class="btn btn-warning" name="bt_validate" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Save and Validate</button>
                    </div>
                </form> 
            <?php
        } else {
            ?>
                <p class="h5"><strong style="color:orange;">Already validate</strong></p>
                <p class="h5"><strong style="color:orange;">Date Time: <?= $dateHeureAjuste ?></strong></p>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <p><strong>Data: </strong></p>
                            <p><?= $donneeAjuste ?></p>
                        </td>

                    </tr>
                </table>
            <?php
        }
    ?>         
                                                
</div>