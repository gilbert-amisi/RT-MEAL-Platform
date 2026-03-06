<div class="m-4 p-4 sectionPanel">
    <div class="h4">
        <i class="fa fa-align-justify" aria-hidden="true" style="color: #b1b1b1;"></i> LIST OF PROJECTS
        <hr>
    </div>
    <div>
        <table class="table table-bordered table-striped table-condensed table-sm table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Organization</th>
                    <th>Focal Point</th>
                    <th>Duration</th>
                    <th>Start Month</th>
                    <th>Reporting</th>
                    <th>Description</th>
                    <th>Results</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdProject = new Project();
                $projects = $bdProject->getProjectAll();
                foreach ($projects as $project) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $project['prDesignation'] ?></td>
                        <td><?= $project['ogDesignation'] ?></td>
                        <td><?= $project['ptfoc'] ?></td>
                        <td><?= $project['dureeMonth'] ?> months</td>
                        <td><?= $project['monthDebut'] ?>/<?= $project['yearDebut'] ?></td>
                        <td><?= $project['frequenceEvaluation'] ?></td>
                        <td><?= $project['prComment'] ?></td>
                        
                        <td>
                            <a class="btn btn-outline-primary btn-sm" href="home.php?render=<?= sha1("result") ?>&sub=<?= sha1("start") ?>&projectId=<?= $project['prId'] ?>&projectName=<?= $project['prDesignation'] ?>&org=<?= $project['ogDesignation'] ?>" title="Set results for this project">
                                <i class="fa fa-cog" aria-hidden="true"></i> Set results
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