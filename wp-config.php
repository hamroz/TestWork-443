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
define( 'DB_NAME', 'TestWork443' );

/** Database username */
define( 'DB_USER', '' );

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
define( 'AUTH_KEY',         'a&_peN.d9F]CIeMb0Ur].7eZh?8V!71fREPE<JoK]m1 2V{`21%bY9Jb~7,TaJ$`' );
define( 'SECURE_AUTH_KEY',  ';Cs70.oIM)rN:5nceM:tx)sxf9ZVAnH@[vfzjx}-po2*(+klQB0KT,*N>Vu@ISIT' );
define( 'LOGGED_IN_KEY',    '4K`A/xFAtL(Uzu:)Sq+F~(7m~v,OQ%1=5|_+>jNseosO.m?s%< DvW<X}awQKK^5' );
define( 'NONCE_KEY',        'V%<diK-k0%h0f}jK-V]|6]:Or_t%;TP*gZP]B&(@l[*mKg3D?3iPh=C<C3BNpbU1' );
define( 'AUTH_SALT',        'KgXo+e; F5ELYXncQt9:?9Jq:-Lfwzw>0TR4)}]h8KWZcn)u)ZG>{+f] @L~q?<-' );
define( 'SECURE_AUTH_SALT', 'v&fHf+7D^%X5/kclMPUr(*0m$S;Z=%E%-g17r<:Rr$A2P^%p~j!QuUq6x(XzM.v&' );
define( 'LOGGED_IN_SALT',   'xttnRCk-A6svx#{A&1v=[UiFw5b%4p| O!+(;8O2;UFp9_vUBt]Fx?.pt De@4JI' );
define( 'NONCE_SALT',       'MkJ=tFZ`!4P|#3c_g@*$?3@`E8/!-xyd@F%/9x_<5?<a%i(=Kis> -6n~KU7|Seo' );

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
