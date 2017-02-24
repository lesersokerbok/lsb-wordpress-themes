<div class="page-header">
	<h1>
		<?php echo roots_title(); ?>
	</h1>

	<?php if(is_singular('post')) : ?>
		<?php get_template_part('templates/entry-meta'); ?>
	<?php endif; ?>
</div>
