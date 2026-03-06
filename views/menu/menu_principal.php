<div class="col-lg-12" style="padding: auto; background-color: #106d0e;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 8px; border-radius: 1px; background-color: #FFE7BF; font-family: Arial, Helvetica, sans-serif;" >
        <div class="container-fluid">
            <a class="navbar-brand" href="./home.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse row m-1 p-1" id="navbarNavDropdown">
                <ul class="navbar-nav col-10">

                <!-- Menu for Admin -->

                    <?php
                    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Projects Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("organization") ?>&sub=<?= sha1("start") ?>">Organizations Settings</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("project") ?>&sub=<?= sha1("start") ?>">Projects Settings</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("ip") ?>&sub=<?= sha1("start") ?>">Implementation Partners</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("axe") ?>&sub=<?= sha1("start") ?>">Territories of DRC</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                TPM Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmphase") ?>&sub=<?= sha1("start") ?>">Phases of Reporting</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("affectation") ?>&sub=<?= sha1("start") ?>">Collector's Assignments</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmreport") ?>&sub=<?= sha1("start") ?>">Incoming Reports</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>">Submitted Reports</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmdashboard") ?>&sub=<?= sha1("start") ?>">Reporting Dashboard</a></li>
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Accountability Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="home.php?render=<?= sha1("sensibilite") ?>&sub=<?= sha1("start") ?>">Sensitivity of Complaints</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("niveau") ?>&sub=<?= sha1("start") ?>">Complaint Reporter Levels</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("visualization") ?>&sub=<?= sha1("start") ?>">Complaint Reporting Map</a></li>
                            </ul>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actors Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("compte") ?>&sub=<?= sha1("register") ?>">Users Accounts</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("keyinformant") ?>&sub=<?= sha1("start") ?>">Key Informants</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("proxyMonitor") ?>&sub=<?= sha1("start") ?>">TPM Proxy Monitors</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("supervisor") ?>&sub=<?= sha1("start") ?>">TPM Supervisors</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("pointfocal") ?>&sub=<?= sha1("start") ?>">Partner Focal Points</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("agent") ?>&sub=<?= sha1("start") ?>">Call-Center Agents</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>

                    <!-- Menu for Call Center Operators -->

                    <?php
                    if ((isset($_SESSION['identite'])) && $_SESSION['typeCompte'] == "Call-Center Agent") {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Reports from Community
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("") ?>&sub=<?= sha1("start") ?>">Reporting</a></li>

                            </ul>
                        </li>
                    <?php
                        $agentId = 0;
                        $niveauId = 0;
                        $levelNiveauAgent = 0;
                        $bdAgent = new Agent();
                        $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                        foreach ($agents as $agent) {
                            $agentId = $agent['agId'];
                            $niveauId = $agent['nvId'];
                            $levelNiveauAgent = $agent['levelNiveau'];
                            $forValidationAgent = $agent['forValidation'];
                        }

                        if ($levelNiveauAgent != 1) {
                    ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Cross-checking
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("soumission") ?>&sub=<?= sha1("start") ?>">Reporting</a></li>

                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Feedbacks From High Levels
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">


                                <?php


                                    if ($forValidationAgent == "yes") {
                                    ?>
                                        <li><a class="dropdown-item" href="home.php?render=<?= sha1("feedback") ?>&sub=<?= sha1("list") ?>">List</a></li>
                                    <?php
                                    }

                                    ?>

                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("feedback") ?>&sub=<?= sha1("validation") ?>">Validation</a></li>
                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("feedback") ?>&sub=<?= sha1("viewPost") ?>">Feedback posted</a></li>
                                <?php
                               
                                ?>


                            </ul>
                        </li>

                    <?php
                    }
                    ?>

                    <?php
                    if (0) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Validation
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("") ?>&sub=<?= sha1("start") ?>">Triangulation</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("") ?>&sub=<?= sha1("start") ?>">Submission</a></li>

                            </ul>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if ((isset($_SESSION['identite'])) && $_SESSION['typeCompte'] == "Partner") {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                IES TPM Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>">TPM Incoming Reports</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmdashboard") ?>&sub=<?= sha1("start") ?>">TPM Reporting Dashboard</a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                IES Accountability Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("feedback") ?>&sub=<?= sha1("start") ?>">Complaints Reporting List</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("visualization") ?>&sub=<?= sha1("start") ?>">Cartography of Complaints</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>

                    <!-- Menu for TPM Supervisor and Proxy Monitor-->
                    <?php
                    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                TPM Assignments
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("affectation") ?>&sub=<?= sha1("start") ?>">My Assignments</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a style="padding: 8px; border-radius: 1px;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                TPM Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmreport") ?>&sub=<?= sha1("start") ?>">From Proxy Monitors</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>">Submitted to Coordinator</a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("listtpmfeedback") ?>&sub=<?= sha1("start") ?>">Sumbitted Feedbacks</a></li>
                            </ul>
                        </li>
                    <?php
                    }

                    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Proxy Monitor")) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    TPM Assignments
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("affectation") ?>&sub=<?= sha1("start") ?>">My Assignments</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a style="padding: 8px; border-radius: 1px;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    TPM Reports
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("tpmreport") ?>&sub=<?= sha1("start") ?>">Submitted Reports</a></li>
                                    <li><a class="dropdown-item" href="home.php?render=<?= sha1("listtpmfeedback") ?>&sub=<?= sha1("start") ?>">Incoming Feedbacks</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                    ?>

                </ul>
                <ul class="navbar-nav col-2">

                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['identite'])) {
                        ?>
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-outline-success btn-sm" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> <?= $_SESSION['identite'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">
                                <i class="fa fa-id-card" aria-hidden="true"></i> <?=$_SESSION['typeCompte'] ?></a></li>
                                <li><a class="dropdown-item" href="home.php?render=<?= sha1("compte") ?>&sub=<?= sha1("updateSelf") ?>">
                                <i class="fa fa-cog" aria-hidden="true"></i> Account settings</a></li>
                                <li><a class="dropdown-item" href="../controllers/logout/logoutController.php?req=<?= sha1('logout') ?>">
                                    <i class="fa fa-window-close" aria-hidden="true"></i> Logout</a></li>
                            </ul>
                        </li>
                        <?php
                        } else {
                        ?>

                        <?php
                        }
                        ?>


                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</div>