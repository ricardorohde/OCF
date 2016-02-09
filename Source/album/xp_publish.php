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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.4.x/xp_publish.php $
  $Revision: 4380 $
  $Author: gaugau $
  $Date: 2008-04-12 12:00:19 +0200 (Sa, 12 Apr 2008) $
**********************************************/

// ------------------------------------------------------------------------- //
// Coppermine Windows XP Web Publishing Wizard Client                        //
// Based on the article posted by Sebastian Delmont                          //
// http://www.zonageek.com/code/misc/wizards/                                //
// ------------------------------------------------------------------------- //
// Other information can be found on Microsoft web site                      //
// http://www.microsoft.com/whdc/hwdev/tech/WIA/imaging/webwizard.mspx       //
// http://msdn.microsoft.com/library/default.asp?url=/library/en-us/shellcc/platform/shell/programmersguide/shell_basics/shell_basics_extending/publishing_wizard/pubwiz_intro.asp
// ------------------------------------------------------------------------- //
// Original implementation comes from Gallery                                //
// http://gallery.menalto.com                                                //
// ------------------------------------------------------------------------- //

// Declare we are in Coppermine.
define('IN_COPPERMINE', true);

// Set the language block.
define('XP_PUBLISH_PHP', true);

// Activate more language block sets.
define('LOGIN_PHP', true);
define('DB_INPUT_PHP', true);
define('ALBMGR_PHP', true);


// Call necessaryy files and subroutines.
require('include/init.inc.php');
require('include/picmgmt.inc.php');

// Set the log file path.
define('LOGFILE', 'xp_publish.log');
// ------------------------------------------------------------------------- //

// HTML template for the login screen
$template_login = <<<EOT
        <p><b>{ENTER_LOGIN_PSWD}</b></p>
        <form method="post" id="login" action="{POST_ACTION}">
            <table border="0" cellpadding="0" cellspasing="0">
                <tr>
                        <td>{USERNAME}:&nbsp;</td>
                        <td><input type="text" name="username" value="" maxlength="25" /></td>
                </tr>
                <tr>
                        <td>{PASSWORD}:&nbsp;</td>
                        <td><input type="password" name="password" value="" maxlength="25" /></td>
            </tr>
            </table>
        </form>
EOT;

// HTML template for a successful login
$template_login_success = <<< EOT
        <p>{WELCOME}</p>
        <form method="post" id="dummy" action="{POST_ACTION}">
                <input type="hidden" name="dummy_val" value="1" />
        </form>
<script language="javascript" type="text/javascript">
dummy.submit();
</script>
EOT;
// HTML template for an unsuccessful login
$template_login_failure = <<< EOT
        <p>{ERROR}</p>
        <form method="post" id="dummy" action="{POST_ACTION}">
                <input type="hidden" name="dummy_val" value="1" />
        </form>
EOT;

// HTML template for the select destination/create new album screen
$template_select_album = <<<EOT
        <p>{WELCOME}</p>
        <br />
<!-- BEGIN no_album -->
        <p>{NO_ALBUM}</p>
<!-- END no_album -->
   <table border="0" cellpadding="0" cellspasing="0">
<!-- BEGIN existing_albums -->
        <tr>
                <td colspan="2"><b>{UPLOAD}</b></td>
        </tr>
        <form id="selform">
    <tr>
                <td>{ALBUM}: &nbsp;</td>
                <td><select id="album" name="album">{SELECT_ALBUM}</select></td>
        </tr>
        </form>
        <tr>
                <td>&nbsp;</td>
        </tr>
<!-- END existing_albums -->
<!-- BEGIN create_album -->
        <form method="post" id="createAlb" action="{POST_ACTION}">
        <tr>
                <td colspan="2"><b>{CREATE_NEW}</b></td>
        </tr>
    <tr>
                <td>{ALBUM}: &nbsp;</td>
                <td><input type="text" id="newAlbName" name="new_alb_name" value="" maxlength="255" /></td>
        </tr>
<!-- BEGIN select_category -->
        <tr>
                <td>{CATEGORY}: &nbsp;</td>
                <td><select name="cat">{SELECT_CATEGORY}</select></td>
        </tr>
<!-- END select_category -->
        </form>
<!-- END create_album -->
        </table>

EOT;
// HTML template for a successful album creation
$template_create_album = <<<EOT
        <p>{NEW_ALB_CREATED}</p>
        <p>{CONTINUE}</p>
        <form id="selform">
                <input type="hidden" id="album" name="album" value ="{ALBUM_ID}" />
        </form>

EOT;
// ------------------------------------------------------------------------- //

// Simple die function (replace the cpg_die function that can't be used inside the wizard)
function simple_die($msg_code, $msg_text, $error_file, $error_line, $output_buffer = false)
{
    global $CONFIG, $lang_cpg_die;

    $msg = $lang_cpg_die[$msg_code] . ': ' . $msg_text;

    if (!$CONFIG['debug_mode']) {
        $msg .= '(' . $lang_cpg_die['file'] . ': ' . $error_file . ' / ' . $lang_cpg_die['line'] . ': ' . $error_line . ')';
    }

    echo $msg;
    // If debug mode is active, write the output into a log file
    if (!$CONFIG['debug_mode']) {
        $ob = ob_get_contents();
        fwrite(fopen(LOGFILE, 'w'), $ob);
    }

    exit;
}
// Quote a string in order to make a valid JavaScript string
function javascript_string($str)
{
    // replace \ with \\ and then ' with \'.
    $str = str_replace('\\', '\\\\', $str);
    $str = str_replace('\'', '\\\'', $str);

    return $str;
}

// Retrieve the category list
function get_subcat_data($parent, $ident = '')
{
    global $CONFIG, $CAT_LIST;

    $result = cpg_db_query("SELECT cid, name, description FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent' AND cid != 1 ORDER BY pos");
    if (mysql_num_rows($result) > 0) {
        $rowset = cpg_db_fetch_rowset($result);
        foreach ($rowset as $subcat) {
            $CAT_LIST[] = array($subcat['cid'], $ident . $subcat['name']);
            get_subcat_data($subcat['cid'], $ident . '&nbsp;&nbsp;&nbsp;');
        }
    }
}

// Return the HTML code for the album list select box
function html_album_list(&$alb_count)
{
    global $CONFIG;

    if (USER_IS_ADMIN) {
        $public_albums = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category < " . FIRST_USER_CAT . " ORDER BY title");
        if (mysql_num_rows($public_albums)) {
            $public_albums_list = cpg_db_fetch_rowset($public_albums);
        } else {
            $public_albums_list = array();
        }
    } else {
        $public_albums_list = array();
    }

    if (USER_ID) {
        $user_albums = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category='" . (FIRST_USER_CAT + USER_ID) . "' ORDER BY title");
        if (mysql_num_rows($user_albums)) {
            $user_albums_list = cpg_db_fetch_rowset($user_albums);
        } else {
            $user_albums_list = array();
        }
    } else {
        $user_albums_list = array();
    }

    $alb_count = count($public_albums_list) + count($user_albums_list);

    $html = "\n";
    foreach($user_albums_list as $album) {
        $html .= '                        <option value="' . $album['aid'] . '">* ' . $album['title'] . "</option>\n";
    }
    foreach($public_albums_list as $album) {
        $html .= '                        <option value="' . $album['aid'] . '">' . $album['title'] . "</option>\n";
    }

    return $html;
}
// Return the HTML code for the category list select box
function html_cat_list()
{
    global $CONFIG, $CAT_LIST;
    global $lang_albmgr_php;

    $CAT_LIST = array();
    if (USER_CAN_CREATE_ALBUMS) $CAT_LIST[] = array(FIRST_USER_CAT + USER_ID, $lang_albmgr_php['my_gallery']);
    $CAT_LIST[] = array(0, $lang_albmgr_php['no_category']);

    get_subcat_data(0, '');

    $html = "\n";
    foreach($CAT_LIST as $category) {
        $html .= '                        <option value="' . $category[0] . '">' . $category[1] . "</option>\n";
    }

    return $html;
}

// Display information on how to use/install the wizard client
function display_instructions()
{
    //global $PHP_SELF;
    global $lang_xp_publish_required, $lang_xp_publish_client, $lang_xp_publish_select, $lang_xp_publish_testing, $lang_xp_publish_notes, $lang_xp_publish_flood, $lang_xp_publish_php;
    global $CONFIG, $lang_charset;
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Coppermine Photo Gallery - XP Publish README</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset']; ?>" />
<style type="text/css">
<!--
body {
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        background : #F7F7F7 ;
        color : Black;
        margin: 30px;
        line-height: 1.5;
}

td {
        font-size: 12px;
}

h1{
        font-weight: bold;
        font-size: 22px;
        font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
        text-decoration: none;
        line-height : 120%;
        color : #000000;
}

h2 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        color: #0E72A4;
        text-decoration: underline;
        margin-top: 20px;
        margin-bottom: 10px;
}

h3 {
        font-weight: bold;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        text-decoration: underline;
}

p {
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        margin: 10px 10px 0px 0px;
}

ul {
        margin-left: 5px;
        margin-right: 0px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 0px;
        list-style-type: square;
}

li {
        margin-left: 10px;
        margin-top: 6px;
        margin-bottom: 6px;
        padding: 0px;
        list-style-position: outside;
}
-->
</style>
<!-- $Id: xp_publish.php 4380 2008-04-12 10:00:19Z gaugau $ -->
</head>

<body>
<?php echo $lang_xp_publish_client ?> Sebastian Delmont <a href="http://www.zonageek.com/code/misc/wizards/">Creating your own XP Publishing Wizard</a>.</p>

<?php echo $lang_xp_publish_required ?> <a href="<?php echo $_SERVER['PHP_SELF'] ?>?cmd=send_reg"><?php echo $lang_xp_publish_php['link'] ?></a>. <?php echo $lang_xp_publish_select,
$lang_xp_publish_testing,
$lang_xp_publish_notes; ?>
  <a href="<?php echo dirname($_SERVER['PHP_SELF']) . '/' . LOGFILE ?>"><?php echo LOGFILE ?></a>
<?php echo $lang_xp_publish_flood ?>
</body>
</html>
<?php
}

// Output page header
function output_header()
{
    global $CONFIG;
    global $lang_charset, $lang_text_dir, $lang_xp_publish_php;

    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="ltr">
<head>
<title><?php echo $lang_xp_publish_php['title'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'];
    ?>" />
<style type="text/css">
<!--
body {
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        background : #FFFFFF ;
        color : Black;
        margin: 20px;
        border: 1px solid #000000;
}

td {
        font-size: 12px;
        padding-top: 5px;
        padding-bottom: 0px;
}

h1{
        font-weight: bold;
        font-size: 22px;
        font-family: Arial, Helvetica, sans-serif;
        text-decoration: none;
        line-height : 120%;
        color : #0E72A4;
}

h2 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        color: #0E72A4;
        text-decoration: underline;
}

h3 {
        font-weight: bold;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        text-decoration: underline;
}

p {
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        margin: 10px 10px 0px 0px;
}

ul {
        margin-left: 5px;
        margin-right: 0px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 0px;
}

li {
        margin-left: 10px;
        margin-top: 4px;
        margin-bottom: 4px;
        padding: 0px;
        list-style-position: outside;
        list-style-type: disc;
}

form {
        display: inline;
}

input {
        width: 200px;
}

-->
</style>
</head>

<body>
<h1><?php echo $lang_xp_publish_php['title'] ?></h1>
<p></p>
<?php
}

// Output page footer
function output_footer()
{
    global $WIZARD_BUTTONS, $ONBACK_SCRIPT, $ONNEXT_SCRIPT;
    global $CONFIG; //$PHP_SELF,

    ?>

<div id="content"></div>

<script language="javascript" type="text/javascript">
function create_alb() {
        if (createAlb.newAlbName.value == ''){
                return false;
        } else {
                createAlb.submit();
        }
}

function create_alb_or_use_existing() {
        if (createAlb.newAlbName.value == ''){
                startUpload();
        } else {
                createAlb.submit();
        }
}

function startUpload() {
        var xml = window.external.Property('TransferManifest');
        var files = xml.selectNodes('transfermanifest/filelist/file');

        for (i = 0; i < files.length; i++) {
                var postTag = xml.createNode(1, 'post', '');
                postTag.setAttribute('href', '<?php echo trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=add_picture'?>&album=' + selform.album.value);
                postTag.setAttribute('name', 'userpicture');

                var dataTag = xml.createNode(1, 'formdata', '');
                dataTag.setAttribute('name', 'MAX_FILE_SIZE');
                dataTag.text = '10000000';
                postTag.appendChild(dataTag);

                files.item(i).appendChild(postTag);
        }

        var uploadTag = xml.createNode(1, 'uploadinfo', '');
        uploadTag.setAttribute('friendlyname', '<?php echo javascript_string($CONFIG['gallery_name'])?>');
        var htmluiTag = xml.createNode(1, 'htmlui', '');
        htmluiTag.text = '<?php echo trim($CONFIG['site_url'], '/') . '/'?>';
        uploadTag.appendChild(htmluiTag);

        xml.documentElement.appendChild(uploadTag);

        window.external.Property('TransferManifest')=xml;
        window.external.SetWizardButtons(true,true,true);
        content.innerHtml=xml;
        window.external.FinalNext();
}

function OnBack() {
        <?php echo $ONBACK_SCRIPT;
    ?>
        window.external.SetWizardButtons(false,true,false);
}

function OnNext() {
        <?php echo $ONNEXT_SCRIPT;
    ?>
}

function OnCancel() {
}

function window.onload() {
        window.external.SetHeaderText('<?php echo javascript_string($CONFIG['gallery_name'])?>','<?php echo javascript_string($CONFIG['gallery_description'])?>');
        window.external.SetWizardButtons(<?php echo $WIZARD_BUTTONS;
    ?>);
}
</script>
</body>
</html>
<?php
}

// Send the file needed to register the service under Windows XP
function send_reg_file()
{
    global $CONFIG; //, $PHP_SELF;

    header("Content-Type: application/octet-stream");
    $time_stamp = time();
        header("Content-Disposition: attachment; filename=cpg_".$time_stamp.".reg");

    $lines[] = 'Windows Registry Editor Version 5.00';
    //$lines[] = '[HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\PublishingWizard\PublishingWizard\Providers\CopperminePhotoGallery]';
        $lines[] = '[HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\PublishingWizard\PublishingWizard\Providers\\'. $CONFIG['gallery_name'] .']';
    $lines[] = '"displayname"="' . $CONFIG['gallery_name'] . '"';
    $lines[] = '"description"="' . $CONFIG['gallery_description'] . '"';
    $lines[] = '"href"="' . trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=publish"';
    $lines[] = '"icon"="' . "http://" . $_SERVER['HTTP_HOST'] . '/favicon.ico"';
    print join("\r\n", $lines);
    print "\r\n";
    exit;
}

// Display the login page
function form_login()
{
    //global $PHP_SELF;
    global $ONNEXT_SCRIPT, $ONBACK_SCRIPT, $WIZARD_BUTTONS;
    global $template_login;
    global $lang_login_php, $lang_xp_publish_php, $cpg_udb;
	global $CONFIG;


    if (!method_exists($cpg_udb,'login')) {
        echo '<p>' . $lang_xp_publish_php['need_login'] . '</p>';
        $ONNEXT_SCRIPT = '';
        $ONBACK_SCRIPT = 'window.external.FinalBack();';
        $WIZARD_BUTTONS = 'false,false,false';
        return;
    }

    $params = array('{POST_ACTION}' => trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=publish',
        '{ENTER_LOGIN_PSWD}' => $lang_login_php['enter_login_pswd'],
        '{USERNAME}' => $lang_login_php['username'],
        '{PASSWORD}' => $lang_login_php['password'],
        );

    echo template_eval($template_login, $params);

    $ONNEXT_SCRIPT = 'login.submit();';
    $ONBACK_SCRIPT = 'window.external.FinalBack();';
    $WIZARD_BUTTONS = 'true,true,false';
}

// Process login information
function process_login()
{
    global $CONFIG, $USER; //$PHP_SELF,
    global $ONNEXT_SCRIPT, $ONBACK_SCRIPT, $WIZARD_BUTTONS;
    global $template_login_success, $template_login_failure,$template_login;
    global $lang_login_php, $cpg_udb;

    $tt = 'worked';

    if ( $USER_DATA = $cpg_udb->login(addslashes($_POST['username']), addslashes($_POST['password'])) ) {
        $USER['am'] = 1;
        user_save_profile();

        $params = array('{WELCOME}' => sprintf($lang_login_php['welcome'], USER_NAME),
            '{POST_ACTION}' => trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=publish',
            );

        echo template_eval($template_login_success, $params);
    } else {
        $params = array('{ERROR}' => $lang_login_php['err_login'],
            '{POST_ACTION}' => trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=publish',
            );


        echo template_eval($template_login_failure, $params);
    }

    $ONNEXT_SCRIPT = 'dummy.submit();';
    $ONBACK_SCRIPT = 'dummy.submit();';
    $WIZARD_BUTTONS = 'true,true,false';
}

// Display the form that allows to choose/create the destination album
function form_publish()
{
    global $CONFIG, $CAT_LIST; //, $PHP_SELF;
    global $ONNEXT_SCRIPT, $ONBACK_SCRIPT, $WIZARD_BUTTONS;
    global $template_select_album;
    global $lang_xp_publish_php;

    $alb_count = 0;
    $html_album_list = html_album_list($alb_count);
    $html_cat_list = html_cat_list();

    if (!(USER_CAN_CREATE_ALBUMS || USER_IS_ADMIN)) {
        template_extract_block($template_select_album, 'existing_albums');
        template_extract_block($template_select_album, 'create_album');

        $params = array('{WELCOME}' => sprintf($lang_xp_publish_php['welcome'], USER_NAME),
            '{NO_ALBUM}' => $lang_xp_publish_php['no_alb'],
            );

        echo template_eval($template_select_album, $params);

        $WIZARD_BUTTONS = "false,false,false";
    } elseif (!$alb_count) {
        template_extract_block($template_select_album, 'no_album');
        template_extract_block($template_select_album, 'existing_albums');

        if (!USER_IS_ADMIN) template_extract_block($template_select_album, 'select_category');

        $params = array('{WELCOME}' => sprintf($lang_xp_publish_php['welcome'], USER_NAME),
            '{CREATE_NEW}' => $lang_xp_publish_php['create_new'],
            '{ALBUM}' => $lang_xp_publish_php['album'],
            '{CATEGORY}' => $lang_xp_publish_php['category'],
            '{SELECT_CATEGORY}' => $html_cat_list,
            '{POST_ACTION}' => trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=create_album',
            );

        echo template_eval($template_select_album, $params);

        $ONNEXT_SCRIPT = 'create_alb();';
        $ONBACK_SCRIPT = 'window.external.FinalBack();';
        $WIZARD_BUTTONS = 'true,true,false';
    } else {
        template_extract_block($template_select_album, 'no_album');

        if (!USER_IS_ADMIN) template_extract_block($template_select_album, 'select_category');

        $params = array('{WELCOME}' => sprintf($lang_xp_publish_php['welcome'], USER_NAME),
            '{UPLOAD}' => $lang_xp_publish_php['upload'],
            '{ALBUM}' => $lang_xp_publish_php['album'],
            '{SELECT_ALBUM}' => $html_album_list,
            '{CATEGORY}' => $lang_xp_publish_php['category'],
            '{SELECT_CATEGORY}' => $html_cat_list,
            '{CREATE_NEW}' => $lang_xp_publish_php['create_new'],
            '{POST_ACTION}' => trim($CONFIG['site_url'], '/') . '/' . $_SERVER['PHP_SELF'] . '?cmd=create_album',
            );

        echo template_eval($template_select_album, $params);

        $ONNEXT_SCRIPT = 'create_alb_or_use_existing();';
        $ONBACK_SCRIPT = 'window.external.FinalBack();';
        $WIZARD_BUTTONS = 'true,true,false';
    }
}

// Create a new album where pictures will be uploaded
function create_album()
{
    global $CONFIG;
    global $ONNEXT_SCRIPT, $ONBACK_SCRIPT, $WIZARD_BUTTONS;
    global $template_create_album;
    global $lang_errors, $lang_xp_publish_php;

    if (!(USER_CAN_CREATE_ALBUMS || USER_IS_ADMIN)) simple_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);

    if (USER_IS_ADMIN) {
        $category = (int)$_POST['cat'];
    } else {
        $category = FIRST_USER_CAT + USER_ID;
    }

    $query = "INSERT INTO {$CONFIG['TABLE_ALBUMS']} (category, title, uploads, pos) VALUES ('$category', '" . addslashes($_POST['new_alb_name']) . "', 'NO',  '0')";
    cpg_db_query($query);

    $params = array('{NEW_ALB_CREATED}' => sprintf($lang_xp_publish_php['new_alb_created'], $_POST['new_alb_name']),
        '{CONTINUE}' => $lang_xp_publish_php['continue'],
        '{ALBUM_ID}' => mysql_insert_id(),
        );

    echo template_eval($template_create_album, $params);

    $ONNEXT_SCRIPT = 'startUpload();';
    $ONBACK_SCRIPT = 'window.external.FinalBack();';
    $WIZARD_BUTTONS = 'true,true,true';
}

// Add a picture
function process_picture()
{
    global $CONFIG, $IMG_TYPES;
    global $lang_db_input_php, $lang_errors;

    @unlink(LOGFILE);

    if (!USER_ID || !USER_CAN_UPLOAD_PICTURES) simple_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);

    $album = (int)$_GET['album'];
    $title = '';
    $caption = '';
    $keywords = '';
    $user1 = '';
    $user2 = '';
    $user3 = '';
    $user4 = '';
    $position = 0;
    // Check if the album id provided is valid
    if (!USER_IS_ADMIN) {
        $result = cpg_db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album' and category = '" . (USER_ID + FIRST_USER_CAT) . "'");
        if (mysql_num_rows($result) == 0) simple_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
        $row = mysql_fetch_array($result);
        mysql_free_result($result);
        $category = $row['category'];
    } else {
        $result = cpg_db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
        if (mysql_num_rows($result) == 0) simple_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
        $row = mysql_fetch_array($result);
        mysql_free_result($result);
        $category = $row['category'];
    }

    // Get position
    $result = cpg_db_query("SELECT position FROM {$CONFIG['TABLE_PICTURES']} WHERE aid='$album' order by position desc");
    if (mysql_num_rows($result) == 0) {
             $position = 100;
    } else {
             $row = mysql_fetch_array($result);
             mysql_free_result($result);
                     if ($row['position']) {
                     $position = $row['position'];
                             $position++;
                                         }
    }


    // Test if the filename of the temporary uploaded picture is empty
    if ($_FILES['userpicture']['tmp_name'] == '') simple_die(ERROR, $lang_db_input_php['no_pic_uploaded'], __FILE__, __LINE__);
    // Create destination directory for pictures
    if (USER_ID && !defined('SILLY_SAFE_MODE')) {
        if (USER_IS_ADMIN && ($category != (USER_ID + FIRST_USER_CAT))) {
            $filepath = 'wpw-' . date("Ymd");
        } else {
            $filepath = $CONFIG['userpics'] . (USER_ID + FIRST_USER_CAT);
        }
        $dest_dir = $CONFIG['fullpath'] . $filepath;
        if (!is_dir($dest_dir)) {
            mkdir($dest_dir, octdec($CONFIG['default_dir_mode']));
            if (!is_dir($dest_dir)) simple_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_mkdir'], $dest_dir), __FILE__, __LINE__, true);
            chmod($dest_dir, octdec($CONFIG['default_dir_mode']));
            $fp = fopen($dest_dir . '/index.html', 'w');
            fwrite($fp, ' ');
            fclose($fp);
        }
        $dest_dir .= '/';
        $filepath .= '/';
    } else {
        $filepath = $CONFIG['userpics'];
        $dest_dir = $CONFIG['fullpath'] . $filepath;
    }
    // Check that target dir is writable
    if (!is_writable($dest_dir)) simple_die(CRITICAL_ERROR, sprintf($lang_db_input_php['dest_dir_ro'], $dest_dir), __FILE__, __LINE__, true);

    $matches = array();

    if (get_magic_quotes_gpc()) $_FILES['userpicture']['name'] = stripslashes($_FILES['userpicture']['name']);
    // Replace forbidden chars with underscores
    $picture_name = replace_forbidden($_FILES['userpicture']['name']);
    // Check that the file uploaded has a valid extension
    if (!preg_match("/(.+)\.(.*?)\Z/", $picture_name, $matches)) {
        $matches[1] = 'invalid_fname';
        $matches[2] = 'xxx';
    }

    if ($matches[2] == '' || !is_known_filetype($matches)) {
        simple_die(ERROR, sprintf($lang_db_input_php['err_invalid_fext'], $CONFIG['allowed_file_extensions']), __FILE__, __LINE__);
    }

    // Create a unique name for the uploaded file
    $nr = 0;
    $picture_name = $matches[1] . '.' . $matches[2];
    while (file_exists($dest_dir . $picture_name)) {
        $picture_name = $matches[1] . '~' . $nr++ . '.' . $matches[2];
    }
    $uploaded_pic = $dest_dir . $picture_name;
    // Move the picture into its final location
    if (!move_uploaded_file($_FILES['userpicture']['tmp_name'], $uploaded_pic))
        simple_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_move'], $picture_name, $dest_dir), __FILE__, __LINE__, true);
    // Change file permission
    chmod($uploaded_pic, octdec($CONFIG['default_file_mode']));

    // Check file size. Delete if it is excessive.
    if (filesize($uploaded_pic) > ($CONFIG['max_upl_size'] << 10)) {
        @unlink($uploaded_pic);
        simple_die(ERROR, sprintf($lang_db_input_php['err_imgsize_too_large'], $CONFIG['max_upl_size']), __FILE__, __LINE__);
    } elseif (is_image($picture_name)) {

        // Get picture information
        $imginfo = getimagesize($uploaded_pic);

        // getimagesize does not recognize the file as a picture
        if ($imginfo == null) {
            @unlink($uploaded_pic);
            simple_die(ERROR, $lang_db_input_php['err_invalid_img'], __FILE__, __LINE__, true);
        }

        // JPEG and PNG only are allowed with GD
        //if ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && ($CONFIG['thumb_method'] == 'gd1' || $CONFIG['thumb_method'] == 'gd2')) {
        if ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && $CONFIG['GIF_support'] == 0) {
            @unlink($uploaded_pic);
            simple_die(ERROR, $lang_errors['gd_file_type_err'], __FILE__, __LINE__, true);
        }

        // Check that picture size (in pixels) is lower than the maximum allowed
        if (max($imginfo[0], $imginfo[1]) > $CONFIG['max_upl_width_height']) {
            if ((USER_IS_ADMIN && $CONFIG['auto_resize'] == 1) || (!USER_IS_ADMIN && $CONFIG['auto_resize'] > 0)) //($CONFIG['auto_resize']==1)
            {
              //resize_image($uploaded_pic, $uploaded_pic, $CONFIG['max_upl_width_height'], $CONFIG['thumb_method'], $imginfo[0] > $CONFIG['max_upl_width_height'] ? 'wd' : 'ht');
              resize_image($uploaded_pic, $uploaded_pic, $CONFIG['max_upl_width_height'], $CONFIG['thumb_method'], $CONFIG['thumb_use']);
            }
            else
            {
              @unlink($uploaded_pic);
              simple_die(ERROR, sprintf($lang_db_input_php['err_fsize_too_large'], $CONFIG['max_upl_width_height'], $CONFIG['max_upl_width_height']), __FILE__, __LINE__);
            }
        }

    }

    // Create thumbnail and internediate image and add the image into the DB
    $result = add_picture($album, $filepath, $picture_name, $position, $title, $caption, $keywords, $user1, $user2, $user3, $user4, $category);

    if (!$result) {
        @unlink($uploaded_pic);
        simple_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_insert_pic'], $uploaded_pic) . '<br /><br />' . $ERROR, __FILE__, __LINE__, true);
    } else {
        echo ("SUCCESS");
        exit;
    }

}
// ------------------------------------------------------------------------- //
if (USER_IS_ADMIN && !GALLERY_ADMIN_MODE) {
    $USER['am'] = 1;
    user_save_profile();
}

$cmd = empty($_GET['cmd']) ? '' : $_GET['cmd'];

if (!USER_ID && $cmd && $cmd != 'send_reg') $cmd = 'login';
if (!empty($_POST['username'])) $cmd = 'process_login';

switch ($cmd) {
    case 'login' :
        output_header();
        form_login();
        output_footer();
        break;

    case 'process_login' :
        output_header();
        process_login();
        output_footer();
        break;

    case 'publish' :
        output_header();
        form_publish();
        output_footer();
        break;

    case 'create_album' :
        output_header();
        create_album();
        output_footer();
        break;

    case 'add_picture' :
        process_picture();
        break;

    case 'send_reg' :
        send_reg_file();
        break;

    default:
        display_instructions();
} // switch

?>
