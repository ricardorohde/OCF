CAPTCHA Plugin
  Based on Mod by Abbas ali(http://coppermine-gallery.net/forum/index.php?topic=29564.0)

Installation:
1.Copy captcha folder to your plugins folder
2.Use plugin manager to install it
3.Copy captcha.php to gallery root


Settings:
1-You can set which group shouldn't see captcha on each page
    open codebase.php
    Find captcha_page_start function and $CAPTCHA_DISABLE array , there you can put name of each group for each page that you don't want captcha
    - If you want to enable Captcha for all users then you should set the value to empty ('') string
    - If you want to disable Captcha for all users then put the name of all group there something like this :
        'Administrators,Registred,Guests'
    - Bridged gallery should use BBS/integrated app's group name instead of gallery group name

2-You can set how many secounds should pass before we delete old records from database
    open codebase.php
    Find captcha_page_start function and $CAPTCHA_TIMEOUT variable , there you can set number of secounds

3-You can set captcha image setting under captcha.php
    - Fonts (array)
    - Width of image (int)
    - Height of image (int)
    - Number of characters to draw (int)
    - Add shadow to generated characters to further obscure code (bool)
    - Add owner text to bottom of CAPTCHA, usually your site address (str)
    - Characters to select from (array)
    - Background image to use

B.Mossavari

Announcement thread :
http://coppermine-gallery.net/forum/index.php?topic=36319.0