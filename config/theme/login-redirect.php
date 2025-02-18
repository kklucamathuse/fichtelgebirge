<?php
add_filter( 'login_url', 'custom_login_url', PHP_INT_MAX );
add_action('init', 'custom_redirect_to_custom_login');
add_filter( 'logout_url', 'custom_logout_url', 10, 2 );
add_action( 'wp_logout','custom_redirect_after_logout' );
add_action('init', 'redirect_wp_admin_to_404');

function custom_login_url( $login_url ) {
    $login_url = site_url( 'cupcake.php', 'login' );
    return $login_url;
}

function custom_redirect_to_custom_login() {
    $request_uri = $_SERVER['REQUEST_URI'];
    if ($request_uri === '/cupcake') {
        wp_redirect(home_url('/cupcake.php'));
        exit();
    }
}

function custom_logout_url( $logout_url, $redirect ) {
    $logout_url = home_url( '/cupcake.php?action=logout' );
    $logout_url = wp_nonce_url( $logout_url, 'log-out' );
    return $logout_url;
}


function custom_redirect_after_logout() {
    if ( ! is_admin() ) {
        wp_safe_redirect( home_url() );
        exit();
    }
}

function redirect_wp_admin_to_404() {
    $request_uri = $_SERVER['REQUEST_URI'];
    if (($request_uri === '/wp-admin/' || strpos($request_uri, '/wp-admin/') === 0 || $request_uri === '/admin' || strpos($request_uri, '/admin/') === 0 || $request_uri === '/login' || strpos($request_uri, '/login/') === 0 || $request_uri === '/wp-login' || strpos($request_uri, '/wp-login/') === 0 || strpos($request_uri, '/wp-login.php') === 0)  && !is_user_logged_in()) {
        wp_redirect(home_url('/404'));
        exit();
    }
}