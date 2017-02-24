<article <?php post_class(); ?>>
	<header>
		<?php get_template_part('templates/page', 'header'); ?>
	</header>
	<div class="entry-content">
		<?php the_post_thumbnail('featured-thumb'); ?>
		<?php the_content(); ?>
	</div>
	<footer>
		<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
	</footer>
	<?php comments_template('/templates/comments.php'); ?>
</article>
