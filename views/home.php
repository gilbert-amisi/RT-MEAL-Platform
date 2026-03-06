<?php
session_start();

include '../models/dataBase/iespConnection.php';
include '../models/dataBase/DrcgeojsonConnection.php';

include '../models/compte/Compte.php';

//


//
//
//


include '../models/organization/Organization.php';
include '../models/project/Project.php';
include '../models/niveau/Niveau.php';
include '../models/keyinformant/Keyinformant.php';
include '../models/sensibilite/Sensibilite.php';
include '../models/pointfocal/Pointfocal.php';
include '../models/agent/Agent.php';
include '../models/rapportage/Rapportage.php';
include '../models/triangulation/Triangulation.php';
include '../models/remonte/Remonte.php';
include '../models/soumission/Soumission.php';
include '../models/feedback/Feedback.php';
include '../models/ajuste/Ajuste.php';
include '../models/traite/traite.php';
include '../models/geodata/Geodata.php';
include '../models/territoire/Territoire.php';
include '../models/information/Information.php';
include '../models/groupement/Groupement.php';
include '../models/supervisor/supervisor.php';
include '../models/proxyMonitor/proxyMonitor.php';
include '../models/axe/axe.php';
include '../models/result/result.php';
include '../models/affectation/affectation.php';
include '../models/tpmreport/tpmreport.php';
include '../models/verification/verification.php';
include '../models/tpmphase/tpmphase.php';
include '../models/ip/ip.php';


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include 'meta/metaTop.php';
    ?>
</head>

<body>

    <div class="container-fluid">
        <?php

        include '../routes/MainRoutes.php';
        include 'header/header.php';

        ?>

        <div class="row" style="height: 80vh; overflow: scroll;">
            <div class="col">
                <?php
                include 'alert/alert.php';
                ?>
                <div class="row">
                    <?php

                    if ((isset($_SESSION['identite']))) {
                        if ((isset($_GET['render']))) {
                            if ($_GET['render'] == sha1('accueil')) {
                                include 'accueil/accueilinfo.php';
                            } else if ($_GET['render'] == sha1('compte')) {
                                include 'compte/crud_compte.php';
                            } else if ($_GET['render'] == sha1('compagnie')) {
                                include 'compagnie/crud_compagnie.php';
                            } else if ($_GET['render'] == sha1('personne')) {
                                include 'personne/crud_personne.php';
                            } else if ($_GET['render'] == sha1('acquisition')) {
                                include 'acquisition/crud_acquisition.php';
                            } else if ($_GET['render'] == sha1('espace')) {
                                include 'espace/crud_espace.php';
                            } else if ($_GET['render'] == sha1('vol')) {
                                include 'vol/crud_vol.php';
                            } else if ($_GET['render'] == sha1('atterissage')) {
                                include 'atterissage/crud_atterissage.php';
                            } else if ($_GET['render'] == sha1('tarifZone')) {
                                include 'tarifZone/crud_tarifZone.php';
                            } else if ($_GET['render'] == sha1('tauxATT')) {
                                include 'tauxATT/crud_tauxATT.php';
                            } else if ($_GET['render'] == sha1('tauxChargement')) {
                                include 'tauxChargement/crud_tauxChargement.php';
                            } else if ($_GET['render'] == sha1('tauxDOM')) {
                                include 'tauxDOM/crud_tauxDOM.php';
                            } else if ($_GET['render'] == sha1('tauxRR')) {
                                include 'tauxRR/crud_tauxRR.php';
                            } else if ($_GET['render'] == sha1('accesVehicule')) {
                                include 'accesVehicule/crud_accesVehicule.php';
                            } else if ($_GET['render'] == sha1('att')) {
                                include 'att/crud_att.php';
                            } else if ($_GET['render'] == sha1('dom')) {
                                include 'dom/crud_dom.php';
                            } else if ($_GET['render'] == sha1('fret')) {
                                include 'fret/crud_fret.php';
                            } else if ($_GET['render'] == sha1('ft')) {
                                include 'ft/crud_ft.php';
                            } else if ($_GET['render'] == sha1('pax')) {
                                include 'pax/crud_pax.php';
                            } else if ($_GET['render'] == sha1('rr')) {
                                include 'rr/crud_rr.php';
                            } else if ($_GET['render'] == sha1('stat')) {
                                include 'stat/crud_stat.php';
                            } else if ($_GET['render'] == sha1('facturation')) {
                                include 'facturation/crud_facturation.php';
                            } else if ($_GET['render'] == sha1('payement')) {
                                include 'payement/crud_payement.php';
                            } else if ($_GET['render'] == sha1('utilisateur')) {
                                include 'compte/crud_compte.php';
                            } else if ($_GET['render'] == sha1('home')) {
                                include 'home/home.php';
                            } else if ($_GET['render'] == sha1('organization')) {
                                include 'organization/crud_organization.php';
                            } else if ($_GET['render'] == sha1('project')) {
                                include 'project/crud_project.php';
                            } else if ($_GET['render'] == sha1('rapportage')) {
                                include 'rapportage/crud_rapportage.php';
                            } else if ($_GET['render'] == sha1('niveau')) {
                                include 'niveau/crud_niveau.php';
                            } else if ($_GET['render'] == sha1('keyinformant')) {
                                include 'keyinformant/crud_keyinformant.php';
                            } else if ($_GET['render'] == sha1('sensibilite')) {
                                include 'sensibilite/crud_sensibilite.php';
                            } else if ($_GET['render'] == sha1('pointfocal')) {
                                include 'pointfocal/crud_pointfocal.php';
                            } else if ($_GET['render'] == sha1('agent')) {
                                include 'agent/crud_agent.php';
                            } else if ($_GET['render'] == sha1('triangulation')) {
                                include 'triangulation/crud_triangulation.php';
                            } else if ($_GET['render'] == sha1('information')) {
                                include 'information/crud_information.php';
                            } else if ($_GET['render'] == sha1('soumission')) {
                                include 'soumission/crud_soumission.php';
                            } else if ($_GET['render'] == sha1('feedback')) {
                                include 'feedback/crud_feedback.php';
                            } else if ($_GET['render'] == sha1('visualization')) {
                                include 'visualization/crud_visualization.php';
                            } else if ($_GET['render'] == sha1('supervisor')) {
                                include 'supervisor/supervisor.php';
                            } else if ($_GET['render'] == sha1('proxyMonitor')) {
                                include 'proxyMonitor/proxyMonitor.php';
                            } else if ($_GET['render'] == sha1('axe')) {
                                include 'axe/axe.php';
                            } else if ($_GET['render'] == sha1('result')) {
                                include 'result/result.php';
                            } else if ($_GET['render'] == sha1('product')) {
                                include 'result/product.php';
                            } else if ($_GET['render'] == sha1('activity')) {
                                include 'result/activity.php';
                            } else if ($_GET['render'] == sha1('affectation')) {
                                include 'affectation/affectation.php';
                            } else if ($_GET['render'] == sha1('affectationproxy')) {
                                include 'affectation/affectationproxy.php';
                            } else if ($_GET['render'] == sha1('tpmreport')) {
                                include 'tpmreport/tpmreport.php';
                            } else if ($_GET['render'] == sha1('addtpmreport')) {
                                include 'tpmreport/addtpmreport.php';
                            } else if ($_GET['render'] == sha1('edittpmreport')) {
                                include 'tpmreport/edittpmreport.php';
                            } else if ($_GET['render'] == sha1('listtpmfeedback')) {
                                include 'tpmreport/listtpmfeedback.php';
                            } else if ($_GET['render'] == sha1('verification')) {
                                include 'verification/verification.php';
                            } else if ($_GET['render'] == sha1('listverification')) {
                                include 'verification/listverification.php';
                            } else if ($_GET['render'] == sha1('tpmdashboard')) {
                                include 'verification/tpmdashboard.php';
                            } else if ($_GET['render'] == sha1('tpmphase')) {
                                include 'tpmphase/tpmphase.php';
                            } else if ($_GET['render'] == sha1('ip')) {
                                include 'ip/ip.php';
                            } else if ($_GET['render'] == sha1('tpmtable')) {
                                include 'verification/tpmtable.php';
                            } else if ($_GET['render'] == sha1('mappe')) {
                                include 'verification/mappe.php';
                            } else if ($_GET['render'] == sha1('tpmfeedback')) {
                                include 'verification/tpmfeedback.php';
                            } else if ($_GET['render'] == sha1('ratingterritory')) {
                                include 'verification/ratingterritory.php';
                            } else if ($_GET['render'] == sha1('ratingip')) {
                                include 'verification/ratingip.php';
                            } else if ($_GET['render'] == sha1('finalreport')) {
                                include 'verification/finalreport.php';
                            } else if ($_GET['render'] == sha1('editverification')) {
                                include 'verification/editverification.php';
                            } else {
   
                                include 'home/home.php';
                            }
                        } else {
                            include 'home/home.php';
                        }
                    } else {
                        include 'compte/formLogin.php';
                    }

                    ?>
                </div>
            </div>

        </div>

        <?php

        include 'footer/footer.php';
        ?>

    </div>

</body>

<?php
include 'meta/metaBottom.php';
?>

</html>