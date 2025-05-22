<?php

class WP_AICHAT_Public {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, WP_AICHAT_PLUGIN_URL . 'public/css/wp-aichat-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, WP_AICHAT_PLUGIN_URL . 'public/js/wp-aichat-public.js', array('jquery'), $this->version, true);
        
        wp_localize_script($this->plugin_name, 'wp_aichat_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wp_aichat_nonce'),
            'welcome_message' => get_option('wp_aichat_welcome_message', 'Hello! How can I help you today?'),
            'theme_color' => get_option('wp_aichat_theme_color', '#007bff')
        ));
    }

    public function display_chat_widget() {
        include_once WP_AICHAT_PLUGIN_DIR . 'public/partials/wp-aichat-public-display.php';
    }

    public function handle_chat_message() {
        check_ajax_referer('wp_aichat_nonce', 'nonce');

        $message = sanitize_text_field($_POST['message']);
        $webhook_url = get_option('wp_aichat_n8n_webhook_url');

        if (empty($webhook_url)) {
            wp_send_json_error('Webhook URL not configured');
            return;
        }

        // Log the request
        error_log('WP AI Chat - Sending request to webhook: ' . $webhook_url);
        error_log('WP AI Chat - Message: ' . $message);

        $response = wp_remote_post($webhook_url, array(
            'body' => json_encode(array(
                'message' => $message,
                'timestamp' => current_time('mysql'),
                'user_ip' => $_SERVER['REMOTE_ADDR']
            )),
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30 // Increase timeout to 30 seconds
        ));

        if (is_wp_error($response)) {
            error_log('WP AI Chat - Error: ' . $response->get_error_message());
            wp_send_json_error('Failed to send message to n8n: ' . $response->get_error_message());
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $status = wp_remote_retrieve_response_code($response);
        
        // Log the response
        error_log('WP AI Chat - Response status: ' . $status);
        error_log('WP AI Chat - Response body: ' . $body);

        $data = json_decode($body, true);

        if (empty($data)) {
            error_log('WP AI Chat - Invalid response: Empty or invalid JSON');
            wp_send_json_error('Invalid response from n8n: Empty or invalid JSON');
            return;
        }

        // Check if the response has the expected format
        if (!isset($data['message'])) {
            error_log('WP AI Chat - Invalid response format: Missing message field');
            wp_send_json_error('Invalid response format from n8n: Missing message field');
            return;
        }

        wp_send_json_success($data);
    }
} 