<?php

/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme('storefront');
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if (class_exists('Jetpack')) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if (storefront_is_woocommerce_activated()) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if (is_admin()) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if (version_compare(get_bloginfo('version'), '4.7.3', '>=') && (is_admin() || is_customize_preview())) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */


/**
 * 
 * 
 * 
 * CUSTOM CODE;
 * CUSTOM CODE;
 * CUSTOM CODE;
 * 
 * 
 * 
 */


// Show post date creation
add_action("woocommerce_product_options_general_product_data", 'dateCreated');
function dateCreated()
{
?>
	<div class="form-field" style="display: flex; align-items: center; margin-top: 10px;">
		<strong style="margin: 10px">Date Created:</strong>
		<?php echo get_the_date(); ?>
	</div>
<?php
}


// Custom text and select field
add_action('woocommerce_product_options_general_product_data', 'add_select_custom_fields');
function add_select_custom_fields()
{
	echo '<div class="options_group">';

	// Text field.
	woocommerce_wp_text_input([
		'id' => '_text_field',
		'label' => 'Custom field',
	]);

	// Select option.
	woocommerce_wp_select(
		[
			'id'      => '_select',
			'label'   => 'Dropdown menu',
			'options' => [
				''   => __('', 'woocommerce'),
				'Rare'   => __('Rare', 'woocommerce'),
				'Frequent'   => __('Frequent', 'woocommerce'),
				'Unusual' => __('Unusual', 'woocommerce'),
			],
		]
	);
	echo '</div>';
}


// Thumbnail
set_post_thumbnail_size(50, 50);
add_action('woocommerce_product_options_general_product_data', 'removeImg');
function removeImg()
{
	global $product, $post_id;
?>
	<div class="form-field" style="display: flex; align-items: center; margin-top: 10px;">
		<strong style="margin: 10px">Thumbnail:</strong>
		<?php the_post_thumbnail(); ?>
	</div>
<?php
}


// Custom JS to update the fields
add_action('woocommerce_product_options_general_product_data', 'updateAlternative');
function updateAlternative()
{
?>
	<div class="form-field" style="display: flex; align-items: center; margin-top: 10px;">
		<strong style="margin: 10px">Custom JS Update Button:</strong>
		<button type="submit" onclick="updateButton()">Submit/Update</button>

		<script>
			function updateButtons() {
				<?php add_action("woocommerce_process_product_meta", '') ?>
			}
		</script>

	</div>
<?php
}


// Clean custom fields value
add_action("woocommerce_product_options_general_product_data", 'cleanForms');
function cleanForms()
{
?>
	<div class="form-field" style="display: flex; align-items: center; margin-top: 10px;">
		<strong style="margin: 10px">Custom JS Clean Button:</strong>
		<button type="button" onclick="cleanCustomForms()">Clean</button>

		<script>
			function cleanCustomForms() {
				document.getElementById('_text_field').value = '';
				document.getElementById('_select').value = '';
			}
		</script>

	</div>
	<?php
}


// Saving the custom field in the database
add_action('woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10);
function art_woo_custom_fields_save($post_id)
{
	// Calling the class object
	$product = wc_get_product($post_id);

	// Saving the custom text field
	$text_field = isset($_POST['_text_field']) ? sanitize_text_field($_POST['_text_field']) : '';
	$product->update_meta_data('_text_field', $text_field);

	// Saving select custom field
	$select_field = isset($_POST['_select']) ? sanitize_text_field($_POST['_select']) : '';
	$product->update_meta_data('_select', $select_field);

	// Saving all above
	$product->save();
};


// Displaying custom fields in front end
add_action('woocommerce_before_add_to_cart_form', 'art_get_text_field_before_add_card');
function art_get_text_field_before_add_card()
{

	// Calling product's object
	$product = wc_get_product();

	// Storing fields values in variables
	$text_field = $product->get_meta('_text_field', true);
	$select_field = $product->get_meta('_select', true);

	// Displaying
	if ($text_field) :
	?>
		<div class="textarea-field">
			<strong>Custom Text Field: </strong>
			<?php echo $text_field; ?>
		</div>
		<php if ($select_field) : ?>
			<div class="textarea-field">
				<strong>Selected Option: </strong>
				<?php echo $select_field; ?>
			</div>
	<?php
	endif;
}


// Creating and displaying custom column with type 'date' published column (in all products page)
add_filter('manage_edit-product_columns', 'misha_date_column_after_name');
function misha_date_column_after_name($product_columns)
{
	return array(
		'cb' => '<input type="checkbox" />', // checkbox for bulk actions
		'thumb' => '<span class="wc-image tips" data-tip="Image">Image</span>',
		'name' => 'Name',
		'date' => '<span class="wc-type parent-tips" data-tip="Date">Custom Date</span>',
		'is_in_stock' => 'Stock',
		'featured' => '<span class="wc-featured parent-tips" data-tip="Featured">Featured</span>',
		'price' => 'Price',
		'product_cat' => 'Categories',
		'sku' => 'SKU',
		'product_tag' => 'Tags',
	);
}


// Removing sidebar (just for design reasons)
function remove_storefront_sidebar()
{
	remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
	add_filter('body_class', function ($classes) {
		return array_merge($classes, array('page-template-template-fullwidth page-template-template-fullwidth-php '));
	});
}
add_action('get_header', 'remove_storefront_sidebar');
