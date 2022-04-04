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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JEEkw2XmuxVA0nvJHVbeAbJmuuPqpkG7ffSE+4wMKYDB2Ydkw2N0sgwVh5a6/XtzoppBNujUD/MKBAO+cCXiUw==');
define('SECURE_AUTH_KEY',  'CzvrFYZHfpz8+yVaHRYRaoy1OyeGLFcZDLhVM4ME0j77DXhO3GB5iuGIAYzIRMmBxCJF5Tv7yo1wHoACpQeeWw==');
define('LOGGED_IN_KEY',    'E32gdKs+D0WGgnRABWzCGKcW94QYdBZf+MWWeSRFp5oYZBq/5O/ZR4FJGsTKwPKx7zJaDFY7oPiv+GiWls1Y3w==');
define('NONCE_KEY',        'LiZJzvc+sEoOL3TCmr/nA2S6ef7namCsph0zf5zfPU+tFnWY7xpboeGroTsv/lpSBYaezxQY0niYM82E9+RkXQ==');
define('AUTH_SALT',        'jSSJ/BXE6Gc64n0SxMNlDgxYezRSWvOcEcyPkArwpXbPGn6QRXVOIjwK3nT69WFf8+fyCUoO4PT5OBYBb3fnhg==');
define('SECURE_AUTH_SALT', 'RKfcjssNWGZEYHdXkGdJXwMBvN2KKkX7SiEf63lOQVV1SqF6UJUmRccpv0O3plZt24Jl8tVYZVlNTNQA3HABMA==');
define('LOGGED_IN_SALT',   'WQs/awfOP8nopayOQ1yEufiincJ5VApYexYBE9pySHC1gGGsGOcHdJU++NBSm0fpd9vKreKapJEEmC8p9KCEqg==');
define('NONCE_SALT',       '3GIZSubHBBZkfQ6urYUX5GWhTPmx/oZl5U0gS9hKaNEeXKjroxFSbESJW9Ao/xhkpn6QLxEDLNabSi6UKMETFA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
