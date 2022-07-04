<?php

// Local environment

define( 'ENV', 'PATH=/usr/local/bin:/usr/local/sbin:/usr/bin:/usr/sbin:/bin:/sbin:/opt/homebrew/bin:~/.composer/vendor/bin' );

// Log folder on Valet instalation

define( 'LOGS', '/Users/username/.config/valet/Log' );

// Folder level to find the group name or 0 to disable
// ~/folder/Group/folder
// ~/Sites/Client/site.com/public

define( 'GROUP', 2 );

// Wallpapers options
// @param wallpaper - Random wallpaper located on /assets/wallpaper
// @param bing - The bing daily wallpaper
// @param #111 - Hexadecimal color
// @param empty - Default color

define( 'BODY', 'wallpaper' );