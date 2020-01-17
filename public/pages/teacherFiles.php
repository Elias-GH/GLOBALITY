<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../index.php");
    } else {
    include '../../src/database/database.php';
    include '../../src/php/composantPage/header.php';
    include '../../src/php/composantPage/includeCSS/teacherFiles.php';
    include '../../src/php/functions/project.php';
 ?>

  <a href="./home.php" class="returnMenu"><i class="fas fa-undo"></i></a>

 <script src="../../src/js/scroll.js" charset="utf-8"></script>
 <script src="../../src/js/showButton.js" charset="utf-8"></script>

 <div class="header">
     <div class="header-content">
         <h2 class="header-title">Espace Professeur <blue>ESIEA</blue></h2>
         <nav class="header-menu">
             <button class="link" onclick="showClass()">Espace Cours</button>
             <button class="link" onclick="showDocsPST()">Espace PST</button>
         </nav>
     </div>
 </div>

<?php
    if (is_dir('../../src/data/teacherFiles/'.$_SESSION['username'].'/')) {
        include '../../src/php/include/teacherComposant/manageFile.php';
        $pathToClass    = '../../src/data/teacherFiles/'.$_SESSION['username'].'/class/';
        $pathToProjects = '../../src/data/teacherFiles/'.$_SESSION['username'].'/projects/';
    ?>
        <div id="homeSpace" style="display: block;">
            <div class="homeSpace">
                <button class="cat" onclick="showClass()"  >Espace Cours</button>
                <button class="cat" onclick="showDocsPST()">Espace PST</button>
            </div>
        </div>

         <div class="menu" id="class" style="display: none;">
             <div class="navYear">
                 <h3 class="subtitle">Les Années</h3>
                 <a href="#1">1er Année</a>
                 <a href="#2">2e Année</a>
                 <a href="#3">3e Année</a>
                 <a href="#4">4e Année</a>
                 <a href="#5">5e Année</a>
                 <a href="#upload">Nouveau</a>
             </div>
             <h2 class="title">Espace Cours</h2>
             <?php for ($i = 1; $i <= 5; $i++) { ?>
                 <div class="year" id="<?= $i ?>">
                     <h3 class="subtitle"><?= $i ?><?php if ($i == 1) echo 'er'; else echo 'e';?> Année</h3>
                     <form class="docs" action="" method="post">
                         <?php
                         $pathToYear = $pathToClass.$i.'/';
                         // $pathToYear = $pathToClass;
                         // echo $pathToYear;
                         $dirYear    = scandir($pathToYear);
                         $dirYearSize = getSizeArray($dirYear);
                        for ($j = 2; $j < $dirYearSize; $j++) { ?>
                            <div class="oneDoc">
                                <a href="<?= $pathToYear.$dirYear[$j] ?>" class="doc" target="_blank">
                                    <?= shortString(printWithoutExtension($dirYear[$j]), 72) ?>
                                </a>
                                <input type="submit" name="formDeleteDoc<?= $i ?>Y_<?= $j ?>D" id="formDeleteDoc<?= $i ?>Y_<?= $j ?>D" style="display: none">
                                <label for="formDeleteDoc<?= $i ?>Y_<?= $j ?>D">Supprimer</label>
                            </div>
                        <?php } ?>
                    </form>
                 </div>
             <?php } ?>

             <h2 class="title">Insérer nouveaux docs</h2>
             <form class="uploadDoc" id="upload" action="" method="post" enctype="multipart/form-data">
                 <input type="file" name="fileAddDoc[]" id="fileAddDoc" multiple="" style="display: none">
                 <label for="fileAddDoc">1. Insérer nouveaux fichiers</label>
                 <select class="selectYear" name="selectYear">
                    <option default>2. Choisir Année</option>
                    <option value="1">1er Année</option>
                    <option value="2">2e Année</option>
                    <option value="3">3e Année</option>
                    <option value="4">4e Année</option>
                    <option value="5">5e Année</option>
                 </select>
                 <input type="submit" name="formAddFiles" id="formAddFiles" value="3. Ajouter">
             </form>
         </div>

         <div class="menu" id="project" style="display: none;">
             <div class="navYear" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr;">
                 <h3 class="subtitle">Les Années</h3>
                 <a href="#2">2e Année</a>
                 <a href="#3">3e Année</a>
                 <a href="#4">4e Année</a>
                 <a href="#uploadProject">Nouveau</a>
             </div>

             <h2 class="title">Espace PST</h2>
             <?php for ($i = 2; $i <= 4; $i++) { ?>
                 <div class="year">
                     <h3 class="subtitle"><?= $i ?> Année</h3>
                     <form class="docs" action="" method="post">
                         <?php
                         $pathToProjectYear = $pathToProjects.$i.'/';
                         $dirProjectYear    = scandir($pathToProjectYear);
                         $dirProjectYearSize = getSizeArray($dirProjectYear);
                        for ($j = 2; $j < $dirProjectYearSize; $j++) { ?>
                            <div class="oneDoc">
                                <a href="<?= $pathToProjectYear.$dirProjectYear[$j] ?>" class="doc" target="_blank">
                                    <?= shortString(printWithoutExtension($dirProjectYear[$j]), 72) ?>
                                </a>
                                <input type="submit" name="formDeleteDoc<?= $i ?>Y_<?= $j ?>D" id="formDeleteDoc<?= $i ?>Y_<?= $j ?>D" style="display: none">
                                <label for="formDeleteDoc<?= $i ?>Y_<?= $j ?>D">Supprimer</label>
                            </div>
                        <?php } ?>
                     </form>
                 </div>
             <?php } ?>

             <h2 class="title">Insérer nouveaux documents</h2>
             <form class="uploadDoc" id="uploadProject" action="" method="post" enctype="multipart/form-data">
                 <input type="file" name="fileAddDocProject[]" id="fileAddDocProject" multiple="" style="display: none">
                 <label for="fileAddDocProject">1. Insérer nouveaux fichiers</label>
                 <select class="selectYearProject" name="selectYearProject">
                    <option default>2. Choisir Année</option>
                    <option value="1">1er Année</option>
                    <option value="2">2e Année</option>
                    <option value="3">3e Année</option>
                    <option value="4">4e Année</option>
                    <option value="5">5e Année</option>
                 </select>
                 <input type="submit" name="formAddFilesProject" id="formAddFilesProject" value="3. Ajouter">
             </form>
         </div>
    <?php } else { ?>
        <div class="alertMessage">
            <h3 class="title">Erreur de stockage</h3>
            <div class="message">
                Vous devez activer le stockage des données pour acceder à cette partie.</br>
                <a href="settings.php" style="background-color: red;">Paramètre...</a>
            </div>
        </div>
    <?php } ?>


 <?php
    include '../../src/php/composantPage/footer.php';
    }
  ?>
