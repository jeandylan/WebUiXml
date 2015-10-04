<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 10/2/2015
 * Time: 11:27 AM
 */
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