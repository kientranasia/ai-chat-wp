(function($) {
    'use strict';

    // Set theme color CSS variable
    document.documentElement.style.setProperty('--wp-aichat-theme-color', wp_aichat_ajax.theme_color);
    document.documentElement.style.setProperty('--wp-aichat-theme-color-hover', adjustColor(wp_aichat_ajax.theme_color, -20));

    const widget = $('#wp-aichat-widget');
    const toggle = $('#wp-aichat-toggle');
    const minimize = $('.wp-aichat-minimize');
    const form = $('#wp-aichat-form');
    const input = $('#wp-aichat-input');
    const messages = $('.wp-aichat-messages');
    const body = $('.wp-aichat-body');

    // Toggle chat widget
    toggle.on('click', function() {
        widget.toggleClass('active');
        if (widget.hasClass('active')) {
            input.focus();
        }
    });

    // Minimize chat widget
    minimize.on('click', function() {
        widget.removeClass('active');
    });

    // Handle form submission
    form.on('submit', function(e) {
        e.preventDefault();
        const message = input.val().trim();
        
        if (!message) return;

        // Add user message
        addMessage(message, 'user');
        input.val('').focus();

        // Show typing indicator
        const typing = $('<div class="wp-aichat-typing"><span></span><span></span><span></span></div>');
        messages.append(typing);
        scrollToBottom();

        // Send message to server
        $.ajax({
            url: wp_aichat_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'wp_aichat_send_message',
                message: message,
                nonce: wp_aichat_ajax.nonce
            },
            success: function(response) {
                // Remove typing indicator
                typing.remove();

                if (response.success && response.data) {
                    // Add bot response
                    addMessage(response.data.message || 'Sorry, I could not process your request.', 'bot');
                } else {
                    // Show error message
                    const errorMsg = response.data ? response.data : 'Sorry, there was an error processing your message. Please try again.';
                    addMessage(errorMsg, 'bot');
                    console.error('Chat error:', response);
                }
            },
            error: function(xhr, status, error) {
                // Remove typing indicator
                typing.remove();
                
                // Show error message
                let errorMsg = 'Sorry, there was an error connecting to the server. Please try again.';
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.data) {
                        errorMsg = response.data;
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
                
                addMessage(errorMsg, 'bot');
                console.error('Chat error:', {xhr, status, error});
            }
        });
    });

    // Add message to chat
    function addMessage(text, type) {
        const message = $('<div class="wp-aichat-message wp-aichat-message-' + type + '"><div class="wp-aichat-message-content"></div></div>');
        message.find('.wp-aichat-message-content').text(text);
        messages.append(message);
        scrollToBottom();
    }

    // Scroll to bottom of chat
    function scrollToBottom() {
        body.scrollTop(body[0].scrollHeight);
    }

    // Helper function to adjust color brightness
    function adjustColor(color, amount) {
        return '#' + color.replace(/^#/, '').replace(/../g, color => ('0' + Math.min(255, Math.max(0, parseInt(color, 16) + amount)).toString(16)).substr(-2));
    }

})(jQuery); 