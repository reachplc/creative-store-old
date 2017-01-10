<?php
$root_dir = dirname( __DIR__ );
$webroot_dir = $root_dir . '/html';
/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv( $root_dir );
if ( file_exists( $root_dir . '/.env' ) ) {
	$dotenv->load();
	$dotenv->required( ['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL'] );
}
/**
 * Set up our global environment constant and load its config first
 * Default: development
 */
define( 'WP_ENV', getenv( 'WP_ENV' ) ?: 'development' );
$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';
if ( file_exists( $env_config ) ) {
	require_once $env_config;
}

/**
 * URLs
 */
define( 'WP_HOME', getenv( 'WP_HOME' ) );
define( 'WP_SITEURL', getenv( 'WP_SITEURL' ) );

/**
 * Custom Content Directory
 */
define( 'CONTENT_DIR', '/app' );
define( 'WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR );
define( 'WP_CONTENT_URL', WP_HOME . CONTENT_DIR );

/**
 * Custom MU Plugins
 */
define( 'WPMU_PLUGIN_DIR', $webroot_dir . CONTENT_DIR .'/plugins-mu' );
define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL . '/plugins-mu' );

/**
 * DB settings
 */
define( 'DB_NAME', getenv( 'DB_NAME' ) );
define( 'DB_USER', getenv( 'DB_USER' ) );
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );
define( 'DB_HOST', getenv( 'DB_HOST' ) ?: 'localhost' );
define( 'DB_CHARSET', getenv( 'DB_CHARSET' ) ?: 'utf8' );
define( 'DB_COLLATE', getenv( 'DB_COLLATE' ) ?: '' );
$table_prefix = getenv( 'DB_PREFIX' ) ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
define( 'AUTH_KEY', getenv( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY', getenv( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY', getenv( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY', getenv( 'NONCE_KEY' ) );
define( 'AUTH_SALT', getenv( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', getenv( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT', getenv( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT', getenv( 'NONCE_SALT' ) );

/**
 * Custom Settings
 */
define( 'AUTOMATIC_UPDATER_DISABLED', getenv( 'WP_AUTOMATIC_UPDATER_DISABLED' ) ?: false );
define( 'DISABLE_WP_CRON', getenv( 'WP_DISABLE_WP_CRON' ) ?: true );
define( 'DISALLOW_FILE_EDIT', getenv( 'WP_DISALLOW_FILE_EDIT' ) ?: true );
define( 'DISALLOW_FILE_MODS', getenv( 'WP_DISALLOW_FILE_MODS' ) ?: true );
define( 'WP_POST_REVISIONS', getenv( 'WP_POST_REVISION' ) ?: 3 );
define( 'AUTOSAVE_INTERVAL', getenv( 'WP_AUTOSAVE_INTERVAL' ) ?: 120 );
define( 'WP_MEMORY_LIMIT', getenv( 'WP_MEMORY_LIMIT' ) ?: '96M' );
define( 'WP_DEFAULT_THEME', getenv( 'WP_DEFAULT_THEME' ) ?: 'twentyseventeen' );
define( 'WPLANG', getenv( 'WPLANG' ) ?: 'en_GB' );

/**
 * Allow WordPress Multisite
 */
define( 'WP_ALLOW_MULTISITE', getenv( 'WP_ALLOW_MULTISITE' ) ?: false );
define( 'MULTISITE', getenv( 'WP_MULTISITE' ) ?: false );
define( 'SUBDOMAIN_INSTALL', getenv( 'WP_SUBDOMAIN_INSTALL' ) ?: false );
define( 'DOMAIN_CURRENT_SITE', getenv( 'DOMAIN_CURRENT_SITE' ) );
define( 'PATH_CURRENT_SITE', getenv( 'WP_PATH_CURRENT_SITE' ) ?: '/' );
define( 'SITE_ID_CURRENT_SITE', getenv( 'WP_SITE_ID_CURRENT_SITE' ) ?: 1 );
define( 'BLOG_ID_CURRENT_SITE', getenv( 'WP_BLOG_ID_CURRENT_SITE' ) ?: 1 );

/**
 * Drop-ins
 */
define( 'SUNRISE', getenv( 'WP_SUNRISE' ) ?: false );

/**
 * Bootstrap WordPress
 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $webroot_dir . '/wp/' );
}
