<?php

include('inc/head.php');

if (empty($_GET)) {

    $errors = 'choisir un fichier';

}else{

    $fileToEdit = $_GET['filetoedit'];
}
?>

<div class="row">
    <div class="col-md-6 separation">

        <?php
        function parcourtDossier($chemin, $level) {


        if (is_dir($chemin)) {
        // c'est un dossier

        // ouvre le dossier
        if ($handle = opendir($chemin)) {

        // liste de tout ce qu'on va trouver
        $dirFiles = array();

        // récupère la liste des fichiers/dossiers
        while (false !== ($entry = readdir($handle))) {
        $dirFiles[] = $entry;
        }

        // trie dans l'ordre alpha
        sort($dirFiles, SORT_NATURAL | SORT_FLAG_CASE);

        // affiche la liste triée
        foreach($dirFiles as $entry) {

        if ($entry != "." && $entry != "..") {

        if (is_dir($chemin.'/'.$entry)) {

        // affiche le nom du dossier
        if ($level == 0) {
        $b1 = '<div style="width:100%; padding:1px; margin-top:0px;">|--<img src="assets/images/gfiles.png"><b style="padding-left:20px; ">';
                $b2 = '</b></div>';
        }
        if ($level == 1) {
        $b1 = '<div style="width:100%; padding:1px; margin-top:5px;">|---<img src="assets/images/sfiles.png"><b style="padding-left:20px;">';
                $b2 = '</b></div>';
        }

        // rajouter des niveaux si besoin

        echo $b1;
        echo '<b>'.$entry.'</b></a><form action="src/deletedir.php" method="POST" name="formulaire" class="alignform">
        <input type="hidden" name="delfilename" value="'.$chemin.'/'.$entry.'"/><button  class="btn-default" type="submit" value="" style="background-color: transparent;text-decoration:none;border: none" ><img src="assets/images/poub.png"></button>
        </form>';

        echo $b2;


        // affiche le contenu du dossier
        echo '<div style="margin-left:40px; margin-top:4px;">';
            parcourtDossier($chemin.'/'.$entry, $level + 1);
            echo '</div>';
        }
        else {
        // $chemin est un un fichier
        // affiche un lien pour le télécharge
        ?>

        |---<img src="assets/images/file.png" alt="visualiser"><a href="<?= $chemin.'/'.$entry; ?>" target="_blank"><?= ' '.$entry; ?></a>

         <?php

         $fichier= $chemin.'/'.$entry;
         $info = new SplFileInfo($fichier);
         $extension = $info->getExtension();
         if ($extension == 'txt' || $extension == 'html' || $extension == 'php' || $extension == 'css'){

         echo '<a href="index.php?filetoedit='.$fichier.'"><img src="assets/images/pencil.png"></a><form action="src/delete.php" method="POST" name="formulaire" class="alignform">
         <input type="hidden" name="delfilename" value="'.$fichier.'"/><button  class="btn-default" type="submit" value="" style="background-color: transparent;text-decoration:none;border: none" ><img src="assets/images/poub.png"></button>
         </form><br/>';

         }else{

             echo '<a href="'.$fichier.'" target="_blank"><img src="assets/images/eye.png"></a></a><form action="src/delete.php" method="POST" name="formulaire" class="alignform">
        <input type="hidden" name="delfilename" value="'.$fichier.'"/><button  class="btn-default" type="submit" value="" style="background-color: transparent;text-decoration:none;border: none" ><img src="assets/images/poub.png"></button>
        </form><br/>';

         }

        }

        }
        }
        closedir($handle);
        }

        } else {
        // $chemin est un fichier
        // utilisé seulement dans le cas où on le paramètre est un nom de fichier
        if ($chemin != "." && $chemin != "..") {
        echo '<a href="'.$chemin.'" target="_blank">'.$chemin.'</a><br/>';
        }
        }
        }

        parcourtDossier("files", 0);

        ?>
    </div>
    <div class="col-md-6 ">
        <div class="col-xs-12 titlefile text-center">-----<?php if (!empty ($fileToEdit)){ echo $fileToEdit;}else{ echo 'HELP';} ?>-----</div>


        <?php
        if (empty ($fileToEdit)){
            $contenu= "Cliquer sur le nom d'un fichier pour l'ouvrir \n\n> icone crayon pour modifier un fichier \n> icone oeil pour visualiser une image \n> icone corbeille pour supprimer un fichier";

        }else{
        $contenu= file_get_contents($fileToEdit);}

        ?>

        <form method="POST" action="src/add.php" class="text-center">
            <input type="hidden" name="fichier" value="<?= $fileToEdit ?>"/>
            <textarea id="myTextArea" name="contenu" style="width: 100%;text-align:left;"><?= $contenu ?></textarea>
            ----------<?php if (!empty ($fileToEdit)){ echo '<button  class="btn-default btn-sm " type="submit" value="">Save this X-File</button>';}else{ echo 'X-FILES BASH';} ?>----------

        </form>

    </div>

</div>


<?php include('inc/foot.php'); ?>