<?php if ( get_field('lsb_supported')): ?>
	<div class="lsb-supported <?php the_field('lsb_support_cat') ?> panel panel-default content-part">
		<div class="panel-body">
			<?php echo __('Boken er støttet av Leser søker bok', 'lsb_boksok'); ?>
		</div>
	</div>
<?php endif; ?>
