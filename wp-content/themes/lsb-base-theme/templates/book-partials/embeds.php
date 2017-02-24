<?php if( have_rows('lsb_oembeds') ): ?>
	<?php while ( have_rows('lsb_oembeds') ) : the_row(); ?>

	<?php
		$iframe = get_sub_field('lsb_oembed');
		preg_match('/src="(.+?)"/', $iframe, $matches);
		$src = $matches[1];
		$oembed_type = '';
		if(preg_match('/youtube/', $src)) {
			$oembed_type = 'youtube';
		} else if (preg_match('/issuu/', $src)) {
			$oembed_type = 'issuu';
		}
	?>

	<div class="embed content-part">
		<div class="embed-container <?php echo $oembed_type ?>">
			<?php echo $iframe ?>
		</div>
	</div>
	<?php endwhile; ?>
<?php endif; ?>
