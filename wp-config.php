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
define( 'DB_NAME', 'security' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '_wX)?3C?,]C,~b/`SqLjZ4F^1b={x<8fWNR*>Te:8QE}~D:DNjt:}:AC`xO9nhR8' );
define( 'SECURE_AUTH_KEY',  'S &){]Q%l}=.<|C;_(~=d/[+?^xLYaHIM=ZqI<8X]m!?( i5&Y,B8j7)UR.1SmXq' );
define( 'LOGGED_IN_KEY',    'QIcNC$m-ReLYINi,[e*rFoi~e+NEj }H-Sn@](Q7MpQ}wV+z+zD:`rgei%EFSdDx' );
define( 'NONCE_KEY',        '(c$*mP?<P~X,x6o;-zL$gk1<dk]@ai@Gg@-fDG]tg+3]u>3;-/A8/bAxC#%]52zF' );
define( 'AUTH_SALT',        'EwKf^iNf9)oF0Rx@Wu_Te@NMv#<_ojH;Ok*4b>d7~3YKshK_U.A yDFH[f@%i<N;' );
define( 'SECURE_AUTH_SALT', 'l[IKXb?;tECaJJ8YUh. >ZAiAC/JQtmZn;_uA)!f~}{C0c?BOF6Fmih 1|[a$|RO' );
define( 'LOGGED_IN_SALT',   '$n`lFkx8c+AkT6}a9jo@snGA-;h$]/|mz0U-U3*x>!{qZH5%[^@r|h`SqTI@1ZMi' );
define( 'NONCE_SALT',       'hxC}T|qOF:aLeKNrNLSrH-fKw.nF%YTrNGJbJaf4D]^kXz(2`(mxdojW# @rYYwH' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
