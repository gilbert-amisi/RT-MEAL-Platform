<?php
if (isset($_SESSION['identite']) && $_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator") {
    if (isset($_GET['projectId']) && isset($_GET['projectName']) && isset($_GET['org'])) {
        $projectId=$_GET['projectId'];
        $projectName=$_GET['projectName'];
        $org=$_GET['org'];

        ?>
        <div class="card m-2 p-2">
            <div class="card-header h5 text-succes">Setting Results for project</div>
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
                    </tbody>
                </table>
                <div class="row">
                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">Add new result</div>
                        <div class="card-body">
                            <form action="../controllers/result/resultController.php" method="POST">
                                <input hidden class="form-control" type="text" value="<?= $projectId ?>" name="projectId" required>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="res_title">Result title</label>
                                    <input class="form-control" type="text" name="res_title" required>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="my-select">Description</label>
                                    <textarea class="form-control" name="res_comment" rows="4" placeholder="Describe the result here..."></textarea>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <button class="btn btn-success" name="add_result" type="submit">
                                    <i class="fas fa-save" aria-hidden="true"></i> Save the result
                                    </button>
                                </div>   
                            </form>
                        </div>

                    </div>

                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">List of results saved</div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $bdResult = new Result();
                                    $results = $bdResult->getResultAll($projectId);
                                    foreach ($results as $result) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $result['name'] ?></td>
                                            <td><?= $result['comment'] ?></td>
                                            
                                            <td>
                                                <a class="btn btn-outline-primary btn-sm" href="home.php?render=<?= sha1("product") ?>&sub=<?= sha1("start") ?>&projectId=<?= $projectId ?>&projectName=<?= $projectName ?>&org=<?= $org ?>&resultId=<?= $result['id'] ?>&resultName=<?= $result['name'] ?>" title="Set products for this result">
                                                    <i class="fa fa-tasks" aria-hidden="true"></i> Set Products
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
