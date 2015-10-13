<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/1/2015
 * Time: 6:46 PM
 */

$xml=simplexml_load_file("contactList.xml") or die("Error: Cannot create object");





$html="";
$htmlFile = file_get_contents("viewAllXml.html"); // opens template.html






appendToHtml(' <form role="form" action="Dispatcher.php" method="post">');


$nodeNumber=0;
$id;
foreach($xml->children() as $child) {
    $html = $html . '<div class="row SolidBorder container-fluid "><div class="row">';
    appendToHtml(removeSpaceBetweenCapitalization($child->getName()).'</div>');
$nodeNumber++;


    foreach ($child->children() as $subchild) {
        if ($subchild->getName() =="id") {
           $id=$subchild;
            continue;
        }
        appendToHtml("<div class='row'>");

        //if it is an image jump to next for loop (assumng image has no Child)
        if ($subchild->getName() =="image") {
            appendToHtml('<img src="'.$subchild.'" alt="..." class="img-rounded">');
            continue;
        }
        if ($subchild->children() != "") {
            appendToHtml('<span class="h4 text-danger "><strong>' . removeSpaceBetweenCapitalization($subchild->getName()) . "</strong></span>". '</div>');
        }

        if ($subchild->children() == "") {
            appendToHtml('<span class="h4 text-primary">' . removeSpaceBetweenCapitalization($subchild->getName()) . "</span>" . " : " . '<em>' . $subchild . '</em>' . '</div>');}

            foreach ($subchild->children() as $subsubChil) {

                appendToHtml("<div class='row'>");
                appendToHtml('<span class="h4 text-primary">'.removeSpaceBetweenCapitalization($subsubChil->getName()).'</span>'. " : ".'<em>'.$subsubChil.'</em>'.'</div>');

                //echo $subsubChil->getName() . ": " . $subsubChil . ";
                //appendToHtml("<\div>");

            }

        }

    appendToHtml('<p>
  <button class="btn btn-large btn-primary" type="submit" value="'.$id.'" name="edit">edit</button>
  <button class="btn btn-large btn-danger" value="'.$id.'" type="submit" name="delete">delete button</button>
</p>' );

}
appendToHtml("</form>");
    $html=$html.'</div></div>';

$html = str_replace("{{contactData}}", $html, $htmlFile); // replaces placeholder with $username

echo $html;





function removeSpaceBetweenCapitalization($String){

    $Words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $String);
return $Words;

}

//takes the global html value refering to contact id in Addcontatc.html and append new data to it
function appendToHtml($html1){
global $html;

    $html =$html.$html1;
}

?>