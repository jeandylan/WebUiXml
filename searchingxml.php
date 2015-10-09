<?php
include 'xmlFunction.php';
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$pstDataSearch= $_POST['dataSearch'];
$pstnodeSearch= $_POST['nodeSearch'];





$nodeSearch = $xml->getElementsByTagName($pstnodeSearch);
$nodeLenght  = $nodeSearch->length;
$dataIsInThisNode;
print $nodeLenght;

/*solution for 2 + node having same data being search for
 * store them in an array while searching.
 * to a for loop on the array element  to get parent node
 * to a for loop on the array to dislay information.
 *
 *
 */
$foundSearch=array(); //store item with matching data within search criteria
for ($nodeIndex = 0; $nodeIndex < $nodeLenght; $nodeIndex++) {

    if ($nodeSearch->item($nodeIndex)->nodeValue==$pstDataSearch){

        $dataIsInThisNode=$nodeSearch->item($nodeIndex);
        array_push($foundSearch,$dataIsInThisNode); //push the matching data to array
    }

}

foreach ($foundSearch as &$dataIsInThisNode) {
    $whileLoopControler = 0;//a loop controller to prevent below loop from overflowing
    while ($dataIsInThisNode->nodeName != "contact") {

        $dataIsInThisNode = $dataIsInThisNode->parentNode;
        $whileLoopControler++;
        if ($whileLoopControler > 20)//loop can run a max of 20 times else break help to prevent bad input
        {
            break;
        }

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
foreach($foundSearch as &$dataIsInThisNode) { //iterate throw each node with corresponding matching search done before
    echo '<form role="form" action="Dispatcher.php" method="post">';
    $numberOfElementInParentNode = $dataIsInThisNode->childNodes->length;
    for ($pos = 0; $pos < $numberOfElementInParentNode; $pos++) {
        $childInCurrentNode = $dataIsInThisNode->childNodes->item($pos)->childNodes->length;

        if ($childInCurrentNode > 1) {
            print"<div>";
            print removeSpaceBetweenCapitalization($dataIsInThisNode->childNodes->item($pos)->nodeName);//->childNodes->item($);
            print"</div>";
            for ($posSubNode = 0; $posSubNode < $childInCurrentNode; $posSubNode++) {
                print"<div>";
                print removeSpaceBetweenCapitalization($dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeName) . "\n";
                print $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue . "\n";
                print"</div>";
            }
        } else {
            $nodeName = $dataIsInThisNode->childNodes->item($pos)->nodeName;
            $valueInNode = $dataIsInThisNode->childNodes->item($pos)->nodeValue;
            if ($nodeName == "id") {
                $id = $valueInNode;
            }
            print"<div>";
            print removeSpaceBetweenCapitalization($nodeName);
            print"  " . $valueInNode;
            print"</div>";

        }
    }
    echo '<p>
  <button class="btn btn-large btn-primary" type="submit" value="' . $id . '" name="edit">edit</button>
  <button class="btn btn-large btn-danger" value="' . $id . '" type="submit" name="delete">delete button</button>
</p></form>';
}
?>