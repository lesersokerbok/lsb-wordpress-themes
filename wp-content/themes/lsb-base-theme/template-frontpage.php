<?php
/*
Template Name: Forsidemal
*/
?>

<?php if ( have_rows('sections') ): ?>
	<?php while ( have_rows('sections') ) : the_row(); ?>
		<section class="page-section page-section-<?php echo get_row_layout(); ?>">

			<?php get_template_part('templates/page-sections/section', get_row_layout()); ?>

		</section>
	<?php endwhile; ?>
<?php endif; ?>
