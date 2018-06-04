<?php
/**
 * Custom WordPress configurations on "wp-config.php" file.
 *
 * This file has the following configurations: MySQL settings, Table Prefix, Secret Keys, WordPress Language, ABSPATH and more.
 * For more information visit {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php} Codex page.
 * Created using {@link http://generatewp.com/wp-config/ wp-config.php File Generator} on GenerateWP.com.
 *
 * @package WordPress
 * @generator GenerateWP.com
 */


/* MySQL settings */
// define( 'DB_NAME', 'scatel_vxm' );
// define( 'DB_USER', 'root' );
// define( 'DB_PASSWORD', '' );

define( 'DB_NAME', 'scatel_vxm' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET',  'utf8' );
define( 'DB_COLLATE',  'utf8_unicode_ci' );


/* MySQL database table prefix. */
$table_prefix = 'aio_';





/* Custom WordPress URL. */
define( 'UPLOADS',        'assets' );


/* WordPress Cache */
define( 'WP_CACHE', false );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );


/* Compression */
define( 'COMPRESS_CSS',        true );
define( 'COMPRESS_SCRIPTS',    true );
define( 'CONCATENATE_SCRIPTS', true );
define( 'ENFORCE_GZIP',        true );


/* Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );


// add_filter( 'wpcf7_load_js', '__return_false' );
// define('WP_HOME', 'http://localhost/vxm');
// define('WP_SITEURL', 'http://localhost/vxm');

// this is a test comment for git testing, erase as soon as i become useless
