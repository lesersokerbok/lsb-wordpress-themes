<footer>
	<div class="widget-area">
		<div class="wrap container-fluid">
			<div class="row">
				<div class="col-sm-4">
					<?php dynamic_sidebar('sidebar-footer-1'); ?>
				</div>
				<div class="col-sm-4 text-center">
					<?php dynamic_sidebar('sidebar-footer-2'); ?>
				</div>
				<div class="col-sm-4 text-right">
					<?php dynamic_sidebar('sidebar-footer-3'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="content-info container" role="contentinfo">
		<p><?php if (get_bloginfo('description')): ?><?php echo get_bloginfo('description') ?><br/><?php endif; ?> © <?php echo date("Y"); ?> <a href="http://lesersøkerbok.no">Leser søker bok</a></p>
	</div>

</footer>

<?php wp_footer(); ?>
