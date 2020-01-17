<?php
    if (isset($_FILES['fileLessonS1'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalLessonS1 = count($_FILES['fileLessonS1']['name']);

        for ($i = 0; $i < $totalLessonS1; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileLessonS1']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileLessonS1']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileLessonS1']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileLessonS1']['size'][$i]);
            $file_error = $_FILES['fileLessonS1']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/LessonsS1/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                } else {
                    echo 'Error Uploading file ! </br>';
                }
            }
        }
    }

    if (isset($_FILES['fileLessonS2'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalLessonS2 = count($_FILES['fileLessonS2']['name']);

        for ($i = 0; $i < $totalLessonS2; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileLessonS2']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileLessonS2']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileLessonS2']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileLessonS2']['size'][$i]);
            $file_error = $_FILES['fileLessonS2']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/LessonsS2/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['fileTDS1'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalTDS1 = count($_FILES['fileTDS1']['name']);

        for ($i = 0; $i < $totalTDS1; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileTDS1']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileTDS1']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileTDS1']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileTDS1']['size'][$i]);
            $file_error = $_FILES['fileTDS1']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/TDS1/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['fileTDS2'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalTDS2 = count($_FILES['fileTDS2']['name']);

        for ($i = 0; $i < $totalTDS2; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileTDS2']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileTDS2']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileTDS2']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileTDS2']['size'][$i]);
            $file_error = $_FILES['fileTDS2']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/TDS2/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['fileTPS1'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        // var_dump($_FILES['fileLessonS1']);
        $totalTPS1 = count($_FILES['fileTPS1']['name']);
        echo 'enter in </br>';
        for ($i = 0; $i < $totalTPS1; $i++) {
            echo 'enter in for </br>';
            $file_name  = htmlspecialchars($_FILES['fileTPS1']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileTPS1']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileTPS1']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileTPS1']['size'][$i]);
            $file_error = $_FILES['fileTPS1']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/TPS1/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['fileTPS2'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        // var_dump($_FILES['fileLessonS1']);
        $totalTPS2 = count($_FILES['fileTPS2']['name']);

        for ($i = 0; $i < $totalTPS2; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileTPS2']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileTPS2']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileTPS2']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileTPS2']['size'][$i]);
            $file_error = $_FILES['fileTPS2']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/TPS2/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['fileProjects'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalProjects = count($_FILES['fileProjects']['name']);

        for ($i = 0; $i < $totalProjects; $i++) {
            $file_name  = htmlspecialchars($_FILES['fileProjects']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['fileProjects']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['fileProjects']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['fileProjects']['size'][$i]);
            $file_error = $_FILES['fileProjects']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/Projects/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }

    if (isset($_FILES['filePerso'])) {
        $_GET['promo'] = htmlspecialchars($_GET['promo']);
        $totalPerso = count($_FILES['filePerso']['name']);

        for ($i = 0; $i < $totalPerso; $i++) {
            $file_name  = htmlspecialchars($_FILES['filePerso']['name'][$i]);
            $file_type  = htmlspecialchars($_FILES['filePerso']['type'][$i]);
            $file_tmp   = htmlspecialchars($_FILES['filePerso']['tmp_name'][$i]);
            $file_size  = htmlspecialchars($_FILES['filePerso']['size'][$i]);
            $file_error = $_FILES['filePerso']['error'][$i];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'pdf', 'zip');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    $file_destination = '../../../src/data/class/'.$_SESSION['username'].'/'.$_GET['promo'].'/info/filePerso/'.$file_name;

                    if (!file_exists($file_destination)) {
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            include '../../../src/php/include/lessonsComposant/moveFileSuccess.php';
                            echo '<script>window.location="infoInformatic.php?promo='.$_GET['promo'].'"</script>';
                        } else {
                            include '../../../src/php/include/lessonsComposant/moveFileDenied.php';
                        }
                    } else {
                        include '../../../src/php/include/lessonsComposant/fileAlreadyExists.php';
                    }
                }
            }
        }
    }


 ?>
