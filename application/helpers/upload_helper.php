<?php


/**
 * Upload URL Helper
 *
 * This function grants access to the uploads folder
 *
 * @usage echo upload_url().'string';
 * @return string
 */
function upload_url(){
    return base_url().'uploads/';
}

