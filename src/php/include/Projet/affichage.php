<?php
$user = $_SESSION['username'];
	 include ("connexion2.php");
	 $user = $_SESSION['username'];
         $reponse = $bdd->query("SELECT PST FROM users WHERE username='$user'");
         $PSTNom = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT pst_user1 FROM users WHERE username='$user'");
         $PSTMembre1 = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT pst_user2 FROM users WHERE username='$user'");
         $PSTMembre2 = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT pst_user3 FROM users WHERE username='$user'");
         $PSTMembre3 = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT pst_user4 FROM users WHERE username='$user'");
         $PSTMembre4 = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT pst_user5 FROM users WHERE username='$user'");
         $PSTMembre5 = $reponse->fetch();
         $reponse->closeCursor();
	     $reponse = $bdd->query("SELECT pst_user6 FROM users WHERE username='$user'");
         $PSTMembre6 = $reponse->fetch();
         $reponse->closeCursor();
		 $reponse = $bdd->query("SELECT fichier FROM users WHERE username='$user'");
        
         $reponse->closeCursor();
		
		 
		 
?>