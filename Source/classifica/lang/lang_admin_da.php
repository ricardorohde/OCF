<?php
// Translation rate: 38%
// (100% means fully translated, 0% means not translated at all)

// If you edit this file, save it in UTF-8 character encoding! 
// Most text editors allow you to select the character encoding you use - even notepad.
// Saving in UTF-8 is important for Noah's Classifieds to be able to display special characters correctly.

// If you make a new translation (or make fixes in an existing one)and want to share 
// your work with other people, too, send us the language file and we will include it 
// in the next release of Noah's.

// You can read more more about the internationalization in the Noah's documentation under:
// http://www.noahsclassifieds.org/documentation/translation

// Content begins:

// Added in 4.1.0:
$lll["settings_displayResponseLink_0"]="none";
$lll["settings_displayFriendmailLink_0"]="none";
$lll["settings_displayResponseLink_1"]="all";
$lll["settings_displayFriendmailLink_1"]="all";
$lll["settings_displayResponseLink_2"]="logged in users only";
$lll["settings_displayFriendmailLink_2"]="logged in users only";
$lll["settings_displayResponseLink_4"]="admin only";
$lll["settings_displayFriendmailLink_4"]="admin only";
$lll["settings_displayResponseLink_5"]="all but admin";
$lll["settings_displayFriendmailLink_5"]="all but admin";
$lll["showInForm_6"]="all in the create form, but admin only in the modify form";
$lll["settings_displayResponseLink"]="Display the 'Contact this user' link on the user details pages.";
$lll["settings_displayFriendmailLink"]="Display the 'Email to a friend' link on the user details pages.";
$lll["enableDisableProperties"]="Enable/disable features";


// Added in 4.0.2:
$lll["settings_downsizeWidth"]="Downsize width in pixels";
$lll["settings_downsizeWidth_expl"]="The uploaded pictures will be automatically downsized to this width. If you enter 0 both as the 'Downsize width' and 'Downsize height', the images will be stored in their original size. If you give a non-null value to only one of the dimensions, the other one will be proportionally calculated.";
$lll["settings_downsizeHeight"]="Downsize height in pixels";
$lll["settings_downsizeHeight_expl"]="The uploaded pictures will be automatically downsized to this height";


// Added in 4.0.0:
$lll["nopermission_read"]="The program has no read permission under the following directories: %s<br>You must execute the following Unix command (in Unix systems, of course):<br><i>chmod 777 &lt;replace directory name&gt;</i>";
// Changed in version 4.1.0. Old text:
//$lll["nopermission_read_expl"]="During it's operation, Noah's must read the content of these directories. You have to make sure the program has enough permission to do this.)";
// New text:
$lll["nopermission_read_expl"]="During it's operation, Noah's must read the content of these directories. You have to make sure the NOAH program has enough permission to do this.)";
$lll["settings_replytoEmail"]="'Reply to' email";
$lll["settings_replytoEmail_expl"]="This will appear as the address in the 'Reply to:' field of emails the program sends.";
$lll["settings_replytoName"]="'Reply to' name";
// Changed in version 4.1.0. Old text:
//$lll["settings_replytoName_expl"]="This will appear as the name in the ''Reply to:' field of email notifications the program sends out.";
// New text:
$lll["settings_replytoName_expl"]="This will appear as the name in the ''Reply to:' field of email notifications the NOAH program sends out.";
$lll["captchaTest"]="CAPTCHA test:";
$lll["captchaTest_1"]="You can use the CAPTCHA feature of the program, if you can see a proper CAPTCHA image below this text. If the image is not displayed, <a href='http://noahsclassifieds.org/documentation/configuration/captcha' target='_blank'>click here to learn more about the possible reasons</a>!<br><br>If the CAPTCHA feature doesn't work on your server, don't try to enable it - especially not in the login form - because it will block you from login as admin!";
$lll["settings_timeFormat"]="Time format";
$lll["settings_smtpPort"]="SMTP port";
$lll["settings_smtpPort_expl"]="Set the remote port number to connect to. Leave it blank to apply the default port.";
$lll["settings_smtpSecure"]="Use secure connection";
$lll["settings_smtpSecure_expl"]="Set the encryption level to use on the connection.<br><br>Note: PHP needs to have been compiled with OpenSSL for SSL and TLS to work.<br><br>Note: Some PHP installations will not have the TLS stream wrapper.";
$lll["settings_smtpSecure_8"]="No";
$lll["settings_smtpSecure_2"]="TLS";
$lll["settings_smtpSecure_4"]="SSL";
$lll["settings_swiftLog"]="SwiftMailer logging level";
$lll["settings_swiftLog_expl"]="If you're running into problems you may consider enabling the logging of SwiftMailer, so you can find out what's going on. The log messages will be written into 'logs/swift_log.txt'. Once you configured the notification sending properly, it is recommended to turn off logging.";
$lll["settings_swiftLog_0"]="Off";
$lll["settings_swiftLog_1"]="Errors only";
$lll["settings_swiftLog_2"]="Failed deliveries";
$lll["settings_swiftLog_3"]="Network commands";
$lll["settings_swiftLog_4"]="Everything";
$lll["settings_logoImage"]="Upload new logo image";
// Changed in version 4.1.0. Old text:
//$lll["settings_logoImage_expl"]="This can only work if the program has write access to the 'layout.tpl.php' file and the 'images' directory of the current theme!<br><br>
//(note: the original logo image is 272x56 pixels)<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_logoImage_expl"]="This can only work if the program has write access to the 'layout.tpl.php' file and the 'images' directory of the current theme!<br><br>
(note: the original logo image is 272x56 pixels)<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_headerBackground"]="Upload new header background image";
// Changed in version 4.1.0. Old text:
//$lll["settings_headerBackground_expl"]="This can only work if the program has write access to the 'layout.css' file and the 'images' directory of the current theme!<br><br>
//After you changed the background image, you may have to click a Shift-Refresh to clear your browser cache, in order to see the change!<br><br>
//(note: the original header background image is 833x108 pixels)<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_headerBackground_expl"]="This can only work if the program has write access to the 'layout.css' file and the 'images' directory of the current theme!<br><br>
After you changed the background image, you may have to click a Shift-Refresh to clear your browser cache, in order to see the change!<br><br>
(note: the original header background image is 833x108 pixels)<br><br>This feature is not available in the Lite version of the program!";
$lll["noPermissionDir"]="The program has probably no write permission to the following directory: %s. The image couldn't be uploaded.";
$lll["noPermissionFile"]="The program has probably no write permission to the following file: %s";
$lll["settings_ecommerceEnabled"]="E-commerce enabled";
$lll["settings_ecommerceEnabled_0"]="Disabled";
$lll["settings_ecommerceEnabled_1"]="Enabled";
$lll["settings_ecommerceEnabled_2"]="Test mode";
$lll["settings_ecommerceEnabled_expl"]="You can hide every E-commerce related features if you disable it here. This is useful if your site is a free classifieds, but you still want to use all the non E-commerce related advantages of the top of the Noah's product line!<br><br>'Test mode' means, that you can configure all the E-commerce related features as admin just like in the Enabled mode, but the normal users will not see anything from this. You can log in, however, as special user called 'ecommtest' (pwd: a) if you want to test how the E-commerce will affect your users!";
$lll["settings_cascadingCategorySelect"]="Enable cascading category selection";
// Changed in version 4.1.0. Old text:
//$lll["settings_cascadingCategorySelect_expl"]="If you have many categories and/or an especially deep category hierarchy, than the category drop-down lists in the ad submission form and in the search form can be very long and uncomfortable to use.<br><br>
//If you enable this property, the category selection lists will always only contain categories from one level and if you select one, a further selection list appears with the sub-categories of the selected main category. And it can go this way right down to \"leaf\" element of the category tree.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_cascadingCategorySelect_expl"]="If you have many categories and/or an especially deep category hierarchy, than the category drop-down lists in the ad submission form and in the search form can be very long and uncomfortable to use.<br><br>
If you enable this property, the category selection lists will always only contain categories from one level and if you select one, a further selection list appears with the sub-categories of the selected main category. And it can go this way right down to \"leaf\" element of the category tree.<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_enablePermalinks"]="Enable permalinks";
// Changed in version 4.1.0. Old text:
//$lll["settings_enablePermalinks_expl"]="Display the category names and/or the ad titles in the URL.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_enablePermalinks_expl"]="Display the category names and/or the ad titles in the URL.<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_ommitCatPermaLink"]="Ommit category names in the URLs of ad details pages";
$lll["settings_customAdListTemplate"]="Custom ad list template";
$lll["settings_customAdListTemplate_expl"]="Per default, all lists in Noah's use the 'default_list.tpl.php' template to display their content. With this, you can override the default template file and assign a custom list template to the ad lists. You can place your custom template file either under 'themes/<theme name>/templates' or 'themes/common_templates'.<br><br>Try this as an alternative ad list template: ad_list_pictures_left.tpl.php";
$lll["settings_templateDebug"]="Template debug mode";
$lll["settings_templateDebug_expl"]="If enabled, the template variables that can be used on a page will be all displayed in a popup window.";
$lll["settings_deleteAdsOnExpiry"]="Delete ads on expiry";
$lll["settings_deleteAdsOnExpiry_expl"]="If you uncheck this, the expired ads will not be deleted - only set to Inactive.";
$lll["linksAndDefaultPages"]="Pages and link locations";
$lll["settings_homeLocation"]="Show this as the Home page";
$lll["settings_homeLocation_expl"]="If it's not the list of the main categories that you want to display as the Home page of Noah's, you can enter here an other page location. Examples: <br><br>
To display the ad listing of Category 1 on the Home, enter this: list/1<br><br>
To display the Recent ad listing on the Home, enter this: customlist/3<br><br>
Note: you can still access the page of the list of main categories using a direct link - say: http://yoursite.com/path_to_noah/list/0";
$lll["settings_redirectFirstLogin"]="Redirect after first login";
$lll["settings_redirectFirstLogin_expl"]="The page users will be redirected after their first login.<br><br>
E.g. if you have a terms page you access this way http://yoursite.com/terms, than just enter 'terms' here and that page will be the first one your users will read after their first login!";
$lll["settings_redirectLogin"]="Redirect after login";
$lll["settings_redirectLogin_expl"]="The page users will be redirected after every subsequent logins.<br><br>
E.g. enter 'user/modify_form' to redirect them to their profile form after every login!";
$lll["settings_redirectAdminLogin"]="Redirect after admin login";
$lll["settings_redirectAdminLogin_expl"]="The page admin will be redirected after login.<br><br>
E.g. enter 'control_panel' for a quick access of the control panel right after you log in as admin!";
$lll["settings_enableCombine"]="Combine CSS and JavaScript files";
$lll["settings_enableCombine_expl"]="Combined files are a way to reduce the number of HTTP requests by combining all scripts into a single script, and similarly combining all CSS into a single stylesheet.
This is a key to faster pages.<br><br>
You should only disable this during the design customization of your site. You will much easier figure out which CSS declaration to change in which CSS file if the files are separate and uncompressed.<br><br>
Note, however, that there might be servers where combining doesn't work properly: if your server has been set up to put some content (typically, ads of the hosting service) automatically on the top of the pages that are served by Php, it can mess up the combined CSS and JavaScript.";
$lll["customfield_addToSubcats"]="Add this field to all the sub categories, too";
$lll["customfield_addToSubcats_expl"]="This will add a Unique field with the same name to every sub categories of this category (if it has some). If a sub category has a field with this name already, it will be skipped.";
$lll["customfield_default_textarea"]="Default value";
$lll["customfield_customListPlacement"]="Custom placement in lists";
$lll["customfield_customListPlacement_expl"]="This property makes the list template customization more flexible. If you enable, the value of this field will be passed over to the list template, but unlike the other fields, it will not populate the 'cells', 'cellAttrs' and 'cellSpans' template variables. This makes it possible that you display the value of this field in the list in a custom way while leaving the placement of the other fields unaffected.<br><br>
The value of the field can be retrieved by name if you enable this property from the 'cellsByNames' template variable: e.g. \$this->cellsByNames[5]['Picture']";
$lll["customfield_customDetailsPlacement"]="Custom placement on the details page";
$lll["customfield_customDetailsPlacement_expl"]="This property makes the details template customization more flexible. If you enable, the value of this field will be passed over to the details template, but unlike the other fields, it will not populate the 'rows' template variables. This makes it possible that you display the value of this field on the details page in a custom way while leaving the placement of the other fields unaffected.<br><br>
The value of the field can be retrieved by name if you enable this property:e.g. \$this->['Picture']";
$lll["itemfield_ttitle_simple"]="Custom fields";
$lll["itemfield_ttitle_globalDescription"]="Configure the fields that appear in the non category specific lists.";
$lll["displayResponseLink_0"]="none";
$lll["displayFriendmailLink_0"]="none";
$lll["displayResponseLink_1"]="all";
$lll["displayFriendmailLink_1"]="all";
$lll["displayResponseLink_2"]="logged in users only";
$lll["displayFriendmailLink_2"]="logged in users only";
$lll["displayResponseLink_4"]="admin only";
$lll["displayFriendmailLink_4"]="admin only";
$lll["displayResponseLink_5"]="all but admin";
$lll["displayFriendmailLink_5"]="all but admin";
$lll["formatPrefix_expl"]="Typical examples are a currency symbol, or percentage sign. Anything you enter here will preceed the values of this custom field.";
$lll["formatPostfix"]="Postfix";
$lll["formatPostfix_expl"]="E.g. you can add units to the numbers here. Anything you enter here will follow the values of this custom field.";
$lll["precision"]="Precision";
$lll["precision_expl"]="Floating point precision - sets the number of decimal points.";
$lll["precisionSeparator"]="Precision separator";
$lll["precisionSeparator_expl"]="Sets the separator for the decimal point";
$lll["thousandsSeparator"]="Thousands separator";
$lll["format"]="Display format";
$lll["format_expl"]="Advanced users can apply a C-style sprintf format string, too.";
$lll["propagateLabel"]="Propagate the current value of this property into all the other fields with the same name!";
$lll["propagateConfirmationText"]="Click 'Ok' to propagate the current value of this property into all the other custom fields that have the same Name and Type in all the other categories!";
$lll["propagateLabel_subcat"]="Propagate the current value of this property into all the other fields with the same name under the sub categories!";
$lll["propagateConfirmationText_subcat"]="Click 'Ok' to propagate the current value of this property into all the other custom fields that have the same Name and Type in all the sub categories!";
$lll["propagateLabel_sorting"]="Propagate the sorting of this custom field list into all the other categories!";
$lll["propagateConfirmationText_sorting"]="Click 'Ok' to propagate the current sorting into all the other categories!";
$lll["propagateLabel_sorting_subcat"]="Propagate the sorting of this custom field list into all the sub categories!";
$lll["propagateConfirmationText_sorting_subcat"]="Click 'Ok' to propagate the current sorting into all the sub categories!";
$lll["propagateLabel_cat"]="Propagate the current value of this property into all the other categories that have the same Name!";
$lll["propagateConfirmationText_cat"]="Click 'Ok' to propagate the current value of this property into all the other categories that have the same Name!";
$lll["propagateLabel_cat_subcat"]="Propagate the current value of this property into all the sub categories!";
$lll["propagateConfirmationText_cat_subcat"]="Click 'Ok' to propagate the current value of this property into all the sub categories!";
$lll["itemfield_propagate_form"]="Propagate the current value of this property into all the other fields with the same name and type!";
$lll["successfullyPropagated"]="The value of the '%s' property has been successfully propagated into %s custom fields.";
$lll["sortingSuccessfullyPropagated"]="The custom field sorting has been successfully propagated.";
$lll["noPropagationOccured"]="There is no other custom field with the same Name and Type. No propagation occured.";
$lll["catSuccessfullyPropagated"]="The value of the '%s' property has been successfully propagated into %s categories.";
$lll["catNoPropagationOccured"]="There is no other category with the same Name. No propagation occured.";
$lll["orUploadValuesFromFile"]="Or select file:";
$lll["uploadValuesFromFileExpl"]="<br><br>You can also upload the possible values from a file all at once! In that case, one line in the file must represent one value (no need to use commas or other separators between the values!) You can designate the default values in the file by adding :default: to the given line. This is an example file with the countries of the world with USA set as the default value: <a href='upload/countries_example.txt'>countries</a>.";
$lll["customfield_default_textarea_expl"]="If you check in the above field, you can insert variables that will be substituted with the appropriate item values.<br><br>
You can use the following variables:
<ul>
<li>{Title}</li>
<li>{Description}</li>
<li>{Picture}</li>
<li>{Id}</li>
<li>{Category}</li>
<li>{Created}</li>
<li>{Views}</li>
<li>{Responses}</li>
<li>{Expiration}</li>
<li>{Status}</li>
<li>{and any other ad custom field...}</li>
</ul>
Tip: if you have a Picture field and you want it to appear in some other column of the listings than the last one, do the following: 
<ol>
<li>Create a new Textarea type field  with variable substitution enabled,</li>
<li>Enter this in the 'Default' property: {Picture}</li>
<li>Hide it from appearing in the forms and details page, but make it appear in lists</li>
<li>Modify the order of the custom fields so that this new one is displayed just in the position you want</li>
<li>Hide the original Picture field from the lists</li>
</ol>
";
$lll["customfield_useVariableSubstitution"]="Use variable substitution";
$lll["customfield_css"]="Custom CSS class";
$lll["customfield_css_expl"]="If you enter a CSS class name here, the TD-s of the values of this custom field will be generated with this class assigned. E.g.:<br><br>&lt;pre&gt;&lt;td class='myClass'&gt;Field value&lt;/td&gt;&lt;/pre&gt;<br><br>
You can then add a CSS declaration of this class to the 'Additional HEAD content' field of the Content form. E.g.:<pre>&lt;style type=&quot;text/css&quot; media=&quot;screen&quot;&gt;
&lt;!--
td.myClass {
    color: red;
}
--&gt;
&lt;/style&gt;</pre>";
$lll["notification_body_expl"]="Click on 'Help' to find more details about how you can configure the email body and subject!";
$lll["category_renewOnModify"]="Renew on modify and prolong";
$lll["category_renewOnModify_expl"]="Whether the posting date of an ad is updated when the ad is modified or prolonged.";
$lll["category_displayResponseLink"]="Display the 'Response to this ad' link on the ad details pages.";
$lll["category_displayFriendmailLink"]="Display the 'Email to a friend' link on the ad details pages.";
$lll["notificationLinksProperties"]="Links";
$lll["expirationAndModerationProperties"]="Expiration and moderation properties";
$lll["category_customAdMeta"]="Custom ad details page meta tags";
$lll["category_sortId"]="Sort index";
$lll["category_id"]="ID";
$lll["category_up"]="Parent ID";
$lll["category_depth"]="Depth";
$lll["alwaysUseAlternativeOrganizer"]="Always use this alternative organizer ";
$lll["updateHierarchy"]="Update hierarchy";
$lll["category_customAdMeta_expl"]="With this, you can overrule the TITLE tag and the DESCRIPTION and KEYWORDS meta tags the program generates for an ad details page. You can insert variables that will be replaced with the appropriate values. A full blown example:<br><br>&lt;title&gt;{Title} - {Site: Title prefix}: {Site: Title}&lt;/title&gt;<br />
&lt;meta name=&quot;country&quot; content=&quot;{owner: Country}&quot;&gt;<br />
&lt;meta name=&quot;state&quot; content=&quot;{owner: State}&quot;&gt;<br />
&lt;meta name=&quot;city&quot; content=&quot;{owner:City}&quot;&gt;<br />
&lt;meta name=&quot;category&quot; content=&quot;{category: Title}&quot;&gt;<br />
&lt;meta name=&quot;description&quot; content=&quot;{Description}, {Category: Description}, {Site: Description}&quot;&gt;<br />
&lt;meta name=&quot;keywords&quot; content=&quot;{Category: Keywords}&quot;&gt;<br><br>You can use the following variables:
<ul>
<li>Site global values (from the Settings form):
<ul>
<li>{site: Title}</li>
<li>{site: Title prefix}</li>
<li>{site: Description}</li>
<li>{site: Keywords}</li>
</ul></li>
<li>Category values (from the category modify form):
<ul>
<li>{category: Title}</li>
<li>{category: Description}</li>
<li>{category: Keywords}</li>
</ul></li>
<li>Fields of the owner of the ad:
<ul>
<li>{owner: Country}</li>
<li>{owner: State}</li>
<li>{owner: Address}</li>
<li>{owner: and any other user custom field...}</li>
</ul></li>
<li>Fields of the ad:
<ul>
<li>{item: Title}</li>
<li>{item: Description}</li>
<li>{item: Keywords}</li>
<li>{item: and any other ad custom field...}</li>
</ul></li>
</ul><br>
Note: in case of the ad fields, you can ommit the 'item:' prefix - e.g. {Title} stands for the title of the ad. The veriables are case insensitive.";
$lll["category_descriptionMeta"]="Meta and RSS Description";
$lll["category_descriptionMeta_expl"]="Used to populate the DESCRIPTION meta tag for SEO and the category description field of the RSS feed. If you leave it blank, the text of the above 'Description' field will be used! If the 'Description' field contains HTML, however, you should enter its HTML-stripped version into this field.";
$lll["category_customAdListTemplate"]="Custom ad list template";
$lll["category_customAdListTemplate_expl"]="Per default, all lists in Noah's use the 'default_list.tpl.php' template to display their content. With this, you can override the default template file on a per category basis. You can place your custom template file either under 'themes/<theme name>/templates' or 'themes/common_templates'.<br><br>Try this as an alternative ad list template: ad_list_pictures_left.tpl.php";
$lll["category_customAdDetailsTemplate"]="Custom ad details page template";
$lll["category_customAdDetailsTemplate_expl"]="Per default, the 'item_details.tpl.php' template is used to display the details pages of all ads in Noah's. With this, you can override the default template file on a per category basis. You can place your custom template file either under 'themes/<theme name>/templates' or 'themes/common_templates'.";
$lll["category_recursive"]="\"Deep\" listings";
$lll["category_recursive_expl"]="If this is enabled, the category listings and the search result lists of this category will contain all the ads of its sub categories, too.<br><br>
Note that this may not work in any case and whether it works or not, depends on the custom field configuration of the main and the sub categories! In Noah's, it is possible to define completely different custom fields in a sub category and in its main category. In such a case, the deep listing of the main category will lead to a wrong result, because the ads of the sub categories can't be reasonably placed in the same list as those of the main category (the columns mismatch!). Tips to avoid the column mismatch:<br>
<ul>
<li>If you create a new custom field in a category, check the 'Add this field to all the sub categories, too' option in the create form,</li>
<li>Try to set up a final custom field configuration for a category, before you create its sub categories (if you create a sub category, it \"inherits\" the fields of the main category)</li>
<li>Use the 'Clone into sub categories' option on the 'List of custom fields' page to \"harmonize\" the fields of a category with the fields of its sub categories.</li>
</ul>
";
$lll["customFieldExists"]="A custom field with this name already exists. Please, choose an other name!";
$lll["exportProperties"]="Export properties";
$lll["customlist_exportFormat"]="Enable export";
// Changed in version 4.1.0. Old text:
//$lll["customlist_exportFormat_expl"]="If you enable this, a new 'export' link will appear in the list of Custom Lists, which you can use to export the content of this custom list.<br><br>Note: this feature is not available in the Free version of the program!";
// New text:
$lll["customlist_exportFormat_expl"]="If you enable this, a new 'export' link will appear in the list of Custom Lists, which you can use to export the content of this custom list.<br><br>Note: this feature is not available in the Lite version of the program!";
$lll["customlist_exportFields"]="Export the following fields";
$lll["customlist_exportFields_expl"]="Note that you can set the order of the fields by drag and drop!";
$lll["customlist_xmlType_RSS2.0"]="RSS2.0";
$lll["customlist_xmlType_RSS1.0"]="RSS1.0";
$lll["customlist_xmlType_ATOM"]="ATOM";
$lll["customlist_xmlType"]="XML type";
$lll["export"]="export";
$lll["exportSavedAs"]="The list has been exported as %s.";
$lll["couldntOpenExportFile"]="Couldn't open the export file for writing. Check the permissions of the 'feedcreator' directory!";
$lll["customlist_customAdListTemplate"]="Custom ad list template";
$lll["customlist_customAdListTemplate_expl"]="Per default, all lists in Noah's use the 'default_list.tpl.php' template to display their content. With this, you can override the default template file and assign a custom list template to this custom ad lists. You can place your custom template file either under 'themes/<theme name>/templates' or 'themes/common_templates'.<br><br>Try this as an alternative ad list template: ad_list_pictures_left.tpl.php";
// Changed in version 4.1.0. Old text:
//$lll["freeNotSupported"]="This feature is not supported in the Free version of the program.";
// New text:
$lll["freeNotSupported"]="This feature is not supported in the Lite version of the program.";
$lll["catSubscriptions"]="Subscriptions on this category";
$lll["subscription_cat_ttitle"]="Subscriptions on this category";
$lll["subscription_ttitle"]="Subscriptions";
$lll["subscription_unsub_ttitle"]="Unsubscribed email addresses";
$lll["subscription_ttitleDescription"]="View the list of subscriptions and add new email addresses.";
$lll["subscription"]="subscription";
$lll["subscription_newitem"]="Add new subscriptions";
$lll["subscription_create_form_admin"]="Create subscriptions";
$lll["subscription_email_expl_admin"]="You can add many email addresses at once. Just put everyone in a new line.<br><br>Note: email addresses that have been already unsubscribed will be skipped!";
$lll["subscription_creationtime"]="Date";
$lll["subscription_userName"]="User";
$lll["subscription_catName"]="Category name";
$lll["subscription_cid"]="Subscribe to this category";


// Added in 3.1.3:
$lll["category_inactivateOnModify"]="Inactivate on modify";
$lll["category_inactivateOnModify_expl"]="Whether an approved ad becomes pending again if the owner of the ad modifies it.";
$lll["clonecat_create_form"]="Clone category";
$lll["clonecat_amount"]="Number of clones";
$lll["clonecat_amount_expl"]="Creating many clones - especially if you clone the sub categories and pictures, too - can take quite a long time and you should not close the browser during that!";
$lll["clonecat_name"]="Clone with name";
$lll["clonecat_name_expl"]="If you are creating more than one clones, you can apply numbering in their names if you insert '%d' here. E.g. 'Cars-%d' will result in the following clones: Cars-1, Cars2, Cars-3, etc.";
$lll["clonecat_recursive"]="Clone sub categories, too";
$lll["clonecat_withPictures"]="Clone the category pictures, too";
$lll["categoriesCloned"]="The categories have been successfully cloned.";


// Added in 3.1.2:
$lll["commonFieldAlreadyExists"]="A common field with this name and type already exists. Please, choose an other name!";


// Added in 3.1.0:
$lll["checkUpdatesDescription"]="Check out if a newer version of Noah's Classifieds has been released. You can even perform the update immediately, or download the update package with a single click!";
// Changed in version 4.1.0. Old text:
//$lll["checkconfDescription"]="Click here any time to verify if the program has been set up correctly. In case of any problems being detected, the Check page gives useful hints how to solve them.";
// New text:
$lll["checkconfDescription"]="Click here at any time to verify if the program has been set up correctly. In case of any problems being detected, the Check page gives useful hints how to solve them.";
$lll["rssDescription"]="Set up the properties of the RSS feed the program generates.";
$lll["settings_langDir_expl"]="If you enable more languages - some with left to right direction and some with right to left, you should rather specify the direction in the lang file itself! E.g. if you have an Arabian language file, you can put a line like this in it, in order to override this setting in case of the Arabian language:<br><br>$langDir='rtl';<br><br>Use 'rtl' for 'right to left' and 'ltr' for 'left to right'!";
// Changed in version 4.0.0. Old text:
//$lll["customfield_values_expl"]="This must be a comma separated list of possible values. E.g. one,two,three";
// New text:
$lll["customfield_values_expl"]="Use this tool to add, remove or modify the possible values! You can also change their order by drag-and-drop. Set the default value(s) using the checkboxes!";
$lll["itemfield_ttitle_global"]="Common custom fields";
$lll["searchable_0"]="none";
$lll["searchable_1"]="all";
$lll["customlist_displayedFor_1"]="all";
$lll["searchable_2"]="logged in users only";
$lll["customlist_displayedFor_2"]="logged in users only";
$lll["searchable_4"]="admin only";
$lll["customlist_displayedFor_4"]="admin only";
$lll["customfield_isCommon"]="Scope of the field";
$lll["customfield_isCommon_colhead"]="Scope";
$lll["common"]="Common";
$lll["unique"]="Unique";
$lll["customfield_isCommon_expl"]="If you set the scope to common, the field will exist in every categories. E.g.: if you have a web shop, whatever categories you set up, a 'Price' field must probably belong to all of them, so the 'Price' is best to define as a common field. If you create a common field, or change a unique field to common, it will suddenly appear in all categories - not just there where you created it. If you delete a common field, it will dissappear from all the categories at once.<br><br>Even if a field is common, it can be differently set up in different categories. E.g. you can set it to appear on the ad details page in one category, but hide it in an other category. Only the 'Name' and the 'Type' properties have to be really equal in all categories.<br><br>You can even set up your classifieds program so that all the fields are common! In some cases, it can make a good sense: e.g. if you have cars and only cars in every categories, probably all the categories have just the same list of custom fileds. The strength of the common fields will really show up in defining custom ad lists! E.g. the 'Recent ads' list can contain ads from many different categories, but if you have common fields, you need not be restricted to show only the 'Title', 'Description', and 'Category' columns in the list any more - you can choose any common field to be a column in the list!";
$lll["customfield_isCommon_0"]="Unique to this category";
$lll["customfield_isCommon_1"]="Common to all the categories";
$lll["userfield_create_completed"]="The custom field has been successfully created.";
$lll["itemfield_create_completed"]="The custom field has been successfully created.";
$lll["itemfield_columnIndex"]="Column index";
$lll["NotificationsDescription"]="Manage the list of notifications here - the emails the program sends out automatically on certain actions.";
$lll["category_restartExpOnModify"]="Restart expiration on modify";
$lll["category_restartExpOnModify_expl"]="You can use this as an alternative of the ad prolonging. If checked and the owner modifies his or her ad (and admin approves it if moderation has been enabled), the ad expiration will start again.";
$lll["controlPanel"]="Control panel";
$lll["controlpanel_ttitle"]="";
$lll["customlist_ttitle"]="Custom lists";
$lll["customlist"]="Custom list";
$lll["customlist_listTitle"]="Title";
$lll["customlist_listDescription"]="Description";
$lll["customlist_listDescription_expl"]="Some notes that can better describe what this custom list is all about. Only visible for admin.";
$lll["customlist_create_form"]="Create custom list";
$lll["customlist_modify_form"]="Modify custom list";
$lll["customlist_newitem"]="Add new custom list";
$lll["checkCustomLists"]="Whenever you delete a custom field, check all the custom lists where a search condition has been supplied by clicking on their Title, because they may become invalid if they referred to the just deleted custom field in their condition!";
$lll["listDisplayProperties"]="List display properties";
$lll["customlist_primarySort"]="Primary sort by";
$lll["customlist_primaryDir"]="Primary sort direction";
$lll["customlist_secondaryDir_DESC"]="Descending";
$lll["customlist_primaryDir_DESC"]="Descending";
$lll["customlist_secondaryDir_ASC"]="Ascending";
$lll["customlist_primaryDir_ASC"]="Ascending";
$lll["customlist_primaryPersistent"]="Primary sort is persistent";
$lll["customlist_primaryPersistent_expl"]="If you leave this unchecked, the users can override the initial sorting of the list by clicking on the sorting icons in the list column headers. If you check this, however, you can force specific ads to always appear say on the top of the list however the users sort the list.<br><br>E.g. if you have a custom field called 'Sponsoring level' with values say 'Gold', 'Silver', 'Bronze' and 'None', you can create a custom list with a persistent sorting by 'Sponsoring level' descending. The Gold ads will always appear on the top of the list then and the non-sponsored ads on the bottom of the list.";
$lll["customlist_secondarySort"]="Secondary sort by";
$lll["customlist_secondaryDir"]="Secondary sort direction";
$lll["customlist_secondaryPersistent"]="Secondary sort is persistent";
$lll["customlist_limit"]="Limit";
// Changed in version 3.1.2. Old text:
//$lll["customlist_limit_expl"]="You can limit the number of ads the list contains. Leave it blank for no limit. E.g. 10 means, the list will display only the first 10 ads in the given sorting order from all the matching ads.";
// New text:
$lll["customlist_limit_expl"]="You can limit the number of ads the list contains. Leave it blank for no limit. E.g. 10 means, the list will display only the first 10 ads in the given sorting order from all the matching ads. If you display this list as a scrollable widget, it is always a good idea to set a reasonable, not too high limit, so that the pages with widgets load faster and have less resource consumption both on the cient and on the server side!";
$lll["customlist_columns"]="Select columns to display";
$lll["customlist_columns_expl"]="If you select more than one, you can re-arrange them by drag-and-drop! 
The columns will be displayed in the order you specify here.<br><br>
So that a column is really displayed in a list, note that it is not enough that you add it here! 
The user who displays the list must have also permission to see that column! 
The visibility of a column can be set from two places depending on the scope of the given field:<br><br>
&nbsp;&nbsp;1. If you want to set the visibility of a column that is in a non-category specific list, 
you can do it from the 'Common custom fields' list (open the modify form and edit the 'Show in lists for' property),<br><br>
&nbsp;&nbsp;2. If you want to set the visibility of a column that is in a category specific list, 
you can do it from the 'List of custom fields of this category' list (open the modify form and edit the 'Show in lists for' property)";
$lll["customlist_displayedFor"]="Display list for";
$lll["customlist_displayedFor_expl"]="Whatever you select here, admin will always be able to view the list by clicking on its Title in the 'List of custom lists'!";
$lll["customlist_pages"]="Display on these pages";
// Changed in version 4.1.0. Old text:
//$lll["customlist_pages_expl"]="You can specify a page with its link. E.g. '/item/1' is the details page of ad with ID 1. Use '/' to denote the start page. You can list more pages - one in every line. You can use the '*' wildcard to match more than one pages - e.g.: '/list/*' means all the category listing pages, '/item/*' means all the ad details pages. You can exclude pages by adding the '!' prefix. A more complex example: <br><br>/user/login_form<br>/item/create_form<br>/list/*<br>!/list/1<br>!/list/2<br>/item/4<br>/item/5<br><br>The above says \"display the list on the login page, on the ad submit page, on every category listing pages except of the category with ID 1 and 2, and on the details pages of ads with ID 4 and 5!\"<br><br>This feature doesn't work in the free version!";
// New text:
$lll["customlist_pages_expl"]="You can specify a page with its link. E.g. '/item/1' is the details page of ad with ID 1. Use '/' to denote the start page. You can list more pages - one in every line. You can use the '*' wildcard to match more than one pages - e.g.: '/list/*' means all the category listing pages, '/item/*' means all the ad details pages. You can exclude pages by adding the '!' prefix. A more complex example: <br><br>/user/login_form<br>/item/create_form<br>/list/*<br>!/list/1<br>!/list/2<br>/item/4<br>/item/5<br><br>The above says \"display the list on the login page, on the ad submit page, on every category listing pages except of the category with ID 1 and 2, and on the details pages of ads with ID 4 and 5!\"<br><br>This feature does not work in the Lite version!";
$lll["customlist_categorySpecific"]="Content depends on the current category";
// Changed in version 3.1.2. Old text:
//$lll["customlist_categorySpecific_expl"]="If you check this and the custom list is just displayed on a page that is in a \"categy context\" (e.g. on a category listing page or ad details page), the custom list will only include the ads of the given category. This is usefulfif you have a custom list called say 'Featured list' and you want to make this list to be context sensitive - so that when a user is just under the Cars category, it displays the featured cars and when the user is just under the 'Dating' category, it contains the featured dating ads.";
// New text:
$lll["customlist_categorySpecific_expl"]="If you check this and the custom list is just displayed on a page that is in a \"category context\" (e.g. on a category listing page or ad details page), the custom list will only include the ads of the given category. <br><br>This is useful if you have a custom list called say 'Featured list' and you want to make this list to be context sensitive - so that when a user is just under the Cars category, it displays the featured cars and when the user is just under the 'Dating' category, it contains the featured dating ads.";
$lll["customlist_recursive"]="and includes ads from the current category AND any of its subcategories";
$lll["customlist_listStyle"]="List style";
$lll["customlist_listStyle_0"]="Normal list";
$lll["customlist_listStyle_1"]="Scrollable widget";
$lll["customlist_listStyle_expl"]="Visit the demo installation http://noahsclassifieds.org/v8rss/ to see how the 'Scrollable widget' style looks like!";
$lll["customlist_positionScrollable"]="Position";
$lll["customlist_positionNormal"]="Position";
$lll["customlist_positionScrollable_expl"]="The place where the list appears on the page";
$lll["customlist_positionNormal_expl"]="The place where the list appears on the page";
$lll["customlist_positionScrollable_0"]="Above the content";
$lll["customlist_positionNormal_0"]="Above the content";
$lll["customlist_positionScrollable_1"]="Below the content";
$lll["customlist_positionNormal_1"]="Below the content";
$lll["customlist_positionScrollable_4"]="On the left side of the page";
$lll["customlist_positionScrollable_5"]="On the right side of the page";
$lll["customlist_positionScrollable_2"]="On the top of the page";
$lll["customlist_positionScrollable_3"]="On the bottom of the page";
$lll["customlist_displayInMenu"]="Assign menu point in menu";
$lll["customlist_displayInMenu_expl"]="If you don't want that the list is displayed on some of the existing pages, you can assign a menu point to it, so that the users access the list on its separate page. E.g.: the good old 'Recent ads', 'Popular ads', 'Pending ads' and 'Approved ads' menu points are from now on just links to the corresponding custom lists!";
$lll["customlist_displayInMenu_0"]="None";
$lll["customlist_displayInMenu_1"]="Login menu";
$lll["customlist_displayInMenu_2"]="User menu";
$lll["customlist_displayInMenu_3"]="Admin menu";
$lll["customlist_displayInMenu_4"]="Category menu";
$lll["randomOrder"]="-- Random order --";
$lll["noDefaultSort"]="-- No sorting --";
$lll["selectField"]="-- Select field --";
$lll["currentUser"]="-- Current user --";
$lll["customlist_ownerName_expl"]="If you select 'Current user', the list will always only contain the ads of the currently logged in user. E.g. this has been used in the setup of the 'My ads' custom list!";
$lll["customlist_loop"]="Loop ads";
$lll["customlist_loop_expl"]="Whether scrolling starts over when last item is exceeded";
$lll["customlist_autoScroll"]="Auto scroll in every (seconds)";
$lll["customlist_autoScroll_expl"]="Use 0 to disable auto scroll";
$lll["customlist_cache"]="Cache list content and renew the cache in every (minutes)";
$lll["customlist_cache_expl"]="So that pages that display custom lists can be faster, it is possible to cache the content of the list on the server. Use 0 to disable caching!";


// Added in 3.0.0:
// Changed in version 3.1.3. Old text:
//$lll["versionTooLow"]="Required minimum MySql version is %s. The current one is %s. Required minimum MySql version is %s. The current one is %s.";
// New text:
$lll["versionTooLow"]="Required minimum MySql version is %s. The current one is %s. Required minimum Php version is %s. The current one is %s.";
$lll["settings_joomlaLink"]="Joomla site";
$lll["settings_joomlaLink_expl"]="If you have installed a Joomla bridge, you can enter the URL of your main Joomla site here. If you do that, the login menu will contain a 'Main site' menu point that links to the URL.";
$lll["enableUserSearch"]="Enable user search";
$lll["enableUserSearch_expl"]="This feature is not available in the Evaluation version!";
$lll["appsettings_modify_completed"]="The settings have been successfully modified";
$lll["settings_langDir"]="Language direction";
$lll["settings_langDir_ltr"]="Left to right";
$lll["settings_langDir_rtl"]="Right to left";
$lll["customfield_fixInfoText"]="This is a \"fix\" field which means that you can't delete it and you can only change some of its properties.";
$lll["selectUserField"]="-- Select user field --";
$lll["customfield_userField"]="or select one of the user fields";
$lll["customfield_userField_expl"]="Instead of creating a completely new custom field by entering a Name for it above, you have the option to select one of the user fields for display. This way, the fields of the owner of an ad can be displayed directly in either the ad list or on the ad details page. <br><br>E.g. you can add the phone number of the owner of the ad to the ad details page. Or if you have a custom 'Zip code' user field, you can display it, too. Moreover, if you specify the Zip code as 'Searchable', users will be able to search for ads by zip code!";
$lll["userField"]="User field";
$lll["customfield_checkboxCols"]="Number of columns to display the checkboxes in";
$lll["userfield_displayLabel_expl"]="If checked off, the field label will not be displayed on the user details page and the field value will span over the labels of the other fields.";
$lll["userfield_displaylength_expl"]="The maximum number of characters that are displayed on the user list page. The appearance of the list view can be protected against displaying very long fields in a cell.";
$lll["userfield_rangeSearch_expl"]="If this is checked than one can define e.g. '10-20' as a search condition to search for user where the value of this field is between 10 and 20.";
$lll["userfield_subType_expl"]="";
$lll["itemfield_ttitle"]="Custom fields of category '%s'";
$lll["customfield_advanced_form"]="Advanced operations";
$lll["userfield_mainPicture_expl"]=" ";
$lll["userfield_seo_expl"]="You can specify here which custom field of the user will serve as the content of the HTML TITLE tag, DESCRIPTION tag and KEYWORDS tag, respectively.";
$lll["userfield_detailsPosition_expl"]="The placement of the fields on the user details page. The 'sidebar' is the right area of the details panel where the pictures reside (in the modern theme). You can place fields above the pictures area, or below them with this setting.";
$lll["customfield_showInForm"]="Show in forms for";
$lll["userfield_showInForm_expl"]="Note that in case of fix user fields, this setting has a limited meaning only! E.g. if you set the 'Name' field to be displayed for admin only, it only refers to the user modify form (i.e. you can't hide the 'Name' field from the registration and the login forms). Similarly, you can't hide the 'Email' field from the registration form.";
$lll["subscriptionType_0"]="none";
$lll["enableFavorities_0"]="none";
$lll["showInDetails_0"]="none";
$lll["showInList_0"]="none";
$lll["showInForm_0"]="none";
$lll["enableUserSearch_0"]="none";
$lll["subscriptionType_1"]="all";
$lll["enableFavorities_1"]="all";
$lll["showInDetails_1"]="all";
$lll["showInList_1"]="all";
$lll["showInForm_1"]="all";
$lll["enableUserSearch_1"]="all";
$lll["enableFavorities_2"]="logged in users only";
$lll["subscriptionType_2"]="logged in users only";
$lll["showInDetails_2"]="logged in users only";
$lll["showInList_2"]="logged in users only";
$lll["showInForm_2"]="logged in users only";
$lll["enableUserSearch_2"]="logged in users only";
$lll["showInDetails_3"]="owner of the ad only";
$lll["showInList_3"]="owner of the ad only";
$lll["showInForm_3"]="owner of the ad only";
$lll["enableFavorities_4"]="admin only";
$lll["subscriptionType_4"]="admin only";
$lll["showInDetails_4"]="admin only";
$lll["showInList_4"]="admin only";
$lll["showInForm_4"]="admin only";
$lll["enableUserSearch_4"]="admin only";
$lll["subscriptionType_5"]="all but admin";
$lll["enableFavorities_5"]="all but admin";
$lll["userfield_ttitle"]="Custom fields of the users";
$lll["userfield_type_expl"]="";
$lll["methods"]="Methods";
$lll["clone"]="clone";
$lll["copyOfCategory"]="Copy of '%s'";
$lll["organizeNextPageDrop"]="Hover the mouse here when dragging to place the category in the next page.";
$lll["organizePreviousPageDrop"]="Hover the mouse here when dragging to place the category in the previous page.";
$lll["organizeNextItems"]="next categories &raquo;";
$lll["organizePreviousItems"]="&laquo; previous categories";
// Changed in version 4.1.0. Old text:
//$lll["fieldset_create_form"]="Advanced operations on the whole list of custom fields of the category (they don't work in the free version!)";
// New text:
$lll["fieldset_create_form"]="Advanced operations on the whole list of custom fields of the category (they don't work in the Lite version!)";
$lll["fieldset_deleteAll"]="Delete all fields";
// Changed in version 3.1.0. Old text:
//$lll["fieldset_deleteAll_expl"]="This will delete all the non-fix custom fields of this category at once.<br><br>Please note that deleting custom fields causes data loss, because the corresponding ad field values will be deleted, too!";
// New text:
$lll["fieldset_deleteAll_expl"]="This will delete all the unique custom fields of this category at once.<br><br>Please note that deleting custom fields causes data loss, because the corresponding ad field values will be deleted, too!";
$lll["fieldset_cloneToSubcats"]="Clone into sub categories";
$lll["fieldset_cloneToSubcats_expl"]="This list of custom fields will be applied in every sub categories of this category.<br><br>Please note that if the sub categories have custom fields already, they will be deleted first! So, this operation is mainly useful for setting up new categories, because it may cause data loss in categories that have ads already.";
$lll["fieldset_cloneToCats"]="Clone into categories";
$lll["fieldset_cloneToCats_expl"]="This list of custom fields will be applied in every category you select on the right (you can select more!).<br><br>Please note that if the categories have custom fields already, they will be deleted first! So, this operation is mainly useful for setting up new categories, because it may cause data loss in categories that have ads already.";
$lll["fieldset_cloneFromCat"]="Clone from category";
$lll["fieldset_cloneFromCat_expl"]="This is the opposite of the previous operation: it will replace all the existing custom fields of this category with the field list of an other category. The same is applied to this one, too: it can cause data loss if if this category has ads already!<br><br>Just to make it completely clear: none of the cloning operations actually copy ads or ad values! And they don't copy categories either! They copy custom field lists with all their properties. Relocating ads from one category into an other is possible with the 'move' feature on a per advertisement basis. If you want to create duplicates of whole categories (with all their custom fields, but without their ads and sub categories!), you can use the 'clone' feature under the 'Organize categories' menu point.";
$lll["fieldset_deleteAll_successful"]="The custom fields have been successfully deleted";
$lll["fieldset_cloneToSubcats_successful"]="The custom fields have been successfully cloned to the sub categories";
$lll["fieldset_cloneToCats_successful"]="The custom fields have been successfully cloned to the selected categories";
$lll["fieldset_cloneFromCat_successful"]="The custom fields of the selected category have been successfully cloned here";
$lll["fields"]="fields";


// Added in 2.4.0:
$lll["settings_charLimit_expl"]="'0' means no limit.";
$lll["settings_extraTopContent"]="Additional top content";
// Changed in version 4.1.0. Old text:
//$lll["settings_extraTopContent_expl"]="With this, you can insert custom HTML below the header section of the pages (status bar, menus).<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_extraTopContent_expl"]="With this, you can insert custom HTML below the header section of the pages (status bar, menus).<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_extraBottomContent"]="Additional bottom content";
// Changed in version 4.1.0. Old text:
//$lll["settings_extraBottomContent_expl"]="With this, you can insert custom HTML above the powered footer of the pages.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_extraBottomContent_expl"]="With this, you can insert custom HTML above the powered footer of the pages.<br><br>This feature is not available in the Lite version of the program!";
$lll["customfield_subType_expl"]="E.g. if you have a 'Price' field, it is wise to set it as a 'Float number', so that the sorting by the Price column and range search by the price field can properly work. You can then enter the necessary currency symbol prefix, precision and thousands separator settings under the 'Display formatting' section.";
$lll["formatSection"]="Display Formatting";
$lll["customfield_formatPrefix"]="Prefix";
$lll["customfield_useMarkitup"]="Use embedded HTML editor instead of a simple textarea";
$lll["category_expirationEnabled"]="Enable expiration";
$lll["category_expirationOverride"]="Allow expiration override for";
$lll["category_allowSubmitAdAdmin"]="Only admin can submit ads in this category";
$lll["category_expirationOverride_expl"]="If you enable this, the 'Number of days before the ad expire' field will appear in the ad create/modify form and the owner can enter a number. If you specified '0' in the above field, they can enter an arbitrary number. If you specified anything greater than null, it will serve as the default and in one as the maximum number of days the owner can enter.";
$lll["category_expirationOverride_0"]="None";
$lll["category_expirationOverride_2"]="All users";
$lll["category_expirationOverride_4"]="Admin only";
$lll["category_organize"]="Organize categories";
$lll["exp"]="Expiration";
$lll["useDragAndDrop"]="Use drag-and-drop to reorganize the categories then click on 'Save order'!";
$lll["organizeSaveButton"]="Save order";
$lll["organizeSaveMessage"]="The category order has been successfully saved";
$lll["organizeSaveError"]="Could not send the data to the server.";
$lll["organizeLoadError"]="Could not load the data from the server.";


// Added in 2.3.0:
$lll["appFileRemoveExpl"]="From version 2.3.0, most of the php files that used to be directly under the installation directory, must reside under the htaccess-protected 'app' sub directory.
                           The installation root directory may only contain 'index.php' and 'initdir.php'.";
$lll["appFileRemove"]="In order to start using the program, you have to remove the following unnecessary php files from the installation root: <span class='confexpl'>%s.</span><br><br><a href='%s'>Click here to remove them!</a><span class='confexpl'> (If this message doesn't disappear after you clicked, it means the program has no permission to remove these files. In this case, you must delete them manually!)</span>";
$lll["backupFileRemoveExpl"]="From security reasons, the backup directories created by the automatic updates have to be deleted. If you still need them, save them somewhere above your web root!";
$lll["backupFileRemove"]="In order to start using the program, you have to remove the following backup directories from the installation root: <span class='confexpl'>%s.</span><br><br><a href='%s'>Click here to remove them!</a><span class='confexpl'> (If this message doesn't disappear after you clicked, it means the program has no permission to remove these files. In this case, you must delete them manually!)</span>";
$lll["systemConfCheck"]="System configuration checking...";
$lll["niceURLFeature"]="Nice URL feature:";
$lll["niceURLFeature_1"]="Noah's Classifieds supports using nice URLs. This means for example that the link of an ad details page can look like this:";
$lll["niceURLFeature_2"]="instead of the current solution:";
$lll["niceURLFeature_3"]="Besides that the former one is nicer, it is also said to be more search engine friendly.";
$lll["niceURLFeature_4"]="So that the nice URL feature works the Apache module called %s must be installed. It can't be find out for sure whether it is installed currently (Php is probably installed as a CGI binary).";
$lll["niceURLFeature_5"]="If %s is already installed, you should create a file under the classifieds installation directory called %s and put the following text in it, in order to enable nice URLs:";
// Changed in version 4.0.0. Old text:
//$lll["niceURLFeature_6"]="If after doing this, the nice url feature still doesn't work, you should also check the following in the Apache configuration file:";
// New text:
$lll["niceURLFeature_6"]="If after doing this, the nice url feature still doesn't work, you should  <a href='http://noahsclassifieds.org/documentation/configuration/rewriterules' target='_blank'>click here to learn more about the possible troubleshooting!</a>";
$lll["niceURLFeature_9"]="So that the nice URL feature works the Apache module called %s must be installed. It's not installed currently.";
$lll["reg_companyName"]="Company name";
$lll["reg_firstName"]="First name";
$lll["reg_lastName"]="Last name";
$lll["reg_email"]="Email";
$lll["reg_submit"]="Submit";
$lll["securityProperties"]="Security settings";
$lll["settings_applyCaptcha"]="Apply Spam protection (CAPTCHA) in the following forms";
$lll["settings_applyCaptcha_1"]="'Reply to this posting' and 'Email this to a friend'";
$lll["settings_applyCaptcha_2"]="Login form";
$lll["settings_applyCaptcha_3"]="Register form";
$lll["settings_applyCaptcha_4"]="Ad submission";
$lll["customfield_displayLabel"]="Display label";
$lll["customfield_displayLabel_expl"]="If checked off, the field label will not be displayed on the ad details page and the field value will span over the labels of the other fields.";
$lll["customfield_detailsPosition"]="Position";
$lll["customfield_detailsPosition_expl"]="The placement of the fields on the ad details page. The 'sidebar' is the right area of the details panel where the pictures reside (in the modern theme). You can place fields above the pictures area, or below them with this setting.";
$lll["customfield_detailsPosition_0"]="Normal";
$lll["customfield_detailsPosition_1"]="Top of the sidebar";
$lll["customfield_detailsPosition_2"]="Bottom of the sidebar";
$lll["formProperties"]="Form settings";
$lll["listProperties"]="List settings";
$lll["detailsProperties"]="Details page settings";
$lll["searchProperties"]="Search settings";
$lll["miscProperties"]="Miscellaneous settings";
$lll["customfield_showInDetails"]="Displayed for";

// Changed in version 4.1.0. Old text:
//$lll["mysql_found"]="MySQL has been found.";
// New text:
$lll["mysql_found"]="Success! MySQL has been found.";
// Changed in version 4.1.0. Old text:
//$lll["need_pw"]="MySQL require password for user %s.";
// New text:
$lll["need_pw"]="MySQL requires the password for user %s.";
// Changed in version 4.1.0. Old text:
//$lll["incorr_pw"]="MySQL password for %s is incorrect.";
// New text:
$lll["incorr_pw"]="The given MySQL password for %s is incorrect, please check it and try again.";
// Changed in version 4.1.0. Old text:
//$lll["mysql_not_found"]="MySQL not found! Please modify the parameters bellow to satisfy your MySQL configuration!";
// New text:
$lll["mysql_not_found"]="Oh no! MySQL not found! Please modify the parameters bellow to satisfy your MySQL configuration!";
$lll["db_installed"]="%s database er nu installeret: %s";
// Changed in version 4.1.0. Old text:
//$lll["cantcreatedb"]="Can not reach or create database. User %s has no create database permission, or cannot reach the database. Change the name of the user or give him appropriate rights!";
// New text:
$lll["cantcreatedb"]="Help! NOAH Cannot reach or create your database. User %s has no create database permission, or cannot reach the database. Change the name of the user or give it the appropriate rights!";
// Changed in version 4.1.0. Old text:
//$lll["cantconnectdb"]="Can not connect to database. May be have no rights or not exists, trying to create.";
// New text:
$lll["cantconnectdb"]=" Help! NOAH Cannot connect to database. Odds are there no rights or does not exist, trying to create.";
$lll["inst_create_table_err"]="Fejl under oprettelse af tabeller. %s already installed?";
// Changed in version 4.1.0. Old text:
//$lll["db_created"]="Database %s has been created.";
// New text:
$lll["db_created"]="Success!!! Your Database for NOAH %s has been created.";
// Changed in version 4.1.0. Old text:
//$lll["tables_installed"]="Database tables has been installed.";
// New text:
$lll["tables_installed"]="The Database tables have been correctly installed.";
// Changed in version 4.1.0. Old text:
//$lll["fill_table_err"]="Error while trying to fill tables.";
// New text:
$lll["fill_table_err"]="Oh my! An Error occurred while trying to fill tables.";
// Changed in version 4.1.0. Old text:
//$lll["tables_filled"]="Database tables has been filled with initial data.";
// New text:
$lll["tables_filled"]="Your NOAH Database tables has been filled with sample ads data.";
$lll["inst_click"]="Klik her for at tilgå %s.";
// Changed in version 4.1.0. Old text:
//$lll["createTableFailed"]="Create table failed";
// New text:
$lll["createTableFailed"]="Ouch! Create table failed";
$lll["install"]="Installér";
$lll["clickToInstall"]="KLik på 'Installér' for at installere %s!";
$lll["admin_ok"]="Administrator er nu oprettet, brugernavn: admin, password: admin.";
// Changed in version 4.1.0. Old text:
//$lll["create_file_ok"]="Config has been successfully created.";
// New text:
$lll["create_file_ok"]="Awesome!!! Config has been successfully created.";
// Changed in version 4.1.0. Old text:
//$lll["create_file_nok"]="Config file have to be created manually.";
// New text:
$lll["create_file_nok"]="Ouch! Config file have to be created manually, it happens.";
$lll["inst_params"]="MySQL databasen vil blive oprettet med følgende parametre:";
$lll["edit_params"]="Ret parametre";
$lll["acceptTerms"]="I have read through and accept the below terms and conditions: <input type='checkbox' id='accept' name='accept'>";
$lll["youMustAcceptTerms"]="You must accept the terms and conditions in order to continue!";
$lll["hostName"]="Hostname";
$lll["dbHostName"]="Hostname";
$lll["mysqluser"]="Mysql user name";
$lll["dbName"]="Database name";
$lll["dbDbName"]="Database name";
$lll["dbSocket"]="Socket";
$lll["formtitle"]="MySQL opsætning";
$lll["password"]="Password";
$lll["dbPort"]="Port";
$lll["cookieok"]="Cookies er tilladt.";
// Changed in version 4.1.0. Old text:
//$lll["cookienok"]="Enable cookies and start the install process again!";
// New text:
$lll["cookienok"]="Please Enable cookies and start the install process again!";
// Changed in version 4.1.0. Old text:
//$lll["conf_file_write_err"]="Can not open config file for write";
// New text:
$lll["conf_file_write_err"]="Hmmm. The config file cannot be opened for write";
// Changed in version 4.1.0. Old text:
//$lll["compare_conf"]="Create a file with your favorite text editor named 'app/config.php' in the directory where your source is, and copy the following source code into it! Be sure not to write any newline after the last line!";
// New text:
$lll["compare_conf"]="Please Create a file with your favorite text editor named 'app/config.php' in the directory where your source is, and copy the following source code into it! Be sure not to write any new lines after the last line!";
$lll["afterwrconf"]="Klik på nedenstående link <u>efter</u> efter du har lavet config filen!";
$lll["move_inst_file"]="Slet nu install.php!";
// Changed in version 4.1.0. Old text:
//$lll["inst_ch_pw"]="Administrator settings - username: admin, password: admin, don't forget to change the password!";
// New text:
$lll["inst_ch_pw"]="Administrator settings - username: admin, password: admin, and don't forget to change the password!";
$lll["create_file_nok_ext"]="Serveren har ikke rettigheder til at oprette config-filen. Du kan enten:<br>
#1: Oprette en tom fil med navnet app/config.php i det directory du har uploaded NOAH til, og tildele serveren skriverettigheder til filen. Under unix:<br>touch app/config.php;chmod 777 app/config.php<br>og klik på 'Reload/Refresh' knappen.<br>#2: Klik på install og opret config filen manuelt.<br>Programmet vil vise dig den tekst som app/config.php skal indeholde.";
$lll["registerNoah"]="Register";
$lll["notRegistered"]="Not registered";
$lll["registerNoahTitle"]="Register Noah's Classifieds";
// Changed in version 4.1.0. Old text:
//$lll["noahAlreadyRegistered"]="The product is already registered!";
// New text:
$lll["noahAlreadyRegistered"]="Your NOAH is already registered!";
$lll["noahRegistrationFalseResponse"]="Unable to send registration data to the Noah's server. Please, try again later!";
// Changed in version 4.1.0. Old text:
//$lll["noahRegistrationSuccessfull"]="Thank you. The product is now registered!";
// New text:
$lll["noahRegistrationSuccessfull"]="Thank you. Your NOAH is now registered!";
$lll["download"]="Download";
$lll["u_maintitle"]="Noah's Classifieds opdaterings proces";
// Changed in version 4.1.0. Old text:
//$lll["secure_copy"]="It is recommended to make a dump of your Noah's Classifieds database before the update!";
// New text:
$lll["secure_copy"]="It is recommended to make a databse dump of your Noah's Classifieds before the update!";
$lll["ready_to_update"]="Klar til at opdatere databasen %s til version %s?<br>";
// Changed in version 4.1.0. Old text:
//$lll["invalid_version"]="The given version is invalid: %s";
// New text:
$lll["invalid_version"]="hmm...The given version is invalid: %s";
// Changed in version 4.1.0. Old text:
//$lll["updateSuccessful"]="The update successfully completed.";
// New text:
$lll["updateSuccessful"]="The NOAH update successfully completed.";
$lll["updating"]="Opdaterer fra version %s til version %s...";
// Changed in version 4.1.0. Old text:
//$lll["already_installed"]="The latest software version %s is already installed.";
// New text:
$lll["already_installed"]="The latest NOAH software version %s is already installed.";
$lll["picturesDirMustbeWritable"]="The '%s' directory must be writable by the program in order to perform the update! Update failed.";
$lll["updateAutomatic"]="Update";
$lll["updateManualZip"]="Download ZIP";
$lll["updateManualTgz"]="Download TGZ";
$lll["downloadFileNotExists"]="Download file '%s' not exists.";
// Changed in version 4.1.0. Old text:
//$lll["updateFailed"]="Update failed, because the program has no permission to create or modify files under the installation directory.";
// New text:
$lll["updateFailed"]="The Update failed, because NOAH has no permission to create or modify files under the installation directory.";
// Changed in version 4.1.0. Old text:
//$lll["currentVersionIs"]="The current version is: %s";
// New text:
$lll["currentVersionIs"]="The current NOAH version is: %s";
// Changed in version 4.1.0. Old text:
//$lll["latestVersionIs"]="The latest version is: %s";
// New text:
$lll["latestVersionIs"]="The latest NOAH version is: %s";
// Changed in version 4.1.0. Old text:
//$lll["noNeedToUpdate"]="There is no need to update.";
// New text:
$lll["noNeedToUpdate"]="There is no need to update NOAH at this time.";
$lll["checkUpdates"]="Updates";
$lll["checkUpdatesTitle"]="Checking the Noah's Classifieds site for available updates";
// Changed in version 4.1.0. Old text:
//$lll["nopermission"]="The program has no write permission under the following directories: %s<br>You must execute the following Unix command (in Unix systems, of course):<br><i>chmod 777 &lt;replace directory name&gt;</i>";
// New text:
$lll["nopermission"]="The NOAH program has no write permission under the following directories: %s<br>You must execute the following Unix command (in Unix systems, of course):<br><i>chmod 777 &lt;replace directory name&gt;</i>";
$lll["nopermission_expl"]="(Noah's Classifieds forsøger at gemme billeder i 'pictures/listings' og kategori billeder i 'pictures/cats'. Du skal sikre at programmet har tilstrækkelige rettigheder til disse.)";
$lll["backToIndex"]="Return to the classifieds.";
$lll["onlyFrom1.3"]="You have a version that is older than 1.3. This update script works only with the 1.3 version!";
$lll["cantGetVersionInfo"]="Couldn't get version information. Update failed.";
// Changed in version 4.1.0. Old text:
//$lll["checkMailtestTitle"]="Sending out a test mail...";
// New text:
$lll["checkMailtestTitle"]="NOAH is sending out a test mail...";
$lll["triggerMailTest"]="Click here to test mail sending.";
$lll["unableToConnectNoah"]="Unable to connect to the Noah's server. Please, try again later!";
$lll["itemNumbersRecalculated"]="The item numbers have been successfully recalculated";
// Changed in version 4.1.0. Old text:
//$lll["dbPrefixExplanation"]="In case Noah's must share the database with tables of other applications, it's wise to specify a table prefix for the Noah's tables, in order to avoid table name collisions. E.g.: 'noah_'";
// New text:
$lll["dbPrefixExplanation"]="In case NOAH must share the database with tables of other applications, it's wise to specify a table prefix for the NOAH tables, in order to avoid table name collisions. E.g.: 'noah_'";
$lll["dbPrefix"]="Table prefix";
$lll["checkconf"]="Check";
// Changed in version 4.1.0. Old text:
//$lll["mailok"]="The send mail test has been successfully completed. You must soon get a test email on %s";
// New text:
$lll["mailok"]="The send mail test has been successfully completed. You will reveive a test email on %s";
// Changed in version 4.1.0. Old text:
//$lll["mailerr"]="The following error occured during sending out a test mail:<br>%s";
// New text:
$lll["mailerr"]="Ouch! The following error occured during sending out a test mail:<br>%s";
$lll["here1"]="klik her";
$lll["confpreerr"]="Der er karakterer før &lt;? i config filen! Slet disse karakterer (også 'ny linie' og mellerum/blanktegn)!";
$lll["confposterr"]="Der er karakterer efter ?&gt; i config filen! Slet disse karakterer (også 'ny linie' og mellerum/blanktegn)!";
$lll["conffileok"]="Config filen er ok.";
// Changed in version 4.1.0. Old text:
//$lll["congrat"]="Congratulations! You have successfully installed Noah's Classifieds!";
// New text:
$lll["congrat"]="Congratulations! You have successfully installed you new Noah's Classifieds!";
$lll["confcheck"]="Kontrollerer system configurationen ...";
// Changed in version 4.1.0. Old text:
//$lll["confdisapp"]="If you want to begin to work with the software and you want this page to disappear";
// New text:
$lll["confdisapp"]="If you want to begin to work with on your Noah's Classifieds and you want this page to disappear";
$lll["confclicheck"]="Du kan til enhver tid tilgå denne konfiguration check-side ved at klikke på 'Check' linket i menuen.";
$lll["chadmemail"]="Din nuværende mail-adresse er sat til admin@admin.admin. Ret den ved at klikke på 'Min profil' linket i menuen!";
// Changed in version 4.1.0. Old text:
//$lll["chsyspass"]="Your system email adress is not yet set. Please set it clicking on the 'Settings' link on the menubar!";
// New text:
$lll["chsyspass"]="Your system email address is not yet set. Please set it clicking on the 'Settings' link on the menubar!";
// Changed in version 4.1.0. Old text:
//$lll["chsyspass_expl"]="The program can't send out notification emails without the system email address that will populate the 'From' and 'Reply-to' fields of the notification emails.";
// New text:
$lll["chsyspass_expl"]="NOAH cannot send out notification emails without the system email address that will populate the 'From' and 'Reply-to' fields of the notification emails.";
$lll["chadmpass"]="Default admin passwordet er endnu ikke ændret! Ret det nu ved at klikke på 'Ret password' linket i menuen!";
$lll["settings_adminEmail"]="System mail";
// Changed in version 4.1.0. Old text:
//$lll["settings_adminEmail_expl"]="This will appear as the address in the 'From:' field of emails the program sends. If you leave this blank, the program may not be able send out email notifications!";
// New text:
$lll["settings_adminEmail_expl"]="This will appear as the address in the 'From:' field of emails the program sends. If you leave this blank... NOAH may not be able send out email notifications! Note that you may not use an email address in this field!";
$lll["nogd"]="Advarsel: Din server har ikke 'GD library' installeret.";
// Changed in version 4.1.0. Old text:
//$lll["nogd_expl"]="(This library is responsible in php programs for the image manipulation, so it might be anyway useful if you put it on your server. In our program it is called for creating thumbnail images to the full sized uploaded pictures. Without this support the program can't generate thumbnails, this way the browser have to shrink 'on-the-fly' each big image in each pages where thumbnails can appear. This method works, but it is far from effective (the page have to download every time every big image). )";
// New text:
$lll["nogd_expl"]="(This library is responsible in php programs for the image manipulation, so it might be anyway useful if you put it on your server. In our program it is called for creating thumbnail images to the full sized uploaded pictures. Without this support the program cannot generate thumbnail sized pictures, this way the browser have to shrink 'on-the-fly' each big image in each pages where thumbnails can appear. This method works, but it is far from effective (the page have to download every time every big image). )";
// Changed in version 4.1.0. Old text:
//$lll["instFileRemove"]="In order to start using the program, you have to remove the installation files (%s).<br><a href='%s'>Click here to remove them!</a><span class='confexpl'> (If this message doesn't disappear after you clicked, it means the program has no permission to remove these files. In this case, you must delete them manually!)</span>";
// New text:
$lll["instFileRemove"]="In order to start using the NOAH program, the installation files have to be removed(%s).<br><a href='%s'>Click here to remove them!</a><span class='confexpl'> (If this message doesn't disappear after you clicked, it means the program has no permission to remove these files. In this case, the files need to be manually deleted.)</span>";
$lll["rss"]="RSS";
$lll["rss_modify_form"]="Modify RSS feed";
$lll["rss_language"]="Language";
$lll["rss_link"]="Link";
// Changed in version 4.1.0. Old text:
//$lll["rss_link_expl"]="The URL of the classifeds site - e.g.: http://yoursete.com/classifieds";
// New text:
$lll["rss_link_expl"]="The URL of the classifeds site - e.g.: http://yoursite.com/classifieds";
$lll["rss_descField"]="Description field";
$lll["rss_descField_expl"]="the index of the variable field that serves as the 'Description' of a given ad in the RSS feed. In the default Classifieds installation, it is the 1st field. If you don't have such field, set ot to '0', and no ad description will be displayed in the feed.";
$lll["settings"]="Opsætning";
$lll["settings_modify_form"]="Skift indstillinger";
$lll["settings_expNoticeBefore"]="Antal dage før annonceudløb som bruger skal adviceres";
$lll["settings_charLimit"]="Tilladte antal karakterer i en annonce";
$lll["settings_blockSize"]="Antal annoncer per side";
$lll["settings_maxPicSize"]="Maksimum billestørrelse i bytes";
$lll["settings_maxPicWidth"]="Maksimum billed-bredde i pixels";
$lll["settings_maxPicHeight"]="Maksimum billed-højde i pixels";
$lll["settings_maxPicHeight_expl"]="'0' means unlimited.";
$lll["settings_maxPicWidth_expl"]="'0' means unlimited.";
$lll["settings_maxPicSize_expl"]="'0' means unlimited.";
$lll["settings_adminFromName"]="System name";
$lll["settings_adminFromName_expl"]="This will appear as the name in the 'From:' field of email notifications the program sends out.";
$lll["settings_versionFooter"]="Version footer";
$lll["settings_titlePrefix"]="Title prefix";
$lll["settings_dateFormat"]="Date format";
$lll["settings_dateFormat_expl"]="For more information and examples on the available date specifiers, <a href='http://php.net/manual/en/function.date.php' target='_blank'>click here</a>";
// Changed in version 3.0.0. Old text:
//$lll["settings_enableFavorities"]="Enable the 'Add to favorities' feature";
// New text:
//$lll["settings_enableFavorities"]="Enable the 'Add to favorities' feature for";
$lll["settings_enableFavorities"]="Enable the 'Add to favorities' feature for";
$lll["settings_enableFavorities_expl"]="This setting has no effect in the Evaluation version";
$lll["settings_updateCheckInterval"]="Check for Noah's updates periodically";
$lll["settings_updateCheckInterval_expl"]="The program can check for updates automatically and when a new release is available, it 
                                              displays the update page for the administrator. This setting specifies the length of the checking period in days.
                                              If you want to disable the feature, set it to 0!";
$lll["mailProperties"]="Mail sending properties";
$lll["themeProperties"]="Theme support";
$lll["settings_defaultTheme"]="Default theme";
$lll["settings_allowedThemes"]="Allowed themes to select from";
$lll["settings_allowedThemes_expl"]="If you create a new subdirectory under 'themes' for your custom theme - e.g. 'my_new_theme', it will automatically appear in this list as a new item 'My new theme'!";
$lll["settings_allowSelectTheme"]="Allow others to change theme";
$lll["settings_allowSelectTheme_expl"]="If this is enabled, a selection drop down will be displayed on the pages that allows the immediate change of the program theme.";
$lll["languageProperties"]="Language support";
$lll["settings_defaultLanguage"]="Default language";
$lll["settings_allowedLanguages"]="Allowed languages to select from";
$lll["settings_allowSelectLanguage"]="Allow others to change language";
$lll["settings_allowSelectLanguage_expl"]="If this is enabled, a selection drop down will be displayed on the pages that allows the immediate change of the program language.";
$lll["settings_smtpServer"]="SMTP server name";
$lll["settings_smtpServer_expl"]="Use these fields if you want that the program sends out the notification emails through an SMTP server. Otherwise, the native Php mail function will be used.";
$lll["settings_smtpUser"]="SMTP user name";
$lll["settings_smtpPass"]="SMTP password";
$lll["settings_fallBackNative"]="Fall back on native mail if SMTP fails";
$lll["settings_titlePrefix_expl"]="This text will preceed any title in the title bar of the browser. E.g.: you can set it to the name of your site.";
$lll["seoProperties"]="Search engine optimization";
$lll["settings_mainTitle"]="Title tag";
$lll["settings_mainTitle_expl"]="The content of the TITLE, DESCRIPTION and KEYWORDS usually depends on which category list or 
                                 which ad details page is currently displayed - i.e. you can define this per category and the users 
                                 may define it per ad. These three fields, however, serve as the defaults for those cases when a page 
                                 is just not in a category or ad context (e.g. the start page itself)";
$lll["settings_mainDescription"]="Description meta tag";
$lll["settings_mainKeywords"]="Keywords meta tag";
$lll["settings_helpLink"]="'Help' link destination";
$lll["settings_helpLink_expl"]="The full URL of the help file. With this, you can define your own Help page. E.g.: http://yoursite/classifieds_dir/customhelp.html";
$lll["settings_maxMediaSize"]="Maximum uploadable media file size in bytes";
$lll["settings_maxMediaSize_expl"]="'0' means unlimited.<br><br>Note, however, that whatever you set here, there are two Php settings that can limit the maximum uploadable file size. They are 'upload_max_filesize' and 'post_max_size'. They can be set either in the 'php.ini' file, or in the 'httpd.conf', or in the '.htaccess' file per directory. Their default is usually 2MB. You can increase their values to say 50MB in the .htaccess file this way:<br><br>php_value upload_max_filesize \"50M\"<br>php_value post_max_size \"50M\" ";
// Changed in version 3.0.0. Old text:
//$lll["settings_subscriptionType"]="Auto notify";
// New text:
//$lll["settings_subscriptionType"]="Enable auto notify for";
$lll["settings_subscriptionType"]="Enable auto notify for";
$lll["settings_subscriptionType_expl"]="Users can subscribe for getting automatic notifications if new ads are submitted in a category";
$lll["settings_subscriptionType_0"]="Disable auto notify";
$lll["settings_subscriptionType_1"]="Allow for registered users only";
$lll["settings_subscriptionType_2"]="Enable for all";
$lll["settings_menuPoints_expl"]="If 'Submit ad' is unchecked, the menu point will only be visible for admin (only admin can submit ads than). You can also disable or reorganize menu points by simply removing or moving their corresponding section in the 'layout.tpl.php' template file!";
$lll["settings_menuPoints"]="Menu points";
$lll["settings_menuPoints_2"]="Logout";
$lll["settings_menuPoints_3"]="Login";
$lll["settings_menuPoints_4"]="Register";
$lll["settings_menuPoints_5"]="Show My profile";
$lll["settings_menuPoints_6"]="My ads";
$lll["settings_menuPoints_7"]="Submit ad";
$lll["settings_menuPoints_8"]="Recent ads";
$lll["settings_menuPoints_9"]="Popular ads";
$lll["settings_menuPoints_10"]="Search";
$lll["settings_menuPoints_11"]="Home";
$lll["settings_menuPoints_12"]="Help";
$lll["menuPointsSep"]="Menu tilretning";
$lll["expirationProperties"]="Udløbs data";
$lll["imageProperties"]="Begrænsninger i upload af billeder";
$lll["otherProperties"]="Andre indstillinger";
$lll["adDisplayProperties"]="Ad display settings";
$lll["settings_renewal"]="Antal tilladte annonceforlængelser";
$lll["settings_allowModify"]="Bruger kan rette i egne annoncer";
$lll["settings_extraHead"]="Additional HEAD content";
// Changed in version 4.1.0. Old text:
//$lll["settings_extraHead_expl"]="With this, you can insert custom HTML right before the closing HEAD tag of the pages. This is usually a good place to insert additional style sheets, or JavaScript.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_extraHead_expl"]="With this, you can insert custom HTML right before the closing HEAD tag of the pages. This is usually a good place to insert additional style sheets, or JavaScript.<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_extraBody"]="Additional BODY content";
// Changed in version 4.1.0. Old text:
//$lll["settings_extraBody_expl"]="With this, you can insert custom HTML right after the opening BODY tag of the pages. E.g. you can insert a banner above all the pages here.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_extraBody_expl"]="With this, you can insert custom HTML right after the opening BODY tag of the pages. E.g. you can insert a banner above all the pages here.<br><br>This feature is not available in the Lite version of the program!";
$lll["settings_extraFooter"]="Additional footer content";
// Changed in version 4.1.0. Old text:
//$lll["settings_extraFooter_expl"]="With this, you can insert custom HTML right before the closing BODY tag of the pages.<br><br>This feature is not available in the Free version of the program!";
// New text:
$lll["settings_extraFooter_expl"]="With this, you can insert custom HTML right before the closing BODY tag of the pages.<br><br>This feature is not available in the Lite version of the program!";
$lll["customfield"]="Variabel-felter";
$lll["mustBeCommaSeparated"]="De mulige værdier for valgbokse skal defineres som komma-separerede strenge";
$lll["invalidDefaultValue"]="Default værdien for valgbokse skal være en af de komma-separerede strenge vist i feltet 'mulige værdier'.";
$lll["description"]="Description";
$lll["descriptionDefaultLabel"]="Beskrivelse";
$lll["privateField"]="Privat";
$lll["customfield_type_1"]="Tekst";
$lll["customfield_type_2"]="Tekstområde";
$lll["customfield_type_3"]="Boolsk";
$lll["customfield_type_4"]="Valg";
$lll["customfield_type_6"]="Felre valg";
$lll["customfield_type_5"]="Separator";
$lll["customfield_type_7"]="Checkbox";
$lll["customfield_type_8"]="Picture";
$lll["customfield_type_10"]="Media file";
$lll["customfield_type_9"]="Web link";
$lll["customfield_type_11"]="Date";
$lll["customfield_dateDefaultNow"]="Default date is the current day";
$lll["customfield_fromyear"]="From year";
$lll["customfield_fromyear_expl"]="The range of the date selector that populates this field will go from this year. 
                                   You can enter an actual year number like '1971', or you can enter 'now' that stands for the current year.
                                   You can also use a relative year: 'now-5' will mean the range will start from 5 years ago!";
$lll["customfield_toyear"]="To year";
$lll["customfield_toyear_expl"]="The range of the date selector that populates this field will go up to this year.
                                   You can enter an actual year number like '2010', or you can enter 'now' that stands for the current year.
                                   You can also use a relative year: 'now+5' will mean the range will end in 5 years from now!";
$lll["customfield_name"]="Navn";
$lll["customfield_type"]="Type";
$lll["customfield_default_multiple"]="Default value";
$lll["customfield_default_text"]="Default value";
$lll["customfield_default_bool"]="Default value";
$lll["customfield_active"]="Aktiv";
$lll["customfield_separator"]="Kolonne 1.";
$lll["customfield_mandatory"]="Obligatorisk";
// Changed in version 3.0.0. Old text:
//$lll["customfield_showInList"]="Appears in list";
// New text:
//$lll["customfield_showInList"]="Show in lists for";
$lll["customfield_showInList"]="Show in lists for";
$lll["customfield_values"]="Mulige værdier";
$lll["customfield_innewline"]="Placer på ny linie";
$lll["customfield_displaylength"]="List display length";
$lll["customfield_displaylength_expl"]="The maximum number of characters that are displayed on the ads list page. The appearance of the list view can be protected against displaying very long fields in a cell.";
// Changed in version 3.1.0. Old text:
//$lll["customfield_searchable"]="Searchable";
// New text:
$lll["customfield_searchable"]="Show in the search form for";
$lll["customfield_rangeSearch"]="Allow range search";
// Changed in version 3.1.0. Old text:
//$lll["customfield_rangeSearch_expl"]="If this is checked than one can define e.g. '10-20' as a search condition to search for ads where the value of this field is between 10 and 20.";
// New text:
$lll["customfield_rangeSearch_expl"]="If this is checked than one can define e.g. '10-20' as a search condition to search for ads where the value of this field is between 10 and 20. Or one can enter a range of dates in case of Date fields.";
$lll["customfield_allowHtml"]="Tillad HTML";
// Changed in version 2.3.0. Old text:
//$lll["customfield_allowHtml_expl"]="This only allows 'save' HTML tags, however! Some tags that would impose a security risk, or ruin the layout are excluded.";
// New text:
//$lll["customfield_allowHtml_expl"]="This only allows 'safe' HTML tags, however! Some tags that would impose a security risk, or ruin the layout are excluded.";
// Changed in version 4.0.0. Old text:
//$lll["customfield_allowHtml_expl"]="This only allows 'safe' HTML tags, however! Some tags that would impose a security risk, or ruin the layout are excluded.";
// New text:
$lll["customfield_allowHtml_expl"]="This only allows 'safe' HTML tags, however! Some tags that would impose a security risk, or ruin the layout are excluded.<br><br>If you don't allow HTML, some simple rules will be still applied: line breaks in the text will be rendered as new lines, web links and email addresses will turn into clickable links.";
$lll["customfield_private"]="Tillad som privat";
// Changed in version 2.4.0. Old text:
//$lll["customfield_format_expl"]="You can use it a C-style sprintf format string";
// New text:
//$lll["customfield_format_expl"]="Advanced users can apply a C-style sprintf format string, too.";
$lll["customfield_subType"]="Treat this field as";
$lll["customfield_subType_1"]="Text";
$lll["customfield_subType_2"]="Integer number";
$lll["customfield_subType_3"]="Float number";
$lll["customfield_sortable"]="Sorting";
$lll["customfield_expl"]="Explanation text";
$lll["customfield_expl_expl"]="Help text like the one you are just reading! A more detailed description of a form field.";
$lll["private_field"]="(privat)";
$lll["customfield_newitem"]="Add new custom field";
$lll["customfield_modify_form"]="Sæt variabel-felter for annoncer for denne kategori";
$lll["customfield_create_form"]="Create custom field";
$lll["customfield_sortId"]="Sort";
$lll["customfield_sorthelp"]="Use the arrow icons in the 'Sort' column to re-arrange the list, then click on the 'Save sorting' button at the bottom!";
$lll["customfield_savesorting"]="Save sorting";
$lll["customfield_sortingsaved"]="The new custom field sorting has been successfully saved.";
// Changed in version 3.0.0. Old text:
//$lll["customFields"]="List of custom fields of this category";
// New text:
//$lll["customFields"]="List of custom fields";
$lll["customFields"]="List of custom fields";
$lll["customfield_rowspan"]="Spans rows";
$lll["customfield_seo"]="Search engine optimization";
$lll["customfield_seo_0"]="No assignment";
// Changed in version 3.0.0. Old text:
//$lll["customfield_seo_1"]="Use this field as the TITLE of the ad";
// New text:
//$lll["customfield_seo_1"]="Use this field as the TITLE of the details page";
$lll["customfield_seo_1"]="Use this field as the TITLE of the details page";
// Changed in version 3.0.0. Old text:
//$lll["customfield_seo_2"]="Use this field as the DESCRIPTION of the ad";
// New text:
//$lll["customfield_seo_2"]="Use this field as the DESCRIPTION of the details page";
$lll["customfield_seo_2"]="Use this field as the DESCRIPTION of the details page";
// Changed in version 3.0.0. Old text:
//$lll["customfield_seo_3"]="Use this field as the KEYWORDS of the ad";
// New text:
//$lll["customfield_seo_3"]="Use this field as the KEYWORDS of the details page";
$lll["customfield_seo_3"]="Use this field as the KEYWORDS of the details page";
// Changed in version 3.0.0. Old text:
//$lll["customfield_mainPicture"]="Use this field as the main picture of the ad";
// New text:
//$lll["customfield_mainPicture"]="Use this field as the main picture";
$lll["customfield_mainPicture"]="Use this field as the main picture";
$lll["customfield_mainPicture_expl"]="To use this picture in non category specific lists and RSS feeds.";
// Changed in version 2.4.0. Old text:
//$lll["customfield_seo_expl"]="You can specify here which custom field of the item will serve as the content of the HTML TITLE tag, DESCRIPTION tag and KEYWORDS tag, respectively. 
//                              Besides SEO, the content of the TITLE fields will appear in the title bar of the browser when one 
//                              displays the ad, it will be used as the title of the ad in non category specific ad lists and in RSS feeds.
//                              The fields designated as the KEYWORD will not be displayed on the ad page - it will only be visible in the create and modify forms of the ads.";
// New tex:
//$lll["customfield_seo_expl"]="You can specify here which custom field of the item will serve as the content of the HTML TITLE tag, DESCRIPTION tag and KEYWORDS tag, respectively. 
//                              Besides SEO, the content of the TITLE fields will appear in the title bar of the browser when one 
//                              displays the ad, it will be used as the title of the ad in non category specific ad lists and in RSS feeds.";
$lll["customfield_seo_expl"]="You can specify here which custom field of the item will serve as the content of the HTML TITLE tag, DESCRIPTION tag and KEYWORDS tag, respectively. 
                              Besides SEO, the content of the TITLE fields will appear in the title bar of the browser when one 
                              displays the ad, it will be used as the title of the ad in non category specific ad lists and in RSS feeds.";
$lll["customfield_innewline_expl"]="Instead of forming a new column, this setting makes the custom field value appear in a new line that spans over all the other columns horizontally and is placed below them.";
// Changed in version 2.3.0. Old text:
//$lll["customfield_rowspan_expl"]="Use this in conjunction with the 'Place in new line' property of other custom fields. If there are other fields which has been placed in a new line, you can specify with this setting that this fields spans over those new lines vertically.";
// New text:
//$lll["customfield_rowspan_expl"]="Use this in conjunction with the 'Place in new line' property of other custom fields. If there are other fields which has been placed in a new line, you can specify with this setting that this field spans over those new lines vertically.";
$lll["customfield_rowspan_expl"]="Use this in conjunction with the 'Place in new line' property of other custom fields. If there are other fields which has been placed in a new line, you can specify with this setting that this field spans over those new lines vertically.";
$lll["notification"]="advicering";
$lll["notification_ttitle"]="Adviceringer";
$lll["Notifications"]="Adviceringer";
$lll["notification_subject"]="Email emne";
$lll["notification_body"]="Email body";
$lll["notification_variables"]="Tilladte variabler";
$lll["notification_active"]="Aktiv";
$lll["notification_modify_form"]="Rediger advicering";
$lll["notif_remindpass_tit"]="Contains a new password if the user forgot the old one.";
$lll["notif_remindpass_subj"]="New password";
$lll["notif_initpass_tit"]="Sendt til brugeren efter registrering, indeholder indledende password";
$lll["notif_initpass_subj"]="Indledende password";
$lll["notification_cc"]="CC";
$lll["notification_cc_expl"]="Angev CC-adresse for besked.";
$lll["notification_active_expl"]="Du kan slå udsendelse af beskeder til og fra her.";
?>