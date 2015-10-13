
<?php
include 'xmlFunction.php';

$html="";
$htmlFile = file_get_contents("addToXml.html");
$xml = new DOMDocument();
$xml->load("contactList.xml");
$root   = $xml->documentElement;
//creating id =epochTime+rndnumber
$grdId=(string)time().(string) rand(1,99);
//getting data from post
$pstFirstName= $_POST['firstName'];
$pstLastName= $_POST['lastName'];
$pstNickName= $_POST['nickName'];
$pstGender= $_POST['gender'];
$pstDateOfBirth= $_POST['dateOfBirth'];
$pstCity= $_POST['city'];
$pstStreet= $_POST['street'];
$pstCountry= $_POST['country'];
$pstPostalCode= $_POST['postalCode'];
$pstOfficeEmail= $_POST['officeEmail'];
$pstPrivateEmail= $_POST['privateEmail'];
$pstPrivateMobile= $_POST['privateMobile'];
$pstOffice= $_POST['office'];
$imageName =$_FILES["fileToUpload"]["name"];



//finish saving all post to variable
$firstNode  = $root;
//contact node <contact>
$contactNode=$xml->createElement("contact");
//inside contact <contact> <image>dedferfr
$id=$xml->createElement("id",$grdId);
//check if TargetFile have only path
if($imageName==""){
    $image=$xml->createElement("image","image/anonymous.png"); //no image
}
else{

    $info = pathinfo($_FILES['fileToUpload']['name']);
    $RandomName = uniqid();
    $ext = $info['extension']; // get the extension of the file
    if ($ext == "jpg" || $ext == "jpeg" || $ext == "gif" ){

        $newImageName = $RandomName . "." . $ext;
        $target = 'image/' . $newImageName;
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target);
        $image = $xml->createElement("image", $target);
    }
    else {
        $image=$xml->createElement("image","image/anonymous.png"); //no mage ,image rejected


    }

}
$firstName=$xml->createElement("firstName",$pstFirstName);
$lastName=$xml->createElement("lastName",$pstLastName);
$gender=$xml->createElement("gender",$pstGender);
$nickName=$xml->createElement("nickName",$pstNickName);
$dateOfBirth=$xml->createElement("dateOfBirth",$pstDateOfBirth);
//appending element
$root->appendChild($contactNode);
$contactNode->appendChild($id);
$contactNode->appendChild($image);
$contactNode->appendChild($firstName);
$contactNode->appendChild($lastName);
$contactNode->appendChild($gender);
$contactNode->appendChild($nickName);
$contactNode->appendChild($dateOfBirth);
//create postal
$postalNode=$xml->createElement("postalDetails");
//append postal to contact node
$contactNode->appendChild($postalNode);
//add postal child
$city=$xml->createElement("city",$pstCity);
$street=$xml->createElement("street",$pstStreet);
$postalCode=$xml->createElement("postalCode",$pstPostalCode);
$country=$xml->createElement("country",$pstCountry);
$postalNode->appendChild($city);
$postalNode->appendChild($street);
$postalNode ->appendChild($postalCode);
$postalNode->appendChild($country);
//create Email
$emailsNode=$xml->createElement("emails");
//append emails to contact node
$contactNode->appendChild($emailsNode);
//add emails child
$officeEmail=$xml->createElement("officeEmail",$pstOfficeEmail);
$privateEmail=$xml->createElement("privateEmail",$pstPrivateEmail);
$emailsNode->appendChild($officeEmail);
$emailsNode->appendChild($privateEmail);
//create telephoneNumbers
$telephoneNumbersNode=$xml->createElement("telephoneNumbers");
//append emails to contact node
$contactNode->appendChild($telephoneNumbersNode);
//add emails child
$privateMobile=$xml->createElement("privateMobile",$pstPrivateMobile);
$office=$xml->createElement("office",$pstOffice);
$telephoneNumbersNode->appendChild($privateMobile);
$telephoneNumbersNode->appendChild($office);

//validate the xml before saving

if (!$xml->schemaValidate('contactListSchema.xsd')) {
    $value=libxml_display_errors();
$dr=$value;
appendToHtml('
    <div class="alert alert-danger alert-fixed-bottom" id="alertMsg">
  <strong>Warning !!!!</strong>' .$dr.'
<button onclick="hideAlert()">Make Modification</button>"</div>');

}else{ //save the xml is validation o.k
    $xml->save("contactList.xml");
    appendToHtml('
    <div class="alert alert-success alert-fixed-bottom" id="alertMsg">
  <strong>Success!</strong>
<button onclick="goToMainPage()">Go to main Page</button>"</div>');

}





$html = str_replace("{{alert}}", $html, $htmlFile); // replaces placeholder with $username

echo $html;




?>

