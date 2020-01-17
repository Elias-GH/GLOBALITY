<?php
function affichage(){
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=globalityesiea;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}4

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT PST FROM users WHERE username ='".$_SESSION['username']."'');

// On affiche chaque entrée une à une
/*while ($donnees = $reponse->fetch())
{*/
?>
    
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête
}
?>