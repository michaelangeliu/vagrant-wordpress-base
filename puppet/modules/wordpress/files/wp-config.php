<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

if (isset($_SERVER['RDS_HOSTNAME'])) { // if on server
    define('DB_NAME',               $_SERVER['RDS_DB_NAME']);
    define('DB_USER',               $_SERVER['RDS_USERNAME']);
    define('DB_PASSWORD',           $_SERVER['RDS_PASSWORD']);
    define('DB_HOST',               $_SERVER['RDS_HOSTNAME']);
    define('AWS_ACCESS_KEY_ID',     $_ENV['AWS_ACCESS_KEY_ID']);
    define('AWS_SECRET_ACCESS_KEY', $_ENV['AWS_SECRET_KEY']);
} else if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) { // if a aws db specified
    include( dirname( __FILE__ ) . '/local-config.php' );
} else {
    define('WP_HOME','http://localhost:8080');
    define('WP_SITEURL','http://localhost:8080');

    // ** MySQL settings - You can get this info from your web host ** //
    /** The name of the database for WordPress */
    define('DB_NAME', 'wordpress');

    /** MySQL database username */
    define('DB_USER', 'wordpress');

    /** MySQL database password */
    define('DB_PASSWORD', 'wordpress');

    /** MySQL hostname */
    define('DB_HOST', 'localhost');
}

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
define('AUTH_KEY',         'W0@R87>toYQAQ_B,DqV<{BLLl7L$;^ad/<{gY8ro&>S;15Q[DM/a15- q};yqT~$');
define('SECURE_AUTH_KEY',  'l6GK-ko;UR6]ktiR;p<P&$SkW:A1}Q!|-P=W|E`eXh?EH!$.-JZD;R;%K.u?y}wf');
define('LOGGED_IN_KEY',    'eu(J##$?SM|mVqK1%(E,0?Aa!AHODZ711#B_,.euq`{GaI4=QZ+a3XH*;Qf0$p?0');
define('NONCE_KEY',        '`8=+8V+Fko,.(-4lC)?vA<8mBnFC])ff+};&YpKTifVU3.9JZOxj_|=&R$8MoJ-7');
define('AUTH_SALT',        '`SH0>d V@|H(%7ctPMxNo7k_ovSuFe1GWxigl~N!Rg/EvO$+Ho{fW`oYm4IuSKJ!');
define('SECURE_AUTH_SALT', '*-Q/T-=}$yh#>#6d ;5X7Dk>%aZT@Zr_X# zKXud-sb!6))*Rs{6a1g-WZ8Q<ZMU');
define('LOGGED_IN_SALT',   '-0n:^ln`EA7j:uJkJ@wkm)rh~X h]QH+V@i|w@}epy2n #fuX,v_u9okx^)rL4]W');
define('NONCE_SALT',       'J`9neUZepVV~BrJIX[R.MyGnb&h|7/sMz+]055uATGo4a|W%{HSH#/EA|E|^7F#C');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
