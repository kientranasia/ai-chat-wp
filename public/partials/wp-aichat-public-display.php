<?php
if (!defined('WPINC')) {
    die;
}

$logo_url = get_option('wp_aichat_logo_url');
?>
<div id="wp-aichat-widget" class="wp-aichat-widget">
    <div class="wp-aichat-header">
        <?php if ($logo_url) : ?>
            <div class="wp-aichat-logo">
                <img src="<?php echo esc_url($logo_url); ?>" alt="Chat Logo">
            </div>
        <?php endif; ?>
        <div class="wp-aichat-title">
            <?php echo esc_html(get_option('wp_aichat_chat_title', 'Chat with us')); ?>
        </div>
        <button class="wp-aichat-minimize">−</button>
    </div>
    
    <div class="wp-aichat-body">
        <div class="wp-aichat-messages">
            <div class="wp-aichat-message wp-aichat-message-bot">
                <div class="wp-aichat-message-content">
                    <?php echo esc_html(get_option('wp_aichat_welcome_message', 'Hello! How can I help you today?')); ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wp-aichat-footer">
        <form id="wp-aichat-form" class="wp-aichat-form">
            <input type="text" 
                   id="wp-aichat-input" 
                   class="wp-aichat-input" 
                   placeholder="Type your message..." 
                   autocomplete="off">
            <button type="submit" class="wp-aichat-send">
                <svg viewBox="0 0 24 24" width="24" height="24">
                    <path fill="currentColor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                </svg>
            </button>
        </form>
    </div>
</div>

<button id="wp-aichat-toggle" class="wp-aichat-toggle">
    <svg viewBox="0 0 24 24" width="24" height="24">
        <path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"></path>
    </svg>
</button> 