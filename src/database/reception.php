<?php
		
		
		function transfert(){
        $ret        = false;
        $img_blob   = '';
        $img_taille = 0;
        $img_nom    = '';
        $taille_max = 500000000;
        $ret        = is_uploaded_file($_FILES['mon_fichier']['tmp_name']);
        
        if (!$ret) {
            echo "Problème de transfert";
            return false;
        } else {
            // Le fichier a bien été reçu
            $img_taille = $_FILES['mon_fichier']['size'];
            
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }

            $img_nom  = $_FILES['mon_fichier']['tmp_name'];
			$img_blob = file_get_contents($_FILES['mon_fichier']['tmp_name']);
			include ('database.php');
			$img_blob = file_get_contents($_FILES['mon_fichier']['tmp_name']);
			$req = "INSERT INTO users(fichier) VALUES ( '. $img_blob . ')";
                             
        $ret = $mysqli->query($req) or die();
		$mysqli->close();
    
	 }
		}
		
		/*
        $ret        = false;
        $img_blob   = '';
		$name 		= htmlspecialchars($_POST['PSTName']);
		$file 		= htmlspecialchars($_POST['mon_fichier']);
        $taille_max = 50000000;
        $ret        = is_uploaded_file($_FILES['mon_fichier']['tmp_name']);
        
        if (!$ret) {
            echo "Problème de transfert";
            return false;
        } else {
            // Le fichier a bien été reçu
            $img_taille = $_FILES[$file]['size'];
            
            if ($img_taille > $taille_max) {
                echo "Trop gros !";
                return false;
            }

			 $img_nom  = $_FILES[$file][$name];
			 include ("connection.php");
        }
		$img_blob = file_get_contents ($_FILES[$file][$name]);
        $req = "INSERT INTO pst (" . 
                                "nom-pst,fichier" .
                                ") VALUES (" .
                                "'" . $img_nom . "', " .
                                "'" . $img_blob . "') ";
        //$ret = mysql_query ($req) or die (mysql_error ());
        //return true;
    */
?>