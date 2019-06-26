<?php
/**
 * Front-end View: Portfolio widget.
 * Included via lib/classes/class-genesis-portfolio-widget.php.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;

// phpcs:ignore
echo $args['before_widget'];

if ( ! empty( $instance['title'] ) ) {
	// phpcs:ignore
	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
}

if ( ! empty( $instance['show_view_all'] ) && 'top' === $instance['view_all_position'] ) {
	printf(
		'<p class="view-all-portfolio"><a href="%1$s">%2$s</a></p>',
		esc_url( get_post_type_archive_link( 'portfolio' ) ),
		esc_html( $instance['view_all_text'] )
	);
}

$portfolio_query_args = array(
	'post_type' => 'portfolio',
	'showposts' => $instance['items_num'],
	'orderby'   => $instance['orderby'],
	'order'     => $instance['order'],
);

if ( ! empty( $instance['portfolio_type'] ) && $instance['portfolio_type'] > 0 ) {
	// phpcs:ignore
	$portfolio_query_args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio-type',
			'terms'    => $instance['portfolio_type'],
		),
	);
}

$portfolio_query = new WP_Query( $portfolio_query_args );

if ( $portfolio_query->have_posts() ) {

	while ( $portfolio_query->have_posts() ) {

		$portfolio_query->the_post();

		genesis_markup(
			array(
				'open'    => '<article %s>',
				'context' => 'entry',
				'params'  => array(
					'is_widget' => true,
				),
			)
		);

		$image = genesis_get_image(
			array(
				'format'  => 'html',
				'size'    => $instance['image_size'],
				'context' => 'featured-post-widget',
				'attr'    => genesis_parse_attr(
					'entry-image-widget',
					array(
						'alt' => get_the_title(),
					)
				),
			)
		);

		if ( $image && $instance['show_image'] ) {
			$state = empty( $instance['show_title'] ) ? '' : 'aria-hidden="true"';
			// phpcs:ignore
			printf( '<a href="%s" class="%s" %s>%s</a>', esc_url( get_permalink() ), esc_attr( $instance['image_alignment'] ), $state, wp_make_content_images_responsive( $image ) );
		}

		if ( $instance['show_title'] ) {

			$header = '';

			$terms = get_the_term_list( get_the_ID(), 'portfolio-type' );

			if ( $terms && ! empty( $instance['show_type'] ) ) {

				$header .= genesis_markup(
					array(
						'open'    => '<p %s>',
						'close'   => '</p>',
						'context' => 'entry-meta',
						'content' => genesis_strip_p_tags( do_shortcode( "[post_terms taxonomy='portfolio-type' before='']" ) ),
						'params'  => array(
							'is_widget' => true,
						),
						'echo'    => false,
					)
				);

			}

			if ( ! empty( $instance['show_title'] ) ) {

				$portfolio_title = get_the_title() ? get_the_title() : __( '(no title)', 'genesis-portfolio-pro' );

				$heading = genesis_a11y( 'headings' ) ? 'h4' : 'h2';

				$header .= genesis_markup(
					array(
						'open'    => "<{$heading} %s>",
						'close'   => "</{$heading}>",
						'context' => 'entry-title',
						'content' => sprintf( '<a href="%s">%s</a>', get_permalink(), $portfolio_title ),
						'params'  => array(
							'is_widget' => true,
							'wrap'      => $heading,
						),
						'echo'    => false,
					)
				);

			}

			genesis_markup(
				array(
					'open'    => '<header %s>',
					'close'   => '</header>',
					'context' => 'entry-header',
					'params'  => array(
						'is_widget' => true,
					),
					'content' => $header,
				)
			);

		}

		if ( ! empty( $instance['show_content'] ) ) {

			genesis_markup(
				array(
					'open'    => '<div %s>',
					'context' => 'entry-content',
					'params'  => array(
						'is_widget' => true,
					),
				)
			);

			if ( 'excerpt' === $instance['show_content'] ) {
				the_excerpt();
			} elseif ( 'content-limit' === $instance['show_content'] ) {
				the_content_limit( (int) $instance['content_limit'], genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
			} else {
				the_content( genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
			}

			genesis_markup(
				array(
					'close'   => '</div>',
					'context' => 'entry-content',
					'params'  => array(
						'is_widget' => true,
					),
				)
			);

		}

		genesis_markup(
			array(
				'close'   => '</article>',
				'context' => 'entry',
				'params'  => array(
					'is_widget' => true,
				),
			)
		);

	}
}

wp_reset_postdata();

if ( ! empty( $instance['show_view_all'] ) && 'bottom' === $instance['view_all_position'] ) {
	printf(
		'<p class="view-all-portfolio"><a href="%1$s">%2$s</a></p>',
		esc_url( get_post_type_archive_link( 'portfolio' ) ),
		esc_html( $instance['view_all_text'] )
	);
}

// phpcs:ignore
echo $args['after_widget'];
