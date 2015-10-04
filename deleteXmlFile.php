                                                                                                                                                                                                                                     <?php
$xml = new DOMDocument();
$xml->load("contactList.xml");
$root   = $xml->documentElement;
print $root->nodeName;
$imageList = $root->getElementsByTagName('contact');
$nodeToBeRemove= $imageList->item(1);
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