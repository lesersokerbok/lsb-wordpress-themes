<div class="page-header">
	<div>
		<header>
			<h1>
				<?php echo roots_title(); ?>
			</h1>
			<?php do_action('search_alert'); ?>
		</header>
		<?php get_search_form(); ?>
	</div>
</div>

<?php if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<?php printf(__('Ingen treff på: %s', 'lsb'), get_search_query()); ?>
	</div>
<?php endif; ?>

<section class="loop">
<?php while (have_posts()) : the_post(); ?>
	<?php get_template_part('templates/content-summary', get_post_type()); ?>
<?php endwhile; ?>
</section>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav class="post-nav">
		<?php roots_pagination(); ?>
	</nav>
<?php endif; ?>

<?php
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$search_query = $wp_query->query_vars['s'];
?>
