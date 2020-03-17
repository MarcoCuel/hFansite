<?php

$defaults = array(
    'default-image'          => '',
    'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
    'default-position-x'     => 'left',    // 'left', 'center', 'right'
    'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
    'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
    'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
    'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
    'default-color'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
);
add_theme_support( 'custom-background', $defaults );

  add_theme_support( 'custom-header' );

  function theme_customize_register( $wp_customize ) {

    // Link color
    $wp_customize->add_setting( 'link_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
      'section' => 'colors',
      'label'   => esc_html__( 'Cor do link', 'theme' ),
    ) ) );

    // Button color
    $wp_customize->add_setting( 'button_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_color', array(
      'section' => 'colors',
      'label'   => esc_html__( 'Cor dos botões', 'theme' ),
    ) ) );
  }

  add_action( 'customize_register', 'theme_customize_register' );



  function theme_get_customizer_css() {
    ob_start();

    $link_color = get_theme_mod( 'link_color', '' );
    if ( ! empty( $link_color ) ) {
      ?>
      a, a:hover {
        color: <?php echo $link_color; ?>;
      }
      <?php
    }
    
    $button_color = get_theme_mod( 'button_color', '' );
    if ( ! empty( $button_color ) ) {
      ?>
      .btn {
        background-color: <?php echo $button_color; ?>;
        border-color: <?php echo $button_color; ?>;
      }
      <?php
    }

    $css = ob_get_clean();
    return $css;
  }

// Modify our styles registration like so:

function theme_enqueue_styles() {
  wp_enqueue_style( 'theme-styles', get_stylesheet_uri() ); // This is where you enqueue your theme's main stylesheet
  $custom_css = theme_get_customizer_css();
  wp_add_inline_style( 'theme-styles', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );