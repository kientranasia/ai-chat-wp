<?php
/**
 * Plugin Name: WP AI Chat
 * Plugin URI: https://wordpress.org/plugins/wp-aichat/
 * Description: A modern AI Chatbot for WordPress with n8n webhook integration
 * Version: 1.0.0
 * Author: Kien Ventures
 * Author URI: https://www.kien.vc
 * Text Domain: wp-aichat
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('WP_AICHAT_VERSION', '1.0.0');
define('WP_AICHAT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_AICHAT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_AICHAT_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Include required files
require_once WP_AICHAT_PLUGIN_DIR . 'includes/class-wp-aichat.php';
require_once WP_AICHAT_PLUGIN_DIR . 'includes/class-wp-aichat-admin.php';
require_once WP_AICHAT_PLUGIN_DIR . 'includes/class-wp-aichat-public.php';

// Initialize the plugin
function run_wp_aichat() {
    $plugin = new WP_AICHAT();
    $plugin->run();
}
run_wp_aichat();

// Activation hook
register_activation_hook(__FILE__, 'wp_aichat_activate');
function wp_aichat_activate() {
    // Add default options
    add_option('wp_aichat_chat_title', 'Chat with us');
    add_option('wp_aichat_welcome_message', 'Hello! How can I help you today?');
    add_option('wp_aichat_theme_color', '#007bff');
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'wp_aichat_deactivate');
function wp_aichat_deactivate() {
    // Clean up if needed
}

// Uninstall hook
register_uninstall_hook(__FILE__, 'wp_aichat_uninstall');
function wp_aichat_uninstall() {
    // Remove plugin options
    delete_option('wp_aichat_n8n_webhook_url');
    delete_option('wp_aichat_chat_title');
    delete_option('wp_aichat_welcome_message');
    delete_option('wp_aichat_theme_color');
    delete_option('wp_aichat_logo_url');
} 