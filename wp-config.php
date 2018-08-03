<?php

define("WPLANG", "");

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
 //Added by WP-Cache Manager
define('DB_NAME', 'dfp_db');

/** MySQL database username */
define('DB_USER', 'pvuser');

/** MySQL database password */
define('DB_PASSWORD', 'pvpass');

/** MySQL hostname */
define('DB_HOST', 'localhost');//mysql51-026.wc1.dfw1.stabletransit.com

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
define('AUTH_KEY',         's21aaoZ-8S-Xc;=-:X4Wl8fm5eh|tu|hFM_et$i,Qk5H($IkiMU|?K@2Adeje &B');
define('SECURE_AUTH_KEY',  ']SDU+/;3Yd5%nxR^j(2{;8(/jpCmH-Z~DFYl^[o:4Bhr~4s&-qE+Q^z(=/(H?,i|');
define('LOGGED_IN_KEY',    '~_aUCRhV(>lbza=z2?J$(s&KAOkw4Y{BNY/2;:kN:@DIhf^qVS/;x^/6-u|3%*0^');
define('NONCE_KEY',        'y($.|lI+G}%ng*Ba[zC)lE![C5*@(oYf:_mjnOlzXh8/~IW3PQV^o.xapG^*(;|5');
define('AUTH_SALT',        'GR-95y+TLi55,fZ?xsPcN-0t)=N}|-3rgTy2Q(S|w1`~`EtpJ]%peb_D:,f;?KtG');
define('SECURE_AUTH_SALT', ':Zu-9J5/=S6ng;>{91D*lZjbXHgP&ZY1 _nV5dh))uL,q7%@H7?t>zf1iv1tRAIu');
define('LOGGED_IN_SALT',   '@cLsJ#&:21{5}!s`S&9a1AnTVqs+tx6(e. 4^kp|ocOo|9|%^^${UM-!f:3F=yt+');
define('NONCE_SALT',       '~3=EzY%evh*H&tOvl_{9]e0XjEU._i=F)-6i(<LFFr|9{%oDmbSbQIEXyal?o{aP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'Hgt_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');


ini_set('zlib.output_compression', 0);


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '128M');

// define('FORCE_SSL_ADMIN', true);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );
/* That's all, stop editing! Happy blogging. */