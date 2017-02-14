 <?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phantom_Lite
 */

?>


  <article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>



    		<?php the_post_thumbnail();  ?>
    		
 

  		<div class="entry-content">
  		<?php if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} ?>
			 <header class="entry-header">
		<?php


		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php phantomlite_posted_on(); ?> | <?php phantomlite_entry_footer(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
          <?php
				the_content();
				wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'phantomlite' ),
				'after'  => '</div>',
			) );
			 ?>
		</div>

  </article>