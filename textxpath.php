<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/7/2015
 * Time: 12:34 AM
 */
$xml = new DomDocument;
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$xpathOfNode = new DomXPath($xml);

$dataIsInThisNode = $xpathOfNode->query($nodePath);
/contactLists/contact[1]
?>