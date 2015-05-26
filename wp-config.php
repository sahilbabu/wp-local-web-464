<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'imgneed_wp_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'eyU7]x@X#8k3MOyT]$+^O><dz+b#,LF<8-NO?0;KSxuB?6>fI8CDANu kBl8~_^{');
define('SECURE_AUTH_KEY',  'u#?F.[8^A],+_oC27Yx9jyq-BF}Edoex*$Ss]<+9nl!~2$3mg5i+|@MDSd=U-GdX');
define('LOGGED_IN_KEY',    'M.0=fl4*0]$,bqJsT|mJBD)&C2D1T4D-T?hWc |n+a,?`0cX4&-F(D-|Ke>5usZ1');
define('NONCE_KEY',        'hC71c2nnBGIlp6pqTt*Xy]Jlw<-=Pa;koCu.wrSf|aZwuiY(,@/~|?jBd^3{KY(A');
define('AUTH_SALT',        'Kbq%~Ss0:4M_<1}$Vq|aa D|A/oWz1@?_zl4x[z>(7j|0MiR*~kR7*~YdmlLzZtN');
define('SECURE_AUTH_SALT', '}RCx3Oq-p>h[K|OSa.0pgEf+<SbXsCD4}j^gnWO,6M_Phw*{BK4+/S@1)2+f@#8F');
define('LOGGED_IN_SALT',   '}?<Maz={>z+3iL74NG^+ C.O!](cY:IQ1D/$~]Z.oB{QB}`-9[h_|B?O3|q-6&-:');
define('NONCE_SALT',       'S^cUS.qDDBZp`9OM?.[R:*KAjC0z,J<S1 bo:+8wLP%M^uNy&ztqga=U< ^&y:Bw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
