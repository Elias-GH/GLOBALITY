<?php
    $projects = getAllPST();
    // var_dump($projects);
 ?>

 <script type="text/javascript">
     function searchProject() {
         console.log('enter in searchEngine\n');
         var input, filter, allProjects, project, titleProject, i, txtValue;
         input = document.getElementById('searchProjectInput');
         filter = input.value.toUpperCase();
         allProjects = document.getElementById('allProjects');
         project = allProjects.getElementsByClassName('project');
         console.log(project.length);

         for (i = 0; i < project.length; i++) {
             titleProject = project[i].getElementsByClassName('titleProject')[0];
             txtValue = titleProject.textContent || titleProject.innerHTML;
             console.log(txtValue);
             if (txtValue.toUpperCase().indexOf(filter) > -1) {
                 project[i].style.display = "";
             } else {
                 project[i].style.display = "none";
             }
         }
     }

     function searchStudent() {
         console.log('enter in searchStudent\n');
         var input, filter, allStudents, students, nameStudent, i, txtValue;
         input = document.getElementById('searchStudentInput');
         filter = input.value.toUpperCase();
         allStudents = document.getElementById('allStudents');
         students = allStudents.getElementsByClassName('student');
         console.log(students.length);

         for (i = 0; i < students.length; i++) {
             nameStudent = students[i].getElementsByClassName('nameStudent')[0];
             txtValue = nameStudent.textContent || nameStudent.innerHTML;
             console.log(txtValue);
             if (txtValue.toUpperCase().indexOf(filter) > -1) {
                 students[i].style.display = "";
             } else {
                 students[i].style.display = "none";
             }
         }
     }
 </script>
 <?php
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////     GENERAL FUNCTIONS     ///////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ?>

<div class="extractForm" id="extractOnePST" style="display: none">
    <button onclick="extractDataOne()" class="clsMenu">+</button>
    <div class="title">Extraction d'un PST</div>
    <input class="searchProject" type="text" onkeyup="searchProject()" placeholder="Rechercher un projet" id="searchProjectInput">
    <form class="allProjects" id="allProjects" action="" method="post">
        <?php
            foreach($projects as $element) { ?>
                <div class="project">
                    <input type="submit" name="formExtract<?= $element['name'] ?>" id="<?= printWithoutSpaces('formExtract'.$element['name']) ?>" style="display: none;">
                    <label class="titleProject" for="<?= printWithoutSpaces('formExtract'.$element['name']) ?>"><?= $element['name'] ?><span>Extraire</span></label>
                </div>
            <?php }
        ?>
    </form>
</div>

<div class="extractForm" id="extractMine" style="display: none">
    <button onclick="extractDataMine()" class="clsMenu">+</button>
    <div class="title">Extraction de mes suivies de PST</div>
    <form class="extractCat" action="" method="post">
        <input type="submit" name="extractDataMine" id="extractDataMine" style="display: none">
        <label for="extractDataMine" class="bigButton mid">Extraire tout mes PST</label>
    </form>
</div>

<div class="extractForm" id="extractYear" style="display: none">
    <button onclick="extractDataYear()" class="clsMenu">+</button>
    <div class="title">Extraction d'une promo de PST</div>
    <form class="extractCat" action="" method="post">
        <select class="selectDataYear" name="selectDataYear" id="selectDataYear">
            <option value="2">2e année</option>
            <option value="3">3e année</option>
            <option value="4">4e année</option>
        </select>
        <input type="submit" name="extractDataYear" id="extractDataYear" style="display: none">
        <label for="extractDataYear" class="bigButton">Extraire PST de la promo</label>
    </form>
</div>

<div class="extractForm" id="extractAll" style="display: none;">
    <button onclick="extractDataAll()" class="clsMenu">+</button>
    <div class="title">Extraction d'une promo de PST</div>
    <form class="extractCat" action="" method="post">
        <input type="submit" name="extractDataAll" id="extractDataAll" style="display: none">
        <label for="extractDataAll" class="bigButton mid">Extraire tous les PST</label>
    </form>
</div>

<?php
    foreach ($projects as $element) {
        $formTxt = printWithoutSpaces('formExtract'.$element['name']);
        if (isset($_POST[$formTxt])) {
            $pathToProject = '../../../../src/data/projects/'.$element['name'].'/';
            $pathToINFO     = '../../../../src/data/extracts/'.$element['name'];
            extractOneProjectUnderZIP($pathToProject, $pathToINFO);
            if (is_file($pathToINFO.'.zip')) {
                downloadINFO($element['name'], $pathToINFO.'.zip');
            } else {
                echo 'L\'archive n\'existe pas. Cela peut être à cause de l\'absence de projet(s) correspondant aux critères</br>';
            }
        }
    }

    if (isset($_POST['extractDataMine'])) {
        $pathToProjects = '../../../../src/data/projects/';
        $pathToINFO      = '../../../../src/data/extracts/MesPST';
        extractMyProjectsUnderZIP($pathToProjects, $pathToINFO);
        if (is_file($pathToINFO.'.zip')) {
            downloadINFO('Mes suivis de PST', $pathToINFO.'.zip');
        } else {
            echo 'L\'archive n\'existe pas. Cela peut être à cause de l\'absence de projet(s) correspondant aux critères</br>';
        }
    }

    if (isset($_POST['extractDataYear']) && isset($_POST['selectDataYear'])) {
        $pathToProjects = '../../../../src/data/projects/';
        $pathToINFO      = '../../../../src/data/extracts/'.$_POST['selectDataYear'].'e année';
        extractYearProjectsUnderZIP($pathToProjects, $pathToINFO, $_POST['selectDataYear']);
        if (is_file($pathToINFO.'.zip')) {
            downloadINFO('PST '.$_POST['selectDataYear'].'e année', $pathToINFO.'.zip');
        } else {
            echo 'L\'archive n\'existe pas. Cela peut être à cause de l\'absence de projet(s) correspondant aux critères</br>';
        }
    }

    if (isset($_POST['extractDataAll'])) {
        $pathToProjects = '../../../../src/data/projects/';
        $pathToINFO      = '../../../../src/data/extracts/PST';
        extractAllProjectsUnderZIP($pathToProjects, $pathToINFO);
        if (is_file($pathToINFO.'.zip')) {
            downloadINFO('Tous les PST', $pathToINFO.'.zip');
        } else {
            echo 'L\'archive n\'existe pas. Cela peut être à cause de l\'absence de projet(s) correspondant aux critères</br>';
        }
    }
?>

<div class="extractForm" id="extractMark" style="display: none;">
    <button onclick="extractDataMark()" class="clsMenu">+</button>
    <div class="title">Extraction des notes</div>
    <form class="extractCat" action="" method="post">
        <input type="submit" name="extractDataMark" id="extractDataMark" style="display: none">
        <label for="extractDataMark" class="bigButton mid">Extraire toutes les notes</label>
    </form>
</div>

<div class="extractForm" id="extractOrder" style="display: none;">
    <button onclick="extractDataOrder()" class="clsMenu">+</button>
    <div class="title">Extraction des consignes de progression</div>
    <form class="extractCat" action="" method="post">
        <input type="submit" name="extractDataOrder" id="extractDataOrder" style="display: none">
        <label for="extractDataOrder" class="bigButton mid">Extraire toutes les consignes</label>
    </form>
</div>

<div class="extractForm" id="extractReport" style="display: none;">
    <button onclick="extractDataReport()" class="clsMenu">+</button>
    <div class="title">Extraction des consignes de depot</div>
    <form class="extractCat" action="" method="post">
        <input type="submit" name="extractDataReport" id="extractDataReport" style="display: none">
        <label for="extractDataReport" class="bigButton mid">Extraire toutes les consignes de dépot</label>
    </form>
</div>

<?php $students = getAllStudent(); ?>

<div class="extractForm" id="extractStudent" style="display: none;">
    <button onclick="extractDataStudent()" class="clsMenu">+</button>
    <div class="title">Extraction d'un étudiant</div>
    <input class="searchStudent" type="text" onkeyup="searchStudent()" placeholder="Rechercher un étudiant" id="searchStudentInput">
    <form class="allStudents" id="allStudents" action="" method="post">
        <?php
            foreach($students as $element) { ?>
                <div class="student">
                    <input type="submit" name="formExtractStudent<?= $element['id'] ?>" id="formExtractStudent<?= $element['id'] ?>" style="display: none;">
                    <label class="nameStudent" for="formExtractStudent<?= $element['id'] ?>"><?= $element['username'] ?><span>Extraire</span></label>
                </div>
            <?php }
        ?>
    </form>
</div>


<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////                   EXTRACTION DES DONNEES                   //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_POST['extractDataMark'])) {
        $pathToCSV = '../../../../src/data/extracts/';
        exportMarks($pathToCSV);

        if (is_file($pathToCSV.'marks.csv')) {
            downloadINFO('Les notes des projets', $pathToCSV.'marks.csv');
        } else {
            echo 'Le fichier n\'existe pas. Cela peut être à cause de l\'absence d\'information(s) correspondant aux critères</br>';
        }
    }

    foreach ($students as $student) {
        if (isset($_POST['formExtractStudent'.$student['id']])) {
            $pathToCSV = '../../../../src/data/extracts/';
            exportStudent($student['id'], $pathToCSV);

            if (is_file($pathToCSV.'infoStudent.csv')) {
                downloadINFO('Les informations de : '.$student['username'], $pathToCSV.'infoStudent.csv');
            } else {
                echo 'Le fichier n\'existe pas. Cela peut être à cause de l\'absence d\'information(s) correspondant aux critères</br>';
            }
        }
    }

    if (isset($_POST['extractDataOrder'])) {
        $pathToCSV = '../../../../src/data/extracts/';
        exportOrders($pathToCSV);

        if (is_file($pathToCSV.'orders.csv')) {
            downloadINFO('Les consignes des projets', $pathToCSV.'orders.csv');
        } else {
            echo 'Le fichier n\'existe pas. Cela peut être à cause de l\'absence d\'information(s) correspondant aux critères</br>';
        }
    }

    if (isset($_POST['extractDataReport'])) {
        $pathToCSV = '../../../../src/data/extracts/';
        exportReports($pathToCSV);

        if (is_file($pathToCSV.'reports.csv')) {
            downloadINFO('Les consignes de dépot de fichier des projets', $pathToCSV.'reports.csv');
        } else {
            echo 'Le fichier n\'existe pas. Cela peut être à cause de l\'absence d\'information(s) correspondant aux critères</br>';
        }
    }
 ?>
