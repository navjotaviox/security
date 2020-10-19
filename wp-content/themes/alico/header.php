<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Alico
 */
$hide_bg_image = alico_get_page_opt('hide_bg_image', false);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <?php 
        	alico_page_loading();
        	alico_header_layout();
            alico_page_title_layout();
        ?>
        <div id="content" class="site-content <?php if($hide_bg_image) { echo 'hide-bg-image'; } ?>">
        	<div class="content-inner">
