<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

<!--			--><?php //if ( has_nav_menu( 'social' ) ) : ?>
<!--				<nav class="social-navigation" role="navigation" aria-label="--><?php //esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?><!--">-->
<!--					--><?php
//						wp_nav_menu( array(
//							'theme_location' => 'social',
//							'menu_class'     => 'social-links-menu',
//							'depth'          => 1,
//							'link_before'    => '<span class="screen-reader-text">',
//							'link_after'     => '</span>',
//						) );
//					?>
<!--				</nav><!-- .social-navigation -->
<!--			--><?php //endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>

				<!--LiveInternet counter--><script type="text/javascript"><!--
					document.write("<a href='//www.liveinternet.ru/click' "+
						"target=_blank><img src='//counter.yadro.ru/hit?t54.6;r"+
						escape(document.referrer)+((typeof(screen)=="undefined")?"":
						";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
							screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
						";"+Math.random()+
						"' alt='' title='LiveInternet: показано число просмотров и"+
						" посетителей за 24 часа' "+
						"border='0' width='88' height='31'><\/a>")
					//--></script><!--/LiveInternet-->

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
<!--				<a href="--><?php //echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?><!--">--><?php //printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?><!--</a>-->
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->


<?php wp_footer(); ?>
</body>
</html>
