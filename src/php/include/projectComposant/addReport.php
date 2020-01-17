<?php
    global $project;
    $reportByYear = reportByYear($project['year']);
    $nbReport = getSizeArray($reportByYear);

    for ($i = 0; $i < $nbReport; $i++) {
        if (isset($_FILES['addFile-'.$i])) {
            $file_name  = $_FILES['addFile-'.$i]['name'];
            $file_type  = $_FILES['addFile-'.$i]['type'];
            $file_tmp   = $_FILES['addFile-'.$i]['tmp_name'];
            $file_size  = $_FILES['addFile-'.$i]['size'];
            $file_error = $_FILES['addFile-'.$i]['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('pdf');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../../src/data/projects/'.$project['name'].'/report/'.$reportByYear[$i]['title'].'.'.$file_ext;
                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="reportFiles.php?year='.$_GET['year'].'"</script>';
                        } else {
                            include '../../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        // include '../../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                        unlink($file_destination);
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="reportFiles.php?year='.$_GET['year'].'"</script>';
                        } else {
                            include '../../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    }
                } else {
                    echo 'Error Uploading file ! </br>';
                    echo 'file error : '.$file_error.'</br>';
                }
            }
        }
    }

 ?>
