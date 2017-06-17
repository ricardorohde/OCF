<?php
/**********************************************************************************
* upgrade.php                                                                     *
***********************************************************************************
* SMF: Simple Machines Forum                                                      *
* Open-Source Project Inspired by Zef Hemel (zef@zefhemel.com)                    *
* =============================================================================== *
* Software Version:           SMF 1.1.8                                           *
* Software by:                Simple Machines (http://www.simplemachines.org)     *
* Copyright 2006-2007 by:     Simple Machines LLC (http://www.simplemachines.org) *
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


// Version information...
define('SMF_VERSION', '1.1.8');
define('SMF_LANG_VERSION', '1.1.5');

$GLOBALS['required_php_version'] = '4.1.0';
$GLOBALS['required_mysql_version'] = '3.23.28';

$timeLimitThreshold = 3;
$install_path = dirname(__FILE__);

if (!empty($_SERVER['argv']) && php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))
	for ($i = 1; $i < $_SERVER['argc']; $i++)
	{
		if (preg_match('~^--path=(.+)$~', $_SERVER['argv'][$i], $match) != 0)
			$install_path = substr($match[1], -1) == '/' ? substr($match[1], 0, -1) : $match[1];
	}

// Initialize everything...
require_once($install_path . '/Settings.php');
initialize_inputs();

$db_connection = mysql_connect($db_server, $db_user, $db_passwd) or die(mysql_error($db_connection));
mysql_select_db($db_name, $db_connection) or die(mysql_error($db_connection));

if (isset($db_character_set) && preg_match('~^\w+$~', $db_character_set) === 1)
	mysql_query("
		SET NAMES $db_character_set");

$request = mysql_query("
	SELECT variable, value
	FROM {$db_prefix}settings") or die(mysql_error($db_connection));
$modSettings = array();
while ($row = mysql_fetch_assoc($request))
	$modSettings[$row['variable']] = $row['value'];
mysql_free_result($request);

// This only exists if we're on SMF ;)
if (isset($modSettings['smfVersion']))
{
	$request = mysql_query("
		SELECT variable, value
		FROM {$db_prefix}themes
		WHERE ID_THEME = 1
			AND variable IN ('theme_url', 'images_url')") or die(mysql_error($db_connection));
	while ($row = mysql_fetch_assoc($request))
		$modSettings[$row['variable']] = $row['value'];
	mysql_free_result($request);
}

if (!isset($modSettings['theme_url']))
{
	$modSettings['theme_url'] = 'Themes/default';
	$modSettings['images_url'] = 'Themes/default/images';
}

if (php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))
{
	$command_line = true;

	cmdStep0();
	exit;
}
else
	$command_line = false;

show_header();

if (!empty($_GET['step']))
	echo '
			<div class="panel">
				<h2>Upgrading...</h2>';

if (function_exists('doStep' . $_GET['step']))
	call_user_func('doStep' . $_GET['step']);

if (!empty($_GET['step']))
	echo '
			</div>';

show_footer();

function initialize_inputs()
{
	global $sourcedir;

	// Turn off magic quotes runtime, enable error reporting, and define SMF.
	@set_magic_quotes_runtime(0);
	error_reporting(E_ALL);
	define('SMF', 1);
	umask(0);

	// Fun.  Low PHP version...
	if (!isset($_GET))
	{
		$GLOBALS['_GET']['step'] = 0;
		return;
	}

	ob_start();

	if (@ini_get('session.save_handler') == 'user')
		@ini_set('session.save_handler', 'files');
	@session_start();

	// Better to upgrade cleanly and fall apart than to screw everything up if things take too long.
	ignore_user_abort(true);

	// If they don't have the file, they're going to get a warning anyway so we won't need to clean request vars.
	if (file_exists($sourcedir . '/QueryString.php'))
	{
		require_once($sourcedir . '/QueryString.php');

		$GLOBALS['func'] = array(
			'htmlspecialchars' => 'htmlspecialchars',
			'htmltrim' => create_function('$string', '
				return preg_replace(\'~^([ \t\n\r\x0B\x00\xA0]|&nbsp;)+|([ \t\n\r\x0B\x00\xA0]|&nbsp;)+$~\', \'\', $string);'),
		);
		cleanRequest();
	}

	// This is really quite simple; if ?delete is on the URL, delete the upgrader...
	if (isset($_GET['delete']))
	{
		@unlink(__FILE__);

		// And the extra little files ;).
		@unlink(dirname(__FILE__) . '/upgrade_1-0.sql');
		@unlink(dirname(__FILE__) . '/upgrade_1-1.sql');
		@unlink(dirname(__FILE__) . '/webinstall.php');

		header('Location: http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']) . dirname($_SERVER['PHP_SELF']) . '/Themes/default/images/blank.gif');
		exit;
	}

	// Something is causing this to happen, and it's annoying.  Stop it.
	$temp = 'upgrade_php?step';
	while (strlen($temp) > 4)
	{
		if (isset($_GET[$temp]))
			unset($_GET[$temp]);
		$temp = substr($temp, 1);
	}

	// Force a step, defaulting to 0.
	$_GET['step'] = (int) @$_GET['step'];
	$_GET['substep'] = (int) @$_GET['substep'];
}

// Step 0 - Do they have everything ready?
function doStep0()
{
	global $boarddir, $sourcedir, $db_prefix, $language, $modSettings;

	// Do they meet the install requirements?
	if (!php_version_check())
	{
		echo '
			<div class="error_message">
				<div style="color: red;">
					Warning!  You do not appear to have a version of PHP installed on your webserver that meets SMF' . "'" . 's minimum installations requirements.<br />
					<br />
					Please ask your host to upgrade.
				</div>
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}
	if (!mysql_version_check())
	{
		echo '
			<div class="error_message">
				<div style="color: red;">
					Your MySQL version does not meet the minimum requirements of SMF.<br />
					<br />
					Please ask your host to upgrade.
				</div>
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';
		return false;
	}

	// Do they have ALTER privileges?
	if (mysql_query("ALTER TABLE {$db_prefix}boards ORDER BY ID_BOARD") === false)
	{
		echo '
			<div class="error_message">
				<div style="color: red;">
					The MySQL user you have set in Settings.php does not have proper privileges.<br />
					<br />
					Please ask your host to give this user the ALTER, CREATE, and DROP privileges.
				</div>
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';
		return false;
	}

	// Check for some key files - one template, one language, and a new and an old source file.
	$check = @file_exists($boarddir . '/Themes/default/index.template.php')
		&& @file_exists($sourcedir . '/QueryString.php')
		&& @file_exists($sourcedir . '/ManageBoards.php')
		&& @file_exists(dirname(__FILE__) . '/upgrade_1-1.sql')
		&& @file_exists(dirname(__FILE__) . '/upgrade_1-0.sql');
	if (!$check && !isset($modSettings['smfVersion']))
	{
		// Don't tell them what files exactly because it's a spot check - just like teachers don't tell which problems they are spot checking, that's dumb.
		echo '
			<div class="error_message">
				The upgrader was unable to find some crucial files.<br />
				<br />
				Please make sure you uploaded all of the files included in the package, including the Themes, Sources, and other directories.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}

	// Do a quick version spot check.
	$temp = substr(@implode('', @file($boarddir . '/index.php')), 0, 4096);
	preg_match('~\*\s*Software\s+Version:\s+SMF\s+(.+?)[\s]{2}~i', $temp, $match);
	if (empty($match[1]) || $match[1] != SMF_VERSION)
	{
		echo '
			<div class="error_message">
				The upgrader found some old or outdated files.<br />
				<br />
				Please make certain you uploaded the new versions of all the files included in the package.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '?step=0">Click here to try again.</a>
			</div>';

		return false;
	}

	// Make sure Settings.php is writable.
	if (!is_writable($boarddir . '/Settings.php'))
		@chmod($boarddir . '/Settings.php', 0777);

	if (!is_writable($boarddir . '/Settings.php'))
	{
		echo '
			<div class="error_message">
				The upgrader was unable to obtain write access to Settings.php.<br />
				<br />
				If you are using a linux or unix based server, please ensure that the file is chmod\'d to 777.<br />
				If your server is running Windows, please ensure that the internet guest account has the proper permissions on it.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}

	// Make sure Settings.php is writable.
	if (!is_writable($boarddir . '/Settings_bak.php'))
		@chmod($boarddir . '/Settings_bak.php', 0777);

	if (!is_writable($boarddir . '/Settings_bak.php'))
	{
		echo '
			<div class="error_message">
				The upgrader was unable to obtain write access to Settings_bak.php.<br />
				<br />
				If you don\'t have a Settings_bak.php, you can make a copy of Settings.php and name it Settings_bak.php.<br />
				<br />
				If you are using a linux or unix based server, please ensure that the file is chmod\'d to 777.<br />
				If your server is running Windows, please ensure that the internet guest account has the proper permissions on it.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}

	// Check agreement.txt. (it may not exist, in which case $boarddir must be writable.)
	if (isset($modSettings['agreement']) && (!is_writable($boarddir) || file_exists($boarddir . '/agreement.txt')) && !is_writable($boarddir . '/agreement.txt'))
	{
		echo '
			<div class="error_message">
				The upgrader was unable to obtain write access to agreement.txt.<br />
				<br />
				If you are using a linux or unix based server, please ensure that the file is chmod\'d to 777, or if it does not exist that the directory this upgrader is in is 777.<br />
				If your server is running Windows, please ensure that the internet guest account has the proper permissions on it or its folder.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}
	// Upgrade the agreement.
	elseif (isset($modSettings['agreement']))
	{
		$fp = fopen($boarddir . '/agreement.txt', 'w');
		fwrite($fp, $modSettings['agreement']);
		fclose($fp);
	}

	// Make sure Themes is writable.
	if (!is_writable($boarddir . '/Themes'))
		@chmod($boarddir . '/Themes', 0777);

	if (!is_writable($boarddir . '/Themes') && !isset($modSettings['smfVersion']))
	{
		echo '
			<div class="error_message">
				The upgrader was unable to obtain write access to the Themes folder.<br />
				<br />
				If you are using a linux or unix based server, please ensure that the file is chmod\'d to 777.<br />
				If your server is running Windows, please ensure that the internet guest account has the proper permissions on it.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '">Click here to try again.</a>
			</div>';

		return false;
	}

	if (!file_exists($boarddir . '/Themes/default/languages/index.' . basename($language, '.lng') . '.php') && !isset($modSettings['smfVersion']) && !isset($_GET['lang']))
	{
		echo '
			<div class="error_message">
				The upgrader was unable to find language files for the language specified in Settings.php.<br />
				SMF will not work without the primary language files installed.<br />
				<br />
				Please either install them, or <a href="' . $_SERVER['PHP_SELF'] . '?step=0;lang=english">use english instead</a>.
			</div>';

		return false;
	}
	else
	{
		$temp = substr(@implode('', @file($boarddir . '/Themes/default/languages/index.' . (isset($_GET['lang']) ? $_GET['lang'] : basename($language, '.lng')) . '.php')), 0, 4096);
		preg_match('~(?://|/\*)\s*Version:\s+(.+?);\s*index(?:[\s]{2}|\*/)~i', $temp, $match);

		if (empty($match[1]) || $match[1] != SMF_LANG_VERSION)
		{
			echo '
			<div class="error_message">
				The upgrader found some old or outdated language files.<br />
				<br />
				Please make certain you uploaded the new versions of all the files included in the package, even the theme and language files for the default theme.<br />
				<br />
				<a href="', $_SERVER['PHP_SELF'], '?step=0">Click here to try again.</a>
			</div>';

			return false;
		}
	}

	echo '
		<div class="panel">
			<h2>', isset($modSettings['smfVersion']) ? 'Updating Your SMF Install' : 'Upgrading from YaBB SE', '!</h2>
			<h3>Thank you for choosing to upgrade to SMF ', SMF_VERSION, '.  All files appear to be in place, please click continue below.</h3>';

	// For large, pre 1.1 RC2 forums give them a warning about the possible impact of this upgrade!
	if ((empty($modSettings['smfVersion']) || $modSettings['smfVersion'] <= '1.1 RC1') && !empty($modSettings['totalMessages']) && $modSettings['totalMessages'] > 75000)
		echo '
		<div style="margin: 2ex; padding: 2ex; border: 2px dashed #cc3344; color: black; background-color: #ffe4e9;">
			<div style="float: left; width: 2ex; font-size: 2em; color: red;">!!</div>
			<b style="text-decoration: underline;">Warning!</b><br />
			<div style="padding-left: 6ex;">
				This upgrade script has detected that your forum contains a lot of data which needs upgrading. This
				process may take quite some time depending on your server and forum size, and for very large forums (~300,000 messages) may take several
				hours to complete.
			</div>
		</div>';

	echo '
			<form action="', $_SERVER['PHP_SELF'], '" method="get">
				<input type="hidden" name="step" value="1" />
				<label for="backup"><input type="checkbox" name="backup" id="backup" value="1" /> Backup tables in your database with the prefix &quot;backup_' . $db_prefix . '&quot;.</label>', isset($modSettings['smfVersion']) ? '' : ' (recommended!)', '<br />
				<label for="maint"><input type="checkbox" name="maint" id="maint" value="1" checked="checked" /> Put the forum into maintenance mode during upgrade.</label><br />
				<label for="debug"><input type="checkbox" name="debug" id="debug" value="1" /> Output extra debugging information.</label><br />
				<br />
				<label for="stats"><input type="checkbox" name="stats" id="stats" value="1" ', empty($modSettings['allow_sm_stats']) ? '' : 'checked="checked"', ' /> Allow Simple Machines to Collect Basic Stats Monthly.<br />
					<span style="font-size: 8pt;">If enabled, this will allow Simple Machines to visit your site once a month to collect basic statistics. This will help us make decisions as to which configurations to optimise the software for. For more information please visit our <a href="http://www.simplemachines.org/about/stats.php" target="_blank">info page</a>.</span>
				</label><br />';

	if (file_exists($boarddir . '/template.php') || file_exists($boarddir . '/template.html') && !file_exists($boarddir . '/Themes/converted'))
		echo '
				<label for="conv"><input type="checkbox" name="conv" id="conv" value="1" /> Convert the existing YaBB SE template and set it as default.</label><br />';

	if (isset($_GET['lang']))
		echo '
				<input type="hidden" name="lang" value="english" />';

	echo '

				<div align="right" style="margin: 1ex;"><input type="submit" value="Continue" /></div>
			</form>
		</div>';

	// All ready.
	return;
}

// Step 1: Do the maintenance and backup.
function doStep1()
{
	global $db_prefix, $command_line, $modSettings;
	global $boarddir, $boardurl, $sourcedir, $maintenance;

	// Firstly, if they're enabling SM stat collection just do it.
	if (!empty($_REQUEST['stats']) && substr($boardurl, 0, 16) != 'http://localhost' && empty($modSettings['allow_sm_stats']))
	{
		// Attempt to register the site etc.
		$fp = @fsockopen("www.simplemachines.org", 80, $errno, $errstr);
		if ($fp)
		{
			$out = "GET /smf/stats/register_stats.php?site=" . base64_encode($boardurl) . " HTTP/1.1\r\n";
			$out .= "Host: www.simplemachines.org\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);

			$return_data = '';
			while (!feof($fp))
				$return_data .= fgets($fp, 128);

			fclose($fp);

			// Get the unique site ID.
			preg_match('~SITE-ID:\s(\w{10})~', $return_data, $ID);

			if (!empty($ID[1]))
				upgrade_query("
					REPLACE INTO {$db_prefix}settings
						(variable, value)
					VALUES
						('allow_sm_stats', '$ID[1]')");
		}
	}
	else
		upgrade_query("
			DELETE FROM {$db_prefix}settings
			WHERE variable = 'allow_sm_stats'");

	$endl = $command_line ? "\n" : '<br />' . "\n";

	$changes = array();

	if (isset($_GET['lang']))
		$changes['language'] = '\'english\'';

	if (!empty($_GET['maint']))
	{
		$changes['maintenance'] = '2';
		$changes['mtitle'] = '\'Upgrading the forum...\'';
		$changes['mmessage'] = '\'Don\\\'t worry, we will be back shortly with an updated forum.  It will only be a minute ;).\'';
	}

	echo $command_line ? ' * ' : '', 'Updating Settings.php...';

	copy($boarddir . '/Settings.php', $boarddir . '/Settings_bak.php');

	if (substr($boarddir, 0, 1) == '.')
		$changes['boarddir'] = '\'' . fixRelativePath($boarddir) . '\'';

	if (substr($sourcedir, 0, 1) == '.')
		$changes['sourcedir'] = '\'' . fixRelativePath($sourcedir) . '\'';

	// !!! Maybe change the cookie name if going to 1.1, too?

	// Update Settings.php with the new settings.
	changeSettings($changes);

	echo ' Successful.', $endl;

	if (!empty($_GET['backup']) || isset($_GET['t']))
	{
		echo $command_line ? ' * ' : 'Backing up old table data...';

		if (preg_match('~^`(.+?)`\.(.+?)$~', $db_prefix, $match) != 0)
		{
			$result = upgrade_query("
				SHOW TABLES
				FROM `" . strtr($match[1], array('`' => '')) . "`
				LIKE '" . str_replace('_', '\_', $match[2]) . "%'");
		}
		else
		{
			$result = upgrade_query("
				SHOW TABLES
				LIKE '" . str_replace('_', '\_', $db_prefix) . "%'");
		}

		$table_names = array();
		while ($row = mysql_fetch_row($result))
			if (substr($row[0], 0, 7) !== 'backup_')
				$table_names[] = $row[0];
		mysql_free_result($result);

		for ($substep = $_GET['substep'], $n = count($table_names); $substep < $n; $substep++)
		{
			nextSubstep($substep);

			if (!empty($_GET['debug']))
			{
				if ($command_line)
					echo $endl, ' +++ Backing up "' . str_replace($db_prefix, '', $table_names[$substep]) . '"...';
				else
					echo '<br />
				&nbsp;&nbsp;&nbsp;', 'Backing up &quot;' . str_replace($db_prefix, '', $table_names[$substep]) . '&quot;...';
				flush();
			}

			$result = upgrade_query("
				SHOW CREATE TABLE " . $table_names[$substep]);
			list (, $create) = mysql_fetch_row($result);
			mysql_free_result($result);

			$create = preg_split('/[\n\r]/', $create);

			$auto_inc = '';
			// Default engine type.
			$engine = 'MyISAM';
			$charset = '';
			$collate = '';

			foreach ($create as $k => $l)
			{
				// Get the name of the auto_increment column.
				if (strpos($l, 'auto_increment'))
					$auto_inc = trim($l);

				// For the engine type, see if we can work out what it is.
				if (strpos($l, 'ENGINE') !== false || strpos($l, 'TYPE') !== false)
				{
					// Extract the engine type.
					preg_match('~(ENGINE|TYPE)=(\w+)(\sDEFAULT)?(\sCHARSET=(\w+))?(\sCOLLATE=(\w+))?~', $l, $match);

					if (!empty($match[2]))
						$engine = $match[2];

					if (!empty($match[5]))
						$charset = $match[5];

					if (!empty($match[7]))
						$collate = $match[7];
				}

				// Skip everything but keys...
				if (strpos($l, 'KEY') === false)
					unset($create[$k]);
			}

			if (!empty($create))
				$create = '(
					' . implode('
					', $create) . ')';
			else
				$create = '';

			upgrade_query("
				DROP TABLE IF EXISTS backup_" . $table_names[$substep]);

			upgrade_query("
				CREATE TABLE backup_" . $table_names[$substep] . " $create
				TYPE=$engine" . (empty($charset) ? '' : " CHARACTER SET $charset" . (empty($collate) ? '' : " COLLATE $collate")) . "
				SELECT *
				FROM " . $table_names[$substep]);

			if ($auto_inc != '')
			{
				if (preg_match('~\`(.+?)\`\s~', $auto_inc, $match) != 0 && substr($auto_inc, -1, 1) == ',')
					$auto_inc = substr($auto_inc, 0, -1);

				upgrade_query("
					ALTER TABLE backup_" . $table_names[$substep] . "
					CHANGE COLUMN $match[1] $auto_inc");
			}

			if (!empty($_GET['debug']))
				echo ' done.';
		}

		if (!empty($_GET['debug']))
		{
			echo $endl;
			flush();
		}

		echo ' Successful.', $endl;
	}

	$_GET['substep'] = 0;
	return doStep2();
}

// Step 2: Everything.
function doStep2()
{
	global $db_prefix, $modSettings, $command_line;
	global $language, $boardurl, $sourcedir, $boarddir;

	$_GET['step'] = '2';
	$endl = $command_line ? "\n" : '<br />' . "\n";

	// Okay, so we want to upgrade to 1.0 if not at 1.0 or higher.
	if (@$modSettings['smfVersion'] < '1.1' && empty($_GET['s']))
	{
		parse_sql(dirname(__FILE__) . '/upgrade_1-0.sql');

		// Don't wanna do this part again, though we're not ready yet.
		upgrade_query("
			REPLACE INTO {$db_prefix}settings
				(variable, value)
			VALUES
				('smfVersion', '1.1 RC0')");
	}

	$_GET['s'] = 1;

	parse_sql(dirname(__FILE__) . '/upgrade_1-1.sql');

	if (!empty($_GET['debug']))
		echo $command_line ? ' +++ ' : '&nbsp;&nbsp;&nbsp;', 'Updating version number...';

	upgrade_query("
		REPLACE INTO {$db_prefix}settings
			(variable, value)
		VALUES
			('smfVersion', '" . SMF_VERSION . "')");

	if (!empty($_GET['debug']))
		echo ' done.', $endl;

	// Almost done... convert the template.php or template.html file?
	if (isset($_GET['conv']) && !file_exists($boarddir . '/Themes/converted'))
	{
		if (!empty($_GET['debug']))
			echo $command_line ? ' +++ ' : '&nbsp;&nbsp;&nbsp;', 'Converting the template...';

		require_once($sourcedir . '/Themes.php');

		mkdir($boarddir . '/Themes/converted', 0777);

		convert_template($boarddir . '/Themes/converted');

		// Copy over the default index.php file.
		copy($boarddir . '/Themes/classic/index.php', $boarddir . '/Themes/converted/index.php');
		@chmod($boarddir . '/Themes/converted/index.php', 0777);

		// Now set up the "converted" theme.
		$values = array(
			'name' => 'Converted Theme from YaBB SE',
			'theme_url' => $boardurl . '/Themes/classic',
			'images_url' => $boardurl . '/Themes/classic/images',
			'theme_dir' => strtr($boarddir, array('\\' => '/')) . '/Themes/converted',
			'base_theme_dir' => strtr($boarddir, array('\\' => '/')) . '/Themes/classic',
		);

		// Get an available ID_THEME first...
		$request = upgrade_query("
			SELECT MAX(ID_THEME) + 1
			FROM {$db_prefix}themes");
		list ($ID_THEME) = mysql_fetch_row($request);
		mysql_free_result($request);

		$setString = '';
		foreach ($values as $variable => $value)
			$setString .= "
					(0, " . $ID_THEME . ", '" . $variable . "', '" . $value . "'),";

		if (!empty($setString))
		{
			upgrade_query("
				INSERT IGNORE INTO {$db_prefix}themes
				VALUES " . substr($setString, 0, -1));
		}

		upgrade_query("
			UPDATE {$db_prefix}settings
			SET value = CONCAT(value, ',$ID_THEME')
			WHERE variable = 'knownThemes'
			LIMIT 1");

		upgrade_query("
			REPLACE INTO {$db_prefix}settings
				(variable, value)
			VALUES ('theme_guests', $ID_THEME),
				('smiley_sets_default', 'classic')");

		if (!empty($_GET['debug']))
			echo ' done.', $endl;
	}

	$changes = array(
		'language' => '\'' . (substr($language, -4) == '.lng' ? substr($language, 0, -4) : $language) . '\'',
		'db_error_send' => '1'
	);

	if (!empty($_GET['maint']))
	{
		echo $command_line ? ' * ' : '', 'Taking the forum out of maintenance mode...';
		$changes['maintenance'] = '0';
	}

	// Make a backup of Settings.php first as otherwise earlier changes are lost.
	copy($boarddir . '/Settings.php', $boarddir . '/Settings_bak.php');
	changeSettings($changes);

	if (!empty($_GET['maint']))
		echo ' Successful.', $endl;

	if ($command_line)
	{
		echo $endl;
		echo 'Upgrade Complete!', $endl;
		echo 'Please delete this file as soon as possible for security reasons.', $endl;
		return true;
	}

	echo '
			<h2 style="margin-top: 2ex;">Upgrade Complete</h2>
			<h3>That wasn\'t so hard, was it?  Now you are ready to use <a href="', $boardurl, '/index.php">your installation of SMF</a>.  Hope you like it!</h3>';

	if (is_writable(dirname(__FILE__)) || is_writable(__FILE__))
		echo '
			<label for="delete_self"><input type="checkbox" id="delete_self" onclick="doTheDelete(this);" /> Delete this upgrade.php and its data files now.</label> <i>(doesn\'t work on all servers.)</i>
			<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
				function doTheDelete(theCheck)
				{
					var theImage = document.getElementById ? document.getElementById("delete_upgrader") : document.all.delete_upgrader;

					theImage.src = "', $_SERVER['PHP_SELF'], '?delete=1&ts=" + (new Date().getTime());
					theCheck.disabled = true;
				}
			// ]]></script>
			<img src="', $boardurl, '/Themes/default/images/blank.gif" alt="" id="delete_upgrader" /><br />';

	echo '<br />
			If you had any problems with this upgrade, or have any problems using SMF, please don\'t hesitate to <a href="http://www.simplemachines.org/community/index.php">look to us for assistance</a>.<br />
			<br />
			Best of luck,<br />
			Simple Machines';

	return true;
}

function convertSettingsToTheme()
{
	global $db_prefix, $modSettings;

	$values = array(
		'show_latest_member' => @$GLOBALS['showlatestmember'],
		'show_bbc' => isset($GLOBALS['showyabbcbutt']) ? $GLOBALS['showyabbcbutt'] : @$GLOBALS['showbbcbutt'],
		'show_modify' => @$GLOBALS['showmodify'],
		'show_user_images' => @$GLOBALS['showuserpic'],
		'show_blurb' => @$GLOBALS['showusertext'],
		'show_gender' => @$GLOBALS['showgenderimage'],
		'show_newsfader' => @$GLOBALS['shownewsfader'],
		'display_recent_bar' => @$GLOBALS['Show_RecentBar'],
		'show_member_bar' => @$GLOBALS['Show_MemberBar'],
		'linktree_link' => @$GLOBALS['curposlinks'],
		'show_profile_buttons' => @$GLOBALS['profilebutton'],
		'show_mark_read' => @$GLOBALS['showmarkread'],
		'show_board_desc' => @$GLOBALS['ShowBDescrip'],
		'newsfader_time' => @$GLOBALS['fadertime'],
		'use_image_buttons' => empty($GLOBALS['MenuType']) ? 1 : 0,
		'enable_news' => @$GLOBALS['enable_news'],
		'show_sp1_info' => @$modSettings['enableSP1Info'],
		'linktree_inline' => @$modSettings['enableInlineLinks'],
		'return_to_post' => @$modSettings['returnToPost'],
	);

	$setString = '';
	foreach ($values as $variable => $value)
	{
		if (!isset($value) || $value === null)
			$value = 0;

		$setString .= '
				(0, 1, \'' . $variable . '\', \'' . $value . '\'),';
	}
	if (!empty($setString))
	{
		upgrade_query("
			INSERT IGNORE INTO {$db_prefix}themes
			VALUES " . substr($setString, 0, -1));
	}
}

function convertSettingstoOptions()
{
	global $db_prefix, $modSettings;

	// Format: new_setting -> old_setting_name.
	$values = array(
		'calendar_start_day' => 'cal_startmonday',
		'view_newest_first' => 'viewNewestFirst',
		'view_newest_pm_first' => 'viewNewestFirst',
	);

	foreach ($values as $variable => $value)
	{
		if (empty($modSettings[$value[0]]))
			continue;

		upgrade_query("
			INSERT IGNORE INTO {$db_prefix}themes
				(ID_MEMBER, ID_THEME, variable, value)
			SELECT ID_MEMBER, 1, '$variable', '" . $modSettings[$value[0]] . "'
			FROM {$db_prefix}members");

		upgrade_query("
			INSERT IGNORE INTO {$db_prefix}themes
				(ID_MEMBER, ID_THEME, variable, value)
			VALUES (-1, 1, '$variable', '" . $modSettings[$value[0]] . "')");
	}
}

function show_header()
{
	global $start_time, $modSettings;
	$start_time = time();

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta name="robots" content="noindex" />
		<title>SMF Upgrade Utility</title>
		<script language="JavaScript" type="text/javascript" src="', $modSettings['theme_url'], '/script.js"></script>
		<style type="text/css">
			body
			{
				background-color: #E5E5E8;
				margin: 0px;
				padding: 0px;
			}
			body, td
			{
				color: #000000;
				font-size: small;
				font-family: verdana, sans-serif;
			}
			div#header
			{
				background-image: url(Themes/default/images/catbg.jpg);
				background-repeat: repeat-x;
				background-color: #88A6C0;
				padding: 22px 4% 12px 4%;
				color: white;
				font-family: Georgia, serif;
				font-size: xx-large;
				border-bottom: 1px solid black;
				height: 40px;
			}
			div#content
			{
				padding: 20px 30px;
			}
			div.error_message
			{
				border: 2px dashed red;
				background-color: #E1E1E1;
				margin: 1ex 4ex;
				padding: 1.5ex;
			}
			div.panel
			{
				border: 1px solid gray;
				background-color: #F6F6F6;
				margin: 1ex 0;
				padding: 1.2ex;
			}
			div.panel h2
			{
				margin: 0;
				margin-bottom: 0.5ex;
				padding-bottom: 3px;
				border-bottom: 1px dashed black;
				font-size: 14pt;
				font-weight: normal;
			}
			div.panel h3
			{
				margin: 0;
				margin-bottom: 2ex;
				font-size: 10pt;
				font-weight: normal;
			}
			form
			{
				margin: 0;
			}
			td.textbox
			{
				padding-top: 2px;
				font-weight: bold;
				white-space: nowrap;
				padding-', empty($txt['lang_rtl']) ? 'right' : 'left', ': 2ex;
			}
		</style>
	</head>
	<body>
		<div id="header">
			<a href="http://www.simplemachines.org/" target="_blank"><img src="', $modSettings['images_url'], '/smflogo.gif" style=" float: right;" alt="Simple Machines" border="0" /></a>
			<div title="Radical Dreamers">SMF Upgrade Utility</div>
		</div>
		<div id="content">';
}

function show_footer()
{
	echo '
		</div>
	</body>
</html>';
}

function changeSettings($config_vars)
{
	global $boarddir;

	$settingsArray = file($boarddir . '/Settings_bak.php');

	if (count($settingsArray) == 1)
		$settingsArray = preg_split('~[\r\n]~', $settingsArray[0]);

	for ($i = 0, $n = count($settingsArray); $i < $n; $i++)
	{
		// Don't trim or bother with it if it's not a variable.
		if (substr($settingsArray[$i], 0, 1) != '$')
			continue;

		$settingsArray[$i] = trim($settingsArray[$i]) . "\n";

		foreach ($config_vars as $var => $val)
		{
			if (strncasecmp($settingsArray[$i], '$' . $var, 1 + strlen($var)) == 0)
			{
				if ($val == '#remove#')
					unset($settingsArray[$i]);
				else
				{
					$comment = strstr(substr($settingsArray[$i], strpos($settingsArray[$i], ';')), '#');
					$settingsArray[$i] = '$' . $var . ' = ' . $val . ';' . ($comment != '' ? "\t\t" . $comment : "\n");
				}

				unset($config_vars[$var]);
			}
		}

		if (trim(substr($settingsArray[$i], 0, 2)) == '?' . '>')
			$end = $i;
	}

	// Assume end-of-file if the end wasn't found.
	if (empty($end) || $end < 10)
		$end = count($settingsArray) - 1;

	if (!empty($config_vars))
	{
		$settingsArray[$end++] = '';
		foreach ($config_vars as $var => $val)
			$settingsArray[$end++] = '$' . $var . ' = ' . $val . ';' . "\n";
	}
	// This should be the last line and even last bytes of the file.
	$settingsArray[$end] = '?' . '>';

	// Blank out the file - done to fix a oddity with some servers.
	$fp = fopen($boarddir . '/Settings.php', 'w');
	fclose($fp);

	$fp = fopen($boarddir . '/Settings.php', 'r+');
	for ($i = 0; $i < $end; $i++)
		fwrite($fp, strtr($settingsArray[$i], "\r", ''));
	fwrite($fp, rtrim($settingsArray[$i]));
	fclose($fp);
}

function php_version_check()
{
	$minver = explode('.', $GLOBALS['required_php_version']);
	$curver = explode('.', PHP_VERSION);

	return !(($curver[0] <= $minver[0]) && ($curver[1] <= $minver[1]) && ($curver[1] <= $minver[1]) && ($curver[2][0] < $minver[2][0]));
}

function mysql_version_check()
{
	$curver = mysql_get_server_info() < mysql_get_client_info() ? mysql_get_server_info() : mysql_get_client_info();
	$curver = preg_replace('~\-.+?$~', '', $curver);

	return version_compare($GLOBALS['required_mysql_version'], $curver) <= 0;
}

function getMemberGroups()
{
	global $db_prefix;
	static $member_groups = array();

	if (!empty($member_groups))
		return $member_groups;

	$request = mysql_query("
		SELECT groupName, ID_GROUP
		FROM {$db_prefix}membergroups
		WHERE ID_GROUP = 1 OR ID_GROUP > 7");
	if ($request === false)
	{
		$request = upgrade_query("
			SELECT membergroup, ID_GROUP
			FROM {$db_prefix}membergroups
			WHERE ID_GROUP = 1 OR ID_GROUP > 7");
	}
	while ($row = mysql_fetch_row($request))
		$member_groups[trim($row[0])] = $row[1];
	mysql_free_result($request);

	return $member_groups;
}

function ip2range($fullip)
{
	$ip_parts = explode('.', $fullip);
	if (count($ip_parts) != 4)
		return array();
	$ip_array = array();
	for ($i = 0; $i < 4; $i++)
	{
		if ($ip_parts[$i] == '*')
			$ip_array[$i] = array('low' => '0', 'high' => '255');
		elseif (preg_match('/^(\d{1,3})\-(\d{1,3})$/', $ip_parts[$i], $range))
			$ip_array[$i] = array('low' => $range[1], 'high' => $range[2]);
		elseif (is_numeric($ip_parts[$i]))
			$ip_array[$i] = array('low' => $ip_parts[$i], 'high' => $ip_parts[$i]);
	}
	if (count($ip_array) == 4)
		return $ip_array;
	else
		return array();
}

function un_htmlspecialchars($string)
{
	return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES)) + array('&#039;' => '\'', '&nbsp;' => ' '));
}

function text2words($text)
{
	// Step 1: Remove entities/things we don't consider words:
	$words = preg_replace('~([\x0B\0\xA0\t\r\s\n(){}\\[\\]<>!@$%^*.,:+=`\~\?/\\\\]|&(amp|lt|gt|quot);)+~', ' ', $text);

	// Step 2: Entities we left to letters, where applicable, lowercase.
	$words = preg_replace('~([^&\d]|^)[#;]~', '$1 ', un_htmlspecialchars(strtolower($words)));

	// Step 3: Ready to split apart and index!
	$words = explode(' ', $words);
	$returned_words = array();
	foreach ($words as $word)
	{
		$word = trim($word, '-_\'');

		if ($word != '')
			$returned_words[] = addslashes(substr($word, 0, 20));
	}

	return array_unique($returned_words);
}

function fixRelativePath($path)
{
	global $install_path;

	// Fix the . at the start, clear any duplicate slashes, and fix any trailing slash...
	return addslashes(preg_replace(array('~^\.([/\\\]|$)~', '~[/]+~', '~[\\\]+~', '~[/\\\]$~'), array($install_path . '$1', '/', '\\', ''), $path));
}

function parse_sql($filename)
{
	global $db_prefix, $boarddir, $boardurl, $command_line, $file_steps;
	global $step_progress, $custom_warning, $db_character_set;

/*
	Failure allowed on:
		- INSERT INTO but not INSERT IGNORE INTO.
		- UPDATE IGNORE but not UPDATE.
		- ALTER TABLE and ALTER IGNORE TABLE.
		- DROP TABLE.
	Yes, I realize that this is a bit confusing... maybe it should be done differently?

	If a comment...
		- begins with --- it is to be output, with a break only in debug mode. (and say successful\n\n if there was one before.)
		- begins with ---# it is a debugging statement, no break - only shown at all in debug.
		- is only ---#, it is "done." and then a break - only shown in debug.
		- begins with ---{ it is a code block terminating at ---}.

	Every block of between "--- ..."s is a step.  Every "---#" section represents a substep.

	Replaces the following variables:
		- {$boarddir}
		- {$boardurl}
		- {$db_prefix}
*/

	$endl = $command_line ? "\n" : '<br />' . "\n";

	$lines = file($filename);

	$current_type = 'sql';
	$current_data = '';
	$substep = 0;
	$last_step = '';

	// Make sure all newly created tables will have the proper characters set.
	if (isset($db_character_set) && $db_character_set === 'utf8')
		$lines = str_replace(') TYPE=MyISAM;', ') TYPE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;', $lines);

	// Count the total number of steps within this file - for progress.
	$file_steps = substr_count(implode('', $lines), '---#');

	foreach ($lines as $line_number => $line)
	{
		$do_current = $substep >= $_GET['substep'];

		// Get rid of any comments in the beginning of the line...
		if (substr(trim($line), 0, 2) === '/*')
			$line = preg_replace('~/\*.+?\*/~', '', $line);

		// Always flush.  Flush, flush, flush.  Flush, flush, flush, flush!  FLUSH!
		if (!empty($_GET['debug']))
			flush();

		if (trim($line) === '')
			continue;

		if (trim(substr($line, 0, 3)) === '---')
		{
			$type = substr($line, 3, 1);

			if (trim($current_data) != '' && $type !== '}')
				echo 'Error in upgrade script - line ', $line_number, '!', $endl;

			if ($type == ' ')
			{
				if ($do_current && $_GET['substep'] != 0)
				{
					echo ' Successful.', $endl;
					flush();
				}

				$last_step = htmlspecialchars(rtrim(substr($line, 4)));

				if ($do_current)
					echo $command_line ? ' * ' : '', $last_step, empty($_GET['debug']) ? '' : $endl;
			}
			elseif ($type == '#')
			{
				if (!empty($_GET['debug']) && $do_current)
				{
					if (trim($line) == '---#')
						echo ' done.', $endl;
					elseif ($command_line)
						echo ' +++ ', rtrim(substr($line, 4));
					else
						echo '&nbsp;&nbsp;&nbsp;', htmlspecialchars(rtrim(substr($line, 4)));
				}

				if ($substep < $_GET['substep'] && $substep + 1 >= $_GET['substep'])
					echo $command_line ? ' * ' : '', $last_step, empty($_GET['debug']) ? '' : $endl;

				// Small step!
				nextSubstep(++$substep);
			}
			elseif ($type == '{')
				$current_type = 'code';
			elseif ($type == '}')
			{
				$current_type = 'sql';

				if (!$do_current)
				{
					$current_data = '';
					continue;
				}

				if (eval('global $db_prefix, $modSettings; ' . $current_data) === false)
					echo 'Error in upgrade script ', basename($filename), ' on line ', $line_number, '!', $endl;

				// Done with code!
				$current_data = '';
			}

			continue;
		}

		$current_data .= $line;
		if (substr(rtrim($current_data), -1) === ';' && $current_type === 'sql')
		{
			if (!$do_current)
			{
				$current_data = '';
				continue;
			}

			$current_data = strtr(substr(rtrim($current_data), 0, -1), array('{$db_prefix}' => $db_prefix, '{$boarddir}' => $boarddir, '{$sboarddir}' => addslashes($boarddir), '{$boardurl}' => $boardurl));

			upgrade_query($current_data);
			$current_data = '';
		}

		// Clean up by cleaning any step info.
		$step_progress = array();
		$custom_warning = '';
	}

	echo ' Successful.', $endl;
	flush();

	$_GET['substep'] = 0;
}

function upgrade_query($string, $unbuffered = false)
{
	global $db_connection, $db_server, $db_user, $db_passwd, $command_line;

	// Get the query result!
	$result = $unbuffered ? mysql_unbuffered_query($string) : mysql_query($string);

	// Failure?!
	if ($result !== false)
		return $result;

	$mysql_error = mysql_error($db_connection);
	$mysql_errno = mysql_errno($db_connection);
	$error_query = in_array(substr(trim($string), 0, 11), array('INSERT INTO', 'UPDATE IGNO', 'ALTER TABLE', 'DROP TABLE ', 'ALTER IGNOR'));

	// Error numbers:
	//    1016: Can't open file '....MYI'
	//    1050: Table already exists.
	//    1054: Unknown column name.
	//    1060: Duplicate column name.
	//    1061: Duplicate key name.
	//    1062: Duplicate entry for unique key.
	//    1068: Multiple primary keys.
	//    1072: Key column '%s' doesn't exist in table.
	//    1091: Can't drop key, doesn't exist.
	//    1146: Table doesn't exist.
	//    2013: Lost connection to server during query.

	if ($mysql_errno == 1016)
	{
		if (preg_match('~\'([^\.\']+)~', $mysql_error, $match) != 0 && !empty($match[1]))
			mysql_query("
				REPAIR TABLE `$match[1]`");

		$result = mysql_query($string);
		if ($result !== false)
			return $result;
	}
	elseif ($mysql_errno == 2013)
	{
		$db_connection = mysql_connect($db_server, $db_user, $db_passwd);
		mysql_select_db($db_name, $db_connection);

		if ($db_connection)
		{
			$result = mysql_query($string);

			if ($result !== false)
				return $result;
		}
	}
	// Duplicate column name... should be okay ;).
	elseif (in_array($mysql_errno, array(1060, 1061, 1068, 1091)))
		return false;
	// Duplicate insert... make sure it's the proper type of query ;).
	elseif (in_array($mysql_errno, array(1054, 1062, 1146)) && $error_query)
		return false;
	// Creating an index on a non-existent column.
	elseif ($mysql_errno == 1072)
		return false;
	elseif ($mysql_errno == 1050 && substr(trim($string), 0, 12) == 'RENAME TABLE')
		return false;

	// Get the query string so we pass everything.
	$query_string = '';
	foreach ($_GET as $k => $v)
		$query_string .= ';' . $k . '=' . $v;
	if (strlen($query_string) != 0)
		$query_string = '?' . substr($query_string, 1);

	if ($command_line)
	{
		echo 'Unsuccessful!  MySQL error message:', "\n", mysql_error(), "\n";
		die;
	}

	echo '
			<b>Unsuccessful!</b><br />

			<div style="margin: 2ex;">
				This query:
				<blockquote><tt>' . nl2br(htmlspecialchars(trim($string))) . ';</tt></blockquote>

				Caused the error:
				<blockquote>' . nl2br(htmlspecialchars($mysql_error)) . '</blockquote>
			</div>

			<form action="', $_SERVER['PHP_SELF'], $query_string, '" method="post">
				<input type="submit" value="Try again" />
			</form>
		</div>';

	show_footer();
	die;
}

// This performs a table alter, but does it unbuffered so the script can time out professionally.
function protected_alter($change, $substep)
{
	global $db_prefix;

	// Firstly, check whether the current index/column exists.
	$found = false;
	if ($change['type'] === 'column')
	{
		$request = upgrade_query("
			SHOW COLUMNS
			FROM {$db_prefix}$change[table]");
		if ($request !== false)
		{
			while ($row = mysql_fetch_row($request))
				$found |= $row[0] === $change['name'];
			mysql_free_result($request);
		}
	}
	elseif ($change['type'] === 'index')
	{
		$request = upgrade_query("
			SHOW INDEX
			FROM {$db_prefix}$change[table]");
		if ($request !== false)
		{
			$cur_index = array();

			while ($row = mysql_fetch_assoc($request))
				if ($row['Key_name'] === $change['name'])
					$cur_index[(int) $row['Seq_in_index']] = $row['Column_name'];

			ksort($cur_index, SORT_NUMERIC);
			$found = array_values($cur_index) === $change['target_columns'];

			mysql_free_result($request);
		}
	}

	// If we're trying to add and it's added, we're done.
	if ($found && in_array($change['method'], array('add', 'change')))
		return true;
	// Otherwise if we're removing and it wasn't found we're also done.
	elseif (!$found && $change['method'] == 'remove')
		return true;

	// Not found it yet? Bummer! How about we see if we're currently doing it?
	$running = false;
	$found = false;
	while (1 == 1)
	{
		$request = upgrade_query("
			SHOW FULL PROCESSLIST");
		while ($row = @mysql_fetch_assoc($request))
		{
			if (strpos($row['Info'], "ALTER TABLE {$db_prefix}$change[table]") !== false && strpos($row['Info'], $change['text']) !== false)
				$found = true;
		}

		// Can't find it? Then we need to run it fools!
		if (!$found && !$running)
		{
			@mysql_free_result($request);

			$success = upgrade_query("
				ALTER TABLE {$db_prefix}$change[table]
				$change[text]", true) !== false;
			
			if (!$success)
				return false;

			// Return
			$running = true;
		}
		// What if we've not found it, but we'd ran it already? Must of completed.
		elseif (!$found)
		{
			@mysql_free_result($request);
			return true;
		}

		// Pause execution for a sec or three.
		sleep(3);

		// Can never be too well protected.
		nextSubstep($substep);
	}

	// Protect it.
	nextSubstep($substep);
}

// Alter a text column definition preserving its character set.
function textfield_alter($change, $substep)
{
	global $db_prefix;

	// Versions of MySQL < 4.1 wouldn't benefit from character set detection.
	if (version_compare('4.1.0', preg_replace('~\-.+?$~', '', min(mysql_get_server_info(), mysql_get_client_info()))) > 0)
	{
		$column_fix = true;
		$null_fix = !$change['null_allowed'];
	}
	else
	{
		$request = upgrade_query("
			SHOW FULL COLUMNS 
			FROM {$db_prefix}$change[table]
			LIKE '$change[column]'");
		if (mysql_num_rows($request) === 0)
			die('Unable to find column ' . $change['column'] . ' inside table ' . $db_prefix . $change['table']);
		$table_row = mysql_fetch_assoc($request);
		mysql_free_result($request);

		// If something of the current column definition is different, fix it.
		$column_fix = $table_row['Type'] !== $change['type'] || (strtolower($table_row['Null']) === 'yes') !== $change['null_allowed'] || ($table_row['Default'] == NULL) !== !isset($change['default']) || (isset($change['default']) && $change['default'] !== $table_row['Default']);

		// Columns that previously allowed null, need to be converted first.
		$null_fix = strtolower($table_row['Null']) === 'yes' && !$change['null_allowed'];

		// Get the character set that goes with the collation of the column.
		if ($column_fix && !empty($table_row['Collation']))
		{
			$request = upgrade_query("
				SHOW COLLATION
				LIKE '$table_row[Collation]'");
			// No results? Just forget it all together.
			if (mysql_num_rows($request) === 0)
				unset($table_row['Collation']);
			else
				$collation_info = mysql_fetch_assoc($request);
			mysql_free_result($request);
		}
	}

	if ($column_fix)
	{
		// Make sure there are no NULL's left.
		if ($null_fix)
			upgrade_query("
				UPDATE {$db_prefix}$change[table]
				SET $change[column] = '" . (isset($change['default']) ? addslashes($change['default']) : '') . "'
				WHERE $change[column] IS NULL");

		// Do the actual alteration.
		upgrade_query("
			ALTER TABLE {$db_prefix}$change[table]
			CHANGE COLUMN $change[column] $change[column] $change[type]" . (isset($collation_info['Charset']) ? " CHARACTER SET $collation_info[Charset] COLLATE $collation_info[Collation]" : '') . ($change['null_allowed'] ? '' : ' NOT NULL') . (isset($change['default']) ? " default '" . addslashes($change['default']) . "'" : ''));
	}
	nextSubstep($substep);
}

function nextSubstep($substep)
{
	global $start_time, $timeLimitThreshold, $command_line, $file_steps, $modSettings, $custom_warning;
	global $step_progress;

	if ($_GET['substep'] < $substep)
		$_GET['substep'] = $substep;

	if ($command_line)
	{
		if (time() - $start_time > 1 && empty($_GET['debug']))
		{
			echo '.';
			$start_time = time();
		}
		return;
	}

	@set_time_limit(300);
	if (function_exists('apache_reset_timeout'))
		apache_reset_timeout();

	if (time() - $start_time <= $timeLimitThreshold)
		return;

	$query_string = '';
	foreach ($_GET as $k => $v)
		$query_string .= ';' . $k . '=' . $v;
	if (strlen($query_string) != 0)
		$query_string = '?' . substr($query_string, 1);

	// Work out what the total percentage done is.
	$percent_done_total = 0;

	// We can only do something meaningful if we have some idea of total steps!
	if (!empty($file_steps))
	{
		if ($substep >= $file_steps)
			$percent_done_total = 99.9;
		else
			$percent_done_total = ($substep / $file_steps) * 100;
	}

	// Finally, if we have more than one file this needs to be changed to accept it!
	if (!isset($modSettings['smfVersion']) || $modSettings['smfVersion'] < '1.1')
	{
		// One way or another we're half as far as we think on this file.
		$percent_done_total /= 2;

		// But wait, have we done the first? If so we're over half way (kinda!)
		if (!empty($_GET['s']))
			$percent_done_total += 50;
	}

	$percent_done_total = round($percent_done_total, 2);

	// Do we have some custom step progress stuff?
	if (!empty($step_progress))
	{
		$step_progress_name = $step_progress['name'];
		if ($step_progress['current'] > $step_progress['total'])
			$step_progress_percent = 99.9;
		else
			$step_progress_percent = ($step_progress['current'] / $step_progress['total']) * 100;

		// Make it nicely rounded.
		$step_progress_percent = round($step_progress_percent, 2);
	}

	echo '
			<i>Incomplete.</i><br />

			<h2 style="margin-top: 2ex;">Not quite done yet!</h2>
			<h3>
				This upgrade has been paused to avoid overloading your server.  Don\'t worry, nothing\'s wrong - simply click the <label for="continue">continue button</label> below to keep going.
			</h3>';

	// Custom warning?
	if (!empty($custom_warning))
		echo '
			<div style="margin: 2ex; padding: 2ex; border: 2px dashed #cc3344; color: black; background-color: #ffe4e9;">
				<div style="float: left; width: 2ex; font-size: 2em; color: red;">!!</div>
				<b style="text-decoration: underline;">Note!</b><br />
				<div style="padding-left: 6ex;">', $custom_warning, '</div>
			</div>';

	echo '
			<div style="padding-left: 20%; padding-right: 20%; margin-top: 1ex;">
				<b>Upgrade Progress:</b>
				<div style="font-size: 8pt; height: 12pt; border: 1px solid black; background-color: white; padding: 1px; position: relative;">
					<div style="padding-top: 1pt; width: 100%; z-index: 2; color: black; position: absolute; text-align: center; font-weight: bold;">', $percent_done_total, '%</div>
					<div style="width: ', $percent_done_total, '%; height: 12pt; z-index: 1; background-color: red;">&nbsp;</div>
				</div>
			</div>';

	// Custom progress bar?
	if (!empty($step_progress_name))
		echo '
			<div style="padding-left: 20%; padding-right: 20%; margin-top: 1ex;">
				<b>Current Step (&quot;', $step_progress_name, '&quot;) Progress:</b>
				<div style="font-size: 8pt; height: 12pt; border: 1px solid black; background-color: white; padding: 1px; position: relative;">
					<div style="padding-top: 1pt; width: 100%; z-index: 2; color: black; position: absolute; text-align: center; font-weight: bold;">', $step_progress_percent, '%</div>
					<div style="width: ', $step_progress_percent, '%; height: 12pt; z-index: 1; background-color: blue;">&nbsp;</div>
				</div>
			</div>';

	echo '
			<form action="', $_SERVER['PHP_SELF'], $query_string, '" method="post" name="autoSubmit">
				<div align="right" style="margin: 1ex;"><input name="b" type="submit" value="Continue" /></div>
			</form>
			<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
				window.onload = doAutoSubmit;
				var countdown = 3;

				function doAutoSubmit()
				{
					if (countdown == 0)
						document.autoSubmit.submit();
					else if (countdown == -1)
						return;

					document.autoSubmit.b.value = "Continue (" + countdown + ")";
					countdown--;

					setTimeout("doAutoSubmit();", 1000);
				}
			// ]]></script>
		</div>';

	show_footer();
	exit;
}

function cmdStep0()
{
	global $boarddir, $sourcedir, $db_prefix, $language, $modSettings, $start_time;
	$start_time = time();

	ob_end_clean();
	ob_implicit_flush(true);
	@set_time_limit(0);

	if (!isset($_SERVER['argv']))
		$_SERVER['argv'] = array();
	$_GET['maint'] = 1;

	foreach ($_SERVER['argv'] as $i => $arg)
	{
		if (preg_match('~^--language=(.+)$~', $arg, $match) != 0)
			$_GET['lang'] = $match[1];
		elseif (preg_match('~^--path=(.+)$~', $arg) != 0)
			continue;
		elseif ($arg == '--no-maintenance')
			$_GET['maint'] = 0;
		elseif ($arg == '--debug')
			$_GET['debug'] = 1;
		elseif ($arg == '--backup')
			$_GET['backup'] = 1;
		elseif ($arg == '--template' && (file_exists($boarddir . '/template.php') || file_exists($boarddir . '/template.html') && !file_exists($boarddir . '/Themes/converted')))
			$_GET['conv'] = 1;
		elseif ($i != 0)
		{
			echo 'SMF Command-line Upgrader
Usage: /path/to/php -f ' . basename(__FILE__) . ' -- [OPTION]...

    --language=LANG         Reset the forum\'s language to LANG.
    --no-maintenance        Don\'t put the forum into maintenance mode.
    --debug                 Output debugging information.
    --backup                Create backups of tables with "backup_" prefix.';
			if (file_exists($boarddir . '/template.php') || file_exists($boarddir . '/template.html') && !file_exists($boarddir . '/Themes/converted'))
				echo '
    --template              Convert the YaBB SE template file.';
			echo "\n";
			exit;
		}
	}

	if (!php_version_check())
		print_error('Error: PHP ' . PHP_VERSION . ' does not match version requirements.', true);
	if (!mysql_version_check())
		print_error('Error: MySQL ' . min(mysql_get_server_info(), mysql_get_client_info()) . ' does not match minimum requirements.', true);

	if (mysql_query("ALTER TABLE {$db_prefix}boards ORDER BY ID_BOARD") === false)
		print_error('Error: The MySQL account in Settings.php does not have sufficient privileges.', true);

	$check = @file_exists($boarddir . '/Themes/default/index.template.php')
		&& @file_exists($sourcedir . '/QueryString.php')
		&& @file_exists($sourcedir . '/ManageBoards.php');
	if (!$check && !isset($modSettings['smfVersion']))
		print_error('Error: Some files are missing or out-of-date.', true);

	// Do a quick version spot check.
	$temp = substr(@implode('', @file($boarddir . '/index.php')), 0, 4096);
	preg_match('~\*\s*Software\s+Version:\s+SMF\s+(.+?)[\s]{2}~i', $temp, $match);
	if (empty($match[1]) || $match[1] != SMF_VERSION)
		print_error('Error: Some files have not yet been updated properly.');

	// Make sure Settings.php is writable.
	if (!is_writable($boarddir . '/Settings.php'))
		@chmod($boarddir . '/Settings.php', 0777);
	if (!is_writable($boarddir . '/Settings.php'))
		print_error('Error: Unable to obtain write access to "Settings.php".');

	// Make sure Settings.php is writable.
	if (!is_writable($boarddir . '/Settings_bak.php'))
		@chmod($boarddir . '/Settings_bak.php', 0777);
	if (!is_writable($boarddir . '/Settings_bak.php'))
		print_error('Error: Unable to obtain write access to "Settings_bak.php".');

	if (isset($modSettings['agreement']) && (!is_writable($boarddir) || file_exists($boarddir . '/agreement.txt')) && !is_writable($boarddir . '/agreement.txt'))
		print_error('Error: Unable to obtain write access to "agreement.txt".');
	elseif (isset($modSettings['agreement']))
	{
		$fp = fopen($boarddir . '/agreement.txt', 'w');
		fwrite($fp, $modSettings['agreement']);
		fclose($fp);
	}

	// Make sure Themes is writable.
	if (!is_writable($boarddir . '/Themes'))
		@chmod($boarddir . '/Themes', 0777);

	if (!is_writable($boarddir . '/Themes') && !isset($modSettings['smfVersion']))
		print_error('Error: Unable to obtain write access to "Themes".');

	if (!file_exists($boarddir . '/Themes/default/languages/index.' . basename($language, '.lng') . '.php') && !isset($modSettings['smfVersion']) && !isset($_GET['lang']))
		print_error('Error: Unable to find language files!');
	else
	{
		$temp = substr(@implode('', @file($boarddir . '/Themes/default/languages/index.' . (isset($_GET['lang']) ? $_GET['lang'] : basename($language, '.lng')) . '.php')), 0, 4096);
		preg_match('~(?://|/\*)\s*Version:\s+(.+?);\s*index(?:[\s]{2}|\*/)~i', $temp, $match);

		if (empty($match[1]) || $match[1] != SMF_LANG_VERSION)
			print_error('Error: Language files out of date.');
	}

	return doStep1();
}

function print_error($message, $fatal = false)
{
	static $fp = null;

	if ($fp === null)
		$fp = fopen('php://stderr', 'wb');

	fwrite($fp, $message . "\n");

	if ($fatal)
		exit;
}

?>