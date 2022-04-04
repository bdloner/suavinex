<?php
/**
 * Loop Name: Content Page Detail
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ('hidden' != get_theme_mod( 'body_title_hidden','0') && 'hidden' != get_field( 'title_style')): ?>
  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' );?>
  </header>
  <?php endif; ?>
  <div class="entry-content">
    <?php the_content(); ?>
    <?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'plant' ),
			'after'  => '</div>',
			) );
			?>
  </div>
  <footer class="entry-footer">
    <?php
			edit_post_link(sprintf(
					esc_html__( 'Edit %s', 'plant' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
				'<span class="edit-link">',
				'</span>'
				);
				?>
  </footer>
</article>