<?php
/**
 * Template part for displaying default header layout
 */
$sticky_scroll = alico_get_opt( 'sticky_scroll', 'scroll-to-bottom' );
$sticky_on = alico_get_opt( 'sticky_on', false );
$navigation_hide_icon = alico_get_page_opt( 'navigation_hide_icon', false );
$hidden_sidebar_icon = alico_get_opt( 'hidden_sidebar_icon', false );

$logo_mobile = alico_get_opt( 'logo_mobile', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$custom_header = alico_get_page_opt('custom_header');
$p_logo_mobile = alico_get_page_opt('p_logo_mobile');
if($custom_header && !empty($p_logo_mobile['url'])) {
    $logo_mobile['url'] = $p_logo_mobile['url'];
}
?>
<header id="ct-masthead">
    <div id="ct-header-wrap" class="ct-header-layout3 fixed-height <?php echo esc_attr($sticky_scroll); ?> <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div id="ct-header" class="ct-header-main">
            <div class="container">
                <div class="row">
                    <div class="ct-header-branding">
                        <div class="ct-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="ct-header-navigation">
                        <nav class="ct-main-navigation <?php if($navigation_hide_icon) { echo 'item-menu-hide-icon'; } ?>">
                            <div class="ct-main-navigation-inner">
                                <?php if ($logo_mobile['url']) { ?>
                                    <div class="ct-logo-mobile">
                                        <a href="<?php esc_url( esc_url( home_url( '/' ) ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo_mobile['url'] ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"/></a>
                                    </div>
                                <?php } ?>
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </div>
                        </nav>
                    </div>
                    <div class="ct-header-meta">
                        <?php if($hidden_sidebar_icon && is_active_sidebar( 'sidebar-hidden' )) : ?>
                            <div class="header-right-item h-btn-sidebar">
                                <div class="ct-menu-line ct-menu-line1"></div>
                                <div class="ct-menu-line ct-menu-line2"></div>
                                <div class="ct-menu-line ct-menu-line3"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div id="ct-menu-mobile">
                <span class="btn-nav-mobile open-menu">
                    <span></span>
                </span>
            </div>
        </div>
    </div>
</header>