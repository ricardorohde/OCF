<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.4.18
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.4.x/config.php $
  $Revision: 4380 $
  $Author: gaugau $
  $Date: 2008-04-12 12:00:19 +0200 (Sa, 12 Apr 2008) $
**********************************************/

define('IN_COPPERMINE', true);
require('include/init.inc.php');
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);


$redirect = "admin.php";
$message = <<< EOT
You are trying to access Coppermine's <a href="admin.php">config page</a> using an outdated link - the file config.php has been renamed to admin.php. You probably updated your site and haven't changed your theme as suggested in the <a href="docs/theme/">theme upgrade guide</a>.<br />
You are now being redirected to the actual page you were looking for.
EOT;
pageheader($lang_info, "<meta http-equiv=\"refresh\" content=\"100;url=$redirect\" />");
msg_box($lang_info, $message, $lang_continue, $redirect);
pagefooter();
ob_end_flush();
?>