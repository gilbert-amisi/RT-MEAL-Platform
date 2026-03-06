<?php
if (isset($_SESSION['identite']) && $_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator") {
    if (isset($_GET['projectId']) && isset($_GET['projectName']) && isset($_GET['org']) && isset($_GET['resultId']) && isset($_GET['resultName'])) {
        $projectId=$_GET['projectId'];
        $projectName=$_GET['projectName'];
        $org=$_GET['org'];
        $resultId=$_GET['resultId'];
        $resultName=$_GET['resultName'];

        ?>
        <div class="card m-2 p-2">
            <div class="card-header h5 text-succes">Setting Products for Result</div>
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
                    </tbody>
                </table>
                <div class="row">
                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">Add new product</div>
                        <div class="card-body">
                            <form action="../controllers/result/resultController.php" method="POST">
                                <input hidden class="form-control" type="text" value="<?= $resultId ?>" name="resultId" required>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="prod_title">Product name</label>
                                    <input class="form-control" type="text" name="prod_title" required>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="prod_comment">Description (optional)</label>
                                    <textarea class="form-control" name="prod_comment" rows="4" placeholder="Describe the product here..."></textarea>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <button class="btn btn-success" name="add_product" type="submit">
                                    <i class="fas fa-save" aria-hidden="true"></i> Save the result
                                    </button>
                                </div>   
                            </form>
                        </div>

                    </div>

                    <div class="card col-6" style="overflow:scroll;">
                        <div class="card-header h5">List of products saved</div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Activities</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $bdProduct = new Result();
                                    $products = $bdProduct->getProductAll($resultId);
                                    foreach ($products as $product) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n ?></td>
                                            <td><?= $product['name'] ?></td>
                                            <td><?= $product['comment'] ?></td>
                                            
                                            <td>
                                                <a class="btn btn-outline-primary btn-sm" href="home.php?render=<?= sha1("activity") ?>&sub=<?= sha1("start") ?>&projectId=<?= $projectId ?>&projectName=<?= $projectName ?>&org=<?= $org ?>&resultId=<?= $resultId ?>&resultName=<?= $resultName ?>&productId=<?= $product['id'] ?>&productName=<?= $product['name'] ?>" title="Set Activites for this product">
                                                    <i class="fa fa-share-o" aria-hidden="true"></i> Set Activities
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
