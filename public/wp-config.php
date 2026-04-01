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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cpl2026' );

/** Database username */
define( 'DB_USER', 'cpl2026' );

/** Database password */
define( 'DB_PASSWORD', 'cpl2026cpl2026' );

/** Database hostname */
define( 'DB_HOST', 'mysql.atomicdesign.net' );

define( 'WP_HOME',    'https://second2026.dreamhosters.com' );
define( 'WP_SITEURL', 'https://second2026.dreamhosters.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'brPJ7{!<b--*5r-}0vQh{/4]eJ,QeNz5a2drnP;ufZqb-y,t:K]iD|8Aa1JAI}jt' );
define( 'SECURE_AUTH_KEY',   ',*-I/~ud.ncq>LkuU;: 1@[:;5|Ex?/5-(U(2U;UDYP@{@)rk$bd}2,fso|1.H4?' );
define( 'LOGGED_IN_KEY',     '(o.|G#;TeokP&i|NOBf({P;UXAWk-id;~3~HKYyQC{b<J2j?l7sbaD1=rlz|iuiL' );
define( 'NONCE_KEY',         '!`Son5Ae!l08nNe#H}zVE hW}GQ0P+0)]]ZdpPH~zZ-Js}#cVs~@h/GaxPhmWsqI' );
define( 'AUTH_SALT',         'H^8@%=F)}#yWsCPcxRj8Hd{;0,p_Za%Z)cZ(Viqf/E8nceo[+XZ/S@(OA2e>v]TP' );
define( 'SECURE_AUTH_SALT',  'nszwQYGnz +hli6SZ>L`?` *hhFhgB>v{%n5m)(~-yk@k^|~[+4J?dZu?|d<OE|K' );
define( 'LOGGED_IN_SALT',    '~FF.%9p,ftf[Vr61=FuL3#tv%RB/.wne:>9ZT}@|P~^ol}Y22Je/iPBtUB[Wi!ry' );
define( 'NONCE_SALT',        '{3YnjK)puCHHF^Y6m9UvvMG1@fok;w>9p1v%@,VWY@W09&Dq>$a}Z-WPMjDgX${s' );
define( 'WP_CACHE_KEY_SALT', ';NrJVGg;BGDo88>Rmi.RD4j[kJxPVc3/`!VbMqD^#F#w]-rJr)#`>5!78tn}$GG4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

// ACF Pro license key — replace YOUR_KEY_HERE with your actual key.
// This registers the license for this environment without needing an account login.
define( 'ACF_PRO_LICENSE', 'NWYxOTgwYzFhN2JiYmE2NTM2NDc5MjQ5NjI5MzE1NWE0N2VkMmYwYzE0ZmYwZGQ2YmJkMDBk' );

// Enable WP_DEBUG on local development only.
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'WP_POST_REVISIONS', TRUE);

if ( file_exists( __DIR__ . '/wp-config-ddev.php' ) ) {
	require_once __DIR__ . '/wp-config-ddev.php';
}



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
// WP_DEBUG is set above in the custom values section.

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
