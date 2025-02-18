<?php
    if (defined('WP_DEBUG') && false === WP_DEBUG && !is_user_logged_in()) {
        ob_end_flush();
    }
