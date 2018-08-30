<?php

defined( 'ABSPATH' ) || exit;

function cptui_register_my_cpts_recipe() {

	/**
	 * Post Type: Recipes.
	 */

	$labels = array(
		"name" => __( "Recipes", "twentyseventeen" ),
		"singular_name" => __( "Recipe", "twentyseventeen" ),
		"menu_name" => __( "Recipes", "twentyseventeen" ),
		"all_items" => __( "All Recipes", "twentyseventeen" ),
		"add_new_item" => __( "Add New Recipe", "twentyseventeen" ),
		"edit_item" => __( "Edit Recipe", "twentyseventeen" ),
		"new_item" => __( "New Recipe", "twentyseventeen" ),
		"view_item" => __( "View Recipe", "twentyseventeen" ),
		"view_items" => __( "View Recipes", "twentyseventeen" ),
		"search_items" => __( "Search Recipe", "twentyseventeen" ),
		"not_found" => __( "No Recipes Found", "twentyseventeen" ),
		"not_found_in_trash" => __( "No Recipes Found in Trash", "twentyseventeen" ),
		"parent_item_colon" => __( "Parent Recipe", "twentyseventeen" ),
		"archives" => __( "Recipe archives", "twentyseventeen" ),
		"insert_into_item" => __( "Insert into recipe", "twentyseventeen" ),
		"parent_item_colon" => __( "Parent Recipe", "twentyseventeen" ),
	);

	$args = array(
		"label" => __( "Recipes", "twentyseventeen" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "recipes",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "recipe", "with_front" => false ),
		"query_var" => true,
		"menu_icon" => "dashicons-book",
		"supports" => array( "title", "editor", "thumbnail" ),
		"taxonomies" => array( "category" ),
	);

	register_post_type( "recipe", $args );
}

add_action( 'init', 'cptui_register_my_cpts_recipe' );
