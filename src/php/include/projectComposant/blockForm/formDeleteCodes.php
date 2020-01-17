<div class="pop" id="pop" style="display: block">
    <h3 class="title">Supprimer Codes</h3>
    <button type="button" class="clsMenu" name="button" onclick="clsPop()">+</button>
    <form class="deleteFiles" action="#" method="post" enctype="multipart/form-data">
        <?php
            $pathToFiles = '../../../../src/data/projects/'.$project['name'].'/';
            // echo 'path : '.$pathToFiles.'</br>';


            $allCodes = scandir($pathToFiles.'codes/');
            // var_dump($allDocuments);

            if ($cptCodes == 0)  {
                echo '<p class="information">Aucun documents disponible </br></p>';
            } else {
                for($i = 2; $i <= $cptCodes+1; $i++) {
                    printDeleteElement('Codes', $allCodes[$i], $i);
                }
            }
         ?>
    </form>
</div>
