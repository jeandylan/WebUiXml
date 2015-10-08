<?php
setcookie("edit", "grrg", time()+3600, "/","", 0);
setcookie("delete", "", time()+3600, "/","", 0);
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/6/2015
 * Time: 11:11 PM
 */

if ($_POST["edit"]) {
  echo "ask for editing";

    $contactId = $_POST["edit"];


    $query_string = "contactId={$contactId}";
    $url = "modifyPhp.php?" . $query_string;

    header('Location:'. $url);
}
elseif ($_POST["delete"]) {

    $contactId = $_POST["delete"];


    $query_string = "contactId={$contactId}";
    $url = "deleteXmlFile.php?" . $query_string;
    header('Location:'.$url);
}

?>