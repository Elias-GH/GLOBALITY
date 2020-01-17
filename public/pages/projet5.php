<?php
    session_start();
    include '../../src/php/composantPage/header.php';
    include '../../src/php/composantPage/includeCSS/projectCSS.php';
?>

<script src="../../src/js/scroll.js" charset="utf-8"></script>

<a href="home.php" class="returnMenu"><i class="fas fa-undo"></i></a>

<div class="header">
    <div class="header-content">
        <h1 class="header-title">Projects <blue>ESIEA</blue></h1>
        <nav class="header-menu">
            <a href="#" class="link">1er Année</a>
            <a href="#" class="link">2e Année</a>
            <a href="#" class="link">3e Année</a>
        </nav>
    </div>
</div>

<div class="tutorials">
    
		<form method="post" enctype="multipart/form-data">
	 
	<label for="PSTName">Nom du PST :</label><br />
	<input type="text" name="PSTName" value="" id="titre" /><br />
	 
	  <label for="PSTStudentName">Identifiant de l'élève 1 :</label><br />
      <input type="text" value="" name="élève1P" /><br />
	 
	  <label for="PSTStudentName">Identifiant de l'élève 2 :</label><br />
     <input type="text" value="" name="élève2P" /><br />
	 
	  <label for="PSTStudentName">Identifiant de l'élève 3 :</label><br />
     <input type="text" value="" name="élève3P" /><br />
	
	 <label for="PSTStudentName">Identifiant de l'élève 4 :</label><br />
     <input type="text" value="" name="élève4P" /><br />
	 
	 <label for="PSTStudentName">Identifiant de l'élève 5 :</label><br />
     <input type="text"  value="" name="élève5P" /><br />
	 
     <label for="description">Description de votre PST :</label><br />
     <textarea name="description" id="description"></textarea><br />
	 
	  <label for="mon_fichier">Fichier (format .zip) :</label><br 	
     <input type="hidden" name="NOM" value="1048576" />
	 
     <input type="file" name="fichier" id="mon_fichier" /><br />
     <input type="submit" name="submit" value="Envoyer" />

</form>
<?php
		include ("transfert/transfert5.php");
		 if ( isset($_FILES['fichier']) )
         {
             transfert();
         }
		 
		 ?>
	
</div>

<?php
    include '../../src/php/composantPage/footer.php';
 ?>