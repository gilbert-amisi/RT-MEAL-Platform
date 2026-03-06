<div class="row">
    <div class="col">
        <p class="myCenter titre1"> En chiffres</p>
    </div>
</div>
<div class="row" style="margin: 20px;">

    <?php
    $bdDossier = new Dossier();
    $n_dossier = 0;
    $dossiers = $bdDossier->getDossierAll();
    foreach ($dossiers as $dossier) {
        $n_dossier++;
    }

    $bdProces = new Proces();
    $n_proces = 0;
    $process = $bdProces->getProcesAll();
    foreach ($process as $proces) {
        $n_proces++;
    }

    $bdJugement = new Jugement();
    $n_jugement = 0;
    $jugements = $bdJugement->getJugementAll();
    foreach ($jugements as $jugement) {
        $n_jugement++;
    }

    $bdIntervention = new Intervention();
    $n_accusation = 0;
    $interventions = $bdIntervention->getInterventionByQualite("Accusé");
    foreach ($interventions as $intervention) {
        $n_accusation++;
    }

    $bdPlainte = new Plainte();
    $n_plainte = 0;
    $plaintes = $bdPlainte->getPlainteAll();
    foreach ($plaintes as $plainte) {
        $n_plainte++;
    }


    ?>

    <div class="col">

        <div style="background-color: #ebebeb; padding: 10px;">
            <p style="font-size: 50px;">
                <?= $n_dossier ?>+
            </p>
            <div>
                <a class="btn btn-success" href="home.php?render=<?= sha1("dossier") ?>&sub=<?= sha1("viewMini") ?>">Voir</a>
            </div>
        </div>
        <div style="background-color: #808080; color: whitesmoke; padding: 7px;">
            <p class="myCenter titre3">
                Dossier
            </p>
        </div>
    </div>
    <div class="col">

        <div style="background-color: #ebebeb; padding: 10px;">
            <p style="font-size: 50px;">
                <?= $n_proces ?>+
            </p>
            <div>
                <a class="btn btn-success" href="home.php?render=<?= sha1("proces") ?>&sub=<?= sha1("viewMini") ?>">Voir</a>
            </div>
        </div>
        <div style="background-color: #808080; color: whitesmoke; padding: 7px;">
            <p class="myCenter titre3">
                Procès
            </p>
        </div>
    </div>
    <div class="col">

        <div style="background-color: #ebebeb; padding: 10px;">
            <p style="font-size: 50px;">
                <?= $n_jugement ?>+
            </p>
            <div>
                <a class="btn btn-success" href="home.php?render=<?= sha1("jugement") ?>&sub=<?= sha1("viewMini") ?>">Voir</a>
            </div>
        </div>
        <div style="background-color: #808080; color: whitesmoke; padding: 7px;">
            <p class="myCenter titre3">
                Jugements
            </p>
        </div>
    </div>
    <div class="col">

        <div style="background-color: #ebebeb; padding: 10px;">
            <p style="font-size: 50px;">
                <?= $n_accusation ?>+
            </p>
            <div>
                <a class="btn btn-success" href="home.php?render=<?= sha1("intervention") ?>&sub=<?= sha1("viewMiniAccusation") ?>">Voir</a>
            </div>
        </div>
        <div style="background-color: #808080; color: whitesmoke; padding: 7px;">
            <p class="myCenter titre3">
                Accusations
            </p>
        </div>
    </div>
    <div class="col">

        <div style="background-color: #ebebeb; padding: 10px;">
            <p style="font-size: 50px;">
                <?= $n_plainte ?>+
            </p>
            <div>
                <a class="btn btn-success" href="home.php?render=<?= sha1("plainte") ?>&sub=<?= sha1("viewMini") ?>">Voir</a>
            </div>
        </div>
        <div style="background-color: #808080; color: whitesmoke; padding: 7px;">
            <p class="myCenter titre3">
                Plaintes
            </p>
        </div>
    </div>

</div>

<div class="row">
    <?php
    include 'dashboard/chartboard.php';
    ?>
</div>