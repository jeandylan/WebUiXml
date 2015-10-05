<?php
include 'xmlFunction.php';
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");






$nodeSearch = $xml->getElementsByTagName('firstName');
$nodeLenght  = $nodeSearch->length;
$dataIsInThisNode;

/*solution for 2 + node having same data being search for
 * store them in an array while searching.
 * to a for loop on the array element  to get parent node
 * to a for loop on the array to dislay information.
 *
 *
 */
for ($nodeIndex = 0; $nodeIndex < $nodeLenght; $nodeIndex++) {

    if ($nodeSearch->item($nodeIndex)->nodeValue=="John"){

        $dataIsInThisNode=$nodeSearch->item($nodeIndex);

    }

}


$whileLoopControler=0;//a loop controller to prevent below loop from overflowing
while($dataIsInThisNode->nodeName !="contact"){

    $dataIsInThisNode=$dataIsInThisNode->parentNode;
    $whileLoopControler++;
    if($whileLoopControler>20)//loop can run a max of 20 times else break help to prevent bad input
    {
        break;
    }
}










//print removeSpaceBetweenCapitalization($zy->nodeName);
//print' : '. $d->hasSiblings();

//$d=$d->nextSibling;
/*~~~~this is decending i.e from top node to bottom
 *numberOfNode= numberof node in rootParent (contact) ~typically 9
 * pos=counter
 * for pos<numberOfNode
 * childInCurrentNode=node[pos]->haveMoreChild->lenght //get number of child in noDe}
 * if (childIncurrentNode >1): i.e more iteration is expected to get subChild{
 *    print nodeName(noText is Expected)
 *    posOfSubNode=0 //counter to keep tract of which subChildWe are
 *     for pos < childInCurrentParentNode:
 *       print  nameof subNode;
 *       print text in subchild ($d->childNode->item(pos)->childNode->item(posOfSubNode)->text)
 * }
 * else{
 * print nodeName[pos](using function to put space between CamelNotation i.e abCd => ab Cd
 * print text in node[pos]
 *
 *
 *
 *
*/

$htmlFile = file_get_contents("modifyXmlTemplate.html");

$numberOfElementInParentNode = $dataIsInThisNode->childNodes->length;
for($pos=0; $pos<$numberOfElementInParentNode; $pos++){
    $childInCurrentNode=$dataIsInThisNode->childNodes->item($pos)->childNodes->length;

    if ($childInCurrentNode >1){

        print removeSpaceBetweenCapitalization($dataIsInThisNode->childNodes->item($pos)->nodeName);//->childNodes->item($);

        for($posSubNode=0 ;$posSubNode<$childInCurrentNode;$posSubNode++){

            $nodeName=$dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeName;
            $nodeText=$dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue;
            switch ($nodeName) {
                case "city":
                    $htmlFile = str_replace("{{city}}",$nodeText , $htmlFile);
                    break;
                case "street":
                    $htmlFile = str_replace("{{street}}",$nodeText , $htmlFile);
                    break;
                case "postalCode":
                    $htmlFile = str_replace("{{postalCode}}",$nodeText, $htmlFile);
                    break;
                case "officeEmail":
                    $htmlFile = str_replace("{{officeEmail}}",$nodeText, $htmlFile);
                    break;
                case "privateEmail":
                    $htmlFile = str_replace("{{privateEmail}}",$nodeText, $htmlFile);
                    break;
                case "privateMobile":
                    $htmlFile = str_replace("{{privateMobile}}",$nodeText, $htmlFile);
                    break;
                case "office":
                    $htmlFile = str_replace("{{office}}",$nodeText, $htmlFile);
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
                $htmlFile = str_replace("{{firstName}}",$nodeText , $htmlFile);
                break;
            case "lastName":
                $htmlFile = str_replace("{{lastName}}",$nodeText , $htmlFile);
                break;
            case "nickName":
                $htmlFile = str_replace("{{nickName}}",$nodeText, $htmlFile);
                break;

              default:
                break;
        }

    }
}
echo $htmlFile;
?>