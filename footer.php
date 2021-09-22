<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package belmarco
 */

?>
	</div><!--/#content-->
</div><!--/.container-->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-xs-6">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-4 col-xs-6 flag1">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-4 col-xs-6 flag1">
					<?php //if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php //dynamic_sidebar( 'footer-3' ); ?>
					<?php //endif; ?>
					<!--<h4>Подписывайтесь и получайте море полезной информации</h4>-->
          <div class="h4">Присоединяйтесь к нам</div>
		      <div class="socials">
				  <?php if(get_theme_mod('vk', '')){?>
            <a href="<?php echo get_theme_mod('vk', ''); ?>" class="vk_new" title="Мы в Вконтакте" target="_blank"></a>
				  <?php } ?>
				  <?php if(get_theme_mod('in', '')){?>
            <a href="<?php echo get_theme_mod('in', ''); ?>" class="inst_new" title="Instagram" target="_blank"></a>
				  <?php } ?>
				  <?php if(get_theme_mod('fb', '')){?>
            <a href="<?php echo get_theme_mod('fb', ''); ?>" class="fb_new" title="Мы в Facebook" target="_blank"></a>
				  <?php } ?>
				  <?php if(get_theme_mod('ok', '')){?>
            <a href="<?php echo get_theme_mod('ok', ''); ?>" class="ok_new" title="Одноклассники" target="_blank"></a>
				  <?php } ?>
				  <?php if(get_theme_mod('youtube', '')){?>
            <a href="<?php echo get_theme_mod('youtube', ''); ?>" class="youtube_new" title="Youtube" target="_blank"></a>
				  <?php } ?>
		      </div>
          <div class="accept-payments">
            <p class="title">Принимаем к оплате</p>
            <img src="<?php echo get_template_directory_uri();?>/img/accept-payment.png" alt="visa, mastercard, paykeeper" />
          </div>
				</div>

			</div><!--/.row-->
			<div style="text-align: center; padding-bottom: 10px;">Не является публичной офертой.</div>
		</div><!--/.container-->
	</footer>
    
    </div><!--/#page-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo get_template_directory_uri();?>/js/ie10-viewport-bug-workaround.js"></script>
	<!-- /*geolocation*/ -->

<?php wp_footer(); ?>
<script type="text/javascript">
		jQuery(function($){
			$("input[type='tel']").click(function(){
				$(this).focus();
				if($(this).val()=='')
					$(this).focus();
			});
   		});
	</script>
<?php if(function_exists('is_checkout') && is_checkout()):?>
<div class="hide">
	<div id="list_city">
		<?php echo do_shortcode('[wc_geo_promo]');?>
	</div>
</div>
<?php endif;?>
</body>
</html>
