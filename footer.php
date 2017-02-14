



<section class="footer">
  <div class="container">
  <div class="row">
      <div class="col-sm-4">
      <?php dynamic_sidebar( 'footer-1' ); ?>
      </div>
      <div class="col-sm-4">
      <?php dynamic_sidebar( 'footer-2' ); ?>
      </div>
      <div class="col-sm-4">
      <?php dynamic_sidebar( 'footer-3' ); ?>
      </div>
  </div>
  </div>
  
</section>

<section class="copyright">
  <div class="container">
    <div class="row">
      <div class="pull-left">
      <?php esc_html_e('Powered by','phantomlite'); ?> <a href="http://wordpress.org"><?php esc_html_e('WordPress','phantomlite');?> </a>
      </div>

      <div class="pull-right">
      <?php esc_html_e('Designed by','phantomlite');?> <a href="http://phantomthemes.com">Phantom Themes</a>
      </div>

</section>


  <?php wp_footer(); ?>

</body>
</html>
