<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'wordpress_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'S,#CV/Q&ccNp:6ReQcl/$5l.(clQ|>*)?5y C&<:A_A}gTbDE0?xbI=B!cKp|gSL' );
define( 'SECURE_AUTH_KEY',  ' ;4)UlNo`yW$yb5$]`;ukIzka`0B*Xf~70a9K U(mNN>I;)wvB0x?O0kyQvC)qaO' );
define( 'LOGGED_IN_KEY',    '#%M}SCvlSR|?fPYsd4N:qF# @90U3p%CGeb{QAsNW%TKog0`X;YZ!{Nf=<MI99wU' );
define( 'NONCE_KEY',        'j2|c?WzWAeH%6WlX48{P}<b6SIf(Yfx|HE2Aw#e{Mh!AFLb[h]RTi41p79Kwe,,h' );
define( 'AUTH_SALT',        '[.g ^F)lMGZcR?R!TR#&(51gkS%2*kh7_fy^v%9DO^gd>/5io52GJyH~5?!Z3bt0' );
define( 'SECURE_AUTH_SALT', 'MA8`mNZ[(Uvcc0?iui8&*ed-`sGTJovKh!=3%rc7AAhshhHo0&;](`{>sA.<d$[$' );
define( 'LOGGED_IN_SALT',   '7 si+e3{W.q(N3!47cN3f2htY4$,7nH0iG7+//&?LIZJJ %zn?^,kZeU=-SUSfeF' );
define( 'NONCE_SALT',       '^7?t`jml]2z;?qg@Czz3+WOeQ`J_6hVQ%l(yQ,0h}kY%$Fzrz})Ndygo.@m)tm`3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
