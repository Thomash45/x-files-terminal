<?php
/**
 * Created by PhpStorm.
 * User: mrtho
 * Date: 19/04/2018
 * Time: 18:38
 */

if (isset($_POST['contenu'])){

    $fichier= '../'.$_POST['fichier'];
    $file=fopen($fichier,"w");
    fwrite($file,$_POST["contenu"]);
    fclose($file);
    header('Location: ../index.php');
    exit();

}