<footer>
	<div class="widget-area">
		<div class="wrap container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-6">
							<?php dynamic_sidebar('sidebar-footer-1'); ?>
						</div>
						<div class="col-md-6">
							<?php dynamic_sidebar('sidebar-footer-2'); ?>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-md-6">
							<?php dynamic_sidebar('sidebar-footer-3'); ?>
						</div>
						<div class="col-md-6">
							<?php dynamic_sidebar('sidebar-footer-4'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<nav role="navigation">
			<?php
				if (has_nav_menu('social_links_menu')) :
					wp_nav_menu(array('theme_location' => 'social_links_menu', 'menu_class' => 'icon-nav nav navbar-nav nav-centered', 'link_before' => '<span>', 'link_after' => '</span>'));
				endif;
			?>
			</nav>
		</div>
	</div>

	<div class="content-info container" role="contentinfo">
		<p><?php if (get_bloginfo('description')): ?><?php echo get_bloginfo('description') ?><br/><?php endif; ?> © <?php echo date("Y"); ?> <a href="http://lesersøkerbok.no">Leser søker bok</a></p>
	</div>

</footer>

<?php wp_footer(); ?>
