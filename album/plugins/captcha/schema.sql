# *************************************************
# Coppermine Photo Gallery 1.4.13 Captcha Plugin
# *************************************************
# Captcha 3.0
# Copyright (C) 2006 Borzoo Mossavari <bmossavari@gmail.com>
# *************************************************
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************


#
# Table structure for table `CPG_plugin_captcha`
#
CREATE TABLE  `CPG_plugin_captcha` (
  `time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ip_addr` tinytext NOT NULL,
  `code` char(32) NOT NULL default ''
) TYPE=MyISAM COMMENT='Used to store captcha code and user ip';


