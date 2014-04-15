<?php
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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'kenny');

/** MySQL database password */
define('DB_PASSWORD', '1234');

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
define('AUTH_KEY',         'O9(&HVVC66^02l?XIi~d)SQg]xYA w+(`gv;<+2]Le5DWmB,4i;B|A$@@^zQ|-Iv');
define('SECURE_AUTH_KEY',  ' t INHbjYf%V|sl>3bO`U+&9VmQa1X[DB$K`lubaaxa<|@N+|5LY4O8x*+S^%YN1');
define('LOGGED_IN_KEY',    '>Iw)Vis{`-+M16O5dSl9PiqJBf(}:+(Th2~YkHFB}-Q[Ow/QX-0xLk5GhX/**u;F');
define('NONCE_KEY',        '+CuEU#h9wD[Ni39y)++ :!cN<?i$CGVgCyNCoZH;{>L8(s+@1WU2xwh9W[m9HH;8');
define('AUTH_SALT',        'X1o*&B`Gr}.?S6u3nY<N@L,SzC|1q2Vc:ojYaNS)?|.[%81/fx`Pe2V$gA9Yyp-|');
define('SECURE_AUTH_SALT', 'M+~:?|~06*o+uGgtS|)#NkN9[s?f{lHXZl*u8HF#kBaE=$~,wc8QxR|j0MBg0]#0');
define('LOGGED_IN_SALT',   '$0&4oUZLwsS5,9?V@@vlB>1G(5|R!t&b1!ObT-|UiM*/JJ]idSU<2mO%+WP*+7/u');
define('NONCE_SALT',       'ST5/^9BI=sq^$9b`|:YL91UQtE7^<f.k](y]{;^-?VK;qVf+| dj8R9<7WMQ+Y-F');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

