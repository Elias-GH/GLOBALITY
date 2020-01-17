<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../../../index.php");
    } else {
        include '../../../../src/database/database.php';
        include '../../../../src/php/composantPage/header.php';
        include '../../../../src/php/composantPage/includeCSS/teacher/tools.php';
        include '../../../../src/php/include/projectComposant/extractPST.php';

        include '../../../../src/php/functions/project.php';
        global $db;
?>

<script src="../../../../src/js/scroll.js"          charset="utf-8"></script>
<script src="../../../../src/js/showButton.js"      charset="utf-8"></script>
<script src="../../../../src/js/showExtractData.js" charset="utf-8"></script>

<a href="../../project.php" class="returnMenu"><i class="fas fa-undo"></i></a>

<div class="header">
    <div class="header-content">
        <h1 class="header-title">Outils <blue>ESIEA</blue></h1>
        <nav class="header-menu">

        </nav>
    </div>
</div>

<div class="extractData">
    <h2 class="title">Les contenues et fichiers</h2>
    <div class="choices">
        <button onclick="extractDataOne()">
            <span class="subject">Un PST</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataMine()">
            <span class="subject">Mes PST</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataYear()">
            <span class="subject">Tous les PST d'une promo</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataAll()">
            <span class="subject">Tous les PST</span>
            <span class="extract">Extraire</span>
        </button>
    </div>
</div>
<div class="extractData">
    <h2 class="title">Les informations</h2>
    <div class="choices">
        <button onclick="extractDataMark()">
            <span class="subject">Les notes</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataStudent()">
            <span class="subject">Les informations d'un étudiant</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataOrder()">
            <span class="subject">Les consignes de toutes les promos</span>
            <span class="extract">Extraire</span>
        </button>
        <button onclick="extractDataReport()">
            <span class="subject">Les consignes de dépot de fichier</span>
            <span class="extract">Extraire</span>
        </button>
    </div>
</div>

<?php
    include '../../../../src/php/include/projectComposant/extractDataForm/extractOptionPST.php';
 ?>


<?php
    include '../../../../src/php/composantPage/footer.php';
    }
 ?>
