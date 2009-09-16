<?php
/*
Plugin Name: Sub Title Plus
Plugin URI: http://www.spunkyjones.com/
Description: A WordPress SEO plugin which lets you assign a Sub Title to posts and pages to boost optimization.
Version: 1.0
Author: Naif Amoodi
Author URI: http://www.naif.in
*/

define('STP_PLUGIN_URL', $_SERVER['PHP_SELF'] . '?page=' . plugin_basename(__FILE__));
define('STP_PLUGIN_PATH', get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__)) . '/');

function stp_options_page() {
	if($_GET['import'] == 1) if( stp_import_titles() ) echo '<div id="message" class="updated fade">WP Subtitle Import Successful!</div>';
	?>
	<div class="wrap">
		<h2>CSS Formatting</h2>
		<form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">CSS Margin</th>
					<td><input type="text" name="stp_css_margin" value="<?php echo get_option('stp_css_margin'); ?>" /> [ex: 2px or 2px 3px 4px 5px (where top=2px right=3px bottom=4px left=5px)]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Padding</th>
					<td><input type="text" name="stp_css_padding" value="<?php echo get_option('stp_css_padding'); ?>" /> [ex: 2px or 2px 3px 4px 5px (where top=2px right=3px bottom=4px left=5px)]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Width</th>
					<td><input type="text" name="stp_css_width" value="<?php echo get_option('stp_css_width'); ?>" /> [ex: 75% or 600px]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Background Color</th>
					<td><input type="text" name="stp_css_bg_color" value="<?php echo get_option('stp_css_bg_color'); ?>" /> [ex: blue or #0000ff]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Border Color</th>
					<td><input type="text" name="stp_css_border_color" value="<?php echo get_option('stp_css_border_color'); ?>" /> [ex: blue or #0000ff]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Border Style</th>
					<td>
						<select name="stp_css_border_style">
							<option<?php if( !get_option('stp_css_border_style') || get_option('stp_css_border_style') == 'none' ) echo ' selected="selected"'; ?>>none</option>
							<option<?php if( get_option('stp_css_border_style') == 'solid' ) echo ' selected="selected"'; ?>>solid</option>
							<option<?php if( get_option('stp_css_border_style') == 'dashed' ) echo ' selected="selected"'; ?>>dashed</option>
							<option<?php if( get_option('stp_css_border_style') == 'dotted' ) echo ' selected="selected"'; ?>>dotted</option>
							<option<?php if( get_option('stp_css_border_style') == 'double' ) echo ' selected="selected"'; ?>>double</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Border Width</th>
					<td><input type="text" name="stp_css_border_width" value="<?php echo get_option('stp_css_border_width'); ?>" /> [ex: 1px]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Font Size</th>
					<td><input type="text" name="stp_css_font_size" value="<?php echo get_option('stp_css_font_size'); ?>" /> [ex: 12px, 10pt or 1em]</td>
				</tr>
				<tr valign="top">
					<th scope="row">CSS Font Color</th>
					<td><input type="text" name="stp_css_font_color" value="<?php echo get_option('stp_css_font_color'); ?>" /> [ex: blue or #0000ff]</td>
				</tr>
			</table>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="stp_css_margin, stp_css_padding, stp_css_width, stp_css_bg_color, stp_css_border_color, stp_css_border_style, stp_css_border_width, stp_css_font_size, stp_css_font_color" />
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
		</form>
		<hr color="#999" size="1" />
		<h2>Import</h2>
		<p class="submit">Click here to import titles from the WP Subtitle plugin: <a href="<?php echo STP_PLUGIN_URL; ?>&import=1" class="button">Import</a></p>
	</div>
	<?php
}

function stp_import_titles() {
	$posts = get_posts('numberposts=-1&post_type=any&post_status=');
	foreach($posts as $post) {
		if($post->post_type == 'post' || $post->post_type == 'page') {
			$wp_subtitle = get_post_meta($post->ID, 'wps_subtitle', true);
			$current_title = get_post_meta($post->ID, 'stp_title', true);
			if( !empty($wp_subtitle) && empty( $current_title ) ) {
				update_post_meta($post->ID, 'stp_title', $wp_subtitle);
				$success = true;
			}
		}
	}
	if($success == true) return true;
	else return false;
}

function stp_sub_title($tag = 'div') {
	$sub_title = stp_get_sub_title();
	if($sub_title) {
		if( $margin = get_option('stp_css_margin') ) $style .= "margin: $margin;";

		if( $padding = get_option('stp_css_padding') ) $style .= "padding: $padding;";

		if( $width = get_option('stp_css_width') ) $style .= "width: $width;";

		if( $bgcolor = get_option('stp_css_bg_color') ) $style .= "background-color: $bgcolor;";

		if( get_option('stp_css_border_style') && get_option('stp_css_border_style') != 'none' ) {
			$border_style = get_option('stp_css_border_style');
			$style .= "border-style: " . strtolower($border_style) . ";";

			if($border_width = get_option('stp_css_border_width')) $style .= "border-width: $border_width;";
			else $style .= "border-width: 1px;";

			if( $border_color = get_option('stp_css_border_color') ) $style .= "border-color: $border_color;";
		}

		if( $font_size = get_option('stp_css_font_size') ) $style .= "font-size: $font_size;";
		
		if( $font_color = get_option('stp_css_font_color') ) $style .= "color: $font_color;";

		$output = '<' . $tag . ' id="sub-title"';
		if($style) $output .= ' style="' . $style . '"';
		$output .= '>';
		$output .= $sub_title;
		$output .= "</$tag>";
		
		echo $output;
	}
}

function stp_get_sub_title() {
	global $post;
	return get_post_meta($post->ID, 'stp_title', true);
}

function stp_meta_box() {
	global $post;
	wp_nonce_field('stp', 'stp_nonce');
	?>
	<input type="text" name="stp_title" id="stp-title" value="<?php echo htmlspecialchars(get_post_meta($post->ID, 'stp_title', true)); ?>" />
	<?php
}

function stp_save_post($post_id) {
	if (wp_verify_nonce($_POST['stp_nonce'], 'stp')) {
		$stp_title = trim($_POST['stp_title']);
		if( !empty($stp_title) ) {
			update_post_meta($post_id, 'stp_title', $stp_title);
		}
		else {
			if(get_post_meta($post_id, 'stp_title', true)) delete_post_meta($post_id, 'stp_title');
		}
	}
}

function stp_admin_menu() {
	add_meta_box('sub-title-plus', 'Sub Title Plus', 'stp_meta_box', 'post', 'normal', 'high');
	add_meta_box('sub-title-plus', 'Sub Title Plus', 'stp_meta_box', 'page', 'normal', 'high');
	add_options_page('Sub Title Plus', 'Sub Title Plus', 8, __FILE__, 'stp_options_page');
}

function stp_admin_print_styles() {
	wp_enqueue_style('admin', STP_PLUGIN_PATH . 'css/admin.css');
}

if( is_admin() ) {
	add_action('admin_menu', 'stp_admin_menu');
	add_action('save_post', 'stp_save_post');
	add_action('admin_print_styles', 'stp_admin_print_styles');
}
?>