<?php
if (isset($_SESSION['identite']) && $_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator") {
    if (isset($_GET['projectId']) && isset($_GET['projectName']) && isset($_GET['org']) && isset($_GET['resultId']) && isset($_GET['resultName']) && isset($_GET['productId']) && isset($_GET['productName'])) {
        $projectId=$_GET['projectId'];
        $projectName=$_GET['projectName'];
        $org=$_GET['org'];
        $resultId=$_GET['resultId'];
        $resultName=$_GET['resultName'];
        $productId=$_GET['productId'];
        $productName=$_GET['productName'];

        ?>
        <div class="card m-2 p-2">
            <div class="card-header h5 text-succes">Setting Activities for Product</div>
            <div class="card-body">
                <table class="table table-bordered table-condensed table-responsive-sm">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Organisation</td>
                            <td style="width: 80%;"><h6><?= $org ?></h6></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Project</td>
                            <td style="width: 80%;"><h6><?= $projectName ?></h6></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Result</td>
                            <td style="width: 80%;"><h6><?= $resultName ?></h6></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Product</td>
                            <td style="width: 80%;"><h6><?= $productName ?></h6></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">Add new activity</div>
                        <div class="card-body">
                            <form action="../controllers/result/resultController.php" method="POST">
                                <input hidden class="form-control" type="text" value="<?= $productId ?>" name="productId" required>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="act_title">Activity's name</label>
                                    <input class="form-control" type="text" name="act_title" required>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="act_comment">Description (Optional)</label>
                                    <textarea class="form-control" name="act_comment" rows="4" placeholder="Describe the activity here..."></textarea>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <button class="btn btn-success" name="add_activity" type="submit">
                                    <i class="fas fa-save" aria-hidden="true"></i> Save the result
                                    </button>
                                </div>   
                            </form>
                        </div>

                    </div>

                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">List of activities saved</div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-condensed table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $bdActivity = new Result();
                                    $activities = $bdActivity->getActivityAll($productId);
                                    foreach ($activities as $activity) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $activity['name'] ?></td>
                                            <td><?= $activity['comment'] ?></td>
                                            
                                            <td>
                                                <a class="btn btn-outline-danger btn-sm" title="Delete the activity">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                    </tr>
                                </tfoot>
                            </table> 
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <?php
    }
}
?>
