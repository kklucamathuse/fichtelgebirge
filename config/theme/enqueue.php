<?php
/** add actions + filter */
add_action('wp_enqueue_scripts', 'enqueue_scripts');
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

/** define functions */
$json = json_decode(file_get_contents(get_template_directory() . '/assets/build/mix-manifest.json'), true);
$url = set_url_scheme(WP_CONTENT_URL . '/themes/bergauf/assets/build');

function enqueue_scripts() {
    global $json, $url;

    // Deregister the built-in version of jQuery from WordPress
    wp_deregister_script('jquery');

    // Register and enqueue jQuery bundle
    wp_register_script('jquery', $url . '/jquery.bundle.js', array(), null, false);
    wp_enqueue_script('jquery');

    foreach ($json as $original => $hashed) {
        $item_url = $url . $hashed;
        $handle = basename($original, '.js');
        $ext = pathinfo($original, PATHINFO_EXTENSION);

        if ($ext === 'js' && $handle !== 'jquery.bundle') {
            // JS
            wp_enqueue_script($handle, $item_url, array('jquery'), null, false);
        } elseif ($ext === 'css') {
            // CSS
            $handle = basename($original, '.css');
            wp_enqueue_style($handle, $item_url, false, null, 'all');
        }
    }
}

function add_defer_attribute($tag, $handle) {
    global $json;

    // Füge hier den `defer`-Tag für jQuery hinzu
    if ($handle === 'jquery') {
        return str_replace(' src', ' defer="defer" src', $tag);
    }

    // Füge den `defer`-Tag für andere JavaScript-Dateien hinzu
    foreach ($json as $original => $hashed) {
        $ext = pathinfo($original, PATHINFO_EXTENSION);

        if ($ext === 'js') {
            $script_handle = basename($original, '.js');

            if ($script_handle === $handle) {
                return str_replace(' src', ' defer="defer" src', $tag);
            }
        }
    }

    return $tag;
}
