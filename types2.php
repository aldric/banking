<?php 
///// CUSTOM POST TYPES /////
function wpse_5308_post_type_link( $link, $post ) {
    if ( $post->post_type === 'fintech_page' ) {
        if ( $terms = get_the_terms( $post->ID, 'fintech_cat' ) )
            $link = str_replace( '%fintech_cat%', current( $terms )->slug, $link );
        else
            $link = str_replace( '/%fintech_cat%', '', $link );
    }

    return $link;
}

add_filter( 'post_type_link', 'wpse_5308_post_type_link', 10, 2 );


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_fintech_taxonomies',0 );
//add_action('admin_init', 'flush_rewrite_rules');

//create two taxonomies, genres and writers for the post type "book"
function create_fintech_taxonomies() {
// register the new post type
register_post_type( 'fintech_page', array( 
    'labels'                 => array(
        'name'               => __( 'Fintech' ),
        'singular_name'      => __( 'Fintech' ),
        'plural_name'        => __( 'Fintech' ),
        'all_items'          => __( 'Toutes les pages Fintech' ),
        'add_new'            => __( 'Nouvelle Page Fintech' ),
        'add_new_item'       => __( 'Nouvelle Page Fintech' ),
        'edit'               => __( 'Editer' ),
        'edit_item'          => __( 'Editer Fintech' ),
        'new_item'           => __( 'Nouvelle Fintech' ),
        'view'               => __( 'Voir Fintech' ),
        'view_item'          => __( 'Voir Fintech' ),
        'search_items'       => __( 'Chercher Fintech' ),
        'not_found'          => __( 'No Fintech found' ),
        'not_found_in_trash' => __( 'No Fintech found in trash' ),
        'parent'             => __( 'Fintech Parente' ),
    ),
    'description'           => __( 'C\'est ici que vous pouvez creer une nouvelle page Fintech.' ),
    'public'                => true,
    'show_ui'               => true,
    'capability_type'       => 'page',
    'publicly_queryable'    => true,
    'exclude_from_search'   => false,
    'menu_position'         => 27,
    'menu_icon'             => 'dashicons-carrot',
    'hierarchical'          => true,
    '_builtin'              => false, // It's a custom post type, not built in!
    'rewrite'               => array( 'slug' => 'fintech/%fintech_cat%', 'with_front' => true ),
    'query_var'             => true,
    'taxonomies'            => array('fintech'),
    'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes')
) );

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Fintech', 'taxonomy general name' ),
        'singular_name'     => _x( 'Fintech', 'taxonomy singular name' ),
        'search_items'      =>  __( 'Chercher dans Fintech' ),
        'all_items'         => __( 'Toutes les categories Fintech' ),
        'parent_item'       => __( 'Categorie Fintech Parente' ),
        'parent_item_colon' => __( 'Categorie Fintech Parente:' ),
        'edit_item'         => __( 'Editer' ), 
        'update_item'       => __( 'Mettre a jour' ),
        'add_new_item'      => __( 'Nouvelle Categorie Fintech' ),
        'new_item_name'     => __( 'Nouvelle Categorie Fintech' ),
        'menu_name'         => __( 'Categories Fintech' ),
    );  

    register_taxonomy( 'fintech_cat', array( 'fintech_page' ), array(
        'hierarchical'  => true,
        'labels'        => $labels,
        'show_ui'       => true,
        'query_var'     => true,
        //'rewrite'     => true,
        'rewrite'       => array( 'slug' => 'fintech', 'with_front' => true ),
    ) );

}
// function generate_taxonomy_rewrite_rules( $wp_rewrite ) {
    
//         $rules = array();
    
//         $post_types = get_post_types( array( 'name' => 'fintech_page', 'public' => true, '_builtin' => false ), 'objects' );
//         $taxonomies = get_taxonomies( array( 'name' => 'fintech_cat', 'public' => true, '_builtin' => false ), 'objects' );
    
//         foreach ( $post_types as $post_type ) {
//             $post_type_name = $post_type->name;
//             $post_type_slug = 'fintech';
    
//             foreach ( $taxonomies as $taxonomy ) {
//                 if ( $taxonomy->object_type[0] == $post_type_name ) {
//                     $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
//                     foreach ( $terms as $term ) {
//                         $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
//                         $rules[$post_type_slug . '/' . $term->slug . '/page/?([0-9]{1,})/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&paged=' . $wp_rewrite->preg_index( 1 );
//                     }
//                 }
//             }
//         }
    
//         $wp_rewrite->rules = $rules + $wp_rewrite->rules;
//         //var_dump($wp_rewrite->rules);
//         //PB : http://localhost:8080/topbanque/fintech/credit-renouvelable-ou-revolving/#qm-rewrites
//     }
    
//     add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');
?>