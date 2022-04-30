<?php

// SITE PRESETS
define('SITE_ROOT', dirname(__FILE__, 3)); // DO NOT CHANGE
define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME']); // DO NOT CHANGE

// Website Name
define('SITE_NAME', 'sxck');

// Website Description
define('SITE_DESC', 'sxck | panel');

/**
 * Folder name should be defined starting with the "/" (slash)
 * 
 * If you do not plan on having it in a subdomain,
 * keep '' empty without a "/" (slash)
 * example: define('SUB_DIR', '');
 */
define('SUB_DIR', '/');

// Loader link // From Root folder
define('LOADER_URL', SITE_ROOT.'/vlc.exe');

// API key
define('API_KEY', 'yfDPzMLd367mwta5P7GPP6mSJ85EWJd23Wm5zYNGedYwaft6drKWxmC4CRJnM7HAsHV5GdBqLNZ');