<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/9/2015
 * Time: 2:35 PM
 */
$nodeSearch=$_REQUEST["nodeSearch"];
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$query = $_REQUEST["query"];
$hint = "";
if($query !=""){
    $nodeSearch = $xml->getElementsByTagName($nodeSearch);
    $nodeSize  = $nodeSearch->length;
    $query = strtolower($query); //make query lowercase ,for better comparison
    $len=strlen($query); //get lenght for substring function
    for ($nodeIndex = 0; $nodeIndex < $nodeSize; $nodeIndex++) {
        $nodeValue=$nodeSearch->item($nodeIndex)->nodeValue;
        $nodeValueLowerCase = strtolower($nodeValue); //make query lowercase ,for better comparison
        if (stristr($query, substr($nodeValueLowerCase, 0, $len))){
            if ($hint === "") {
                $hint = $nodeValue;
            } else {
                $hint .= ", $nodeValue";
            }

        }

    }
echo $hint;



}
?>