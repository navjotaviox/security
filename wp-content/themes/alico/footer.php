<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Alico
 */ 
$back_totop_on = alico_get_opt('back_totop_on', true);
?>
	</div><!-- #content inner -->
</div><!-- #content -->

<?php alico_footer(); ?>
<?php if (isset($back_totop_on) && $back_totop_on) : ?>
    <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
<?php endif; ?>

</div><!-- #page -->
<?php alico_search_popup(); ?>
<?php alico_sidebar_hidden(); ?>
<?php alico_cart_sidebar(); ?>
<?php wp_footer(); ?>

</body>
</html>
