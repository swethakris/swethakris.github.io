<?php
/**
 * Template Name: Frontpage 1 - Three Column Blog
 *
 * This is three column grid layout as well as 1 column list layout withot sidebar 
 *
 *
 * @package Phantom_Lite
 */

get_header(); ?>
<div class="top-banner">
<!-- Header Image -->
<?php if (has_header_image()): ?>
<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

<!-- Header Image -->


<div class="welcome-text">
<h1><?php bloginfo('title'); ?></h1>
<p><?php bloginfo('description'); ?></p> 
</div>  
<?php endif;?>
</div>




<section class="main">
    <div class="container">
        <div class="row">     
        <div class="col-sm-12">
          <div class="content front">

           <?php
              $args = array(
                  
                  'orderby' => 'date',
              );
              $loop = new WP_Query($args);                                   
              if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
          ?>

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
 <?php
            endwhile;
                wp_reset_postdata();
            endif; 
        ?>

    </div>


    </div><!-- #primary -->
</div>
  </div>
</section>


<?php
get_footer(); ?>