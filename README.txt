=== WP AI Chat ===
Contributors: Kien Ventures
Tags: chat, chatbot, ai, n8n, webhook, customer support
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A modern AI Chatbot for WordPress with n8n webhook integration.

== Description ==

WP AI Chat is a modern and professional chat widget for WordPress that integrates with n8n webhooks. It provides a clean, user-friendly interface for your website visitors to interact with your AI chatbot.

= Features =

* Modern and professional chat interface
* n8n webhook integration
* Customizable chat title and welcome message
* Theme color customization
* Logo support
* Mobile responsive design
* Typing indicators
* Smooth animations

= Requirements =

* WordPress 5.0 or higher
* PHP 7.2 or higher
* n8n instance with webhook workflow

== Installation ==

1. Upload the `wp-aichat` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to 'AI Chat' in the WordPress admin menu
4. Configure your n8n webhook URL and other settings

== Frequently Asked Questions ==

= How do I set up the n8n webhook? =

1. Create a new workflow in n8n
2. Add a "Webhook" node
3. Configure it to receive POST requests
4. Add a "Function" node with this code:
```javascript
return {
  message: "Your response message here"
};
```
5. Add a "Respond to Webhook" node
6. Connect the nodes and activate the workflow
7. Copy the webhook URL to the plugin settings

= Can I customize the chat appearance? =

Yes, you can customize:
* Chat title
* Welcome message
* Theme color
* Logo

== Screenshots ==

1. Chat widget on website
2. Admin settings page
3. Mobile view

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release 