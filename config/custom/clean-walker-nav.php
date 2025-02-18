<?php

// Clean Nav Menu
class Clean_Walker_Nav extends Walker_Nav_Menu {

	public function __construct( $base = '' ) {
		if ( '' != $base ) {
			$this->css_base = $base;
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$real_depth = $depth + 1;

		$indent  = str_repeat( "\t", $real_depth );
		$classes = [
			"level-{$real_depth}",
		];
		$output  .= "\n" . $indent . '<ul>' . "\n";
	}

	// Add main/sub classes to li's and links

	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {

		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( '    ', $depth ) : '' );

		/**
		 * Item
		 */

        $item_classes = [];
        if ( $args->has_children ) {
            $item_classes['parent_class'] = "children";
        }
        if ( in_array( 'current-menu-item', $item->classes ) ) {
            $item_classes['active_page_class'] = "active open";
        }
        if ($depth != "0") {
            if ( in_array( 'current-menu-parent', $item->classes ) ) {
                $item_classes['active_parent_class'] = "active open";
            }
        }
        if ($depth == "0") {
            if ( in_array( 'current-menu-ancestor', $item->classes ) ) {
                $item_classes['active_ancestor_class'] = "active open";
            }
        }
        if ( '' !== $item->classes[0] ) {
            $item_classes['user_class'] = $item->classes[0];
        }
        
        // Attributes
        $item_attributes = [];
        if ( ! empty( $item_classes ) ) {
            $item_attributes['class'] = implode( ' ', $item_classes );
        }
        
        array_walk( $item_attributes, 'esc_attr' );
        
        // Markup
        $item_markup = $indent;
        $item_markup .= '<li';
        foreach ( $item_attributes as $att => $value ) {
            $item_markup .= " $att='$value'";
        }
        $item_markup .= '>';
        
        /**
         * Link
        */
        
        $link_attributes = [];

        // Attributes
        if ( ! empty( $item->attr_title ) ) {
            $link_attributes['title'] = $item->attr_title;
        }
        if ( ! empty( $item->target ) ) {
            $link_attributes['target'] = $item->target;
        }
        if ( ! empty( $item->xfn ) ) {
            $link_attributes['rel'] = $item->xfn;
        }
        if ( ! empty( $item->url ) ) {
            $link_attributes['href'] = $item->url;
        }

        // Check for current menu item
        if ( in_array( 'current-menu-item', $item->classes ) ) {
            $link_attributes['aria-current'] = 'page';
        }

        if ( ! empty( $link_classes ) ) {
            $link_attributes['class'] = implode( ' ', $link_classes );
        }

        array_walk( $link_attributes, 'esc_attr' );

        // Markup
        $link_markup = $args->before;
        $link_markup .= '<a';
        foreach ( $link_attributes as $att => $value ) {
            $link_markup .= " $att='$value'";
        }
        $link_markup .= '>';
        $link_markup .= $args->link_before;
        $link_markup .= apply_filters( 'the_title', $item->title, $item->ID );
        $link_markup .= $args->link_after;
        $link_markup .= '</a>';

        // edit submenu-toggler here
        if ( $args->has_children ) {
            $link_markup .= '<button class="sub-nav-toggler" data-toggle-sub-nav="level-' . ($depth + 1) . '"><span class="sub-nav-toggler-icon"></span></button>';
        }

        $item_markup .= $link_markup;

        $output .= $item_markup;

		/**
		 * create markup
		 */

        if ( $args->has_children && $depth >= 0 ) {
            $output .= "\n" . $indent . '<div class="level-' . ( $depth + 1 ) . '">';
        }
    }
}
