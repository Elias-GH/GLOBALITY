<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../../../index.php");
    } else {
        $_GET['year'] = htmlspecialchars($_GET['year']);
        include '../../../../src/database/database.php';
        include '../../../../src/php/composantPage/header.php';
        include '../../../../src/php/composantPage/includeCSS/student/infoProjectCSS.php';

        include '../../../../src/php/functions/project.php';
        $project = getProject($_SESSION['id'], $_GET['year']);    //
        $pathToJacketOfPST = '../../../../src/data/projects/'.$project['name'].'/pictures/logo.png';
        global $db;
?>

<script src="../../../../src/js/scroll.js" charset="utf-8"></script>
<script src="../../../../src/js/uploadFiles.js" charset="utf-8"></script>
<script src="../../../../src/js/showButton.js" charset="utf-8"></script>

<a href="../../project.php" class="returnMenu"><i class="fas fa-undo"></i></a>

<div class="header">
    <div class="header-content">
        <h1 class="header-title">Projet <blue style="text-transform: none;"><?= $project['name'] ?></blue></h1>
    </div>
</div>

<?php // var_dump($project); ?>

 <div class="menuInformation" id="infoPST" style="display: none;">
     <button class="clsMenu" onclick="showInfoPST()">+</button>
     <div class="jacket">
        <?php if (file_exists($pathToJacketOfPST)) { ?>
            <img class="image" src="<?= $pathToJacketOfPST ?>" alt="jacket du PST">
            <form class="deleteLogo" action="#" method="post">
                <input type="submit" name="deleteLogo" value="Supprimer Logo">
            </form>
        <?php } else { ?>
            <form class="image formulaire" enctype="multipart/form-data" action="#" method="post">
                <input class="input-logoPST" type="file" name="input-logoPST" id="input-logoPST" accept="image/png" style="display: none;">
                <label class="logoPST" for="input-logoPST">
                    <span id="span-logoPST">Choisir un logo</span>
                </label>
                <input type="submit" name="formAddLogo" value="Confirmer">
            </form>
        <?php } ?>
     </div>
     <div class="infoFix">
         <h5 class="subtitle">Suiveur :</h5>
         <p class="follower" name="idFollower"><?= convertIdToName($project['idFollower']) ?></p>
         <h5 class="subtitle" style="margin-top: 20px;">Type :</h5>
        <p class="description"><?= $project['category'] ?></p>
    </div>
    <div class="markBlock">
        <p class="mark"><span>S1 :</span> <?= $project['markS1'] ?> / 20</p>
        <p class="mark"><span>Intermédiaire :</span> <?= $project['markInterm'] ?> / 20</p>
        <p class="mark"><span>TechDay :</span> <?= $project['markTech'] ?> / 42</p>
        <p class="mark"><span>Soutenance Final :</span> <?= $project['markFin'] ?> / 15</p>
        <p class="mark"><span>Note général :</span> <?= $project['markGen'] ?> / 20</p>
    </div>

     <form class="informations" method="post">
         <p class="members">
             <h5 class="subtitle">Membres :</h5>
             <input class="member" name="member1" value="<?= convertIdToName($project['idProjectManager']) ?>">
             <input class="member" name="member2" value="<?= convertIdToName($project['idMember2']) ?>">
             <input class="member" name="member3" value="<?= convertIdToName($project['idMember3']) ?>">
             <input class="member" name="member4" value="<?= convertIdToName($project['idMember4']) ?>">
             <input class="member" name="member5" value="<?= convertIdToName($project['idMember5']) ?>">
         </p>
         <h5 class="subtitle">Description <min style="text-transform: lowercase;">(max: 255 caractères)</min> :</h5>
         <textarea class="description" name="descriptionPST" maxlength="255" placeholder="description (255 caractères max)"><?= $project['description'] ?></textarea>
         <input type="submit" name="formUpdateInfo" value="Modifier">
     </form>
     <?php
        if ($project['idProjectManager'] == $_SESSION['id']) { ?>
            <form class="deleteProject" action="#" method="post">
                <input class="input-deleteProject" type="submit" name="formDeleteProject" id="formDeleteProject" value="Supprimer le projet">
                <label class="label-deleteProject" for="formDeleteProject"><i class="fas fa-trash"></i> Supprimer Projet</label>
            </form>
        <?php }
      ?>
 </div>
 <?php include '../../../../src/php/include/projectComposant/addProject.php'; ?>



<div class="menu">
    <?php if ($project['step'] != 5) { ?>
        <a href="progress.php?year=<?= $project['year'] ?>&step=<?= $project['step'] ?>" class="category">
    <?php } else { ?>
        <a href="progress.php?year=<?= $project['year'] ?>&step=<?= $project['step'] - 1 ?>" class="category">
    <?php } ?>
        <i class="fas fa-spinner reverse"></i>
        <h5 class="subtitle">Progression</h5>
    </a>
    <a href="shareFiles.php?year=<?= $project['year'] ?>" class="category">
        <i class="fab fa-creative-commons-share"></i><h5 class="subtitle">Partage fichiers</h5>
    </a>
    <a href="reportFiles.php?year=<?= $project['year'] ?>" class="category">
        <i class="fas fa-folder"></i><h5 class="subtitle">Fichiers demandés</h5>
    </a>
    <button class="category" onclick="showInfoPST()">
        <i class="fas fa-info"></i><h5 class="subtitle">Informations</h5>
    </button>
</div>


<?php
    include '../../../../src/php/composantPage/footer.php';
    }
 ?>
