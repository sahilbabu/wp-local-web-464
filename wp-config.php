<?php

/** Enable W3 Total Cache Edge Mode */

define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/imgneed/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

define('DISABLE_WP_CRON', true);
define('WP_SITEURL','http://www.imgneed.com');
define("COOKIE_DOMAIN", "www.imgneed.com");
define("WP_CONTENT_URL", "http://static.imgneed.com"); 

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'imgneed_wp');


/** MySQL database username */
define('DB_USER', 'imgneed_admin');


/** MySQL database password */
define('DB_PASSWORD', '8);wG*HNn?0U');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']^Mko97q-IjhF8{bfJ9-1u#+VKxY{4Jbh0.,T_tE~NQo-SMu)oZn`w`e;AKcod| ');

define('SECURE_AUTH_KEY',  'INfkodk:HT+={( riu)n/9#Lp,w^}?E0[As::`Y$&4L4+rH|a|!=}IVlh`|9+HZc');

define('LOGGED_IN_KEY',    '.u~=$sEX?gBm[v)l(wq8j[iymy|S|,B%cp-%DVol3LyP.srsjKbv<c,N@];#J En');

define('NONCE_KEY',        'C=KA|<--5NL*/||@`BJU ?tdci&Z7!l/=2tZJl-x9^++nxZQuTQ,sNEwIcKt&}gl');

define('AUTH_SALT',        '{iE~;QWOr;BLoTzt0>xw+V0O:!iA9YRYebHQA@ XB?T#Ip,tL]SnB%:?:&&Vc2@Y');

define('SECURE_AUTH_SALT', 'AO;3rnK :]Ht9asIaytkL/&~ecY@e#H4VEo<2Gih`.XC)t8Ile{R`2(`=/a9*&H6');

define('LOGGED_IN_SALT',   'A=xGX^ZDJ?[*CICWd^nS:uJ:L,^ui@DIblKRF?MCs&gSBTB@{ KC8O-m:pGS<m,G');

define('NONCE_SALT',       '!@OK[)+QA:n~X(54}v^)%){$M4U$4x8>hXh!k%WgsTNyjz|83faKMvB,[VnPpS(T');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_img_';


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');