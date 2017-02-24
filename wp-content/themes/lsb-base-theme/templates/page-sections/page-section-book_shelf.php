<?php $books = LsbPageSectionsUtil::get_books_for_book_shelf(); ?>

<?php if($books->have_posts()) : ?>

<section class="book-shelf">
	<div class="page-section-header">
		<h1>
			<a href="<?php echo LsbPageSectionsUtil::get_link_for_book_shelf(); ?>"><?php the_sub_field('lsb_page_section_title') ?></a>

			<?php if ( get_sub_field('lsb_page_section_sub_title') ) : ?>
				<small>| <a href="<?php echo LsbPageSectionsUtil::get_link_for_book_shelf(); ?>"><?php the_sub_field('lsb_page_section_sub_title'); ?></a></small>
			<?php endif; ?>
		</h1>
	</div>

	<div class="book-shelf-body">

		<span aria-hidden="true" class="book-shelf-left-scroll hidden-xs glyphicon glyphicon-chevron-left"></span>
		<span aria-hidden="true" class="book-shelf-right-scroll hidden-xs glyphicon glyphicon-chevron-right"></span>

		<div class="book-shelf-scroll">
			<?php while ( $books->have_posts() ) : $books->the_post(); ?>
				<?php get_template_part('templates/content-summary', 'lsb_book'); ?>
			<?php endwhile; ?>
		</div>

	</div>
</section>

<?php endif; ?>

<?php wp_reset_query(); ?>
