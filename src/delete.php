<?php
/**
 * Created by PhpStorm.
 * User: mrtho
 * Date: 18/04/2018
 * Time: 00:19
 */

if (!empty($_POST['delfilename'])) {
    $fichier = '../'.$_POST['delfilename'];

    var_dump($fichier);
    echo $fichier;
    if( file_exists ( $fichier))
        unlink( $fichier ) ;
   header('Location: ../index.php');
   exit();
}
