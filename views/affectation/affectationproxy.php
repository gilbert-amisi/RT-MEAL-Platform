<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
        if (isset($_GET['affectationId']) && isset($_GET['instruction']) && isset($_GET['start'])  && isset($_GET['end'])) {
            $instruction = $_GET['instruction'];
            $affectationId = $_GET['affectationId'];
            $start = $_GET['start'];
            $end = $_GET['end'];
            $village = $_GET['village'];
        }
    ?>
    <div class="card m-4 p-4">
        <div class="alert alert-primary" role="alert">
            <h5 class="alert-heading">Assigning TPM Proxy Monitor</h5><hr>
            <form action="../controllers/affectation/affectationController.php" method="POST" enctype="multipart/form-data">
                <input hidden type="text" class="form-control" value="<?= $affectationId ?>" name="affectationId" id="affectationId" required>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="proxyId">TPM Proxy Monitor</label>
                    <select class="form-control select2" name="proxyId" style="width: 100%;">
                        <option value="0">Choose</option>
                        <?php
                        $bdProxyMonitor = new ProxyMonitor();
                        $proxymonitors = $bdProxyMonitor->getProxyMonitorAll();
                        foreach ($proxymonitors as $proxymonitor) {
                        ?>
                            <option value="<?= $proxymonitor['id'] ?>"><?= $proxymonitor['name'] ?> / <?= $proxymonitor['location'] ?> / <?= $proxymonitor['phone'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>  
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="start">Village</label>
                    <input type="text" class="form-control" value="<?= $village ?>" name="village" id="affectationId" required>
                </div>
                    
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="start">Instructions</label>
                    <textarea class="form-control" id="instruction" name="instruction" rows="7" placeholder="Improve instructions here..." required><?= $instruction ?></textarea>
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="start">Start date</label>
                    <input class="form-control" type="date" value="<?= $start ?>" name="start" required>
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="end">End date</label>
                    <input class="form-control" type="date" value="<?= $end ?>" name="end" required>
                </div>
                <div class="form-group m-1 p-1">
                    <button class="btn btn-success btn-md" name="assign_proxy" type="submit">
                    <i class="fa fa-save" aria-hidden="true"></i> Save assignment
                </button>
                </div>
            </form>
        </div>
    </div> <hr>
    <?php
        }
    ?>
