<?php
/**
 * @package WP Foundation Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php foundation_posted_on(); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">

        <?php if ( has_post_thumbnail() ) : ?>

            <div class="entry-image featured-image center">

                <?php
                global $post;
                $attachment_id = get_post_thumbnail_id( $post->ID );
                $attachment = wp_get_attachment_image_src( $attachment_id, 'large' );
                $full = wp_get_attachment_image_src( $attachment_id, 'full' );
                ?>

                <span class="icon-new">

                    <a href="<?php echo esc_url( $full[0] ); ?>">
                        <img src="<?php echo esc_url( $attachment[0] ); ?>">
                    </a>

                </span>

            </div>

        <?php endif; ?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'foundation' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

    <footer class="entry-footer">

        <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
            <?php
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( __( ', ', 'foundation' ) );
            if ( $categories_list && foundation_categorized_blog() ) : ?>
                <span class="cat-links">
                    <?php printf( __( '<i class="fa fa-folder-open"></i> %1$s', 'foundation' ), $categories_list ); ?>
                </span>
            <?php endif; // End if categories ?>

            <?php
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', __( ', ', 'foundation' ) );
            if ( $tags_list ) : ?>

                <span class="tags-links">
                    <?php printf( __( '<i class="fa fa-tag"></i> %1$s', 'foundation' ), $tags_list ); ?>
                </span>

            <?php endif; // End if $tags_list ?>

        <?php endif; // End if 'post' == get_post_type() ?>

        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
            <span class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( __( 'Leave a Comment', 'foundation' ), __( '1 Comment', 'foundation' ), __( '% Comments', 'foundation' ) ); ?></span>
        <?php endif; ?>

        <?php edit_post_link( __( 'Edit', 'foundation' ), '<span class="edit-link"><i class="fa fa-cog"></i>', '</span>' ); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
