<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2006 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.13
 * CAPTCHA Plugin
 * Based on Mod by Abbas ali(http://coppermine-gallery.net/forum/index.php?topic=29564.0)
 * Plugin Writen by bmossavari at gmail dot com
 */

define("IN_COPPERMINE", true);
require('include/init.inc.php');

/**
 * Fonts to create the captch image
 */
$aFonts = array('plugins/captcha/fonts/acidic.ttf', 'plugins/captcha/fonts/hurryup.ttf');
// create new image
$oPhpCaptcha = new PhpCaptcha(
    $aFonts, // array of TrueType fonts to use
    145, // width of image
    45, // height of image
    5, // number of characters to draw
    70, // number of noise lines to draw
    false, // add shadow to generated characters to further obscure code
    $sOwnerText = 'Coppermine Captcha v3.0', // add owner text to bottom of CAPTCHA, usually your site address
    $aCharSet = array(), // array of characters to select from - if blank uses upper case A - Z
    $sBackgroundImage = '' // background image to use - if blank creates image with white background
    );
$code = $oPhpCaptcha->Create();

$ip = $_SERVER['REMOTE_ADDR'];
// add user ip and captcha code to captcha table
$query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_captcha (time,ip_addr,code) VALUES (NOW(),'$ip','$code')";
cpg_db_query($query);

?>