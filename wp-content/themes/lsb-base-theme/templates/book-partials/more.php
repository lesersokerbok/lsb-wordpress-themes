<?php if (has_term('', 'lsb_tax_series') || has_term('', 'lsb_tax_list')) : ?>
<div class="more panel panel-default content-part">
	<div class="panel-body">
		<p><?php _e('Boka er en del av: ', 'lsb'); ?></p>
		<ul>
			<?php the_terms($post->ID, 'lsb_tax_series', '<li>', '</li><li>', '</li>') ?>
			<?php the_terms($post->ID, 'lsb_tax_list', '<li>', '</li><li>', '</li>') ?>
		</ul>
	</div>
</div>
<?php endif ; ?>
