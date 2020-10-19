<?php
/**
 * Template part for displaying default header layout
 */
$sticky_scroll = alico_get_opt( 'sticky_scroll', 'scroll-to-bottom' );
$sticky_on = alico_get_opt( 'sticky_on', false );
$navigation_hide_icon = alico_get_page_opt( 'navigation_hide_icon', false );

$h_btn_on = alico_get_opt( 'h_btn_on', 'hide' );
$h_btn_text = alico_get_opt( 'h_btn_text' );
$h_btn_link_type = alico_get_opt( 'h_btn_link_type', 'page' );
$h_btn_link = alico_get_opt( 'h_btn_link' );
$h_btn_link_custom = alico_get_opt( 'h_btn_link_custom' );
$h_btn_target = alico_get_opt( 'h_btn_target', '_self' );
if($h_btn_link_type == 'page') {
    $h_btn_url = get_permalink($h_btn_link);
} else {
    $h_btn_url = $h_btn_link_custom;
}

$h_btn_on2 = alico_get_opt( 'h_btn_on2', 'hide' );
$h_btn_text2 = alico_get_opt( 'h_btn_text2' );
$h_btn_link_type2 = alico_get_opt( 'h_btn_link_type2', 'page' );
$h_btn_link2 = alico_get_opt( 'h_btn_link2' );
$h_btn_link_custom2 = alico_get_opt( 'h_btn_link_custom2' );
$h_btn_target2 = alico_get_opt( 'h_btn_target2', '_self' );
if($h_btn_link_type2 == 'page') {
    $h_btn_url2 = get_permalink($h_btn_link2);
} else {
    $h_btn_url2 = $h_btn_link_custom2;
}


$wellcome = alico_get_opt( 'wellcome' );
$h_phone = alico_get_opt( 'h_phone' );
$h_phone_link = alico_get_opt( 'h_phone_link' );
$h_email = alico_get_opt( 'h_email' );
$h_email_link = alico_get_opt( 'h_email_link' );
$h_btn_icon = alico_get_opt( 'h_btn_icon' );
$h_btn_icon2 = alico_get_opt( 'h_btn_icon2' );

$logo_mobile = alico_get_opt( 'logo_mobile', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$custom_header = alico_get_page_opt('custom_header');
$p_logo_mobile = alico_get_page_opt('p_logo_mobile');
if($custom_header && !empty($p_logo_mobile['url'])) {
    $logo_mobile['url'] = $p_logo_mobile['url'];
}
?>
<header id="ct-masthead">
    <div id="ct-header-wrap" class="ct-header-layout2 fixed-height <?php echo esc_attr($sticky_scroll); ?> <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div id="ct-header-topbar" class="ct-header-topbar1">
            <div class="container">
                <div class="row">
                    <?php if(!empty($wellcome)) : ?>
                        <div class="ct-header-welcome">
                            <?php echo ct_print_html($wellcome); ?>
                        </div>
                    <?php endif; ?>
                    <ul class="ct-header-top-info">
                        <li><a href="tel:<?php echo esc_attr($h_phone_link); ?>"><i class="flaticon-telephone-call"></i><?php echo esc_attr($h_phone_link); ?></a></li>
                        <li><a href="mailto:<?php echo esc_attr($h_email_link); ?>"><i class="flaticon-envelope"></i><?php echo esc_attr($h_email); ?></a></li>
                    </ul>
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
                                <?php if($h_btn_on == 'show' && !empty($h_btn_text)) : ?>
                                    <div class="ct-header-button-mobile">
                                        <a class="btn btn-secondary2" href="<?php echo esc_url( $h_btn_url ); ?>" target="<?php echo esc_attr($h_btn_target); ?>">
                                            <?php if(!empty($h_btn_icon)) : ?>
                                                <i class="<?php echo esc_attr($h_btn_icon); ?> space-right"></i>
                                            <?php endif; ?>
                                        <?php echo esc_attr( $h_btn_text ); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if($h_btn_on2 == 'show' && !empty($h_btn_text2)) : ?>
                                    <div class="ct-header-button-mobile">
                                        <a class="btn" href="<?php echo esc_url( $h_btn_url2 ); ?>" target="<?php echo esc_attr($h_btn_target2); ?>">
                                            <?php if(!empty($h_btn_icon2)) : ?>
                                                <i class="<?php echo esc_attr($h_btn_icon2); ?> space-right"></i>
                                            <?php endif; ?>
                                        <?php echo esc_attr( $h_btn_text2 ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>
                        <div class="ct-header-button-wrap">
                            <?php if($h_btn_on == 'show' && !empty($h_btn_text)) : ?>
                                <div class="ct-header-button">
                                    <a class="btn btn-secondary2" href="<?php echo esc_url( $h_btn_url ); ?>" target="<?php echo esc_attr($h_btn_target); ?>">
                                        <?php if(!empty($h_btn_icon)) : ?>
                                            <i class="<?php echo esc_attr($h_btn_icon); ?> space-right"></i>
                                        <?php endif; ?>
                                        <?php echo esc_attr( $h_btn_text ); ?><i class="<?php echo esc_attr($h_btn_icon); ?> icon-abs"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if($h_btn_on2 == 'show' && !empty($h_btn_text2)) : ?>
                                <div class="ct-header-button">
                                    <a class="btn" href="<?php echo esc_url( $h_btn_url2 ); ?>" target="<?php echo esc_attr($h_btn_target2); ?>">
                                        <?php if(!empty($h_btn_icon2)) : ?>
                                            <i class="<?php echo esc_attr($h_btn_icon2); ?> space-right"></i>
                                        <?php endif; ?>
                                        <?php echo esc_attr( $h_btn_text2 ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
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