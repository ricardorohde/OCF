<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.12
  CAPTCHA Plugin 
  Based on Mod by Abbas ali(http://coppermine-gallery.net/forum/index.php?topic=29564.0)
  Plugin Writen by bmossavari at gmail dot com
**********************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/captcha/lang/{$CONFIG['lang']}.php")) {
  require "plugins/captcha/lang/{$CONFIG['lang']}.php";
} else {require "plugins/captcha/lang/english.php";}
?>