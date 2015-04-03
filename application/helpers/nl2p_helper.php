<?php

/**
* New Line To Paragraph
*
* This function takes any newlines found in a string and inserts opening and closing paragraph tags.
* This is highly useful when pulling large project abstract text from the database
*
* @usage $this->functions->nl2p($string);
* @param $string
* @return string
*/
function nl2p($string) {

$string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);
return '<p>' . preg_replace(
    array("/([\n]{2,})/i", "/([\r\n]{3,})/i", "/([^>])\n([^<])/i"),
    array("</p>\n<p>", "</p>\n<p>", '$1<br' .  '>$2'),
    trim($string)) .
    '</p>';
}