                                                                                                                                                                                                                                     <?php
$xpath= $_POST['xpath'];
echo $xpath;
libxml_use_internal_errors(true); //use for debugging
$xml = new DomDocument;
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$xpathOfNode = new DomXPath($xml);
$nodes = $xpathOfNode->query($xpath);
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