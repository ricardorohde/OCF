<?php
/**********************************************************************************
* Settings.php                                                                    *
***********************************************************************************
* SMF: Simple Machines Forum                                                      *
* Open-Source Project Inspired by Zef Hemel (zef@zefhemel.com)                    *
* =============================================================================== *
* Software Version:           SMF 1.1                                             *
* Software by:                Simple Machines (http://www.simplemachines.org)     *
* Copyright 2006 by:          Simple Machines LLC (http://www.simplemachines.org) *
*           2001-2006 by:     Lewis Media (http://www.lewismedia.com)             *
* Support, News, Updates at:  http://www.simplemachines.org                       *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license as published by Simple Machines LLC.          *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the Simple Machines license.          *
* The latest version can always be found at http://www.simplemachines.org.        *
**********************************************************************************/


########## Maintenance ##########
# Note: If $maintenance is set to 2, the forum will be unusable!  Change it to 0 to fix it.
$maintenance = 2;		# Set to 1 to enable Maintenance Mode, 2 to make the forum untouchable. (you'll have to make it 0 again manually!)
$mtitle = 'Upgrading the forum...';		# Title for the Maintenance Mode message.
$mmessage = 'Don\'t worry, we will be back shortly with an updated forum.  It will only be a minute ;).';		# Description of why the forum is in maintenance mode.

########## Forum Info ##########
$mbname = 'Opala Clube Franca';		# The name of your forum.
$language = 'portuguese_brazilian';		# The default language file set for the forum.
$boardurl = 'http://www.opalaclubefranca.com.br/ocfforum';		# URL to your forum's folder. (without the trailing /!)
$webmaster_email = 'admin@opalaclubefranca.com.br';		# Email address to send emails from. (like noreply@yourdomain.com.)
$cookiename = 'SMFCookie';		# Name of the cookie to set for authentication.

########## Database Info ##########
$db_server = 'mysql.opalaclubefranca.com.br';
$db_name = 'opalaclubefran01';
$db_user = 'opalaclubefran01';
$db_passwd = 'racnela';
$db_prefix = 'ocfsmf_';
$db_persist = 0;
$db_error_send = 1;

########## Directories/Files ##########
# Note: These directories do not have to be changed unless you move things.
$boarddir = '/home/opalaclubefranca/www/ocfforum';		# The absolute path to the forum's folder. (not just '.'!)
$sourcedir = '/home/opalaclubefranca/www/ocfforum/Sources';		# Path to the Sources directory.

########## Error-Catching ##########
# Note: You shouldn't touch these settings.
$db_last_error = 1224639106;


# Make sure the paths are correct... at least try to fix them.
if (!file_exists($boarddir) && file_exists(dirname(__FILE__) . '/agreement.txt'))
	$boarddir = dirname(__FILE__);
if (!file_exists($sourcedir) && file_exists($boarddir . '/Sources'))
	$sourcedir = $boarddir . '/Sources';

$db_character_set = 'utf8';
?>