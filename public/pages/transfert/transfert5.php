<?php
    function transfert(){
        $ret        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_type   = '';
        $img_nom    = '';
        $taille_max = 250000000000;
        $ret        = is_uploaded_file($_FILES['fichier']['tmp_name']);
        
        if (!$ret) {
            echo "Problème de transfert";
            return false;
        } else {
            // Le fichier a bien été reçu
            $img_taille = $_FILES['fichier']['size'];
            
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }

            $PST = $_POST['PSTName'];
            $pst_user1 = $_POST['élève1P'];
			$pst_user2 = $_POST['élève2P'];
			$pst_user3 = $_POST['élève3P'];
			$pst_user4 = $_POST['élève4P'];
			$pst_user5 = $_POST['élève5P'];
			$username = $_SESSION['username'];
			include ("connexion.php");
			$img_blob = file_get_contents ($_FILES['fichier']['tmp_name']);
			
			$req = "UPDATE users set PST =" .
                            "'" . $PST . "', pst_user1 = " .
                            "'" . $pst_user1 . "', pst_user2 = " .
                            "'" . $pst_user2 . "',pst_user3 = " .
                            "'" . $pst_user3 . "', pst_user3 = " .
                            "'" . $pst_user3 . "',pst_user4 = " .
                            "'" . $pst_user4 . "', pst_user5 = " .
                            "'" . $pst_user5 . "', pst_user6 = " .
                            "'" . '/' . "', fichier =" .
                            "'" . addslashes ($img_blob) . "'  WHERE username ='".$_SESSION['username']."' ";
        $ret = mysql_query ($req) or die (mysql_error ());
        return true;
        }
    }
?>