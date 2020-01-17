<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../../../index.php");
    } else {
        $_GET['year'] = htmlspecialchars($_GET['year']);
        include '../../../../src/database/database.php';
        include '../../../../src/php/composantPage/header.php';
        include '../../../../src/php/composantPage/includeCSS/student/projectReport.php';

        include '../../../../src/php/functions/project.php';
        $project   = getProject($_SESSION['id'], $_GET['year']);
        $pathToReport = '../../../../src/data/projects/'.$project['name'].'/report/';

        include '../../../../src/php/include/projectComposant/getReports.php';
        include '../../../../src/php/include/projectComposant/addFiles.php';
        include '../../../../src/php/include/projectComposant/removeFiles.php';
        include '../../../../src/php/include/projectComposant/addReport.php';
        global $db;
 ?>

 <?php
    $reportByYear = reportByYear($project['year']);
    $nbReport = getSizeArray($reportByYear);
    // var_dump($reportByYear);
  ?>

<a href="./infoProject.php?year=<?= $project['year'] ?>" class="returnMenu"><i class="fas fa-undo"></i></a>
<script type="text/javascript">
    $(document).ready(function () {
        var i;
        <?php for ($i = 0; $i < $nbReport; $i++) { ?>
            $('#addFile-<?= $i ?>').on('change', function(e) {
                var files = $(this)[0].files;
                if (files.length >= 2) {
                    $('#label-addFile-<?= $i ?>').text(files.length + " fichiers");
                } else {
                    $('#label-addFile-<?= $i ?>').text(files.length + " fichier");
                }
            });
        <?php } ?>
    })
</script>

 <div class="header" style="display: block;">
     <div class="header-content">
         <h1 class="header-title">Fichiers Demandés <blue style="text-transform: none;"><?= $project['name'] ?></blue></h1>
     </div>
 </div>

 <div class="main" style="display: grid;">
     <?php
        if (!empty($reportByYear)) {
            $i = 0;
            // var_dump($reportByYear);
            while (isset($reportByYear[$i])) { ?>
                <div class="container <?php if ($reportByYear[$i]['deadLine'] < date('Y-m-d')) { ?> pastDeadLine <?php }?>">
                    <h2 class="title"><?php if(strlen($reportByYear[$i]['title']) < 24) { echo $reportByYear[$i]['title']; } else { echo shortString($reportByYear[$i]['title'], 24); } ?></h2>
                    <p class="description"><?= $reportByYear[$i]['description'] ?></p>
                    <?php if (file_exists('../../../../src/data/projectsModel/'.$project['year'].'/'.$reportByYear[$i]['title'].'.pdf')) { ?>
                        <a href="../../../../src/data/projectsModel/<?= $project['year'] ?>/<?= $reportByYear[$i]['title'] ?>.pdf" class="baseFile"><?= $reportByYear[$i]['title'] ?></a>
                    <?php } else { ?>
                        <div class="baseFile">Aucun modèle</div>
                    <?php } ?>
                    <red><p class="deadLine">DeadLine : <?= $reportByYear[$i]['deadLine'] ?></p></red>
                    <?php if ($reportByYear[$i]['deadLine'] >= date('Y-m-d')) { ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <input type="file" name="addFile-<?= $i ?>" id="addFile-<?= $i ?>" style="display: none;">

                            <?php if (!file_exists($pathToReport.$reportByYear[$i]['title'].'.pdf')) { ?>
                                <label for="addFile-<?= $i ?>" id="label-addFile-<?= $i ?>">Ajouter un fichier... </label>
                            <?php } else { ?>
                                <a href="<?= $pathToReport.$reportByYear[$i]['title'] ?>.pdf" target="_blank">Consulter le fichier</a>
                                <label for="addFile-<?= $i ?>" id="label-addFile-<?= $i ?>">Modifier le fichier... </label>
                            <?php } ?>

                            <input type="submit" name="formAddReport-<?= $i ?>" id="formAddReport-<?= $i ?>" value="Envoyer">
                        </form>
                    <?php } else { ?>
                        <?php if (file_exists($pathToReport.$reportByYear[$i]['title'].'.pdf')) { ?>
                            <a href="../../../../src/data/projects/<?= $project['name'] ?>/report/<?= $reportByYear[$i]['title'] ?>.pdf" target="_blank">Consulter le fichier</a>
                        <?php } else { ?>
                            <p class="notReturnFile" href="">Fichier non rendu</p>
                        <?php } ?>
                        <div class="endReport">Terminé</div>
                    <?php } ?>
                </div>
                <?php
                $i++;
                }
            } else { ?>
                <div class="block">
                    <div class="title">Information</div>
                    <p class="description">Aucun élément demandé par le jury</p>
                </div>
            <?php } ?>
 </div>

 <?php
     include '../../../../src/php/composantPage/footer.php';
     }
  ?>
