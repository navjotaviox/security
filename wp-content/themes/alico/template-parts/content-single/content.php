<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Alico
 */
$post_tags_on = alico_get_opt( 'post_tags_on', true );
$post_category_on = alico_get_opt( 'post_category_on', true );
$post_navigation_on = alico_get_opt( 'post_navigation_on', false );
$post_social_share_on = alico_get_opt( 'post_social_share_on', false );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-hentry'); ?>>
    <div class="entry-blog">
        <?php if (has_post_thumbnail()) {
            echo '<div class="entry-featured">'; ?>
                <?php the_post_thumbnail('alico-large'); ?>
                <?php if($post_category_on) : 
                    the_terms( get_the_ID(), 'category', '<div class="entry-category">', ' ', '</div>' );
                endif; ?>
            <?php echo '</div>';
        } ?>
        <div class="entry-body">

            <?php alico_post_meta(); ?>

            <div class="entry-content clearfix">
                <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="page-links">',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ) );
                ?>
            </div>

        </div>
    </div>
    <?php if($post_tags_on || $post_social_share_on ) :  ?>
        <div class="entry-footer">
            <?php if($post_tags_on) { alico_entry_tagged_in(); } ?>
            <?php if($post_social_share_on) { alico_socials_share_default(); } ?>
        </div>
    <?php endif; ?>

    <?php alico_post_nav_default(); ?>
</article><!-- #post -->