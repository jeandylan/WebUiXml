<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/6/2015
 * Time: 12:57 AM
 */

$xpath= $_POST["xpath"];
echo $xpath;
libxml_use_internal_errors(true); //use for debugging
$xml = new DomDocument;
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$xpathOfNode = new DomXPath($xml);
$nodes = $xpathOfNode->query($xpath);
$numberOfElementInParentNode=$nodes->item(0)->childNodes->length;
$childInCurrentNode;
$dataIsInThisNode=$nodes->item(0);
echo $numberOfElementInParentNode;
for($pos=0; $pos<$numberOfElementInParentNode; $pos++){
    $childInCurrentNode=$dataIsInThisNode->childNodes->item($pos)->childNodes->length;

    if ($childInCurrentNode >1){

        //print removeSpaceBetweenCapitalization($dataIsInThisNode->childNodes->item($pos)->nodeName);//->childNodes->item($);

        for($posSubNode=0 ;$posSubNode<$childInCurrentNode;$posSubNode++){

            $nodeName=$dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeName;

            switch ($nodeName) {
                case "city":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['city'];
                    break;
                case "street":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['street'];
                    break;
                case "postalCode":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['postalCode'];
                    break;
                case "officeEmail":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['officeEmail'];
                    break;
                case "privateEmail":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['privateEmail'];
                    break;
                case "privateMobile":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['privateMobile'];
                    break;
                case "office":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['office'];
                    break;
                default:
                    break;
            }

        }
    }
    else{

        $nodeName=$dataIsInThisNode->childNodes->item($pos)->nodeName;
        $nodeText=$dataIsInThisNode->childNodes->item($pos)->nodeValue;
        switch ($nodeName) {
            case "firstName":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['firstName'];
                break;
            case "lastName":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['lastName'];
                break;
            case "nickName":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['nickName'];
                break;

            default:
                break;
        }

    }
}
$xml->save("contactList.xml");
echo "changes sucessful";

?>