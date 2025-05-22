<?php
if (!defined('WPINC')) {
    die;
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <form method="post" action="options.php">
        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        ?>
        
        <div class="wp-aichat-admin-container">
            <div class="wp-aichat-admin-section">
                <h2>n8n Webhook Settings</h2>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wp_aichat_n8n_webhook_url">Webhook URL</label>
                        </th>
                        <td>
                            <input type="url" 
                                   id="wp_aichat_n8n_webhook_url" 
                                   name="wp_aichat_n8n_webhook_url" 
                                   value="<?php echo esc_attr(get_option('wp_aichat_n8n_webhook_url')); ?>" 
                                   class="regular-text"
                                   placeholder="https://your-n8n-instance.com/webhook/your-webhook-id">
                            <p class="description">Enter your n8n webhook URL here.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="wp-aichat-admin-section">
                <h2>Chat Widget Settings</h2>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wp_aichat_logo_url">Chat Logo</label>
                        </th>
                        <td>
                            <div class="wp-aichat-logo-preview" style="margin-bottom: 10px;">
                                <?php 
                                $logo_url = get_option('wp_aichat_logo_url');
                                if ($logo_url) {
                                    echo '<img src="' . esc_url($logo_url) . '" style="max-width: 100px; max-height: 100px;">';
                                }
                                ?>
                            </div>
                            <input type="hidden" 
                                   id="wp_aichat_logo_url" 
                                   name="wp_aichat_logo_url" 
                                   value="<?php echo esc_attr($logo_url); ?>">
                            <button type="button" class="button" id="wp_aichat_upload_logo">Upload Logo</button>
                            <button type="button" class="button" id="wp_aichat_remove_logo" <?php echo empty($logo_url) ? 'style="display:none;"' : ''; ?>>Remove Logo</button>
                            <p class="description">Upload a logo to display in the chat widget header. Recommended size: 100x100 pixels.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wp_aichat_chat_title">Chat Title</label>
                        </th>
                        <td>
                            <input type="text" 
                                   id="wp_aichat_chat_title" 
                                   name="wp_aichat_chat_title" 
                                   value="<?php echo esc_attr(get_option('wp_aichat_chat_title', 'Chat with us')); ?>" 
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wp_aichat_welcome_message">Welcome Message</label>
                        </th>
                        <td>
                            <textarea id="wp_aichat_welcome_message" 
                                      name="wp_aichat_welcome_message" 
                                      rows="3" 
                                      class="large-text"><?php echo esc_textarea(get_option('wp_aichat_welcome_message', 'Hello! How can I help you today?')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wp_aichat_theme_color">Theme Color</label>
                        </th>
                        <td>
                            <input type="color" 
                                   id="wp_aichat_theme_color" 
                                   name="wp_aichat_theme_color" 
                                   value="<?php echo esc_attr(get_option('wp_aichat_theme_color', '#007bff')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php submit_button('Save Settings'); ?>
    </form>
</div> 