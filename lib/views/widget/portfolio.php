<?php
/**
 * Front-end View: Portfolio widget.
 *
 * @package Genesis Portfolio Pro
 * @since   1.2.0
 */

// phpcs:disable WordPress.WP.GlobalVariableOverride - mirrors Genesis Featured Post widget usage.
defined( 'ABSPATH' ) || exit;

echo $args['before_widget'];

if ( ! empty( $instance['title'] ) ) {
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
	'cat'       => $instance['posts_cat'],
	'showposts' => $instance['items_num'],
	'orderby'   => $instance['orderby'],
	'order'     => $instance['order'],
);

$wp_query = new WP_Query( $portfolio_query_args );

if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

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
					'entry-image-widget', array(
						'alt' => get_the_title(),
					)
				),
			)
		);

		if ( $image && $instance['show_image'] ) {
			$role = empty( $instance['show_title'] ) ? '' : 'aria-hidden="true"';
			printf( '<a href="%s" class="%s" %s>%s</a>', get_permalink(), esc_attr( $instance['image_alignment'] ), $role, wp_make_content_images_responsive( $image ) );
		}

		if ( $instance['show_title'] || $instance['show_byline'] ) {

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

				$title = get_the_title() ? get_the_title() : __( '(no title)', 'genesis' );

				$heading = genesis_a11y( 'headings' ) ? 'h4' : 'h2';

				$header .= genesis_markup(
					array(
						'open'    => "<{$heading} %s>",
						'close'   => "</{$heading}>",
						'context' => 'entry-title',
						'content' => sprintf( '<a href="%s">%s</a>', get_permalink(), $title ),
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
					'context' => 'portfolio-header',
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

			if ( 'excerpt' == $instance['show_content'] ) {
				the_excerpt();
			} elseif ( 'content-limit' == $instance['show_content'] ) {
				the_content_limit( (int) $instance['content_limit'], genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
			} else {
				global $more;

				$orig_more = $more;
				$more      = 0;

				the_content( genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );

				$more = $orig_more;
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

wp_reset_query();

if ( ! empty( $instance['show_view_all'] ) && 'bottom' === $instance['view_all_position'] ) {
	printf(
		'<p class="view-all-portfolio"><a href="%1$s">%2$s</a></p>',
		esc_url( get_post_type_archive_link( 'portfolio' ) ),
		esc_html( $instance['view_all_text'] )
	);
}

echo $args['after_widget'];
