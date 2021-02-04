<?php

if ( ! class_exists('GradaStudio_MainMenu_Nav_Walker') ) {
	class GradaStudio_MainMenu_Nav_Walker extends Walker_Nav_Menu {

		private $mega_menu = false;

		// add classes to ul sub-menus
		public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		// add main/sub classes to li's and links
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$sub = "";
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
			if($depth==1 && $args->has_children) :
				$sub = 'sub';
			endif;

			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );


			$anchor = '';
			if($item->anchor != ""){
				$anchor = '#'.esc_attr($item->anchor);
				$class_names .= ' anchor-item';
			}


			$post_args = array(
				'post_type'   => 'nav_menu_item',
				'nopaging'    => true,
				'numberposts' => 1,
				'meta_key'    => '_menu_item_menu_item_parent',
				'meta_value'  => $item->ID,
			);

			$children = get_posts( $post_args );

			foreach ( $children as $child ) {
				$obj = get_post_meta( $child->ID, '_menu_item_object' );
				if ( $obj[0] === 'grada_mega_menu' ) {
					$class_names       .= apply_filters( 'grada_mega_menu_css_class', ' has-mega-menu', $item, $args, $depth );
					$this->mega_menu = true;
				}
			}

			// build html
			$output .= $indent . '<li id="grada-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $sub .'">';

			$current_a = "";
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ' href="'   . esc_url( $item->url        ) .$anchor.'"';
			if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
				$current_a .= 'current';
			endif;

			$link_class = [
				$current_a
			];

			if (get_field('menu_unclickable', $item)) {
				$link_class[] = 'disabled';
			}

			$attributes .= ' class="'. esc_attr(implode(' ', $link_class )).'"';
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'><span class="menu-item-text">';
			$item_output .= apply_filters('the_title', $item->title, $item->ID);
			$item_output .= '</span>';
			$item_output .= '</a>';

			// append arrow for dropdown
			if($args->has_children && $depth > 0 && $depth < 2 ){
				$item_output .= '<i class="sub-menu-arrow"></i>';
			}

			$item_output .= $args->after;

			if ( 'grada_mega_menu' === $item->object ) {
				$mega_menu_content_class = apply_filters( 'grada_mega_menu_content_css_class', 'mega-menu-content', $item, $args, $depth );

				$output .= '<div class="' . esc_attr( $mega_menu_content_class ) . '">' . do_shortcode( '[elementor-template id="' . $item->object_id . '"]' ) . '</div>';
			} else {
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$class = 'sub-menu children';

			if ( $this->mega_menu ) {
				$class .= ' mega-menu';
			} else {
				$class .= ' simple-menu';
			}

			$indent = str_repeat( "\t", $depth );
			$output .= $indent . '<ul class="' . $class . '">';
		}

	}
}