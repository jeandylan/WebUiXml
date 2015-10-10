
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
$pstGender= $_POST['Gender'];
$pstDateOfBirth= $_POST['dateOfBirth'];
$pstCity= $_POST['city'];
$pstStreet= $_POST['street'];
$pstCountry= $_POST['country'];
$pstPostalCode= $_POST['postalCode'];
$pstOfficeEmail= $_POST['officeEmail'];
$pstPrivateEmail= $_POST['privateEmail'];
$pstPrivateMobile= $_POST['privateMobile'];
$pstOffice= $_POST['office'];
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = str_replace(' ', '_', $target_file);


//finish saving all post to variable
$firstNode  = $root;
//contact node <contact>
$contactNode=$xml->createElement("contact");
//inside contact <contact> <image>dedferfr
$id=$xml->createElement("id",$grdId);
//check if TargetFile have only path
if($target_file=="image/"){
    $image=$xml->createElement("image","image/anonymous.png"); //no image
}
else{
$image=$xml->createElement("image",$target_file);}
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
  <strong>Success!</strong>' .$dr.'
<button onclick="goToMainPage()">Go to main Page</button>"</div>');

}



/*
 * file upload
 * */

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

$html = str_replace("{{alert}}", $html, $htmlFile); // replaces placeholder with $username

echo $html;




?>

