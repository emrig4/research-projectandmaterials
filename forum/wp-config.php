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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'projgqic_wpforum' );

/** MySQL database username */
define( 'DB_USER', 'projgqic_wpforum' );

/** MySQL database password */
define( 'DB_PASSWORD', '1)HwN(r8)[pS16' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0eo3g52gqilcuhnpv8vktxdcsjc5kn5qzd7i70gcm0e60pj0loh1vwxslgdgdvre' );
define( 'SECURE_AUTH_KEY',  'elzvmsvwkcdwcrtdtckhbupiuusd0s94cgqnco1a8jxhlcomkxobw5ro3e1d0n7n' );
define( 'LOGGED_IN_KEY',    'uzukg7dnuz1w4xe06nrkifgpmoauh9jqjsyyx5ekdkjr7uvysvp1saq5ji4lpunz' );
define( 'NONCE_KEY',        'rbmxwocbo4jeala3fkwfnx5zkw00sgr0ahy0cgcmm27mvkrriblkimyl1hanwmaw' );
define( 'AUTH_SALT',        '38ickkq0lj11hlssor0oo2rjx5uiransthxrmfagjvoxfagshoglwszqoqkjx66m' );
define( 'SECURE_AUTH_SALT', 'gtcbcuqjnuecylz9gvr4ffojfkhxbwa6jphg0tklerkpstfriejffqyczov8gd37' );
define( 'LOGGED_IN_SALT',   'hjqaobxodxamnnihoolfymwsvurcfsgy0sspm2lwl8lubbdnwn7pgdik83ta9nbo' );
define( 'NONCE_SALT',       'fwzze8zksehow5rftq8vdiuosw34dekxlftbhyb1sobt60kso0psljdxggxjrlac' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpforum_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
