<?php if( get_field( 'lsb_quote' ) ): ?>
<div class="quote panel panel-default content-part">
	<div class="panel-heading">
		<h2 class="panel-title"><?php _e('Utdrag fra boka', 'lsb_boksok'); ?></h2>
	</div>
	<div class="panel-body">
		<?php the_field('lsb_quote'); ?>
	</div>
</div>
<?php endif; ?>
