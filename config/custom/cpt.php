<?php
/** add actions + filter */
add_action("init", "create_post_type");

/** define functions */
if (!function_exists("create_post_type")) {
    function create_post_type()
    {
        register_post_type("team", [
            "labels" => [
                "name" => __("Team"),
                "singular_name" => __("Team"),
                "add_new" => __("Neue Seite erstellen"),
            ],
            "public" => true,
            "supports" => ["title", "custom-fields"],
            //"taxonomies" => array( "category", "post_tag" ),
            "hierarchical" => true,
            "has_archive" => true,
            "show_in_rest" => true,
            "show_ui" => true,
            "rewrite" => ["slug" => __("team")],
        ]);
        register_post_type("beitrag", [
            "labels" => [
                "name" => __("Beitrag"),
                "singular_name" => __("Beitrag"),
                "add_new" => __("Neue Seite erstellen"),
            ],
            "public" => true,
            "supports" => ["title", "custom-fields"],
            //"taxonomies" => array( "category", "post_tag" ),
            "hierarchical" => true,
            "has_archive" => true,
            "show_in_rest" => true,
            "show_ui" => true,
            "rewrite" => ["slug" => __("beitrag")],
        ]);
    }
}

/**
 * noindex Posttype Projekte Kategorien
 */
// function noindex_for_nameofcpt() {
//     if ( is_singular( "name-of-cpt" ) ) {
//         echo "<meta name="robots" content="noindex, nofollow">";
//     }
// } add_action("wp_head", "noindex_for_nameofcpt");
