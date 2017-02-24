<?php
/*
Template Name: Ansatte/Styre sidemal
*/
?>

<div class="page-header">
	<h1>
		<?php the_title(); ?>
	</h1>
</div>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php if ( get_the_content() ): ?>
			<div class="page-content">
				<?php the_content(); ?>
			</div>

			<hr />
		<?php endif; ?>

		<section class="loop">
			<?php $posts = get_field('lsb_custom_field_person_relationship'); ?>
			<?php if( $posts ): ?>
				<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
					<?php get_template_part('templates/content-single-lsb-person'); ?>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</section>

	<?php endwhile; ?>
<?php endif; ?>
