<div class="page-header">
	<div>
		<header>
			<h1>
				<?php TaxonomyUtil::the_single_term_icon(get_queried_object()); ?><?php echo roots_title(); ?>
			</h1>
			<?php echo category_description(); ?>
		</header>
	</div>
</div>

<?php if(!is_paged()) : ?>
	<?php get_template_part('templates/page-sections'); ?>
<?php endif; ?>

<?php if ( have_posts() ): ?>
	<section class="loop">
		<?php if( !is_paged() && have_rows('lsb_page_sections', get_queried_object()) ) : ?>
		<div class="page-section-header">
			<h1>
				<?php esc_html_e( 'Arkiv', 'lsb' ); ?> <small> | <?php echo roots_title(); ?></small>
			</h1>
		</div>
		<?php endif; ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('templates/content-summary', get_post_type()); ?>
		<?php endwhile; ?>
	</section>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav class="post-nav">
		<?php roots_pagination(); ?>
	</nav>
<?php endif; ?>
