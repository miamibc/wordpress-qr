=== Wordpress QR ===
Contributors: miamibc
Donate link: http://www.blackcrystal.net/project/wordpress-qr/
Tags: qr, qrcode, qr code, code
Requires at least: 4.0
Tested up to: 4.6.1
Stable tag: 4.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin adds QR code to admin pages of pages, products and other custom post types

== Description ==

Plugin adds XML feed with products to your webshop (Woocommerce) with title, description,
image, categories, tags, regular/sale/wholesale prices and ability to configure wholesale discount.

= Features =
* Plugin is absolutely free and always will be, [donations](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8Y8DAJ3BVD6DU) very welcome.
* No advertises, clean and handy.
* Easy interface to manage feeds. You can add unlimited number of feeds with wholesale discount for each feed.
* No special requirements, working Wordpress with Woocommerce only.

= More =

* We made it, because all similar plugins are slow and buggy;
* We made it, because it's simple and we can do it;
* We made it, to show what we can - perfectly fase and useful piece of code;
* We made it, to learn something new - yeah, wordpress always makes me to learn something new;
* *«Show what you can. Learn what you don’t.» — [BlackCrystal](http://www.blackcrystalnet/), 1999.*

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/woocommerce-product-xml` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the **Settings** -> **Woocommerce Product XML** screen to configure the plugin
4. Type feed **name** and **discount**, click **Save**
5. Send link of new feed to your partner


== Frequently Asked Questions ==

= I don't see link to feed =

Both `name` and `discount` boxes must be filled, and `discount` must be number.

= I don't see some products in feed =

Only products with status `published`, with price and marked as `instock` will be added to feed.

= How to remove feed =

Clear `name` and `discount` boxes of feed you want to remove and click Save.


== Screenshots ==

1. Woocommerce Product XML settings page
2. Woocommerce Product XML generated XML example

== Upgrade Notice ==



== Changelog ==

= 1.0 =
* Initial version

= 1.1 =
* Added support of wholesale price from [WooCommerce Wholesale Prices](https://wholesalesuiteplugin.com)
