<?php
/**
 * Template part for displaying the primary menu of the site
 */

if ( has_nav_menu( 'primary' ) )
{
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'  => '',
        'menu_id'    => 'ct-main-menu',
        'menu_class' => 'ct-main-menu clearfix',
        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
    ) );
} else { ?>
    <ul class="ct-main-menu">
        <?php wp_list_pages( array(
            'depth'        => 0,
            'show_date'    => '',
            'date_format'  => get_option( 'date_format' ),
            'child_of'     => 0,
            'exclude'      => '',
            'title_li'     => '',
            'echo'         => 1,
            'authors'      => '',
            'sort_column'  => 'menu_order, post_title',
            'link_before'  => '',
            'link_after'   => '',
            'item_spacing' => 'preserve',
            'walker'       => '',
        ) ); ?>
    </ul>
<?php }