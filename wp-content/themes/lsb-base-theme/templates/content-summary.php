<article <?php post_class('summary'); ?>>
	<header>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php get_template_part('templates/entry-meta'); ?>
	</header>
	<div class="entry-content">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-thumb'); ?></a>
		<?php the_content(); ?>
	</div>
</article>
