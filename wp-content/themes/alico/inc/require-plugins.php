<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/libs/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'alico_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
*/
function alico_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        /* CMS Plugin */
        array(
            'name'               => esc_html__('* Redux Framework', 'alico'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Elementor', 'alico'),
            'slug'               => 'elementor',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Case Theme Core', 'alico'),
            'slug'               => 'case-theme-core',
            'source'             => esc_url('http://demo.casethemes.net/plugins/elementor/case-theme-core.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Case Theme Marker', 'alico'),
            'slug'               => 'case-theme-marker',
            'source'             => esc_url('http://demo.casethemes.net/plugins/elementor/case-theme-marker.zip'),
            'required'           => true,
        ),
        
        array(
            'name'               => esc_html__('Case Theme Import', 'alico'),
            'slug'               => 'case-theme-import',
            'source'             => esc_url('http://demo.casethemes.net/plugins/elementor/case-theme-import.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Revolution Slider', 'alico'),
            'slug'               => 'revslider',
            'source'             => esc_url('http://demo.casethemes.net/plugins/revslider.zip'),
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Contact Form 7', 'alico'),
            'slug'               => 'contact-form-7',
            'required'           => true,
        ),

        array(
            'name'               => esc_html__('Mailchimp', 'alico'),
            'slug'               => 'mailchimp-for-wp',
            'required'           => true,
        ),  

        array(
            'name'               => esc_html__('Instagram Feed', 'alico'),
            'slug'               => 'instagram-feed',
            'required'           => true,
        ),  
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.

    );

    tgmpa( $plugins, $config );

}