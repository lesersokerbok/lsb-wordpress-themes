<div class="meta panel panel-default content-part">
	<div class="panel-body">
		<ul>
			<?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_genre', '<li>'.__('Sjanger: ', 'lsb_boksok'), ', ', '</li>') ?>
			<?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_publisher', '<li>'.__('Forlag: ', 'lsb_boksok'), ', ', '</li>') ?>
			<?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_translator', '<li>'.__('Oversetter: ', 'lsb_boksok'), ', ', '</li>') ?>
			<?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_lsb_cat', '<li>'.__('Hovedkategori: ', 'lsb_boksok'), ', ', '</li>') ?>
			<?php if( get_field( "lsb_published_year" ) ): ?>
			<li>
				<?php _e('Utgitt: ', 'lsb_boksok');?>
				<?php the_field( "lsb_published_year" ); ?>
			</li>
			<?php endif; ?>
			<?php TaxonomyUtil::the_unhidden_term_list($post->ID, 'lsb_tax_language', '<li>'.__('Hovedkategori: ', 'lsb_boksok'), ', ', '</li>') ?>
			<?php if( get_field( 'lsb_pages' ) ): ?>
			<li>
				<?php echo __('Antall sider: ', 'lsb_boksok'); ?>
				<?php the_field( "lsb_pages" ); ?><br/>
			</li>
			<?php endif; ?>
			<?php if( get_field( "lsb_isbn" ) ): ?>
			<li>
				<?php _e('ISBN: ', 'lsb_boksok'); ?>
				<?php the_field( "lsb_isbn" ); ?>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
