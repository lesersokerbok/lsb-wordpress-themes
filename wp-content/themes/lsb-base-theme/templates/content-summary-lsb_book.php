<article <?php post_class('summary'); ?>>
	<div class="entry-image">
		<a class="thumbnail" href="<?php the_permalink(); ?>">

			<?php if ( get_field('lsb_supported')): ?>
				<div class="lsb-supported <?php the_field('lsb_support_cat') ?>">
				</div>
			<?php endif; ?>

			<?php if ( has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('medium'); ?></img></a>
			<?php else : ?>
				<img src="<?php echo get_bloginfo('template_url'); ?>/assets/img/book-cover.jpg"></img>
			<?php endif; ?>
		</a>
	</div>
	<header>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="meta">
			<?php the_terms($post->ID, 'lsb_tax_author', '', ', ', '<br/>') ?>
			<?php the_terms($post->ID, 'lsb_tax_publisher', '', ', ', '<br/>') ?>
		</p>
	</header>
</article>
