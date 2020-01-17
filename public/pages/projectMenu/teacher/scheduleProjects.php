<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../../../index.php");
    } else {
        include '../../../../src/database/database.php';
        include '../../../../src/php/composantPage/header.php';
        include '../../../../src/php/composantPage/includeCSS/teacher/scheduleProjectsCSS.php';

        include '../../../../src/php/functions/project.php';
?>

<script src="../../../../src/js/scroll.js"       charset="utf-8"></script>

<script src="../../../../src/js/uploadFiles.js"  charset="utf-8"></script>
<script src="../../../../src/js/showButton.js"   charset="utf-8"></script>
<script src="../../../../src/library/jQuery.js"  charset="utf-8"></script>

<a href="../../project.php" class="returnMenu"><i class="fas fa-undo"></i></a>

<?php
    $myFollow   = getPSTForFollower($_SESSION['id']);
    $projects   = array();

    $allOrders   = getAllOrders();
    $maxStep     = getMaxStep($allOrders);
 ?>

 <style media="screen">
     @keyframes loadingBar {
     	0% {
     		width: 20px;
     	}
     	100% {
         	width: <?= $myFollow[$i]['step']/$maxStep * 100?>%;
     	}
     }
 </style>

 <script type="text/javascript">
     var i;

     for (i = 0; i < <?= $project['step']/$maxStep ?>*100) {
         document.getElemementByClass('progressValue')
     }
 </script>

 <script type="text/javascript">
 function searchProject() {
     console.log('enter in searchEngine\n');
     // var input, filter, allProjects, project, titleProject, i, txtValue;
     // input = document.getElementById('searchProjectInput');
     // filter = input.value.toUpperCase();
     // allProjects = document.getElementById('allProjects');
     // project = allProjects.getElementsByClassName('project');
     // console.log(project.length);
     //
     // for (i = 0; i < project.length; i++) {
     //     titleProject = project[i].getElementsByClassName('titleProject')[0];
     //     txtValue = titleProject.textContent || titleProject.innerHTML;
     //     console.log(txtValue);
     //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
     //         project[i].style.display = "";
     //     } else {
     //         project[i].style.display = "none";
     //     }
     // }

     var input, filter, allProjects, project, titleProject, yearProject, category, follower, projectManager, member2, member3, member4, member5, i;
     input       = document.getElementById("searchProjectInput");
     filter      = input.value.toUpperCase();
     allProjects = document.getElementById("allProjects");
     project     = allProjects.getElementsByClassName("project");

     for (i = 0; i < project.length; i++) {
       titleProject   = project[i].getElementsByClassName("titleProject")[0];
       yearProject    = project[i].getElementsByClassName("yearProject")[0];
       category       = project[i].getElementsByClassName("category")[0];
       projectManager = project[i].getElementsByClassName("member")[0];
       member2        = project[i].getElementsByClassName("member")[1];
       member3        = project[i].getElementsByClassName("member")[2];
       member4        = project[i].getElementsByClassName("member")[3];
       member5        = project[i].getElementsByClassName("member")[4];

       console.log('projectManager : ' + projectManager.textContent + '\n');
       console.log('member2        : ' + member2.textContent + '\n');
       console.log('member3        : ' + member3.textContent + '\n');
       console.log('member4        : ' + member4.textContent + '\n');
       console.log('member5        : ' + member5.textContent + '\n');
       if (titleProject.innerHTML.toUpperCase().indexOf(filter) > -1 || yearProject.innerHTML.toUpperCase().indexOf(filter) > -1 || category.innerHTML.toUpperCase().indexOf(filter) > -1 ||
        projectManager.innerHTML.toUpperCase().indexOf(filter) > -1 || member2.innerHTML.toUpperCase().indexOf(filter) > -1 || member3.innerHTML.toUpperCase().indexOf(filter) > -1 || member4.innerHTML.toUpperCase().indexOf(filter) > -1 || member5.innerHTML.toUpperCase().indexOf(filter) > -1) {
         project[i].style.display = "";
       } else {
         project[i].style.display = "none";
       }
     }
 }

 </script>

<div class="showProjects" id="showProjects">
    <div class="main">
        <div class="header-list">
            <h3 class="header-list-title">
                Tous les Projets Scientifiques et Techniques
            </h3>
            <input type="text" id="searchProjectInput" onkeyup="searchProject()" placeholder="Rechercher un projet" title="Type in a category">
        </div>

        <div class="list-projects" id="allProjects">
            <?php
            $i = 0;
            while (!empty($myFollow[$i])) { ?>
                <?php $pathToJacketOfPST = '../../../../src/data/projects/'.$myFollow[$i]['name'].'/pictures/logo.png'; ?>
                <a href="infoPST.php?title=<?= $myFollow[$i]['name'] ?>" class="project">
                    <div class="jacket" style="display: block;">
                        <?php if (file_exists($pathToJacketOfPST)) { ?>
                            <img src="<?= $pathToJacketOfPST ?>" class="unknow" alt="?">
                        <?php } else { ?>
                            <p class="unknow">?</p>
                        <?php } ?>
                    </div>
                    <div class="progress" id="progress">
                        <div class="progressBar"></div>
                        <div class="progressValue"><?= $myFollow[$i]['step']/$maxStep * 100 ?>%</div>
                        <?php if (isset($myFollow[$i]['step']) && $myFollow[$i]['step'] != 0) { ?>
                             <div class="progressBar completed" style="width: <?= $myFollow[$i]['step']/$maxStep * 100 ?>%;"></div>
                         <?php } ?>
                    </div>

                    <div class="informations" style="display: block;">
                        <h4 class="titleProject"><?= shortString($myFollow[$i]['name'], 35); ?></h4>
                        <div class="block">
                            <p class="category"><blue>Catégorie :</blue> <upp> <?= $myFollow[$i]['category'] ?> </upp> </p>
                            <p class="yearProject">PST <?= $myFollow[$i]['year'] ?>A</p>
                            <div class="team">
                                Equipe :
                                <div class="member"><?= convertIdToName($myFollow[$i]['idProjectManager']) ?></div>
                                <div class="member"><?= convertIdToName($myFollow[$i]['idMember2']) ?></div>
                                <div class="member"><?= convertIdToName($myFollow[$i]['idMember3']) ?></div>
                                <div class="member"><?= convertIdToName($myFollow[$i]['idMember4']) ?></div>
                                <div class="member"><?= convertIdToName($myFollow[$i]['idMember5']) ?></div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php  $i++;} ?>
          </div>

      </div>
</div>

<!-- faire tout passer à gauche retire nom du suiveur, trier en fonction du suiveur, faire à droite barre de progression et affiche l'étape-->

<?php
    include '../../../../src/php/composantPage/footer.php';
    }
 ?>
