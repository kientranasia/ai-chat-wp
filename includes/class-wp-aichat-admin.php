<?php

class WP_AICHAT_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, WP_AICHAT_PLUGIN_URL . 'admin/css/wp-aichat-admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, WP_AICHAT_PLUGIN_URL . 'admin/js/wp-aichat-admin.js', array('jquery'), $this->version, false);
        wp_enqueue_media(); // Enqueue WordPress media scripts
    }

    public function add_plugin_admin_menu() {
        add_menu_page(
            'WP AI Chat Settings',
            'AI Chat',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page'),
            'dashicons-format-chat',
            30
        );
    }

    public function register_settings() {
        register_setting($this->plugin_name, 'wp_aichat_n8n_webhook_url');
        register_setting($this->plugin_name, 'wp_aichat_chat_title');
        register_setting($this->plugin_name, 'wp_aichat_welcome_message');
        register_setting($this->plugin_name, 'wp_aichat_theme_color');
        register_setting($this->plugin_name, 'wp_aichat_logo_url');
    }

    public function display_plugin_admin_page() {
        include_once WP_AICHAT_PLUGIN_DIR . 'admin/partials/wp-aichat-admin-display.php';
    }
} 