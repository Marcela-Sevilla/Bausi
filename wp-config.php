<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bausi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'HW+XlfgB_zR}sa]X7NwtK7>Hfd<C6TV Xixu/^=%W D((i{0Rjc4:9ed*bRoa(@{' );
define( 'SECURE_AUTH_KEY',  '#v)Bx-wc7|HU)M=WM.-SW0du86e94HET/*++SiMmV1!Gj);pdW<tsq<2CAFIh(t&' );
define( 'LOGGED_IN_KEY',    '^YF/osENy1G`{gK^ZcE,M,2/Y&GTC6|)=1`-ecfcF-iAZen>M=HIqHUqQpcWJF+>' );
define( 'NONCE_KEY',        '_n)ZtJ=6XLS=WgBc]Nj5?LP?-cR#v[gNkJc>.1]uCnVMR{&*I`7BROA48:)rr S_' );
define( 'AUTH_SALT',        'rWxZL,}BCSwmZp-Kavgs 6I!*9poNP)>F@Bx/mL3|Tw&2y$5wa<wq(+%IZ&l5S{5' );
define( 'SECURE_AUTH_SALT', ')6@CG:myJ3S0 o pa5{Ms4Es,DBuXl p=%ak]<EuWUV(>m}M ,$fV:X}azW#.E3M' );
define( 'LOGGED_IN_SALT',   '8+azMrNdYZo/AL7e1yl+QP_yB=.anAcb.~8cetNVMn,{pEMNn0P]qMVEK8#gn4*?' );
define( 'NONCE_SALT',       'l7.2gvmj03gA6t3(deH+D,O]skun-#c?Qyfs]x)*sQTrIiUo0YjLwSC$E4x@/=0[' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
