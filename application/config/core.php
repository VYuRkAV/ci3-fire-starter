<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */

// Site Details
$config['site_version']          = "3.1.4.001";
$config['root_folder']           = "htdocs";        // set to whatever your webroot is (htdocs, public_html, etc.) - MAKE SURE you physically rename the /htdocs folder
$config['caching_driver']        = array('adapter' => 'file', 'backup' => 'file');  // set caching driver (File-based Caching - array('adapter' => 'file', 'backup' => 'file'))
$config['public_theme']          = "default";       // folder containing your public theme
$config['private_theme']         = "private";       // folder containing your admin theme
$config['admin_theme']           = "admin";         // folder containing your admin theme

// Pagination
$config['num_links']             = 8;
$config['full_tag_open']         = "<div class=\"pagination\">";
$config['full_tag_close']        = "</div>";

// Login Attempts
$config['login_max_time']        = 10;              // in seconds
$config['login_max_attempts']    = 3;

// Miscellaneous
$config['profiler']              = FALSE;
$config['error_delimeter_left']  = "";
$config['error_delimeter_right'] = "<br />";

// SSL
$config['redirect_ssl']          = FALSE;           // If you want to redirect always SSL
