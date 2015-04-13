<?php

/**
 * Asset URL Helper
 *
 * This function grants access to the assets folder
 *
 * @usage echo asset_url().'string';
 * @return string
 */
function asset_url(){
    return base_url().'assets/';
}

