<?php
    if (isset($_FILES['fileAddDoc'])) {
        // var_dump($_FILES);
        $_POST['selectYear'] = htmlspecialchars($_POST['selectYear']);
        $totalFile = count($_FILES['fileAddDoc']['name']);

        for ($i = 0; $i < $totalFile; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileAddDoc']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileAddDoc']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileAddDoc']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileAddDoc']['size'][$i]);
            $file_error = $_FILES['fileAddDoc']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip', 'pptx', 'xlsx', 'docx');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../src/data/teacherFiles/'.$_SESSION['username'].'/class/'.$_POST['selectYear'].'/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="teacherFiles.php"</script>';
                        } else {
                            include '../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                } else {
                    echo 'Error Uploading file ! </br>';
                }
            } else {
                echo 'Error type of file !</br>';
            }
        }
    }

    for ($i = 1; $i <= 5; $i++) {
        $pathToClass = '../../src/data/teacherFiles/'.$_SESSION['username'].'/class/'.$i.'/';
        $dirClass = scandir($pathToClass);
        $dirClassSize = getSizeArray($dirClass);
        for ($j = 0; $j < $dirClassSize; $j++) {
            if (isset($_POST['formDeleteDoc'.$i.'Y_'.$j.'D'])) {
                $pathToFile = $pathToClass.$dirClass[$j];
                if (!unlink($pathToFile)) {
                    echo $dirClass[$j].' n\'a pas été supprimé </br>';
                } else {
                    echo $dirClass[$j].' a été supprimé </br>';
                    echo '<script>window.location="teacherFiles.php"</script>';
                }
            }
        }
    }


    if (isset($_FILES['fileAddDocProject'])) {
        var_dump($_FILES);
        $_POST['selectYearProject'] = htmlspecialchars($_POST['selectYearProject']);
        $totalFile = count($_FILES['fileAddDocProject']['name']);

        for ($i = 0; $i < $totalFile; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileAddDocProject']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileAddDocProject']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileAddDocProject']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileAddDocProject']['size'][$i]);
            $file_error = $_FILES['fileAddDocProject']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../src/data/teacherFiles/'.$_SESSION['username'].'/projects/'.$_POST['selectYearProject'].'/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="teacherFiles.php"</script>';
                        } else {
                            include '../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                } else {
                    echo 'Error Uploading file ! </br>';
                }
            }
        }
    }

    for ($i = 2; $i <= 4; $i++) {
        $pathToProject = '../../src/data/teacherFiles/'.$_SESSION['username'].'/projects/'.$i.'/';
        $dirProject = scandir($pathToProject);
        $dirProjectSize = getSizeArray($dirProject);
        for ($j = 0; $j < $dirProjectSize; $j++) {
            if (isset($_POST['formDeleteDoc'.$i.'Y_'.$j.'D'])) {
                $pathToFile = $pathToProject.$dirProject[$j];
                if (!unlink($pathToFile)) {
                    echo $dirProject[$j].' n\'a pas été supprimé </br>';
                } else {
                    echo $dirProject[$j].' a été supprimé </br>';
                    echo '<script>window.location="teacherFiles.php"</script>';
                }
            }
        }
    }
 ?>
