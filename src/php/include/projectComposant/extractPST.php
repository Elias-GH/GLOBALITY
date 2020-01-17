<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////            EXTRACTION DE FICHIERS SOUS ARCHIVES            //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // 3 ETAPES D'EXTRACTION DE PROJET :
    //      - MISE DE LA DEMANDE SOUS FORMAT ZIP
    //      - TELECHARGEMENT DU DOSSIER COMPRESSE
    //      - SUPPRESSION DU DOSSIER COMPRESSE

    function exportDataProject($projectName) {
        global $db;
        $name         = basename($projectName);
        $p            = getPSTWithName($name);
        $titleGEN     = array("INFORMATIONS ".$name);
        $projectPART  = array("LE PROJET :");
        $actorGEN     = array("LES ACTEURS DU PROJETS");
        $actionPART   = array("LES ACTIONS :");

        $file = fopen($projectName.'.csv', "w");
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($file, $titleGEN, ";");

        $projectId             = array("Identifiant",                       $p['id']);
        $projectName           = array("Nom du projet",                     $p['name']);
        $projectYear           = array("Année du PST",                      $p['year']);
        $projectCat            = array("Catégorie du projet",               $p['category']);
        $projectFollower       = array("Suiveur :",                         convertIdToName($p['idFollower']));
        $projectDescription    = array("Description du projet",             $p['description']);
        $projectProjectManager = array("Chef de projet :",                  convertIdToName($p['idProjectManager']));
        $projectMember2        = array("Membre 2 :",                        convertIdToName($p['idMember2']));
        $projectMember3        = array("Membre 3 :",                        convertIdToName($p['idMember3']));
        $projectMember4        = array("Membre 4 :",                        convertIdToName($p['idMember4']));
        $projectMember5        = array("Membre 5 :",                        convertIdToName($p['idMember5']));
        $projectStep           = array("Etape du PST",                      $p['step']);
        $markS1                = array("Note du projet S1  /20 :",          $p['markS1']);
        $markInterm            = array("Note du bilan intermediaire  /20",  $p['markInterm']);
        $markTech              = array("Note du TechDay  /42",              $p['markTech']);
        $markFin               = array("Note de la soutenance finale  /15", $p['markFin']);
        $markGen               = array("Note Finale du projet  /20",        $p['markGen']);

        fputcsv($file, $projectId            , ";");
        fputcsv($file, $projectName          , ";");
        fputcsv($file, $projectYear          , ";");
        fputcsv($file, $projectCat           , ";");
        fputcsv($file, $projectFollower      , ";");
        fputcsv($file, $projectDescription   , ";");
        fputcsv($file, $projectProjectManager, ";");
        fputcsv($file, $projectMember2       , ";");
        fputcsv($file, $projectMember3       , ";");
        fputcsv($file, $projectMember4       , ";");
        fputcsv($file, $projectMember5       , ";");
        fputcsv($file, $projectStep          , ";");
        fputcsv($file, $markS1               , ";");
        fputcsv($file, $markInterm           , ";");
        fputcsv($file, $markTech             , ";");
        fputcsv($file, $markFin              , ";");
        fputcsv($file, $markGen              , ";");

        fclose($file);
    }

    function extractProject($projectName, $projectPath, $targetDir, $zip, $zipName) {
         exportDataProject($projectPath.$projectName);
        // echo $projectName.'</br>';
        $dirProject = scandir($projectPath.$projectName);
        // var_dump($dirProject);
        if (isset($dirProject[2])) {
            $codesDir    = scandir($targetDir.$projectName.'/'.$dirProject[2].'/');
        }
        if (isset($dirProject[3])) {
            $filesDir    = scandir($targetDir.$projectName.'/'.$dirProject[3].'/');
        }
        if (isset($dirProject[4])) {
            $picturesDir = scandir($targetDir.$projectName.'/'.$dirProject[4].'/');
        }
        if (isset($dirProject[5])) {
            $reportDir   = scandir($targetDir.$projectName.'/'.$dirProject[5].'/');
        }
        if (isset($dirProject[6])) {
            $sharesDir   = scandir($targetDir.$projectName.'/'.$dirProject[6].'/');
        }

        // CREATION DE L'ARCHIVE ZIP
        if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
            exit("Impossible d'ouvrir le fichier '$zipName'\n");
        }

        $k = 2;
        $l = 2;
        while (isset($codesDir[$l])) {
            // echo $targetDir.$projectName.'/'.$dirProject[$k].'/'.$codesDir[$l].'</br>';
            $zip->addFile($targetDir.$projectName.'/'.$dirProject[$k].'/'.$codesDir[$l], $projectName.'/'.$dirProject[$k].'/'.$codesDir[$l]);
            $l++;
        }
        $k++;
        $l = 2;
        // echo '</br>';
        while (isset($filesDir[$l])) {
            // echo $targetDir.$projectName.'/'.$dirProject[$k].'/'.$filesDir[$l].'</br>';
            $zip->addFile($targetDir.$projectName.'/'.$dirProject[$k].'/'.$filesDir[$l], $projectName.'/'.$dirProject[$k].'/'.$filesDir[$l]);
            $l++;
        }
        $k++;
        $l = 2;
        // echo '</br>';
        while (isset($picturesDir[$l])) {
            // echo $targetDir.$projectName.'/'.$dirProject[$k].'/'.$picturesDir[$l].'</br>';
            $zip->addFile($targetDir.$projectName.'/'.$dirProject[$k].'/'.$picturesDir[$l], $projectName.'/'.$dirProject[$k].'/'.$picturesDir[$l]);
            $l++;
        }
        $k++;
        $l = 2;
        // echo '</br>';
        while (isset($reportDir[$l])) {
            // echo $targetDir.$projectName.'/'.$dirProject[$k].'/'.$reportDir[$l].'</br>';
            $zip->addFile($targetDir.$projectName.'/'.$dirProject[$k].'/'.$reportDir[$l], $projectName.'/'.$dirProject[$k].'/'.$reportDir[$l]);
            $l++;
        }
        $k++;
        $l = 2;
        // echo '</br>';
        while (isset($sharesDir[$l])) {
            // echo $targetDir.$projectName.'/'.$dirProject[$k].'/'.$sharesDir[$l].'</br>';
            $zip->addFile($targetDir.$projectName.'/'.$dirProject[$k].'/'.$sharesDir[$l], $projectName.'/'.$dirProject[$k].'/'.$sharesDir[$l]);
            $l++;
        }
        echo $projectPath.$projectName.'.csv</br>';
        $zip->addFile($targetDir.$projectName.'.csv', basename($targetDir.$projectName).'.csv');
        $zip->close();
    }

    function extractOneProjectUnderZIP($targetPath, $newName) {
         // EXTRACTION DES INFORMATIONS GENERALES
         echo $newName;
         exportDataProject($newName);

        // INITIALISATION DE L'ARCHIVE ZIP
        $targetDir   = $targetPath;
        if (is_dir($targetDir)) {
            // echo $targetDir.'</br>';
            // OUVERTRE DE L'ARCHIVE ZIP
            $zip           = new ZipArchive();
            $zipName     = $newName.'.zip';
            $rootDir     = scandir($targetDir);
            if (isset($rootDir[2])) {
                // echo $targetDir.$rootDir[2].'/</br>';
                $codesDir    = scandir($targetDir.$rootDir[2].'/');
            }
            if (isset($rootDir[3])) {
                $filesDir    = scandir($targetDir.$rootDir[3].'/');
            }
            if (isset($rootDir[4])) {
                $picturesDir = scandir($targetDir.$rootDir[4].'/');
            }
            if (isset($rootDir[5])) {
                $reportDir   = scandir($targetDir.$rootDir[5].'/');
            }
            if (isset($rootDir[6])) {
                $sharesDir   = scandir($targetDir.$rootDir[6].'/');
            }

            // CREATION DE L'ARCHIVE ZIP
            if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
                exit("Impossible d'ouvrir le fichier '$zipName'\n");
            }

            $i = 2;
            $j = 2;
            while (isset($codesDir[$j])) {
                // echo $targetDir.'/'.$rootDir[$i].'/'.$codesDir[$j].'</br>';
                $zip->addFile($targetDir.'/'.$rootDir[$i].'/'.$codesDir[$j], $rootDir[$i].'/'.$codesDir[$j]);
                $j++;
            }
            $i++;
            $j = 2;
            // echo '</br>';
            while (isset($filesDir[$j])) {
                // echo $targetPath.$targetDir.'/'.$rootDir[$i].'/'.$filesDir[$j].'</br>';
                $zip->addFile($targetDir.'/'.$rootDir[$i].'/'.$filesDir[$j], $rootDir[$i].'/'.$filesDir[$j]);
                $j++;
            }
            $i++;
            $j = 2;
            // echo '</br>';
            while (isset($picturesDir[$j])) {
                // echo $targetDir.'/'.$rootDir[$i].'/'.$picturesDir[$j].'</br>';
                $zip->addFile($targetDir.'/'.$rootDir[$i].'/'.$picturesDir[$j], $rootDir[$i].'/'.$picturesDir[$j]);
                $j++;
            }
            $i++;
            $j = 2;
            // echo '</br>';
            while (isset($reportDir[$j])) {
                // echo $targetDir.'/'.$rootDir[$i].'/'.$reportDir[$j].'</br>';
                $zip->addFile($targetDir.'/'.$rootDir[$i].'/'.$reportDir[$j], $rootDir[$i].'/'.$reportDir[$j]);
                $j++;
            }
            $i++;
            $j = 2;
            // echo '</br>';
            while (isset($sharesDir[$j])) {
                // echo $targetDir.'/'.$rootDir[$i].'/'.$sharesDir[$j].'</br>';
                $zip->addFile($targetDir.'/'.$rootDir[$i].'/'.$sharesDir[$j], $rootDir[$i].'/'.$sharesDir[$j]);
                $j++;
            }

            $zip->addFile($newName.'.csv', basename($newName));

            // FERMETURE DE L'ARCHIVE ZIP
            $zip->close();

        } else {
            echo 'Le dossier situé à : '.$targetDir.' n\'existe pas </br>';
        }
    }

    function extractMyProjectsUnderZIP($targetPath, $newName) {
        global $db;
        // INITIALISATION DE L'ARCHIVE ZIP
        $targetDir   = $targetPath;
        if (is_dir($targetDir)) {
            // OUVERTRE DE L'ARCHIVE ZIP
            $zip           = new ZipArchive();
            $zipName     = $newName.'.zip';
            $rootDir     = scandir($targetDir);
            $projectsFollower = getPSTForFollower($_SESSION['id']);

            $i = 2;
            while (isset($rootDir[$i])) {
                $projectRoot = $rootDir[$i];
                foreach($projectsFollower as $project) {
                    if ($project['name'] == $projectRoot) {
                        extractProject($project['name'], $targetPath, $targetDir, $zip, $zipName);
                    }
                }
                $i++;
            }
        } else {
            echo 'Le dossier situé à : '.$targetDir.' n\'existe pas </br>';
        }
    }

    function extractYearProjectsUnderZIP($targetPath, $newName, $year) {
        // INITIALISATION DE L'ARCHIVE ZIP
        $targetDir   = $targetPath;
        if (is_dir($targetDir)) {
            // OUVERTRE DE L'ARCHIVE ZIP
            $zip          = new ZipArchive();
            $zipName      = $newName.'.zip';
            $rootDir      = scandir($targetDir);
            $projectsYear = getPSTByYear($year);

            $i = 2;
            while (isset($rootDir[$i])) {
                $projectRoot = $rootDir[$i];
                foreach($projectsYear as $project) {
                    if ($project['name'] == $projectRoot) {
                        extractProject($project['name'], $targetPath, $targetDir, $zip, $zipName);
                    }
                }
                $i++;
            }
        } else {
            echo 'Le dossier situé à : '.$targetDir.' n\'existe pas </br>';
        }
    }

    function extractAllProjectsUnderZIP($targetPath, $newName) {
        // INITIALISATION DE L'ARCHIVE ZIP
        $targetDir   = $targetPath;
        if (is_dir($targetDir)) {
            // OUVERTRE DE L'ARCHIVE ZIP
            $zip          = new ZipArchive();
            $zipName      = $newName.'.zip';
            $rootDir      = scandir($targetDir);
            $allProjects = getAllPST();

            $i = 2;
            while (isset($rootDir[$i])) {
                $projectRoot = $rootDir[$i];
                foreach($allProjects as $project) {
                    if ($project['name'] == $projectRoot) {
                        extractProject($project['name'], $targetPath, $targetDir, $zip, $zipName);
                    }
                }
                $i++;
            }
        } else {
            echo 'Le dossier situé à : '.$targetDir.' n\'existe pas </br>';
        }
    }

    function downloadINFO($name, $pathToFile) {
        echo '<a href="'.$pathToFile.'" class="downloadINFO">
            Télécharger l\'archive
            <div class="info">
                <p class="category"><blue>'.$name.'</blue> </p>
            </div>
            Cliquer sur pour télécharger
        </a>';
    }

    function eraseINFO($pathToFile) {
        if (!unlink($pathToFile)) {
            echo "Erreur de suppresion de l'archive de fichier";
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////                   EXTRACTION DES DONNEES                   //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function exportReports($targetPath) {
        global $db;
        $exportReportSQL = "SELECT year, type, title, description, deadLine FROM reportorders";
        $exportReport    = $db->prepare($exportReportSQL);
        $exportReport->execute();

        $categories[] = array('Promo','Type','Titre', 'Description', 'Deadline');
        $file = fopen($targetPath.'reports.csv','w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        foreach ($categories as $category){
            fputcsv($file, $category, ";");
        }

        while ($data = $exportReport->fetch(PDO::FETCH_NUM)) {
            $data = array_map("utf8_decode", $data);
            fputcsv($file, $data, ";");
        }
        fclose($file);
    }

    function exportOrders($targetPath) {
        global $db;
        $exportOrdersSQL = "SELECT year, step, titleStep, contentOrder, deadLine FROM orderprojects";
        $exportOrders    = $db->prepare($exportOrdersSQL);
        $exportOrders->execute();

        $categories[] = array('Année','Etape','Titre étape', 'Contenu', 'Deadline');
        $file = fopen($targetPath.'orders.csv','w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        foreach ($categories as $category){
            fputcsv($file, $category, ";");
        }

        while ($data = $exportOrders->fetch(PDO::FETCH_NUM)) {
            $data = array_map("utf8_decode", $data);
            fputcsv($file, $data, ";");
        }
        fclose($file);
    }

    function selectMark($year) {
        global $db;
        $selectMarksSQL = "SELECT markS1, markGen, markInterm, markTech, markFin FROM projects WHERE year = :year";
        $selectMarks = $db->prepare($selectMarksSQL);
        $selectMarks->execute(['year' => $year]);

        $marks = array();

        while ($e = $selectMarks->fetch()) {
            array_push($marks, $e);
        }

        return $marks;
    }

    function calcAverage($marks) {
        $average = 0;
        $size = 0;
        foreach($marks as $mark) {
            $average = $average + $mark['markGen'];
            if ($mark['markGen'] != NULL) {
                $size++;
            }
        }
        if ($size != 0) {
            return $average/$size;
        } else {
            return 0;
        }
    }

    function exportMarks($targetPath) {
        global $db;
        $cpt = 2;
        $exportMarksSQL  = "SELECT name, year, markS1, markInterm, markTech, markFin, markGen FROM projects";
        $exportMarks     = $db->prepare($exportMarksSQL);
        $exportMarks->execute();

        $mark2A = selectMark(2);
        $mark3A = selectMark(3);
        $mark4A = selectMark(4);

        $file = fopen($targetPath.'marks.csv','w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        $categories[] = array('Titre projet', 'Année', 'NoteS1 /20', 'Note Bilan Intermédiaire /20', 'Note TechDay /42', 'Note Soutenance Finale /15', 'Note Général /20');

        foreach ($categories as $category){
            fputcsv($file, $category, ";");
        }

        while ($data = $exportMarks->fetch(PDO::FETCH_NUM)) {
            $data = array_map("utf8_decode", $data);
            fputcsv($file, $data, ";");
            $cpt++;
        }

        $spaces = array('');
        fputcsv($file, $spaces, ";");

        $averageGEN = array('Moyenne tout projet : ', '=MOYENNE(G2:G'.$cpt.')');
        $average2A  = array('Moyenne 2e année', str_replace(".", ",", calcAverage($mark2A)));
        $average3A  = array('Moyenne 3e année', str_replace(".", ",", calcAverage($mark3A)));
        $average4A  = array('Moyenne 4e année', str_replace(".", ",", calcAverage($mark4A)));

        fputcsv($file, $averageGEN, ";");
        fputcsv($file, $average2A,  ";");
        fputcsv($file, $average3A,  ";");
        fputcsv($file, $average4A,  ";");
        fclose($file);
    }

    function exportStudent($idStudent, $targetPath) {
        global $db;
		$infoStudent = array();

        $exportUserTableSQL    = "SELECT username, email FROM users WHERE id = :id";
        $exportUserTable       = $db->prepare($exportUserTableSQL);
        $exportUserTable->execute(['id' => $idStudent]);

        $exportProjectTableSQL = "SELECT name, category, description, year, step, markS1, markInterm, markTech, markFin, markGen FROM projects WHERE idProjectManager = :id OR idMember2 = :id OR idMember3 = :id OR idMember4 = :id OR idMember5 = :id";
        $exportProjectTable    = $db->prepare($exportProjectTableSQL);
        $exportProjectTable->execute(['id' => $idStudent]);

		$exportActionsTableSQL = "SELECT title, description, dateAction FROM actionsinproject WHERE idAuthor = :id";
		$exportActionsTable    = $db->prepare($exportActionsTableSQL);
		$exportActionsTable->execute(['id' => $idStudent]);

		$space         = array(' ');
		$titleGen      = array('INFORMATIONS GENERALES :');
		$titleProject  = array('PROJETS :');
		$titleAction   = array('ACTIONS :');

        $file = fopen($targetPath.'infoStudent.csv', 'w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

		$infoStudent['infoGen'] = array();
		fputcsv($file, $titleGen, ";");
        while($e = $exportUserTable->fetch()) {
			$infoStudent['infoGen']['username'] = $e['username'];
			$infoStudent['infoGen']['email']   = $e['email'];
        }
		$infoStudent['projects'] = array();
        while ($e = $exportProjectTable->fetch()) {
			array_push($infoStudent['projects'], $e);
        }
		$infoStudent['actions'] = array();
		while ($e = $exportActionsTable->fetch()) {
			array_push($infoStudent['actions'], $e);

		}

		$usernameInfo = array('Nom de l\'étudiant :', $infoStudent['infoGen']['username']);
		$emailInfo    = array('email :', $infoStudent['infoGen']['email']);
		fputcsv($file, $usernameInfo, ";");
		fputcsv($file, $emailInfo, ";");
		fputcsv($file, $space, ";");
		fputcsv($file, $titleProject, ";");
		foreach ($infoStudent['projects'] as $project) {
			$projectName        = array('Nom du projet',                      $project['name']);
			$projectCategory    = array('Catégorie du projet',                $project['category']);
			$projectDescription = array('Description du projet',              $project['description']);
			$projectYear        = array('Année du PST',                       $project['year']);
			$projectStep        = array('Etape du PST',                       $project['step']);
			$projectMarkS1      = array('Note du projet S1  /20',             $project['markS1']);
               $projectMarkInterm  = array('Note du bilan intermediaire  /20',   $project['markInterm']);
               $projectMarkTech    = array('Note du TechDay  /42',               $project['markTech']);
               $projectMarkFinal   = array('Note de la soutenance finale  /15',  $project['markFin']);
               $projectMarkGen     = array('Note Finale du projet  /20',         $project['markGen']);

			fputcsv($file, $projectName,        ";");
			fputcsv($file, $projectCategory,    ";");
			fputcsv($file, $projectDescription, ";");
			fputcsv($file, $projectYear,        ";");
			fputcsv($file, $projectStep,        ";");
			fputcsv($file, $projectMarkS1,      ";");
               fputcsv($file, $projectMarkInterm,  ";");
               fputcsv($file, $projectMarkTech,    ";");
               fputcsv($file, $projectMarkFinal,   ";");
               fputcsv($file, $projectMarkGen,     ";");
			fputcsv($file, $space,              ";");
		}
		fputcsv($file, $titleAction, ";");
		foreach ($infoStudent['actions'] as $action) {
			$newAction         = array_map('utf8_decode',          $action);
			$actionTitle       = array('Titre de l\'action',       $newAction['title']);
			$actionDescription = array('Description de l\'action', $newAction['description']);
			$actionDate        = array('Date de l\'action',        $newAction['dateAction']);

			fputcsv($file, $actionTitle,       ";");
			fputcsv($file, $actionDescription, ";");
			fputcsv($file, $actionDate,        ";");
			fputcsv($file, $space,             ";");
		}

        fclose($file);
    }
?>
