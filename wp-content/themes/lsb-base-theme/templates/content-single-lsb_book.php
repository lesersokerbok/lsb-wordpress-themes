
<article <?php post_class('full'); ?>>

	<header class="page-header">
		<h1>
			<?php echo roots_title(); ?>
		</h1>
	</header>

	<div class="aside hidden-xs">
		<?php get_template_part('templates/book-partials/cover'); ?>
		<?php get_template_part('templates/book-partials/library-status'); ?>
	</div>

	<div class="entry-content clearfix">
		<?php get_template_part('templates/book-partials/meta1'); ?>
		<div class="visible-xs">
			<?php get_template_part('templates/book-partials/cover'); ?>
			<?php get_template_part('templates/book-partials/library-status'); ?>
		</div>
		<?php get_template_part('templates/book-partials/review'); ?>
		<?php get_template_part('templates/book-partials/quote'); ?>
		<?php get_template_part('templates/book-partials/more'); ?>
		<?php get_template_part('templates/book-partials/icon-nav'); ?>
		<?php get_template_part('templates/book-partials/meta2'); ?>
		<?php get_template_part('templates/book-partials/lsb-supported'); ?>
	</div>

	<div class="entry-embeds">
		<?php get_template_part('templates/book-partials/embeds'); ?>
	</div>

</article>
