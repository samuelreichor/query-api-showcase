<?php
/**
 * Shared bootstrap file
 */

// Define path constants
define('CRAFT_BASE_PATH', __DIR__);
define('CRAFT_VENDOR_PATH', CRAFT_BASE_PATH . '/vendor');

// Load Composer's autoloader
require_once CRAFT_VENDOR_PATH . '/autoload.php';

// Load dotenv?
if (class_exists(Dotenv\Dotenv::class)) {
    // By default, this will allow .env file values to override environment variables
    // with matching names. Use `createUnsafeImmutable` to disable this.
    Dotenv\Dotenv::createUnsafeMutable(CRAFT_BASE_PATH)->safeLoad();
}

// Craft only reads the license key from this constant or config/license.key,
// the CRAFT_LICENSE_KEY env var alone isn't enough.
if (!defined('CRAFT_LICENSE_KEY') && ($licenseKey = getenv('CRAFT_LICENSE_KEY'))) {
    define('CRAFT_LICENSE_KEY', $licenseKey);
}
