<?php

/**
 * String Max Length
 *
 * This function will take a string and reduce its size if it is over 100 characters.
 * This can be useful for display snippets.
 *
 * @usage echo '<p>' . maxLength($string) . '...</p>';
 * @param $string
 * @return string
 */
function maxLength($string) {
    $maxLength = 100;

    if (strlen($string) > $maxLength) {
        $stringCut = substr($string, 0, $maxLength);
        $string = substr($stringCut, 0, strrpos($stringCut, ' '));
    }

    return $string;
}

