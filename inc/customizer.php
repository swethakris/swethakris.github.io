<?php
/******************************************
Customizer Base
 *******************************************/
if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;
/**
 * Customize Control for Taxonomy Select
 */
class phantomlite_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $phantomlite_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $phantomlite_taxonomy;
    $this->taxonomy = esc_attr( $phantomlite_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__('Select', 'phantomlite') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}

class phantomlite_Select_Customize_Control extends WP_Customize_Control {
  public $type = 'select';
}

/**
 * Customizer: Sanitization Callbacks
 *
 * This file demonstrates how to define sanitization callback functions for various data types.
 * 
 * @package   code-examples
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */
/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function phantomlite_sanitize_checkbox( $checked ) {
  // Boolean check.
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
/**
 * Drop-down Pages sanitization callback example.
 *
 * - Sanitization: dropdown-pages
 * - Control: dropdown-pages
 * 
 * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
 * as an absolute integer, and then validates that $input is the ID of a published page.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
 *
 * @param int                  $page    Page ID.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string Page ID if the page is published; otherwise, the setting default.
 */
function phantomlite_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * HTML sanitization callback example.
 *
 * - Sanitization: html
 * - Control: text, textarea
 * 
 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
 * for HTML allowable in posts.
 * 
 * NOTE: wp_filter_post_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 * 
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function phantomlite_sanitize_html( $html ) {
  return wp_filter_post_kses( $html );
}
/**
 * No-HTML sanitization callback example.
 *
 * - Sanitization: nohtml
 * - Control: text, textarea, password
 * 
 * Sanitization callback for 'nohtml' type text inputs. This callback sanitizes `$nohtml`
 * to remove all HTML.
 * 
 * NOTE: wp_filter_nohtml_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 * 
 * @see wp_filter_nohtml_kses() https://developer.wordpress.org/reference/functions/wp_filter_nohtml_kses/
 *
 * @param string $nohtml The no-HTML content to sanitize.
 * @return string Sanitized no-HTML content.
 */
function phantomlite_sanitize_nohtml( $nohtml ) {
  return wp_filter_nohtml_kses( $nohtml );
}
/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function phantomlite_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );
  
  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function phantomlite_sanitize_select( $input, $setting ) {
  
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
/**
 * URL sanitization callback example.
 *
 * - Sanitization: url
 * - Control: text, url
 * 
 * Sanitization callback for 'url' type text inputs. This callback sanitizes `$url` as a valid URL.
 * 
 * NOTE: esc_url_raw() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 * 
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function phantomlite_sanitize_url( $url ) {
  return esc_url_raw( $url );
}

function phantomlite_sanitize_category($input){
  $output=intval($input);
  return $output;
}
function phantomlite_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
/**
 * Phantom Lite Theme Customizer.
 *
 * @package Phantom_Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function phantomlite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'phantomlite_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function phantomlite_customize_preview_js() {
	wp_enqueue_script( 'phantomlite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'phantomlite_customize_preview_js' );


function phantomlite_theme_customizer_register( $wp_customize ) 
    {
      // Do stuff with $wp_customize, the WP_Customize_Manager object.

    /**
  * Customizer for Default 
  */
         $wp_customize->add_panel( 'theme_option', array(
        'priority' => 20,
        'title' => __( 'Phantom BlogPage Options', 'phantomlite' ),
        'description' => __( 'phantomlite Default Option', 'phantomlite' ),
      ));

     /***********************THEME LAYOUT SECTION ********************/
    /******************************************************/
      $wp_customize->add_section('blogview' , array(
        'priority' => 20,
        'title' => __(' Blog View Option','phantomlite'),
        'panel' => 'theme_option'
      ));

      $wp_customize->add_setting('blogview', array(
        'sanitize_callback' => 'phantomlite_sanitize_select',
        'default' => 'list',
        ));

      $wp_customize->add_control('blogview', array(
        'label'      => __('Select Blog View ', 'phantomlite'),
        'section'    => 'blogview',
        'settings'   => 'blogview',
        
        'type'       => 'radio',
        'choices'    => array(
          'listview'   => __('List Layout','phantomlite'),
          'gridview'   => __('Grid Layout','phantomlite'),
        ),
      ));
      /**
  * Customizer for Slider 
  */
 $wp_customize->add_panel( 'homepage_options', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Phantom FrontPage 2 Options','phantomlite'),
    'description'    => __('PhantomFrontPage 2 Sections','phantomlite'),
) );
// Featured Slider
/*Featured text slider setting controls*/
$wp_customize->add_section( 'phantomlite-home-slider', array(
    'capability' => 'edit_theme_options',
    'priority'       => 10,
    'title'          => __( 'Slider Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Slider Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-slider-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-slider-enable', array(
    'label'                 =>  __( 'Enable Slider', 'phantomlite' ),
    'section'               => 'phantomlite-home-slider',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-slider-enable',
) );

$wp_customize->add_setting( 'phantomlite-home-slider-page-1', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-slider-page-1', array(
    'label'                 =>  __( 'Select Page For Slider 1', 'phantomlite' ),
    'section'               => 'phantomlite-home-slider',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-slider-page-1',
) );


$wp_customize->add_setting( 'phantomlite-home-slider-page-2', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-slider-page-2', array(
    'label'                 =>  __( 'Select Page For slider 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-slider',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-slider-page-2',
) );


$wp_customize->add_setting( 'phantomlite-home-slider-page-3', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-slider-page-3', array(
    'label'                 =>  __( 'Select Page For slider 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-slider',
    'type'                  => 'dropdown-pages',
    'priority'              => 60,
    'settings' => 'phantomlite-home-slider-page-3',
) );


//slider text align
$wp_customize->add_setting( 'phantomlite-home-slider-type', array(
    'capability'    => 'edit_theme_options',
    'default'     => 'text-center',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );

$wp_customize->add_control( 'phantomlite-home-slider-type', array(
    'label'                 =>  __( 'Select Slider Text Floating', 'phantomlite' ),
    'section'               => 'phantomlite-home-slider',
    'type'                  => 'select',
    'priority'              => 20,
    'settings' => 'phantomlite-home-slider-type',
     'choices'    => array(
          ''   => 'left',
          'text-right'   => 'right',
          'text-center'  => 'center',
        ),
) );
  /**
  * Customizer for About Section 
  */
 $wp_customize->add_section( 'phantomlite-home-about', array(
    'capability' => 'edit_theme_options',
    'priority'       => 30,
    'title'          => __( 'About Section', 'phantomlite' ),
    'description'    => __( 'Select pages for About', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-about-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-about-enable', array(
    'label'                 =>  __( 'Enable About Section', 'phantomlite' ),
    'section'               => 'phantomlite-home-about',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-about-enable',
) );

$wp_customize->add_setting( 'phantomlite-home-about-page', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-about-page', array(
    'label'                 =>  __( 'Select Page For About Section', 'phantomlite' ),
    'section'               => 'phantomlite-home-about',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-about-page',
) );

//Banner text align
$wp_customize->add_setting( 'phantomlite-home-about-type', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'text-center',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );

$wp_customize->add_control( 'phantomlite-home-about-type', array(
    'label'                 =>  __( 'Select Banner Text Position', 'phantomlite' ),
    'section'               => 'phantomlite-home-about',
    'type'                  => 'select',
    'priority'              => 100,
    'settings' => 'phantomlite-home-about-type',
     'choices'    => array(
          ''   => 'left',
          'text-right'   => 'right',
          'text-center'  => 'center',
        ),
) );

  /**
  * Customizer for Service Section 
  */
$wp_customize->add_section( 'phantomlite-home-service', array(
    'capability' => 'edit_theme_options',
    'priority'       => 20,
    'title'          => __( 'Service Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Service Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-service-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-service-enable', array(
    'label'                 =>  __( 'Enable Service', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-service-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-service-icon1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-service-icon1', array(
    'label'                 =>  __( 'Icon For Service 1', 'phantomlite' ),
    'description'           => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'phantomlite' ), 'fa fa-magic','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'text',
    'priority'              => 15,
    'settings' => 'phantomlite-home-service-icon1',
) );

$wp_customize->add_setting( 'phantomlite-home-service-icon2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-service-icon2', array(
    'label'                 =>  __( 'Icon For Service 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'phantomlite-home-service-icon2',
) );
$wp_customize->add_setting( 'phantomlite-home-service-icon3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-service-icon3', array(
    'label'                 =>  __( 'Icon For Service 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'text',
    'priority'              => 25,
    'settings' => 'phantomlite-home-service-icon3',
) );
$wp_customize->add_setting( 'phantomlite-home-service-page-1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'phantomlite-home-service-page-1', array(
    'label'                 =>  __( 'Select Page For Service 1', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-service-page-1',
) );


$wp_customize->add_setting( 'phantomlite-home-service-page-2', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-service-page-2', array(
    'label'                 =>  __( 'Select Page For Service 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'dropdown-pages',
    'priority'              => 35,
    'settings' => 'phantomlite-home-service-page-2',
) );


$wp_customize->add_setting( 'phantomlite-home-service-page-3', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-service-page-3', array(
    'label'                 =>  __( 'Select Page For Service 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-service-page-3',
) );


//Service text align
$wp_customize->add_setting( 'phantomlite-home-service-type', array(
    'capability'    => 'edit_theme_options',
    'default'     => 'text-center',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );

$wp_customize->add_control( 'phantomlite-home-service-type', array(
    'label'                 =>  __( 'Select Service Text Align', 'phantomlite' ),
    'section'               => 'phantomlite-home-service',
    'type'                  => 'select',
    'priority'              => 70,
    'settings' => 'phantomlite-home-service-type',
     'choices'    => array(
          ''   => 'left',
          'text-right'   => 'right',
          'text-center'  => 'center',
        ),
) );


  /**
  * Customizer for Team Section 
  */
  $wp_customize->add_section( 'phantomlite-home-team', array(
    'capability' => 'edit_theme_options',
    'priority'       => 40,
    'title'          => __( 'Team Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Team Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-team-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-team-enable', array(
    'label'                 =>  __( 'Enable Team', 'phantomlite' ),
    'section'               => 'phantomlite-home-team',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-team-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-team-page-1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'phantomlite-home-team-page-1', array(
    'label'                 =>  __( 'Select Page For Team 1', 'phantomlite' ),
    'section'               => 'phantomlite-home-team',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-team-page-1',
) );


$wp_customize->add_setting( 'phantomlite-home-team-page-2', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-team-page-2', array(
    'label'                 =>  __( 'Select Page For Team 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-team',
    'type'                  => 'dropdown-pages',
    'priority'              => 35,
    'settings' => 'phantomlite-home-team-page-2',
) );


$wp_customize->add_setting( 'phantomlite-home-team-page-3', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-team-page-3', array(
    'label'                 =>  __( 'Select Page For Team 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-team',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-team-page-3',
) );

$wp_customize->add_setting( 'phantomlite-home-team-page-4', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-team-page-4', array(
    'label'                 =>  __( 'Select Page For Team 4', 'phantomlite' ),
    'section'               => 'phantomlite-home-team',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-team-page-4',
) );

  /**
  * Customizer for Blog Section 
  */
$wp_customize->add_section( 'phantomlite-home-blog', array(
    'capability' => 'edit_theme_options',
    'priority'       => 50,
    'title'          => __( 'Blog Section', 'phantomlite' ),
    'description'    => __( 'Select Options for Blog Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-blog-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 2,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-blog-enable', array(
    'label'                 =>  __( 'Enable Blog', 'phantomlite' ),
    'section'               => 'phantomlite-home-blog',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-blog-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-blog-title', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'Latest Blog',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-blog-title', array(
    'label'                 =>  __( 'Blog Title Text', 'phantomlite' ),
    'section'               => 'phantomlite-home-blog',
    'type'                  => 'text',
    'priority'              => 15,
    'settings' => 'phantomlite-home-blog-title',
) );
//Blog category selection
$wp_customize->add_setting( 'phantomlite-home-blog-cat', array(
    'capability'    => 'edit_theme_options',
    'default'     => '',
    'sanitize_callback' => 'phantomlite_sanitize_category'
) );
$wp_customize->add_control(new phantomlite_Customize_Dropdown_Taxonomies_Control($wp_customize,'phantomlite-home-blog-cat',array(
    'label'                 =>  __( 'Select Category for Blog', 'phantomlite' ),
    'section'               => 'phantomlite-home-blog',
    'type'                  => 'dropdown-taxonomies',
    'priority'              => 20,
    'settings' => 'phantomlite-home-blog-cat',
    )
) );
//Blog Number
$wp_customize->add_setting( 'phantomlite-home-blog-num', array(
    'capability'    => 'edit_theme_options',
    'default'     => 2,
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );

$wp_customize->add_control( 'phantomlite-home-blog-num', array(
    'label'                 =>  __( 'Number of Blog', 'phantomlite' ),
    'section'               => 'phantomlite-home-blog',
    'type'                  => 'select',
    'priority'              => 30,
    'settings' => 'phantomlite-home-blog-num',
     'choices'    => array(1,2),
) );
  /**
  * Customizer for Portfolio Section 
  */
  $wp_customize->add_section( 'phantomlite-home-portfolio', array(
    'capability' => 'edit_theme_options',
    'priority'       => 60,
    'title'          => __( 'Portfolio Section', 'phantomlite' ),
    'description'    => __( 'Select Options for Portfolio Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-portfolio-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-portfolio-enable', array(
    'label'                 =>  __( 'Enable Portfolio', 'phantomlite' ),
    'section'               => 'phantomlite-home-portfolio',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-portfolio-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-portfolio-title', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'Latest Portfolio',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-portfolio-title', array(
    'label'                 =>  __( 'Portfolio Title Text', 'phantomlite' ),
    'section'               => 'phantomlite-home-portfolio',
    'type'                  => 'text',
    'priority'              => 15,
    'settings' => 'phantomlite-home-portfolio-title',
) );
//Portfolio category selection
$wp_customize->add_setting( 'phantomlite-home-portfolio-cat', array(
    'capability'    => 'edit_theme_options',
    'default'     => '',
    'sanitize_callback' => 'phantomlite_sanitize_category'
) );
$wp_customize->add_control(new phantomlite_Customize_Dropdown_Taxonomies_Control($wp_customize,'phantomlite-home-portfolio-cat',array(
    'label'                 =>  __( 'Select Category for Portfolio', 'phantomlite' ),
    'section'               => 'phantomlite-home-portfolio',
    'type'                  => 'dropdown-taxonomies',
    'priority'              => 20,
    'settings' => 'phantomlite-home-portfolio-cat',
    )
) );

  /**
  * Customizer for Testimonials Section 
  */
  $wp_customize->add_section( 'phantomlite-home-testimonial', array(
    'capability' => 'edit_theme_options',
    'priority'       => 70,
    'title'          => __( 'Testimonial Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Testimonial Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-testimonial-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-testimonial-enable', array(
    'label'                 =>  __( 'Enable Testimonial', 'phantomlite' ),
    'section'               => 'phantomlite-home-testimonial',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-testimonial-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-testimonial-page-1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'phantomlite-home-testimonial-page-1', array(
    'label'                 =>  __( 'Select Page For Testimonial 1', 'phantomlite' ),
    'section'               => 'phantomlite-home-testimonial',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-testimonial-page-1',
) );


$wp_customize->add_setting( 'phantomlite-home-testimonial-page-2', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-testimonial-page-2', array(
    'label'                 =>  __( 'Select Page For Testimonial 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-testimonial',
    'type'                  => 'dropdown-pages',
    'priority'              => 35,
    'settings' => 'phantomlite-home-testimonial-page-2',
) );


$wp_customize->add_setting( 'phantomlite-home-testimonial-page-3', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-testimonial-page-3', array(
    'label'                 =>  __( 'Select Page For Testimonial 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-testimonial',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-testimonial-page-3',
) );

  /**
  * Customizer for Counter Section 
  */
  $wp_customize->add_section( 'phantomlite-home-counter', array(
    'capability' => 'edit_theme_options',
    'priority'       => 80,
    'title'          => __( 'Counter Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Counter Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-counter-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-counter-enable', array(
    'label'                 =>  __( 'Enable Counter', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-counter-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-counter-icon1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-smile-o',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-counter-icon1', array(
    'label'                 =>  __( 'Icon For Counter 1', 'phantomlite' ),
    'description'           => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'phantomlite' ), 'fa fa-smile-o','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 15,
    'settings' => 'phantomlite-home-counter-icon1',
) );

$wp_customize->add_setting( 'phantomlite-home-counter-icon2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-rocket',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-counter-icon2', array(
    'label'                 =>  __( 'Icon For Counter 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'phantomlite-home-counter-icon2',
) );
$wp_customize->add_setting( 'phantomlite-home-counter-icon3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-cloud-download',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-counter-icon3', array(
    'label'                 =>  __( 'Icon For Counter 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 25,
    'settings' => 'phantomlite-home-counter-icon3',
) );
$wp_customize->add_setting( 'phantomlite-home-counter-icon4', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-map-marker',
    'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'phantomlite-home-counter-icon4', array(
    'label'                 =>  __( 'Icon For Counter 4', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 25,
    'settings' => 'phantomlite-home-counter-icon4',
) );
$wp_customize->add_setting( 'phantomlite-home-counter-text-1', array(
    'capability'        => 'edit_theme_options',
    'default'           => '250 Clients',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-counter-text-1', array(
    'label'                 =>  __( 'Text For First Counter', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 30,
    'settings' => 'phantomlite-home-counter-text-1',
) );

$wp_customize->add_setting( 'phantomlite-home-counter-text-2', array(
    'capability'        => 'edit_theme_options',
    'default'           => '75 Projects',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-counter-text-2', array(
    'label'                 =>  __( 'Text For Second Counter', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 35,
    'settings' => 'phantomlite-home-counter-text-2',
) );$wp_customize->add_setting( 'phantomlite-home-counter-text-3', array(
    'capability'        => 'edit_theme_options',
    'default'           => '454 Downloads',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-counter-text-3', array(
    'label'                 =>  __( 'Text For Third Counter', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 40,
    'settings' => 'phantomlite-home-counter-text-3',
) );$wp_customize->add_setting( 'phantomlite-home-counter-text-4', array(
    'capability'        => 'edit_theme_options',
    'default'           => '20 Countries',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-counter-text-4', array(
    'label'                 =>  __( 'Text For Fourth Counter', 'phantomlite' ),
    'section'               => 'phantomlite-home-counter',
    'type'                  => 'text',
    'priority'              => 45,
    'settings' => 'phantomlite-home-counter-text-4',
) );
  /**
  * Customizer for Client Section 
  */
  $wp_customize->add_section( 'phantomlite-home-client', array(
    'capability' => 'edit_theme_options',
    'priority'       => 90,
    'title'          => __( 'Client Section', 'phantomlite' ),
    'description'    => __( 'Select pages for Client Section', 'phantomlite' ),
    'panel'  => 'homepage_options'
) );

$wp_customize->add_setting( 'phantomlite-home-client-enable', array(
    'capability'    => 'edit_theme_options',
    'default'     => 1,
    'sanitize_callback' => 'phantomlite_sanitize_checkbox'
) );

$wp_customize->add_control( 'phantomlite-home-client-enable', array(
    'label'                 =>  __( 'Enable Client', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'checkbox',
    'priority'              => 10,
    'settings' => 'phantomlite-home-client-enable',
) );
$wp_customize->add_setting( 'phantomlite-home-client-title', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'Some of Our Happy Clients',
    'sanitize_callback' => 'phantomlite_sanitize_text'
) );
$wp_customize->add_control( 'phantomlite-home-client-title', array(
    'label'                 =>  __( 'Client Title Text', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'text',
    'priority'              => 30,
    'settings' => 'phantomlite-home-client-title',
) );
$wp_customize->add_setting( 'phantomlite-home-client-page-1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'phantomlite-home-client-page-1', array(
    'label'                 =>  __( 'Select Page For Client 1', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'dropdown-pages',
    'priority'              => 30,
    'settings' => 'phantomlite-home-client-page-1',
) );


$wp_customize->add_setting( 'phantomlite-home-client-page-2', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-client-page-2', array(
    'label'                 =>  __( 'Select Page For Client 2', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'dropdown-pages',
    'priority'              => 35,
    'settings' => 'phantomlite-home-client-page-2',
) );


$wp_customize->add_setting( 'phantomlite-home-client-page-3', array(
    'capability'    => 'edit_theme_options',
    'default'     => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-client-page-3', array(
    'label'                 =>  __( 'Select Page For Client 3', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-client-page-3',
) );

$wp_customize->add_setting( 'phantomlite-home-client-page-4', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'phantomlite_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'phantomlite-home-client-page-4', array(
    'label'                 =>  __( 'Select Page For Client 4', 'phantomlite' ),
    'section'               => 'phantomlite-home-client',
    'type'                  => 'dropdown-pages',
    'priority'              => 40,
    'settings' => 'phantomlite-home-client-page-4',
) );




  }

  add_action( 'customize_register', 'phantomlite_theme_customizer_register' );



/**
 * Enqueue scripts for customizer
 */
function phantomlite_customizer_pro_js() {
    wp_enqueue_script('phantomlite-customizer', get_template_directory_uri() . '/js/phantomlite-customizer.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'phantomlite-customizer', 'phantomlite_customizer_pro_js_obj', array(
        'pro' => __('Upgrade To Phantom Pro','phantomlite')
    ) );
    wp_enqueue_style( 'phantomlite-customizer', get_template_directory_uri() . '/css/phantomlite-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'phantomlite_customizer_pro_js' );