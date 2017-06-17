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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Add an install & configure & uninstall actions
$thisplugin->add_action('plugin_install', 'captcha_install');
$thisplugin->add_action('plugin_configure', 'captcha_configure');
$thisplugin->add_action('plugin_uninstall', 'captcha_uninstall');
// Add a filter for the gallery header
$thisplugin->add_filter('page_html', 'captcha_main');
// Add actions
$thisplugin->add_action('page_start', 'captcha_page_start');
// Install Plugin
function captcha_install()
{
    global $CONFIG, $lang_plugin_captcha;
    require ('plugins/captcha/include/init.inc.php');

    require 'include/sql_parse.php';
    // create table
    $db_schema = 'plugins/captcha/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    foreach($sql_query as $q) {
        cpg_db_query($q);
    }

    return true;
}
// Uninstall (ask admin about dropping table)
function captcha_uninstall()
{
    global $CONFIG;

    cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_captcha");
    return true;
}

/**
 * captcha_main()
 * Filter HTML and ADD Capthca image & confirmation
 *
 * @return HTML
 */
function captcha_main($html)
{
    global $lang_display_comments, $lang_register_php, $lang_plugin_captcha_conf , $CAPTCHA_DISABLE;

    switch ($_SERVER['PHP_SELF']) {
        case 'login.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['login']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['login'] == '') {
                $exper = '(<input type="password".*</td>)';
                if (preg_match($exper, $html)) {
                    $newcpch = '<!-- CAPTCH PLUGIN 3 --><input type="password" class="textinput" name="password" style="width: 100%" tabindex="2" /></td></tr><tr><td class="tableb">' . $lang_plugin_captcha_conf . '</td><td class="tableb" colspan="2"><input type="text" name="confirmCode" id="confirmCode" size="20" class="textinput" style="width=50%" tabindex="3"><img src="captcha.php" align="middle"></td>';
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'register.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['register']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['register'] == '') {
                $exper = '(<td colspan="2" align="center" class="tablef">.*
                 .*<input type="submit" name="submit" value="' . $lang_register_php['submit'] . '" class="button" />.*
             .*</td>)';
                if (preg_match($exper, $html)) {
                    $newcpch = '<!-- CAPTCH PLUGIN 3 --><tr><td class="tableb" height="25" width="40%">' . $lang_plugin_captcha_conf . '</td><td class="tableb_compact" colspan="2"><input type="text" name="confirmCode" id="confirmCode" size="5" class="textinput"><img src="captcha.php" align="middle"></tr><tr><td colspan="2" align="center" class="tablef">
                    <input type="submit" name="submit" value="' . $lang_register_php['submit'] . '" class="button" />
            </td></tr>';
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'displayimage.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['comment']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['comment'] == '') {
                $exper = '(<input type="submit" class="comment_button" name="submit" value="' . $lang_display_comments['OK'] . '" />)';
                if (preg_match($exper, $html)) {
                    if (USER_ID) {
                        $newcpch = '<!-- CAPTCH PLUGIN 3 --><input type="submit" class="comment_button" name="submit" id="submit" value="' . $lang_display_comments['OK'] . '" /></td></tr><tr><td class="tableb_compact" colspan="2">' . $lang_plugin_captcha_conf . '</td><td class="tableb_compact" colspan="2"><input type="text" name="confirmCode" id="confirmCode" size="5" class="textinput"><img src="captcha.php" align="middle">';
                    } else {
                        $newcpch = '<!-- CAPTCH PLUGIN 3 --><input type="submit" class="comment_button" name="submit" id="submit" value="' . $lang_display_comments['OK'] . '" /></td></tr><tr><td class="tableb_compact" >' . $lang_plugin_captcha_conf . '</td><td class="tableb_compact" ><input type="text" name="confirmCode" id="confirmCode" size="5" class="textinput"><td class="tableb_compact"><img src="captcha.php" align="middle"></td><td class="tableb_compact" >&nbsp;</td><td class="tableb_compact" >&nbsp;</td>';
                    }
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }
            break;
        case 'report_file.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['report']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['report'] == '') {
                $exper = '(<textarea.*<br />)';
                if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
            <textarea name="message" class="textinput" rows="8" cols="40" onselect="storeCaret_post(this);" onclick="storeCaret_post(this);" onkeyup="storeCaret_post(this);" style="width: 100%;">$message</textarea><br /><br />
        </td>
        <tr>
            <!-- CAPTCH PLUGIN 3 --><td class="tableh2" colspan="3"><b>{$lang_plugin_captcha_conf}</b><img src="captcha.php" align="middle"></td>
        </tr>
        <tr>
            <td class="tableb" colspan="3">
                                                                                <input type="text" name="confirmCode" id="confirmCode" size="5" class="textinput" style="width: 100%;">
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }

            break;
        case 'ecard.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['ecard']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['ecard'] == '') {
                $exper = '(<textarea.*<br />)';
                if (preg_match($exper, $html)) {
                    $newcpch = <<<EOT
            <textarea name="message" class="textinput" rows="8" cols="40" onselect="storeCaret_post(this);" onclick="storeCaret_post(this);" onkeyup="storeCaret_post(this);" style="width: 100%;">$message</textarea><br /><br />
        </td>
        <tr>
            <!-- CAPTCH PLUGIN 3 --><td class="tableh2" colspan="3"><b>{$lang_plugin_captcha_conf}</b><img src="captcha.php" align="middle"></td>
        </tr>
        <tr>
            <td class="tableb" colspan="3">
                                                                                <input type="text" name="confirmCode" id="confirmCode" size="5" class="textinput" style="width: 100%;">
EOT;
                    $html = preg_replace($exper, $newcpch, $html);
                }
            }

            break;
        default: ;
    } // switch
    return $html;
}
/**
 * captcha_page_start()
 * check/validate captcha confirmation code [user input] for each page
 *
 * @return
 */
function captcha_page_start()
{
    global $lang_continue, $lang_error, $lang_plugin_captcha_conf, $CONFIG, $CAPTCHA_DISABLE, $CAPTCHA_TIMEOUT;
    /*                              Setting Options                                        */
    /**
     * Enable/Disable array
     *
     * Set which group should NOT see Captcha on each page
     * ''=> Captcha Enable for all users
     * COppermine Standard Group Name:
     * Administrators,Registered,Guests,Banned
     * You can add your custome group name too
     * Seprated by ','
     */

    $CAPTCHA_DISABLE = array('login' => 'Administrators,Registered,Guests',
        'register' => 'Administrators,Registered',
        'comment' => 'Administrators,Registered',
        'report' => 'Administrators',
        'ecard' => 'Administrators',
        );
    $CAPTCHA_TIMEOUT = 300; // How many sec should passed before we remove the code from database
    require ('plugins/captcha/include/init.inc.php');
    require('plugins/captcha/include/captcha.class.php');

    switch ($_SERVER['PHP_SELF']) {
        case 'login.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['login']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['login'] == '') {
                if (isset($_POST['submitted']) AND !Validate($_POST['confirmCode'])) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"3;url=login.php\">");
                    msg_box($lang_error, "$lang_plugin_captcha_error", $lang_continue, 'login.php');
                    pagefooter();
                    exit;
                }
            }
            break;
        case 'register.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['register']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['register'] == '') {
                if (isset($_POST['submit']) AND !Validate($_POST['confirmCode'])) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"3;url=register.php\">");
                    msg_box($lang_error, "$lang_plugin_captcha_error", $lang_continue, 'register.php');
                    pagefooter();
                    exit;
                }
            }
            break;
        case 'db_input.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['comment']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['comment'] == '') {
                if (isset($_POST['msg_body']) AND !Validate($_POST['confirmCode'])) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"3;url=displayimage.php?pos=" . (- $_POST['pid']) . "\">");
                    msg_box($lang_error, "$lang_plugin_captcha_error", $lang_continue, "displayimage.php?pos=" . (- $_POST['pid']));
                    pagefooter();
                    exit;
                }
            }
            break;
        case 'report_file.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['report']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['report'] == '') {
                if (count($_POST) > 0 AND !Validate($_POST['confirmCode'])) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"3;url=report_file.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}\">");
                    msg_box($lang_error, "$lang_plugin_captcha_error", $lang_continue, "report_file.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}");
                    pagefooter();
                    exit;
                }
            }
            break;
        case 'ecard.php':
            $valid_groups = explode(',', $CAPTCHA_DISABLE['ecard']);
            if (!in_array(USER_GROUP, $valid_groups) OR $CAPTCHA_DISABLE['ecard'] == '') {
                if (count($_POST) > 0 AND !Validate($_POST['confirmCode'])) {
                    load_template();
                    pageheader($lang_error, "<META http-equiv=\"refresh\" content=\"3;url=ecard.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}\">");
                    msg_box($lang_error, "$lang_plugin_captcha_error", $lang_continue, "ecard.php?album={$_GET['album']}&pid={$_GET['pid']}&pos={$_GET['pos']}");
                    pagefooter();
                    exit;
                }
            }
            break;
        default: ;
    } // switch
}

/**
 * Validate()
 * Retrieve Captcha code from database based on ip address and user input
 *
 * @param string $sUserCode
 * @return boolian
 */
function Validate($sUserCode)
{
    global $CONFIG, $CAPTCHA_TIMEOUT;
    $timeout = (time() - $CAPTCHA_TIMEOUT); // set timeout for removing old enteries
    $query = "DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_captcha where UNIX_TIMESTAMP(time) < $timeout ";
    cpg_db_query($query);
    $ip = $_SERVER['REMOTE_ADDR'];
    $code = md5(strtoupper($sUserCode));
    $query = "SELECT COUNT(*) AS ccount FROM {$CONFIG['TABLE_PREFIX']}plugin_captcha WHERE ((ip_addr = '$ip') AND (code ='$code')) LIMIT 1";
    $results = cpg_db_query($query);
    $result = mysql_fetch_assoc($results);
    if ($result['ccount']) {
        return true;
    }
    return false;
}

?>