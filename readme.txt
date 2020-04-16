=== Genesis Portfolio Pro ===
Contributors: nathanrice, studiopress, wpmuguru, nick_thegeek, bgardner, marksabbath, modernnerd
Tags: genesis, portfolio, templates
Requires at least: 4.4
Tested up to: 5.4
Stable tag: 1.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Genesis Portfolio Pro adds all you need to allow for styled portfolios for any Genesis HTML5 theme.

== Description ==

Genesis Portfolio Pro will add a new "Portfolio" post type where you can add portfolio entries with images and galleries to show your off visual content.

The default template and styles will create a portfolio grid showing your featured images in a landscape format. These will link to a simple page where you can control the content including text, images, and even galleries.

To get started click "add new" under the new "Portfolio" menu item to add your first Portfolio entry. Simply add your images and content just like you already know how to do with posts and publish. Add a few more entries to build your portfolio archive and show off your work in an attractive grid.

== Installation ==

Download the latest version of the Genesis Portfolio plugin and upload as a new plugin within your WordPress dashboard or via FTP to the wp-content/plugins folder and then activate the plugin.

== Frequently Asked Questions ==

= What can I customize in the portfolio? =

Custom templates are supported using the WordPress template hierarchy and the portfolio image size can be overridden by adding `add_image_size( 'portfolio', 300, 200, TRUE );` to your theme functions.php file. There are many other tricks you can use with the Genesis actions and filters to customize anything in the plugin output.


== Changelog ==

= 1.2.2 =
* REST: Expose the Portfolio post type and Portfolio Type taxonomy to the REST API.
* Tooling: Generate language file with WP-CLI instead of Node.js.

= 1.2.1 =
* Conform to WordPress Development Standards for PHP

= 1.2.0 =
* New: Genesis Portfolio widget.
* New: You can now sort Portfolio archive items by menu order. Edit the menu order of each Portfolio item directly, or use a page ordering plugin.
* Enhanced: image markup on the Portfolio archive is improved with `alt` and `itemprop` attributes.

= 1.1 =
* Added Feature items per page in portfolio archive settings
* Fix layout setting for portfolio-type term

= 1.0.1 =
* Bug fix for search layout.

= 1.0 =
* Initial WordPress.org release.

== Upgrade Notice ==

= 1.1 =

Portfolio-Type term meta layout setting now working. If this was changed for a term it will take effect on upgrade. Users should check their portfolio-type archives to ensure the desired layout is displayed.

= 1.0 =
Plugin was added to the WordPress.org repo. Users should update to ensure they have the latest code.
