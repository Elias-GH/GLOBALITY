<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../../../index.php");
    } else {
        $_GET['year'] = htmlspecialchars($_GET['year']);
        include '../../../../src/database/database.php';
        include '../../../../src/php/composantPage/header.php';
        include '../../../../src/php/composantPage/includeCSS/student/projectProgress.php';

        include '../../../../src/php/functions/project.php';
        $project = getProject($_SESSION['id'], $_GET['year']);
        include '../../../../src/php/include/projectComposant/confirmStep.php';
        global $db;
 ?>

 <?php
    // addOrder(2, 0, 'initialisation', 'consigne 1 étape 0', NULL);
    // addOrder(2, 0, 'initialisation', 'consigne 2 étape 0', NULL);
    // addOrder(2, 1, 'initialisation', 'consigne 1 étape 1', NULL);
    // addOrder(2, 1, 'initialisation', 'consigne 1 étape 1', NULL);

    $allOrders    = getAllOrders();
    $maxStep      = 5;
    $stepsConfirm = $project['step'];
    // $maxStep = 4;
    $orderByStep = array();

    for ($i = 0; $i <= $maxStep; $i++) {
        $tempOrder = orderByStepAndYear($i, $project['year']);
        array_push($orderByStep, $tempOrder);
    }
    $titleStep = getTitleStepOrder();

    // var_dump($allOrders);
    // var_dump($orderByStep);

    /*
        $orderByStep[stepNumber][orderNumber][typeOfContent]
        $allOrders[numberOfOrder][typeOfContent]

        addOrder($year, $stepNumber, $contentOfStep, $deadLine);
        removeOrder($id);
    */
 ?>

 <?php
    // addOrder(2, 0, 'Former des groupes de 4 élèves dans le même sous groupe', '2018-14-09');
    // addOrder(2, 0, 'Choisir une ou plusieurs thématiques', NULL);
    // addOrder(2, 0, 'Réfléchir à une (ou plusieurs) idée(s) de sujet(s) de projet(s) dans une (ou plus) des thématiques proposées', NULL);
    // addOrder(2, 0, 'Réaliser un état de l\'art du (ou des) sujet(s) qui vous intéressent', NULL);
    // addOrder(2, 0, 'Lister approximativement les composants envisageables ainsi que leurs prix : budget approximatif', NULL);
    // addOrder(2, 1, 'Présenter le (ou les) sujets en cours de conception à \'équipe pédagogique', '2018-01-10');
    // addOrder(2, 1, 'Valider un sujet d\'étude par groupe, affiner le budget', NULL);
    // addOrder(2, 2, 'Concevoir une affiche : format PDF A3', '2018-19-11');
    // addOrder(2, 2, 'Lancer la commande des composants', '2018-03-12');
    // addOrder(2, 3, 'Début de la réalisation à partir du début de S2', NULL);
    // addOrder(2, 3, 'Bilan intermédiaire', '2019-01-03');
    // addOrder(2, 4, 'Rapport final et soutenance', '2019-01-05');
    // addOrder(2, 4, 'Salon des PST', '2019-12-06');

  ?>

<style media="screen">
     .progressLine {
         <?php if ($stepsConfirm == 0) { ?>
             height: 0px;
             display: none;
         <?php } else { ?>
             <?php if ($stepsConfirm == 5) { ?>
                 height: calc(100vh - 70px);
             <?php } else { ?>
                 height: calc(90%/<?= (($maxStep-1)/$stepsConfirm) ?> - 70px);
             <?php } ?>
         <?php } ?>
         font-size: 18px;
         font-family: 'Poppins-Light';
         letter-spacing: 1px;
     }

     @keyframes showProgressLine {
     	0% {
            height: 0px;
     	}
     	100% {
            <?php if ($stepsConfirm == 5) { ?>
                height: calc(100vh - 70px);
            <?php } else { ?>
                height: calc(90%/<?= (($maxStep-1)/$stepsConfirm) ?> - 70px);
            <?php } ?>
     	}
     }
 </style>

 <script src="../../../../src/js/scroll.js" charset="utf-8"></script>
 <script src="../../../../src/js/uploadFiles.js" charset="utf-8"></script>
 <script src="../../../../src/js/showButton.js" charset="utf-8"></script>
 <script src="../../../../src/js/progressValue.js" charset="utf-8"></script>

<a href="./infoProject.php?year=<?= $project['year'] ?>" class="returnMenu"><i class="fas fa-undo"></i></a>

 <div class="header" style="display: block;">
     <div class="header-content">
         <h1 class="header-title">Progression <blue style="text-transform: none;"><?= $project['name'] ?></blue></h1>
         <nav class="header-menu">
             <button onclick="showProgress()">Progression</button>
             <button onclick="showAction()">Action</button>
         </nav>
     </div>
 </div>

 <?php include '../../../../src/php/include/projectComposant/addAction.php'; ?>

 <div class="progressBlock" id="progressBlock" style="display: block;">
     <div class="infoProject" style="display: block;">
         <div class="steps">
             <?php if (!empty($orderByStep)) {?>
                 <?php
                 for ($i = $maxStep-1; $i >= 0; $i--) { ?>
                     <a class="step" href="progress.php?year=<?= $project['year'] ?>&step=<?= $i ?>" style="margin: calc(90%/<?= $maxStep ?>) auto"><stepProgress>Etape <?= $i ?> :</stepProgress> <?= $titleStep[$i] ?></a>
                 <?php }
                 ?>
             <?php } else {?>
                 <p class="step">Aucune étape définie</p>
             <?php } ?>
         </div>
     </div>
     <div class="progressLine" id="myValue" ><?= $stepsConfirm/$maxStep * 100 ?>%</div>

    <script type="text/javascript">
        progressValue('.progressLine', <?= $stepsConfirm/$maxStep * 100 ?>, 20);
    </script>

     <?php if (isset($_GET['step']) && $_GET['step'] <= $maxStep) {
         $_GET['step'] = htmlspecialchars($_GET['step']); ?>
         <div class="infoStep">
             <h3 class="title">Etape <?= $_GET['step'] ?> : <?= $titleStep[$_GET['step']] ?></h3>
             <?php if ($project['step'] <= $_GET['step']) {?>
                 <form action="#" method="post">
                     <input style="display: none;" type="submit" name="formConfirmStep<?= $_GET['step'] ?>" id="formConfirmStep<?= $_GET['step'] ?>" value="✓">
                     <label for="formConfirmStep<?= $_GET['step'] ?>"><i class="fas fa-check"></i></label>
                 </form>
             <?php } else { ?>
                <form action="" method="post">
                    <label class="confirmStep"><i class="fas fa-check"></i></label>
                </form>
             <?php } ?>
             <ul class="list">
                 <?php
                 if (!empty($orderByStep[$_GET['step']])) {
                     $i = 0;
                     while (isset($orderByStep[$_GET['step']][$i])) { ?>
                         <li class="list-element"><?= $orderByStep[$_GET['step']][$i]['contentOrder'] ?>
                         <?php if (isset($orderByStep[$_GET['step']][$i]['deadLine'])) {
                             echo '<red>DeadLine : '.$orderByStep[$_GET['step']][$i]['deadLine'].'</red>';
                         } ?> </li>
                         <?php
                         $i++;
                     }
                 } else { ?>
                     <p class="noContent">
                         Aucune consigne
                     </p>
                 <?php } ?>

             </ul>
         </div>
    <?php } ?>
 </div>

 <?php $actions = getActionsByProjects($project['id']); ?>

 <div class="actionBlock" id="actionBlock" style="display: none;">
     <div class="lastActions">
         <div class="title">Les actions</div>
         <div class="list-actions">
             <?php foreach($actions as $action) { ?>
                 <form class="action" action="" method="post">
                     <input type="submit" name="deleteAction<?= $action['id'] ?>" id="deleteAction<?= $action['id'] ?>" style="display: none">
                     <label class="deleteAction" for="deleteAction<?= $action['id'] ?>">Supprimer</label>
                     <div class="info titleAction"><?= $action['title'] ?></div>
                     <div class="info authorAction"><upp>Auteur :</upp> <?= convertIdToName($action['idAuthor']) ?></div>
                     <div class="info dateAction"><upp>Date :</upp> <?= $action['dateAction'] ?></div>
                     <div class="info descriptionAction"><upp>Description :</upp> </br><?= $action['description'] ?></div>
                 </form>
             <?php } ?>
         </div>
         <button class="addActionBtn" onclick="showAddAction()">Ajouter une nouvelle action</button>
     </div>
     <div class="addAction" id="addAction" style="display: none;">
         <div class="title">Ajouter une nouvelle action</div>
         <button class="clsMenu" onclick="showAddAction()">+</button>
         <form action="#" method="post">
             <input class="titleAction" type="text" name="titleAction" id="titleAction" placeholder="Titre">
             <textarea name="descriptionAction" id="descriptionAction" placeholder="Description (255 caractères max)" maxlength="255"></textarea>
             <input type="submit" name="formAddAction" id="formAddAction">
         </form>
     </div>
 </div>

 <?php
    foreach($actions as $action) {
        if (isset($_POST['deleteAction'.$action['id']])) {
            deleteAction($action['id']);
        }
    }
  ?>



 <?php
     include '../../../../src/php/composantPage/footer.php';
     }
  ?>
