 <?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phantom_Lite
 */

?>
<?php $i=0; ?>
<div class="<?php echo esc_attr(get_theme_mod('blogview')); ?> eq-blocks" > 
   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   
  


			<?php if (!is_single() && has_post_thumbnail()) : ?>

    		<?php the_post_thumbnail();  ?>
    		
 
  			<?php endif; ?> 

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
			if ( is_single() ) {
				the_content();
			} else {
				the_excerpt();
			} ?>
		</div>

  </article>
  </div>
  <?php $i=$i+1; if($i%2==0){ echo '<div class="clear"></div>';} ?>