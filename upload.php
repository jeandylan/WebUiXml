<?php
$imgdata = $_POST['imgdata'];
$ifp = fopen("newimage.jpg", "wb");
$data = explode(',', $imgdata);
fwrite($ifp, base64_decode($data[1]));
fclose($ifp);

?>