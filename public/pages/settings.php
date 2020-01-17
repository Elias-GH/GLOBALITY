<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../index.php");
    } else {
    include '../../src/database/database.php';
    include '../../src/php/composantPage/header.php';
    include '../../src/php/composantPage/includeCSS/settingsCSS.php';
    include '../../src/php/functions/project.php';
?>

<?php
    $username = $_SESSION['username'];
    $email    = $_SESSION['email'];
    $promo    = $_SESSION['promo'];
    $student = getStudentWithId($_SESSION['id']);
 ?>

<script src="../../src/js/scroll.js" charset="utf-8"></script>
<script src="../../src/js/persoAlert.js" charset="utf-8"></script>

<a href="home.php" class="returnMenu"><i class="fas fa-undo"></i></a>

<div class="header">
    <div class="header-content">
        <h1 class="header-title">Paramètres <blue>ESIEA</blue></h1>
    </div>
</div>

<div class="themeBlock">
    <h3 class="title">Thèmes</h3>
    <div class="line"></div>
    <div class="content">
        <form class="themeSelect" action="#" method="post">
            <div class="inputBox customSelect" style="margin-bottom: 30px; margin-left: -10px;">
                <select name="themeNumber" id="themeNumber" class="yearSelect">
                    <option value="1" selected>Thème par Default</option>
                    <option value="2">Thème Light</option>
                    <option value="3">Thème darkYellow</option>
                    <option value="4">Thème darkGreen</option>
                    <option value="5">Thème darkCyan</option>
                </select>
            </div>
            <!-- <input type="submit" value="MODIFIER"> -->
            <input type="submit" value="MODIFIER" name="selectTheme" id="selectTheme"/> <!--- Bouton pour appeler la fonction -->
        </form>
    </div>
</div>
<div id="alertPanel" ></div>
<?php
    if (isset($_POST['selectTheme'])) {
        global $db;
        $_POST['themeNumber'] = htmlspecialchars($_POST['themeNumber']);
        $changeThemeSQL = "UPDATE users SET theme = :theme WHERE username = :username";
        $changeTheme = $db->prepare($changeThemeSQL);
        $saveStateOfChangement = $changeTheme->execute([
            'theme' => $_POST['themeNumber'],
            'username' => $_SESSION['username'],
        ]);
        $_SESSION['theme'] = $_POST['themeNumber'];
        $url = "home.php";
        $messageok = 'Le thème a bien été mis à jour';
        echo "<script type='text/javascript'>alert('$messageok');</script>";
        // echo '<script>window.location = "'.$url.'";</script>';
    }
 ?>

<div class="persoInformations">
    <h3 class="title">Informations Personnelles</h3>
    <div class="block">
        <div class="information">
            <h3 class="subtitle">Nom d'utilisateur : </h3> <output> <?php echo $username; ?> </output>
        </div>
        <div class="information">
            <h3 class="subtitle">Promo : </h3> <output>
                <?php
                if ($promo > 0) {
                    echo $promo.'A'.'</br>';
                    echo '<h3 class="subtitle">Classe : </h3> <output>'.$student['class'].'</br>';
                }
                else
                    echo $promo;
                ?>
            </output>
        </div>
        <div class="information">
            <h3 class="subtitle">eMail : </h3> <output><?= $email ?> </output>
        </div>
    </div>
</div>

<div class="themeBlock fonctionBlock">
    <h3 class="title">Fonctionnalité</h3>
    <div class="line"></div>
    <form class="content" method="post">
        <?php if ($_SESSION['promo'] == 0) { ?>
            <input type="submit" name="formAccessStorage" value="Activer le stockage">
        <?php } else { ?>
            <input type="submit" name="formAccessLessons" value="Activer les leçons">
        <?php } ?>
        <!-- <input type="submit" name="formAccessProjects" value="Activer les projets" style="margin-top: 20px;"> -->
    </form>
</div>

<?php include '../../src/php/include/createDataDirectory.php'; ?>

<?php
    include '../../src/php/composantPage/footer.php';
    }
 ?>
