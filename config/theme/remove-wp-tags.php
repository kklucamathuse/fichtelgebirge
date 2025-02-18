<?php
    /** add actions + filter */
    add_action( 'after_setup_theme', 'removeTags' );

    /** define function */
    function removeTags() {
        // Remove the REST API lines from the HTML Header
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );

        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );

        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		// Remove WP Generator
		remove_action('wp_head', 'wp_generator');
			
		// Remove RSD Link
		remove_action ('wp_head', 'rsd_link');
		remove_action( 'wp_head', 'wlwmanifest_link');
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_excerpt', 'wpautop' );
		
		// Remove WP Emoji
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');

		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Remove DNS Prefetech
		remove_action( 'wp_head', 'wp_resource_hints', 2 );

		// Remove Canonical from head
		remove_action('wp_head', 'rel_canonical');

		// Remove shortlink from head
        remove_action('wp_head', 'wp_shortlink_wp_head');

        // Remove Robots Text
        remove_action( 'wp_head', 'noindex', 1 );
    }