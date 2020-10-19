<?php
/**
 * Template part for displaying default header layout
 */
$sticky_scroll = alico_get_opt( 'sticky_scroll', 'scroll-to-bottom' );
$sticky_on = alico_get_opt( 'sticky_on', false );
$h_search_form = alico_get_opt( 'h_search_form', false );
$navigation_hide_icon = alico_get_page_opt( 'navigation_hide_icon', false );
$logo_mobile = alico_get_opt( 'logo_mobile', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$custom_header = alico_get_page_opt('custom_header');
$p_logo_mobile = alico_get_page_opt('p_logo_mobile');
if($custom_header && !empty($p_logo_mobile['url'])) {
    $logo_mobile['url'] = $p_logo_mobile['url'];
}
$search_field_placeholder = alico_get_opt( 'search_field_placeholder' );
$h_phone = alico_get_opt( 'h_phone' );
$h_phone_label = alico_get_opt( 'h_phone_label' );
$h_phone_link = alico_get_opt( 'h_phone_link' );
$h_email = alico_get_opt( 'h_email' );
$h_email_label = alico_get_opt( 'h_email_label' );
$h_email_link = alico_get_opt( 'h_email_link' );
$h_address = alico_get_opt( 'h_address' );
$h_address_label = alico_get_opt( 'h_address_label' );
$h_address_link = alico_get_opt( 'h_address_link' );
?>
<header id="ct-masthead">
    <div id="ct-header-wrap" class="ct-header-layout4 fixed-height <?php echo esc_attr($sticky_scroll); ?> <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div id="ct-header-topbar" class="ct-header-topbar2">
            <div class="container">
                <div class="row">
                    <div class="ct-header-branding">
                        <div class="ct-header-branding-inner">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>
                    <div class="ct-header-info">
                        <div class="ct-header-info-item">
                            <div class="item-icon">
                                <i class="flaticon-telephone"></i>
                            </div>
                            <div class="item-meta">
                                <label><?php echo esc_attr($h_phone_label); ?></label>
                                <span><?php echo esc_attr($h_phone); ?></span>
                                <a class="item-link" href="tel:<?php echo esc_attr($h_phone_link); ?>"></a>
                            </div>
                        </div>
                        <div class="ct-header-info-item">
                            <div class="item-icon">
                                <i class="flaticon-envelope"></i>
                            </div>
                            <div class="item-meta">
                                <label><?php echo esc_attr($h_email_label); ?></label>
                                <span><?php echo esc_attr($h_email); ?></span>
                                <a class="item-link" href="mailto:<?php echo esc_attr($h_email_link); ?>"></a>
                            </div>
                            
                        </div>
                        <div class="ct-header-info-item">
                            <div class="item-icon">
                                <i class="flaticon-maps-and-flags"></i>
                            </div>
                            <div class="item-meta">
                                <label><?php echo esc_attr($h_address_label); ?></label>
                                <span><?php echo esc_attr($h_address); ?></span>
                                <a class="item-link" href="<?php echo esc_url($h_address_link); ?>"></a>
                            </div>
                            
                        </div>
                    </div>
                    <?php alico_social_header(); ?>
                </div>
            </div>
        </div>
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
                                <div class="ct-header-info ct-header-info-mobile">
                                    <div class="ct-header-info-item">
                                        <div class="item-icon">
                                            <i class="flaticon-telephone"></i>
                                        </div>
                                        <div class="item-meta">
                                            <label><?php echo esc_attr($h_phone_label); ?></label>
                                            <span><?php echo esc_attr($h_phone); ?></span>
                                            <a class="item-link" href="tel:<?php echo esc_attr($h_phone_link); ?>"></a>
                                        </div>
                                    </div>
                                    <div class="ct-header-info-item">
                                        <div class="item-icon">
                                            <i class="flaticon-envelope"></i>
                                        </div>
                                        <div class="item-meta">
                                            <label><?php echo esc_attr($h_email_label); ?></label>
                                            <span><?php echo esc_attr($h_email); ?></span>
                                            <a class="item-link" href="mailto:<?php echo esc_attr($h_email_link); ?>"></a>
                                        </div>
                                        
                                    </div>
                                    <div class="ct-header-info-item">
                                        <div class="item-icon">
                                            <i class="flaticon-maps-and-flags"></i>
                                        </div>
                                        <div class="item-meta">
                                            <label><?php echo esc_attr($h_address_label); ?></label>
                                            <span><?php echo esc_attr($h_address); ?></span>
                                            <a class="item-link" href="<?php echo esc_url($h_address_link); ?>"></a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="ct-header-social-mobile">
                                    <?php alico_social_header(); ?>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <?php if($h_search_form) : ?>
                        <div class="ct-header-search">
                            <form role="search" method="get" class="h-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
                                <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_attr_e('Search...', 'alico'); } ?>" name="s" class="search-field" />
                                <button type="submit" class="search-submit"><i class="far fac-search"></i></button>
                            </form>
                        </div>
                    <?php endif; ?>
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