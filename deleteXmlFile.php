                                                                                                                                                                                                                                     <?php
$id= $_GET["contactId"];
//echo $xpath;
print $id;
libxml_use_internal_errors(true); //use for debugging
$xml = new DomDocument;
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$nodeSearch = $xml->getElementsByTagName("id");
$nodeLenght  = $nodeSearch->length;


/*solution for 2 + node having same data being search for
 * store them in an array while searching.
 * to a for loop on the array element  to get parent node
 * to a for loop on the array to dislay information.
 *
 *
 */
print $nodeLenght;
for ($nodeIndex = 0; $nodeIndex < $nodeLenght; $nodeIndex++) {

    if ($nodeSearch->item($nodeIndex)->nodeValue==$id){

        $nodeToBeRemove=$nodeSearch->item($nodeIndex);

    }

}


$whileLoopControler=0;//a loop controller to prevent below loop from overflowing
while($nodeToBeRemove->nodeName !="contact"){

    $nodeToBeRemove=$nodeToBeRemove->parentNode;
    $whileLoopControler++;
    if($whileLoopControler>20)//loop can run a max of 20 times else break help to prevent bad input
    {
        break;
    }

}

//start of removale
print $nodeToBeRemove->getNodePath();
deleteNode($nodeToBeRemove);

function deleteNode($node) {
    deleteChildren($node);
    $parent = $node->parentNode;
    $oldnode = $parent->removeChild($node);
}
function deleteChildren($node) {
    while (isset($node->firstChild)) {
        deleteChildren($node->firstChild);
        $node->removeChild($node->firstChild);
}
}
echo $xml->save("contactList.xml");
?>