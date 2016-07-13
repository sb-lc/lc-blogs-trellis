<?php
/** Staging */
ini_set('display_errors', 0);

define('WP_DEBUG_DISPLAY', true); #siedev # change back to false
define('SCRIPT_DEBUG', true); #siedev # change back to false
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);


#SIEDEV - CONSTANTS ADDED

define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('ROOT_DIR', $root_dir);

