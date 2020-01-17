<div class="menu">
    <a href="projectMenu/teacher/followPST.php" class="division">
        <i class="fas fa-users"></i>
        <h3 class="subtitle">Les Projets</h3>
    </a>
    <a href="projectMenu/teacher/ordersPST.php" class="division">
        <i class="fas fa-align-justify"></i>
        <h3 class="subtitle">Consigne PST</h3>
    </a>
    <a href="projectMenu/teacher/scheduleProjects.php" class="division">
        <i class="fas fa-database"></i>
        <h3 class="subtitle">Suivi des projets</h3>
    </a>
    <a href="projectMenu/teacher/toolsPST.php" class="division">
        <i class="fas fa-toolbox"></i>
        <h3 class="subtitle">Outils</h3>
    </a>
</div>

<?php
    include '../../src/php/functions/project.php';
    include '../../src/php/include/projectComposant/extractPST.php';
    $pathToINFO = '../../src/data/extracts/';
    $dir = scandir($pathToINFO);
    // var_dump($dir);
    $i = 2;
    while (isset($dir[$i])) {
        eraseINFO($pathToINFO.$dir[$i]);
        $i++;
    }
 ?>
