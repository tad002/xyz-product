<?php
/*
Plugin Name: XYZ Product
Description: This plugin is used to allow website administrators to populate the product slider with images and products.
Version: 1.0
Author: Troy Dildine
*/

add_action( 'init', 'add_xyz_product' );

function add_xyz_product() {
	register_post_type( 'xyz_products',
		array(
			'labels' => array(
				'name' => 'Products',
				'singular_name' => 'Product',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Product',
				'edit' => 'Edit',
				'edit_item' => 'Edit Product',
				'new_item' => 'New Product',
				'view' => 'View',
				'view_item' => 'View Product'
			),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'supports' => array( 'title', 'editor', 'thumbnail' )
		)
	);
}