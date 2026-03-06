<div class="m-4 p-4 sectionPanel card">
    <div class="card-header h5">
        <i class="fa fa-align-left" aria-hidden="true" style="color: #b1b1b1;"></i> Agents list
        <hr>
    </div>
    <div>
        <table class="table table-bordered table-condensed table-striped">
            <thead class="thead">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Account</th>
                    
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdAgent = new Agent();
                $agents = $bdAgent->getAgentActiveAll();
                foreach ($agents as $agent) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $agent['agIdentite'] ?></td>
                        <td><?= "Level: ".$agent['levelNiveau']." / ".$agent['nvDesignation'] ?></td>
                        <td><?= $agent['coIdentite'] ?></td>
                        
                        <td>
                            <form action="../controllers/agent/agentController.php" method="POST">

                                <input type="hidden" name="tb_agentId" value="<?= $agent['agId'] ?>">
                                <button class="btn btn-primary btn-sm" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                            </form>
                        </td>
                        <td>
                            <form action="../controllers/agent/agentController.php" method="POST">

                                <input type="hidden" name="tb_agentId" value="<?= $agent['agId'] ?>">       
                                <button class="btn btn-danger btn-sm" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                            </form>
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