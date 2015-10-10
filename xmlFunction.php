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
function libxml_display_error($error)
{
    $return = "<br/>\n";
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "<b>Warning $error->code</b>: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "<b>Error $error->code</b>: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "<b>Fatal Error $error->code</b>: ";
            break;
    }
    $return .= trim($error->message);

    $return .= " on line <b>$error->line</b>\n";

    return $return;
}

function libxml_display_errors() {
    $errors = libxml_get_errors();
    $x="";
    foreach ($errors as $error) {
    $x=$x. libxml_display_error($error);
    }
    return $x;
    libxml_clear_errors();
}

// Enable user error handling
libxml_use_internal_errors(true);
?>