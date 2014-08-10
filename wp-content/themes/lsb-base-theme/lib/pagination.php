<?php
/**
 * Bootstrap Pagination.
 *
 * Echos Bootstraped paginated links (http://getbootstrap.com/components/#pagination).
 *
 * @since 0.0.1
 *
 * @param array $args {
 *     An array of arguments. Optional.
 *     @type bool 'echo'           If true, pagination is echoed. Otherwise is is returned.
 *                                 Default true. Accepts true|false.
 *     @type WP_Query 'query'      Allows you to specify a custom query to paginate (avoids the dreaded query_posts()).
 *                                 Default $GLOBALS['wp_query']. Accepts WP_Query object.
 *     @type bool 'show_all'       If set to True, then it will show all of the pages instead of a short list of the pages near the current page.
 *                                 Default false. Accepts true|false.
 *     @type bool 'prev_next'      Wheter to include the previous and next links in the list or not.
 *                                 Default true. Accepts true|false.
 *     @type string 'prev_text'    The previous page text which is only shown to screenreaders. Works only if 'prev_next' argument is set to true.
 *                                 Default ''. Accepts string.
 *     @type string 'next_text'    The next page text which is only shown to screenreaders. Works only if 'prev_next' argument is set to true.
 *                                 Default ''. Accepts string.
 * }
 * @return string Bootstrapped HTML for pagination list if 'echo' is set to false.
 * @return void Value is echoed if 'echo' is set to true.
 */

function roots_pagination( $args = array() ) {
	$defaults = array(
		'echo' => true,
		'query' => $GLOBALS['wp_query'],
		'show_all' => false,
		'prev_next' => true,
		'prev_text' => __('Previous Page', 'roots'),
		'next_text' => __('Next Page', 'roots'),
	);

	$args = wp_parse_args( $args, $defaults );
	extract($args, EXTR_SKIP);

	// Stop execution if there's only 1 page
	if( $query->max_num_pages <= 1 ) {
		return;
	}

	$pagination = '';
	$links = array();

	$paged = max( 1, absint( $query->get( 'paged' ) ) );
	$max   = intval( $query->max_num_pages );

	if ( $show_all ) {
		$links = range(1, $max);
	} else {
		// Add the pages before the current page to the array
		if ( $paged >= 2 + 1 ) {
			$links[] = $paged - 2;
			$links[] = $paged - 1;
		}

		// Add current page to the array
		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		// Add the pages after the current page to the array
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 1;
			$links[] = $paged + 2;
		}
	}

	$pagination .= "\n" . '<ul class="pagination">' . "\n";

	// Previous Post Link
	if ( $prev_next && get_previous_posts_link() ) {
		$pagination .= sprintf( '<li class="prev">%s</li>', get_previous_posts_link('&laquo;<span class="sr-only">' . $prev_text . '</span>') );
	}

	$pagination .= "\n";

	// Link to first page, plus ellipses if necessary
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		$pagination .= sprintf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		$pagination .= "\n";
		if ( ! in_array( 2, $links ) ) {
			$pagination .= '<li class="ellipsis"><span>' . __( '&hellip;' ) . '</span></li>';
		}
		$pagination .= "\n";
	}

	// Link to current page, plus $mid_size pages in either direction if necessary
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		$pagination .= sprintf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( $link ) ), $link );
		$pagination .= "\n";
	}

	// Link to last page, plus ellipses if necessary
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			$pagination .= '<li class="ellipsis"><span>' . __( '&hellip;' ) . '</span></li>';
			$pagination .= "\n";
		}

		$class = $paged == $max ? ' class="active"' : '';
		$pagination .= sprintf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		$pagination .= "\n";
	}

	// Next Post Link
	if ( $prev_next && get_next_posts_link() && $paged <= $max ) {
		$pagination .= sprintf( '<li class="next">%s</li>' . "\n", get_next_posts_link('<span class="sr-only">' . $next_text . '</span>&raquo;') );
	}

	$pagination .= "</ul><!-- /.pagination -->\n";

	if ( $echo ) {
		echo $pagination;
	} else {
		return $pagination;
	}

}
