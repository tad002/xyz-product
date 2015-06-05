<?php
/*
Plugin Name: XYZ Product
Description: This plugin is used to allow website administrators to populate the product slider with images and products.
Version: 1.0
Author: Troy Dildine
*/

add_action( 'init', 'add_xyz_product' );
add_action( 'admin_init', 'xyz_product_admin' );
add_action( 'save_post', 'add_xyz_product_details', 10, 2 );

function add_xyz_product() {
	register_post_type( 'xyz_product',
		array(
			'labels'       => array(
				'name'          => 'Products',
				'singular_name' => 'Product',
				'add_new'       => 'Add New',
				'add_new_item'  => 'Add New Product',
				'edit'          => 'Edit',
				'edit_item'     => 'Edit Product',
				'new_item'      => 'New Product',
				'view'          => 'View',
				'view_item'     => 'View Product'
			),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => true,
			'supports'     => array( 'title', 'editor', 'thumbnail' )
		)
	);
}

function xyz_product_admin() {
	add_meta_box( 'xyz_product_meta_box',
		'Product Details',
		'display_xyz_product_meta_box',
		'xyz_product',
		'normal',
		'high'
	);
	wp_register_style( 'xyz_product_style', plugins_url( 'style.css', __FILE__ ) );
	wp_enqueue_style( 'xyz_product_style' );
}

function display_xyz_product_meta_box( $xyz_product ) {
	$width  = esc_html( get_post_meta( $xyz_product->ID, 'width', true ) );
	$height = esc_html( get_post_meta( $xyz_product->ID, 'height', true ) );
	$weight = esc_html( get_post_meta( $xyz_product->ID, 'weight', true ) );
	?>
	<table>
		<tr>
			<td>Product Width</td>
			<td class="tabbed"><input type="text" size="80" name="xyz_product_width" value="<?php echo $width; ?>"/>
			</td>
		</tr>
		<tr>
			<td>Product Height</td>
			<td class="tabbed"><input type="text" size="80" name="xyz_product_height" value="<?php echo $height; ?>"/>
			</td>
		</tr>
		<tr>
			<td>Product Weight</td>
			<td class="tabbed"><input type="text" size="80" name="xyz_product_weight" value="<?php echo $weight; ?>"/>
			</td>
		</tr>
	</table>
<?php
}

function add_xyz_product_details( $xyz_product_id, $xyz_product ) {
	if ( $xyz_product->post_type == 'xyz_product' ) {
		if ( isset( $_POST['xyz_product_width'] ) && $_POST['xyz_product_width'] != '' ) {
			update_post_meta( $xyz_product_id, 'width', $_POST['xyz_product_width'] );
		}
		if ( isset( $_POST['xyz_product_height'] ) && $_POST['xyz_product_height'] != '' ) {
			update_post_meta( $xyz_product_id, 'height', $_POST['xyz_product_height'] );
		}
		if ( isset( $_POST['xyz_product_weight'] ) && $_POST['xyz_product_weight'] != '' ) {
			update_post_meta( $xyz_product_id, 'weight', $_POST['xyz_product_weight'] );
		}
	}
}