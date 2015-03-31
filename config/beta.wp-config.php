<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings,
 * Table Prefix, Secret Keys, WordPress Language, and ABSPATH.
 * You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings
 * from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just
 * copy this file to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
 * Load database info and local development parameters
 */
define( 'WP_LOCAL_DEV', false );
define( 'DB_NAME', 'db192821_beta_creativestore' );
define( 'DB_USER', 'db192821_tm' );
define( 'DB_PASSWORD', 'zJgHZdsxV4VH>cQ?he8b' );
define( 'DB_HOST', $_ENV['DATABASE_SERVER'] ); // Probably 'localhost'

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Custom Content Directory
 */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all
 * existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'HeotDiUfyeYldIrdjFEW');
define('SECURE_AUTH_KEY',  'WryntEgubdAdjIkEqRTI');
define('LOGGED_IN_KEY',    'gaigoAfrIakePciFcZLD');
define('NONCE_KEY',        'lumvUcPaghOfvuBMpTPi');
define('AUTH_SALT',        'yEhowMaplAgriVkiqsLF');
define('SECURE_AUTH_SALT', 'alpuThNisutoBoVsecFA');
define('LOGGED_IN_SALT',   'IbVikahafsIcnIrIJvzE');
define('NONCE_SALT',       'vadjosBavateckHBdSHu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give
 * each a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the
 * chosen language must be installed to wp-content/languages.
 * For example, install de_DE.mo to wp-content/languages and set
 * WPLANG to 'de_DE' to enable German language support.
 */
define('WPLANG', '');

/**
 * Enable W3 Total Cache
 * Added by W3 Total Cache
 */
define('WP_CACHE', false);

/**
 * WordPress Default Theme
 * Change this to the theme name.
 */

define( 'WP_DEFAULT_THEME', 'creative-store' );

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during
 * development. It is strongly recommended that plugin and theme
 * developers use WP_DEBUG in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Reduce number of revisions saved
 */
define('WP_POST_REVISIONS', 3);

/**
 * Increase PHP memory limit if possible
 */
define('WP_MEMORY_LIMIT', '96M');

/**
 * Disallow themes and plugins to be edited via the Admin console.
 */
define( 'DISALLOW_FILE_EDIT', true );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
