<?php if( have_rows('lsb_page_sections', get_queried_object()) ) : ?>
	<?php while( have_rows('lsb_page_sections', get_queried_object()) ) : the_row(); ?>
		<?php get_template_part('templates/page-sections/page-section-'.get_sub_field('lsb_page_section_type' )); ?>
	<?php endwhile; ?>
<?php endif; ?>
