<?php


defined( 'ABSPATH' ) || exit;

// Get ACF ingredients repeater field key
function get_recipe_ingredients_field_key() {

    $key = 'field_5b883f2ed2214';
    return $key;

}

// Callback to get recipe ingredients
function recipe_ingredients_get_callback( $data ) {

    $field_key = get_recipe_ingredients_field_key();

    $ingredients_field = get_field( $field_key, $data->id );
    $ingredients = array();

    if ( $ingredients_field && isset( $ingredients_field['ingredients_row'] ) ) {
        foreach ( $ingredients_field['ingredients_row'] as $key => $ingredient ) {
            $ingredients[$key] = $ingredient['name'];
        }
    }

    return $ingredients;
}

// Callback to get update ingredients
function recipe_ingredients_update_callback( $ingredient, $recipe_obj ) {

    $field_key = get_recipe_ingredients_field_key();

    $ret = update_sub_field( $field_key, $ingredient, $recipe_obj->ID );

    if ( false === $ret ) {
        return new WP_Error(
          'rest_recipe_ingredient_failed',
          __( "Failed to update recipe's ingredient." ),
          array( 'status' => 500 )
        );
    }

    return true;
}

// Get Recipe categories in a nicer and more useful array to overwrite default one
function recipe_nicer_categories_get_callback( $data ) {

    $tax = 'category';
    $all_terms = get_the_terms( $data->id, $tax );
    $terms = array();

    //Parse the terms and store to final terms array
    foreach ( $all_terms as $term ) :

        $id = $term->term_id;
        $name = $term->name;

        $terms[ $id ] = $name;

    endforeach;

    return $terms;

}

// Read and write extra recipes in recipes response
add_action( 'rest_api_init', 'recipe_endpoints' );
function recipe_endpoints() {

    register_rest_field( 'recipe', 'ingredients', array(

        'get_callback' => 'recipe_ingredients_get_callback',
        // 'update_callback' => 'recipe_ingredients_update_callback', // commented out - uncertain if callback is coded well due to limited time for the test
        'schema' => array(
            'description' => __( 'Recipe ingredient.' ),
            'type'        => 'array'
        ),
        
    ) );

    register_rest_field( 'recipe', 'categories', array(

        'get_callback' => 'recipe_nicer_categories_get_callback',
        'schema' => array(
            'description' => __( 'Recipe categories.' ),
            'type'        => 'array'
        ),
        
    ) );

}
