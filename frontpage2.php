<?php
/**
 * Template Name: Frontpage 2 - Corporate Agency
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


<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-slider-enable','1' ) )) :?>
<?php 
$slidertalign = get_theme_mod('phantomlite-home-slider-type');

?>




<!-- sliders starts-->
<div id="carousel-slider" class="carousel slide sliders" data-ride="carousel">
      <!-- Controls -->
      <a class="left carousel-arrow" href="#carousel-slider" role="button" data-slide="prev">
      <i class="fa fa-angle-left"></i>
      <span class="sr-only"><?php echo __('Previous','phantomlite'); ?></span>
      </a>
      <a class="right carousel-arrow" href="#carousel-slider" role="button" data-slide="next">
      <i class="fa fa-angle-right"></i>
      <span class="sr-only"><?php echo __('Next','phantomlite'); ?></span>
      </a>



<!-- carousel-inner -->
      <div class="carousel-inner">  
        <!-- items -->
        <?php
                  $i=0;
                  $sliderp[0] = get_theme_mod('phantomlite-home-slider-page-1');
                  $sliderp[1] = get_theme_mod('phantomlite-home-slider-page-2');
                  $sliderp[2] = get_theme_mod('phantomlite-home-slider-page-3');

              
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $sliderp,
                          'orderby'           =>'post__in',
                        );

                      $sliderloop = new WP_Query($args);

                      
                      if ($sliderloop->have_posts()) :  while ($sliderloop->have_posts()) : $sliderloop->the_post();
                      
            ?>

        <div class="item <?php if($i==0){echo 'active';}?>">
          <div class="banner  <?php echo $slidertalign; ?>" style="color:#fff;">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="banner" class="main-banner img-responsive">
            <div class="caption">
              <div class="container">
                <div class="caption-info">              
                <h1 class="animated slideInRight"><?php the_title(); ?></h1>
                <div class="animated slideInUp"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink();?>" class="animated slideInDown btn btn-info"><i class="fa fa-angle-right"></i> <?php _e('Read More','phantomlite'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php $i=$i+1;?> 
        <!-- items -->
          <?php  endwhile;
              wp_reset_postdata();  
            endif;                             
            
        ?>
    </div>
    <!-- carousel-inner -->

</div>
<!-- sliders ends-->
<?php  endif; ?>

<!--service section-->

<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-service-enable','1' ) )) :?>
<?php  $servicetalign = esc_attr(get_theme_mod('phantomlite-home-service-type')); ?>
<!-- widgets -->
<div class="services-widgets <?php echo $servicetalign; ?> spacer">
  <div class="container">
    <div class="row wowload fadeInUp">
      
      <?php
                  $i=0;
                  $servicep[0] = get_theme_mod('phantomlite-home-service-page-1');
                  $servicep[1] = get_theme_mod('phantomlite-home-service-page-2');
                  $servicep[2] = get_theme_mod('phantomlite-home-service-page-3');

                  $servicei[0] = get_theme_mod('phantomlite-home-service-icon1');
                  $servicei[1] = get_theme_mod('phantomlite-home-service-icon2');
                  $servicei[2] = get_theme_mod('phantomlite-home-service-icon3');
                
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $servicep,
                          'orderby'           =>'post__in',
                        );

                      $serviceloop = new WP_Query($args);

                      
                      if ($serviceloop->have_posts()) :  while ($serviceloop->have_posts()) : $serviceloop->the_post();
                      
            ?>
      <div class="col-sm-4 wowload slideInUp">
        <div class="services-list">
        <i class="color-text <?php echo $servicei[$i]; ?> fa-3x"></i> 
        <h4 class="color-text"><?php the_title(); ?></h4>
        <p><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="readmore"><?php echo __('Read more','phantomlite'); ?></a>
        </div>
      </div>
      <?php $i=$i+1;?> 
        <!-- items -->
          <?php  endwhile;
              wp_reset_postdata();  
            endif;                             
            
        ?>
    </div>
  </div>
</div>
<!-- widgets -->
<?php endif; ?>

<!-- about section -->
<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-about-enable','1' ) )) :?>
<?php  $abouttalign = esc_attr(get_theme_mod('phantomlite-home-about-type')); ?>
<!-- About Starts -->
<div class="about spacer <?php echo $abouttalign; ?> ">
          <?php 
                          $aboutid = get_theme_mod('phantomlite-home-about-page');
                          $AboutPost = $post;
                          $post = get_post( $aboutid );
                          setup_postdata( $post );
          ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 wowload slideInLeft"><?php the_post_thumbnail(); ?></div>
      <div class="col-sm-6 wowload slideInRight">
        <h3><?php the_title(); ?></h3>
        <p><?php the_excerpt();?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-default"><?php _e('Read More','phantomlite'); ?></a>
      </div>
  </div>
  </div>
  <?php wp_reset_postdata(); $post = $AboutPost; ?>
</div>
<?php endif; ?>
<!-- About Ends -->

<!-- team-->
<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-team-enable','1' ) )) :?>
<!-- team -->
<div class="team spacer text-center">
  <div class="container  wowload fadeInUp">
    <h2>Our Team</h2>
    <div class="row">
     <?php
                  $teamp[0] = get_theme_mod('phantomlite-home-team-page-1');
                  $teamp[1] = get_theme_mod('phantomlite-home-team-page-2');
                  $teamp[2] = get_theme_mod('phantomlite-home-team-page-3');
                  $teamp[3] = get_theme_mod('phantomlite-home-team-page-4');
                
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 4,
                          'post__in'         => $teamp,
                          'orderby'           =>'post__in',
                        );

                      $teamloop = new WP_Query($args);

                      
                      if ($teamloop->have_posts()) :  while ($teamloop->have_posts()) : $teamloop->the_post();
                      
            ?>
      <div class="col-sm-3">
        <div class="team-info">
      <?php if(has_post_thumbnail()): 
      $teamimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'phantomlite-team' ); ?> 
      <a href="<?php the_permalink(); ?>" ><div class="team-image"><img src="<?php echo $teamimage[0]; ?>"></div> </a>
      <?php else: ?>
       <a href="<?php the_permalink(); ?>" > <div class="team-image"><img src="<?php echo get_template_directory_uri(); ?>/images/18.jpg"></div></a>
      <?php endif; ?>
        <h4><?php the_title(); ?></h4>
        <?php the_excerpt(); ?>
      </div>
      </div>
      <?php  endwhile; wp_reset_postdata();  endif; ?>
  </div>
</div>
</div>
<!-- team -->
<?php endif; ?>
<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-blog-enable','1' ) )) :?>
<!-- post 1 starts-->
<div class="blogpost-list spacer">
<div class="container">
<h3><?php echo esc_attr(get_theme_mod('phantomlite-home-blog-title')); ?></h3>
<div class="row">

      <?php

                  $blogcat = get_theme_mod('phantomlite-home-blog-cat'); 
                  $bnum = get_theme_mod('phantomlite-home-blog-num');
                  global $post;
                  $bnum=$bnum+1;
                    $args = array(
                      'posts_per_page' => $bnum,
                      'paged' => 1,
                      'cat' => $blogcat
                        );
              $loop = new WP_Query($args);

            
              if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                      
            ?>
  <!-- post wrap -->
  <div class="col-sm-6 post-wrap  wowload fadeInUp">
    <div class="row">
    <?php if(has_post_thumbnail()): 
            $bimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'phantomlite-testimonial' );
            ?>

      <div class="col-md-5">
      <img src="<?php echo $bimage[0]; ?>" class="img-responsive"/></div>
      <?php endif; ?>
      <div class="col-md-7">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <?php if (get_theme_mod('phantomlite-home-blog-meta-enable') == 1) : ?>
        <ul class="list-inline">
            <li><a href="<?php get_author_posts_url(); ?>"><i class="fa fa-user"></i> <?php the_author() ?></a></li>
            <li><a href="#"><i class="fa fa-calendar-check-o"></i> <?php the_time('F jS, Y') ?></a></li>
            <li><i class="fa fa-tags"></i><?php the_tags(); ?></li>
        </ul>
        <?php endif; ?>
        <p>
          <?php the_excerpt(); ?>
        </p>
        <a href="<?php the_permalink(); ?>" class="readmore"><?php echo __('Read More','phantomlite'); ?></a>
      </div>
    </div>
  </div>
  <!-- post wrap -->
<?php  endwhile;
              wp_reset_postdata();  
            endif;                             
   
        ?>

</div>

</div>
</div>
<!-- post 1 ends-->

<?php endif; ?>

<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-portfolio-enable','1' ) )) :?>
<!-- portfolio 2 -->
<div class="portfolio spacer "> 
  <div class="container">
     <h3><?php echo esc_attr(get_theme_mod('phantomlite-home-portfolio-title')); ?></h3>
  <div id="owl-portfolio" class="owl-carousel">



           <?php

                  $portcat = get_theme_mod('phantomlite-home-portfolio-cat'); 
                  global $post;
                    $args = array(
                      'posts_per_page' => -1,
                      'paged' => 1,
                      'cat' => $portcat
                        );
              $loop = new WP_Query($args);

            
              if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                      
            ?>

        <div class="item">
          <!-- project -->
          <div class="portfolio-list">
          <?php if(has_post_thumbnail()): 
            $pimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'phantomlite-testimonial' );
            ?>
          <img src="<?php echo $pimage[0]; ?>" alt="<?php the_title(); ?>"/>
          <?php endif; ?>
          <div class="portfolio-caption">
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <a href="<?php the_permalink(); ?>" class="btn"><?php echo __('Read More','phantomlite'); ?></a>
          </div>
          </div>
          <!-- project -->
        </div>

        
        <?php  endwhile; wp_reset_postdata();  endif; ?>
        

        
      </div>
      </div>
  </div>
  </div>
</div>
<!-- portfolio 2 -->

<?php endif; ?>
<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-testimonial-enable','1' ) )) :?>
<?php  $ttalign = esc_attr(get_theme_mod('phantomlite-home-testimonial-type')); ?>



<!-- testimonials 1 start -->
<div class="testimonials spacer text-center">
  <div class="container  wowload fadeInUp">
	<h3>What our customer says</h3>
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
  <div id="owl-testimonial" class="owl-carousel">
  <?php
                  $testimonialp[0] = get_theme_mod('phantomlite-home-testimonial-page-1');
                  $testimonialp[1] = get_theme_mod('phantomlite-home-testimonial-page-2');
                  $testimonialp[2] = get_theme_mod('phantomlite-home-testimonial-page-3');
                
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $testimonialp,
                          'orderby'           =>'post__in',
                        );

                      $testimonialloop = new WP_Query($args);

                      
                      if ($testimonialloop->have_posts()) :  while ($testimonialloop->have_posts()) : $testimonialloop->the_post();
                      
            ?>
      <div class="item <?php echo $ttalign; ?>">
        <div class="testimonial-info"><?php the_excerpt(); ?></div>
         <h4><?php the_title(); ?> </h4>
        <div class="client-info">
          <?php if(has_post_thumbnail()): 
                    $ttimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'phantomlite-testimonial' ); ?> 
           <img alt="portfolio" src="<?php echo $ttimage[0];?>" width="100" class="img-circle img-responsive">
          <?php endif; ?>
        </div>
      </div>
<?php  endwhile; wp_reset_postdata();  endif; ?>
</div>
</div>
</div>


  </div>
</div>
<?php endif; ?>
<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-counter-enable','1' ) )) :?>
<!-- highlight-info -->
<div class="highlight-info spacer ">
<div class="container ">
<div class="row text-center  wowload fadeInUp">
            <?php
                              $i=0;
                              $countertext[0] = esc_attr(get_theme_mod('phantomlite-home-counter-text-1'));
                              $countertext[1] = esc_attr(get_theme_mod('phantomlite-home-counter-text-2'));
                              $countertext[2] = esc_attr(get_theme_mod('phantomlite-home-counter-text-3'));
                              $countertext[3] = esc_attr(get_theme_mod('phantomlite-home-counter-text-4'));

                              $countericon[0] = get_theme_mod('phantomlite-home-counter-icon1');
                              $countericon[1] = get_theme_mod('phantomlite-home-counter-icon2');
                              $countericon[2] = get_theme_mod('phantomlite-home-counter-icon3'); 
                              $countericon[3] = get_theme_mod('phantomlite-home-counter-icon4');
              ?>
  <?php while($i<4): ?>
  <div class="col-sm-3 col-xs-6">
  <i class="<?php echo esc_attr($countericon[$i]); ?>  fa-5x"></i><h4><?php echo $countertext[$i]; $i=$i+1; ?></h4>
  </div>
  <?php endwhile; ?>
</div>
</div>
</div>
<!-- highlight-info -->
<?php endif; ?>

<?php if ( esc_attr(get_theme_mod( 'phantomlite-home-client-enable','1' ) )) :?>
<!-- clients-logo -->
<div class="clients-logo spacer text-center">
<div class="container  wowload fadeInUp">
  <h3><?php echo esc_attr(get_theme_mod('phantomlite-home-client-title')); ?></h3>
<div class="row text-center">
                <?php         $clientp[0] = esc_attr(get_theme_mod('phantomlite-home-client-page-1'));
                              $clientp[1] = esc_attr(get_theme_mod('phantomlite-home-client-page-2'));
                              $clientp[2] = esc_attr(get_theme_mod('phantomlite-home-client-page-3'));
                              $clientp[3] = esc_attr(get_theme_mod('phantomlite-home-client-page-4'));
                              $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 4,
                          'post__in'         => $clientp,
                          'orderby'           =>'post__in',
                        );

                      $clientloop = new WP_Query($args);

                      
                      if ($clientloop->have_posts()) :  while ($clientloop->have_posts()) : $clientloop->the_post();

                              ?>

        <?php if(has_post_thumbnail()): 
        $cimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'phantomlite-client' ); ?> 
              
              <a href="<?php the_permalink(); ?>" class="col-sm-3 col-xs-6" alt="<?php the_title(); ?>">
              <img src="<?php echo $cimage[0]; ?>" height="50px">
              </a>
            <?php endif; ?>    

  <?php  endwhile; wp_reset_postdata();  endif; ?>
</div>
</div>
</div>

<?php endif; ?>

<?php get_footer(); ?>