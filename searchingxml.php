<?php
include 'xmlFunction.php';
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("contactList.xml");
$xml->preserveWhiteSpace = false;
echo "null";





$imageList = $xml->getElementsByTagName('office');
$imageCnt  = $imageList->length;
$d;

$z;
for ($idx = 0; $idx < $imageCnt; $idx++) {
    if ($imageList->item($idx)->nodeValue=="7654321"){

        $d=$imageList->item($idx);

    }

}

//come in text
$x=0;
while($d->parentNode->nodeName != "contact"){
    echo"\n". $d->parentNode->nodeName;
    echo "inloop";
 $x++;
    if($x==20){
        break;
        echo "inloop";
    }
$d=$d->parentNode;
    echo"\n". $d->parentNode->nodeName;
if ($d->parentNode->nodeName=="contact"){
    $d=$d->parentNode;
    print "\n"."tes";
    break;
}

}


    $d->preserveWhiteSpace=false;
    print '<div>';
    //print removeSpaceBetweenCapitalization($zy->nodeName);
    //print' : '. $d->hasSiblings();
    print '</div>';
    //$d=$d->nextSibling;
/*
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

$numberOfElementInParentNode = $d->childNodes->length;
for($pos=0; $pos<$numberOfElementInParentNode; $pos++){
    $childInCurrentNode=$d->childNodes->item($pos)->childNodes->length;

  if ($childInCurrentNode >1){
      print"<div>";
      print $d->childNodes->item($pos)->nodeName;//->childNodes->item($);
      print"</div>";
      for($posSubNode=0 ;$posSubNode<$childInCurrentNode;$posSubNode++){
          print"<div>";
          print $d->childNodes->item($pos)->childNodes->item($posSubNode)->nodeName."\n";
          print $d->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue."\n";
          print"</div>";
      }
  }
    else{
        print"<div>";
        print $d->childNodes->item($pos)->nodeName;
         print $d->childNodes->item($pos)->nodeValue;
        print"</div>";

    }
}

?>