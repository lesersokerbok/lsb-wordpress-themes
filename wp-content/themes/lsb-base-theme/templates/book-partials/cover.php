<?php if (has_post_thumbnail()): ?>
<div class="cover content-part">
	<div class="thumbnail">
	<?php if ( get_field('lsb_look_inside')): ?>
		<a href="<?php the_field('lsb_look_inside'); ?>" target="_blank">
			<?php the_post_thumbnail('large', array('class' => 'look-inside')); ?>
		</a>
	<?php else : ?>
		<?php the_post_thumbnail('large'); ?>
	<?php endif; ?>
	</div>
</div>
<?php endif; ?>
