<div class="col-lg-6">

    <?php
        $bdAjuste=new Ajuste();
        $ajusteId=0;
        $dateHeureAjuste="";
        $contactAjuste="";
        $donneeAjuste="";
        $ajustes=$bdAjuste->getAjusteByFeedbackId($_GET['use_feedback']);
        foreach ($ajustes as $ajuste) {
            $ajusteId=$ajuste['afId'];
            $dateHeureAjuste=$ajuste['afDateHeure'];
            $donneeAjuste=$ajuste['doafValeur'];
            $contactAjuste=$ajuste['scContact'];
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
            <hr>

            <div class="row">
                <div class="col">
                    <p class="h6"><strong>Validated</strong></p>
                    <p class="h6"><strong>Date Time: <?= $dateHeureAjuste ?></strong></p>
                    <hr>

                    <p class="h6"><strong style="color:red;">Source contact: <?= $contactAjuste ?></strong></p>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <p><strong>Data: </strong></p>
                                <p><?= $donneeAjuste ?></p>
                            </td>

                        </tr>
                    </table>
                </div>

                <?php
                    $traiteId=0;
                    $traiteDateHeure="";
                    $traiteCommentaire="";
                    $traiteEtat="";
                    $bdTraite=new Traite();
                    $traites=$bdTraite->getTraiteByAjusteId($_GET['use_ajuste']);
                    foreach($traites as $traite) {
                        $traiteId=$traite['tfId'];
                        $traiteDateHeure=$traite['tfDateHeure'];
                        $traiteCommentaire=$traite['tfCommentaire'];
                        $traiteEtat=$traite['tfEtat'];
                    }

                    if ($traiteId==0) {
                        ?>
                            <div class="col">
                                <form action="../controllers/feedback/feedbackController.php" method="POST">
                                    <p class="h4">Comment</p>
                                    <div class="form-group">
                                        
                                        <textarea class="form-control" name="tb_commentaire"></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select">Situation</label>
                                        <select class="form-control select2" name="cb_etat">
                                            <option value="none">Choose</option>
                                            <option value="Close">Close</option>
                                            <option value="Keep-Open">Keep Open</option>

                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">

                                        <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                                        <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageSelected) ?>">
                                        <input type="hidden" name="tb_remonteId" value="<?= ($_GET['use_remonte']) ?>">
                                        <input type="hidden" name="tb_soumissionId" value="<?= ($soumissionSelected) ?>">
                                        <input type="hidden" name="tb_feedbackId" value="<?= ($_GET['use_feedback']) ?>">
                                        <input type="hidden" name="tb_ajusteId" value="<?= ($_GET['use_ajuste']) ?>">
                                        <button class="btn btn-warning" name="bt_traite" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Save and Post</button>
                                    </div>
                                </form>
                            </div>
                        <?php
                    } else {
                        ?>
                            <p class="h5"><strong style="color:forestgreen;">Post Details</strong></p>
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <p><strong>Date Time: </strong><?= $traiteDateHeure ?></p>
                                    </td>
                                    <td>
                                        <p><strong>Comment: </strong><?= $traiteCommentaire ?></p>
                                    </td>
                                    <td>
                                        <p><strong>Situation: </strong><?= $traiteEtat ?></p>
                                    </td>
                                </tr>
                            </table>
                            
                            
                        <?php
                    }
                ?>

                
            </div>

            <?php
        }
    ?>         
                                                
</div>