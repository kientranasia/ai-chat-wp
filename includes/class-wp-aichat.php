<?php

class WP_AICHAT {
    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->version = WP_AICHAT_VERSION;
        $this->plugin_name = 'wp-aichat';
        
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once WP_AICHAT_PLUGIN_DIR . 'includes/class-wp-aichat-loader.php';
        $this->loader = new WP_AICHAT_Loader();
    }

    private function define_admin_hooks() {
        $plugin_admin = new WP_AICHAT_Admin($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
        $this->loader->add_action('admin_init', $plugin_admin, 'register_settings');
    }

    private function define_public_hooks() {
        $plugin_public = new WP_AICHAT_Public($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_action('wp_footer', $plugin_public, 'display_chat_widget');
        $this->loader->add_action('wp_ajax_wp_aichat_send_message', $plugin_public, 'handle_chat_message');
        $this->loader->add_action('wp_ajax_nopriv_wp_aichat_send_message', $plugin_public, 'handle_chat_message');
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
} 