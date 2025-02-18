<?php
    /** add actions + filter */
    add_filter( 'upload_mimes', 'kb_svg' );
    add_filter( 'wp_check_filetype_and_ext', 'kb_ignore_upload_ext', 10, 4 );

    /** define functions */
    function kb_svg( $svg_mime ) {
        $svg_mime['svg'] = 'image/svg+xml';
        return $svg_mime;
    }

    function kb_ignore_upload_ext( $checked, $file, $filename, $mimes ) {
        if ( ! $checked['type'] ) {
            $wp_filetype     = wp_check_filetype( $filename, $mimes );
            $ext             = $wp_filetype['ext'];
            $type            = $wp_filetype['type'];
            $proper_filename = $filename;

            if ( $type && 0 === strpos( $type, 'image/' ) && $ext !== 'svg' ) {
                $ext = $type = false;
            }

            $checked = compact( 'ext', 'type', 'proper_filename' );
        }
        return $checked;
    }