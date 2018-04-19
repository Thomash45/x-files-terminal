<?php
/**
 * Created by PhpStorm.
 * User: mrtho
 * Date: 18/04/2018
 * Time: 00:19
 */


function rmdir_recursive($dir)
{
//Liste le contenu du répertoire dans un tableau
    $dir_content = scandir($dir);
//Est-ce bien un répertoire?
    if($dir_content !== FALSE){
//Pour chaque entrée du répertoire
        foreach ($dir_content as $entry)
        {
//Raccourcis symboliques sous Unix, on passe
            if(!in_array($entry, array('.','..'))){
//On retrouve le chemin par rapport au début
                $entry = $dir . '/' . $entry;
//Cette entrée n'est pas un dossier: on l'efface
                if(!is_dir($entry)){
                    unlink($entry);
                }
//Cette entrée est un dossier, on recommence sur ce dossier
                else{
                    rmdir_recursive($entry);
                }
            }
        }
    }
//On a bien effacé toutes les entrées du dossier, on peut à présent l'effacer
    rmdir($dir);
}

if (!empty($_POST['delfilename'])) {
    $dir = '../'.$_POST['delfilename'];

var_dump($dir);


if (is_dir($dir)) {
    rmdir_recursive($dir);
}


header('Location: ../index.php');
exit();
}
