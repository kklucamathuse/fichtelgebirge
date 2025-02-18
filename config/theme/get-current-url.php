<?php
function wp_get_current_url() {
    return home_url( $_SERVER['REQUEST_URI'] );
}
