<?php $terms = LsbPageSectionsUtil::get_terms_for_navigation(); ?>

<?php if($terms->all) : ?>

<nav class="tax-navigation">
	<?php if ( get_sub_field('lsb_page_section_title') ) : ?>
		<div class="page-section-header">
			<h2>
				<?php the_sub_field('lsb_page_section_title') ?>

				<?php if ( get_sub_field('lsb_page_section_sub_title') ) : ?>
					<small>| <?php the_sub_field('lsb_page_section_sub_title'); ?></small>
				<?php endif; ?>
			</h2>
		</div>
	<?php endif; ?>

	<ul>
			<?php foreach ($terms->all as $term ): ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
						<?php echo TaxonomyUtil::get_term_icon( $term ) ?>
						<span><?php echo ucfirst( TaxonomyUtil::get_term_name( $term ) ) ?></span>
					</a>
				</li>
			<?php endforeach; ?>
	</ul>

</nav>

<?php endif; ?>
