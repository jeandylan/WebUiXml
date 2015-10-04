
<?php



$xml = new DOMDocument();
$xml->load("contactList.xml");
$root   = $xml->documentElement;
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

//finish saving all post to variable
$firstNode  = $root;
//contact node <contact>
$contactNode=$xml->createElement("contact");
//inside contact <contact> <image>dedferfr
$image=$xml->createElement("image",$pstFirstName); //no image
$firstName=$xml->createElement("firstName",$pstFirstName);
$lastName=$xml->createElement("lastName",$pstLastName);
$gender=$xml->createElement("gender",$pstGender);
$nickName=$xml->createElement("nickName",$pstNickName);
$dateOfBirth=$xml->createElement("dateOfBirth",$pstDateOfBirth);
$root->appendChild($contactNode);
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
$xml->save("contactList.xml");

// xml;

;
?>

