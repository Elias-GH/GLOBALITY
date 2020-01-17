<?php
    if (isset($_POST['formAccessLessons'])) {
        if (!is_dir('../../src/data/class/')) {
            mkdir('../../src/data/class/');
        }
        // mkdir('../../src/data/class/'.$_SESSION['username'].'/', 0777);
        if (!is_dir('../../src/data/class/'.$_SESSION['username'].'/1/')) {
            mkdir('../../src/data/class/'.$_SESSION['username'].'/');
            $subject = array('info', 'elec', 'meca', 'maths');
            for ($i = 1; $i <= 3; $i++) {
                mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/');
                for ($j = 0; $j < 4; $j++) {
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/');

                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/LessonsS1/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/LessonsS2/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/TDS1/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/TDS2/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/TPS1/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/TPS2/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/Projects/');
                    mkdir('../../src/data/class/'.$_SESSION['username'].'/'.$i.'/'.$subject[$j].'/filePerso/');
                }
            }
            echo 'Votre dossier de stockage a été créer avec succès !';
        } else {
            echo 'Le dossier de leçon existe déjà !';
        }
    }

    if (isset($_POST['formAccessStorage'])) {
        if (!is_dir('../../src/data/teacherFiles/')) {
            mkdir('../../src/data/teacherFiles/');
        }
        if (!is_dir('../../src/data/teacherFiles/'.$_SESSION['username'].'/')) {
            mkdir('../../src/data/teacherFiles/'.$_SESSION['username'].'/');
            mkdir('../../src/data/teacherFiles/'.$_SESSION['username'].'/class/');
            mkdir('../../src/data/teacherFiles/'.$_SESSION['username'].'/projects/');
            for ($i = 1; $i <= 5; $i++) {
                mkdir('../../src/data/teacherFiles/'.$_SESSION['username'].'/class/'.$i.'/');
            }
            for ($i = 2; $i <= 4; $i++) {
                mkdir('../../src/data/teacherFiles/'.$_SESSION['username'].'/projects/'.$i.'/');
            }
            echo 'Votre dossier de stockage a été créer avec succès !';
        } else {
            echo 'Le dossier de stockage existe déjà !';
        }
    }

 ?>
