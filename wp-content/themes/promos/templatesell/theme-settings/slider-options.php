<?php
$GLOBALS['promos_theme_options'] = promos_get_options_value();

/*Slider Options*/

$wp_customize->add_section( 'promos_slider_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Slider Settings', 'promos' ),
   'panel' 		 => 'promos_panel',
) );


/*Slider Enable Option*/
$wp_customize->add_setting( 'promos_options[promos_enable_slider]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['promos_enable_slider'],
   'sanitize_callback' => 'promos_sanitize_checkbox'
) );

$wp_customize->add_control(
    'promos_options[promos_enable_slider]', 
    array(
       'label'     => __( 'Enable Slider', 'promos' ),
       'description' => __('You can select the category for the slider below. More Options are available on premium version.', 'promos'),
       'section'   => 'promos_slider_section',
       'settings'  => 'promos_options[promos_enable_slider]',
        'type'      => 'checkbox',
       'priority'  => 15,
   )
 );    

 /*callback functions slider*/
if ( !function_exists('promos_slider_active_callback') ) :
  function promos_slider_active_callback(){
      global $promos_theme_options;
      $enable_slider =  absint($promos_theme_options['promos_enable_slider']);     
      if( 1 == $enable_slider ){
          return true;
      }
      else{
          return false;
      }
  }
endif;    

/*Slider Category Selection*/
$wp_customize->add_setting( 'promos_options[promos-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['promos-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Promos_Customize_Category_Dropdown_Control(
        $wp_customize,
        'promos_options[promos-select-category]',
        array(
            'label'     => __( 'Select Category For Slider', 'promos' ),
            'description' => __('Choose one category to show the slider. More settings are in pro version.', 'promos'),
            'section'   => 'promos_slider_section',
            'settings'  => 'promos_options[promos-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 15,
            'active_callback'=> 'promos_slider_active_callback',
        )
    )

);