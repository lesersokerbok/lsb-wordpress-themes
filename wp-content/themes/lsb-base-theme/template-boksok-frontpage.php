<?php
/*
Template Name: Boksøk Forsidemal
*/
?>

<div class="page-header">
	<div>
		<header>
			<h1>
				<?php the_title(); ?>
			</h1>
		</header>
		<?php get_search_form(); ?>
	</div>
</div>

<?php get_template_part('templates/page-sections'); ?>
