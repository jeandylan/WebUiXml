<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/6/2015
 * Time: 12:57 AM
 */
include 'xmlFunction.php';
$xpath= $_POST["xpath"];
echo $xpath;


$html="";
$htmlFile = file_get_contents("modifyXmlTemplate.html");


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
                case "country":
                    $dataIsInThisNode->childNodes->item($pos)->childNodes->item($posSubNode)->nodeValue=$_POST['country'];
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
            case "gender":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['gender'];
                break;

            case "lastName":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['lastName'];
                break;
            case "nickName":
                $dataIsInThisNode->childNodes->item($pos)->nodeValue=$_POST['nickName'];
                break;
            //image case
            case "image":
                //image $target_dir = "image/";
                $target_dir = "image/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $target_file = str_replace(' ', '_', $target_file);
                if($target_file!="image/"){
                    $dataIsInThisNode->childNodes->item($pos)->nodeValue=$target_file;
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
// Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
// Check file size

// Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
// Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        } else {

                            exit("image error");
                        }
                    }
                }
                else{

                }

                break;
            default:
                break;
        }

    }
}

//check if shema is validate


if (!$xml->schemaValidate('contactListSchema.xsd')) {
    $value=libxml_display_errors();
    $dr=$value;
    appendToHtml('
    <div class="alert alert-danger alert-fixed-bottom" id="alertMsg">
  <strong>Warning !!!!</strong>' .$dr.'
<button onclick="hideAlert()">Make Modification</button>"</div>');
}

else{ //save the xml is validation o.k
    $xml->save("contactList.xml");
    appendToHtml('
    <div class="alert alert-success alert-fixed-bottom" id="alertMsg">
  <strong>Success!</strong>' .$dr.'
<button onclick="goToMainPage()">Go to main Page</button>"</div>');

}
$html = str_replace("{{alert}}", $html, $htmlFile); // replaces placeholder with $username

echo $html;
?>