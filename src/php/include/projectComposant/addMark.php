<?php
    if (isset($_POST['formMarkS1']) && $project['idFollower'] == $_SESSION['id'] && htmlspecialchars($_POST['markS1']) >= 0 && htmlspecialchars($_POST['markS1'] <= 20)) {
        $_POST['markS1'] = htmlspecialchars($_POST['markS1']);
        $_GET['title']   = htmlspecialchars($_GET['title']);
        global $db;
        global $project;
        $markSQL = "UPDATE projects SET markS1 = :mark WHERE id = :id";
        $mark = $db->prepare($markSQL);
        $mark->execute([
            'mark' => $_POST['markS1'],
            'id'   => $project['id'],
        ]);

        if ($mark) {
            echo 'New mark has been insert into database ! </br>';
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo 'The mark hasn\'t been insert into database ! </br>';
        }
    }

    if (isset($_POST['formMarkInterm']) && $project['idFollower'] == $_SESSION['id'] && htmlspecialchars($_POST['markInterm']) >= 0 && htmlspecialchars($_POST['markInterm'] <= 20)) {
        $_POST['markInterm'] = htmlspecialchars($_POST['markInterm']);
        $_GET['title']   = htmlspecialchars($_GET['title']);
        global $db;
        global $project;
        $markSQL = "UPDATE projects SET markInterm = :mark WHERE id = :id";
        $mark = $db->prepare($markSQL);
        $mark->execute([
            'mark' => $_POST['markInterm'],
            'id'   => $project['id'],
        ]);

        if ($mark) {
            echo 'New mark has been insert into database ! </br>';
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo 'The mark hasn\'t been insert into database ! </br>';
        }
    }

    if (isset($_POST['formMarkFin']) && $project['idFollower'] == $_SESSION['id'] && htmlspecialchars($_POST['markFin']) >= 0 && htmlspecialchars($_POST['markFin'] <= 15)) {
        $_POST['markFin'] = htmlspecialchars($_POST['markFin']);
        $_GET['title']    = htmlspecialchars($_GET['title']);
        global $db;
        global $project;
        $markSQL = "UPDATE projects SET markFin = :mark, markGen = :markGen WHERE id = :id";
        $mark = $db->prepare($markSQL);
        $markGLB = floatval(str_replace(',', '.', ($project['markTech'] * 5) / 42)) + floatval(str_replace(',', '.', $_POST['markFin']));
        $mark->execute([
            'mark'    => $_POST['markFin'],
            'markGen' => number_format($markGLB, 2, '.', ','),
            'id'      => $project['id'],
        ]);

        if ($mark) {
            echo 'New mark has been insert into database ! </br>';
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo 'The mark hasn\'t been insert into database ! </br>';
        }
    }

    if (isset($_POST['formMarkTech']) && $project['idFollower'] == $_SESSION['id'] && htmlspecialchars($_POST['markTech']) >= 0 && htmlspecialchars($_POST['markTech'] <= 42)) {
        $_POST['markTech'] = htmlspecialchars($_POST['markTech']);
        $_GET['title']     = htmlspecialchars($_GET['title']);
        global $db;
        global $project;
        $markSQL = "UPDATE projects SET markTech = :mark, markGen = :markGen WHERE id = :id";
        $mark = $db->prepare($markSQL);
        $markGLB = floatval(str_replace(',', '.', ($_POST['markTech'] * 5) / 42)) + floatval(str_replace(',', '.', $project['markFin']));
        $mark->execute([
            'mark'    => $_POST['markTech'],
            'markGen' => number_format($markGLB, 2, '.', ','),
            'id'      => $project['id'],
        ]);

        if ($mark) {
            echo 'New mark has been insert into database ! </br>';
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo 'The mark hasn\'t been insert into database ! </br>';
        }
    }

    if (isset($_POST['formFollowPST'])) {
        $_GET['title'] = htmlspecialchars($_GET['title']);
        $followPST     = "UPDATE projects SET idFollower = :idFollower WHERE id = :idProject";
        $follow = $db->prepare($followPST);
        $follow->execute(['idFollower' => $_SESSION['id'], 'idProject' => $project['id']]);

        if ($follow) {
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo "Une erreur est survenue, réessayer ! </br>";
        }
    }

    if (isset($_POST['formUnfollowPST'])) {
        $_GET['title'] = htmlspecialchars($_GET['title']);
        $followPST = "UPDATE projects SET idFollower = :idFollower WHERE id = :idProject";
        $follow = $db->prepare($followPST);
        $follow->execute(['idFollower' => 0, 'idProject' => $project['id']]);

        if ($follow) {
            echo '<script>window.location="infoPST.php?title='.$_GET['title'].'"</script>';
        } else {
            echo "Une erreur est survenue, réessayer ! </br>";
        }
    }

    if (isset($_POST['formDownloadProject'])) {

    }
 ?>
