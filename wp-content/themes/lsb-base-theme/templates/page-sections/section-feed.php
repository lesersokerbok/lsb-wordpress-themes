<?php

$feed_url = get_sub_field('feed_url');
$rss = fetch_feed( $feed_url );

?>

<?php if ( ! is_wp_error( $rss ) && $rss->get_item_quantity()) : ?>

	<?php if(get_sub_field('feed_heading')): ?>
		<h1>
		<?php if(get_sub_field('feed_heading_link')): ?>
			<a href="<?php the_sub_field('books_heading_link') ?>">
				<?php the_sub_field('feed_heading'); ?>
			</a>
		<?php else : ?>
			<?php the_sub_field('feed_heading'); ?>
		<?php endif; ?>
		</h1>
	<?php endif; ?>

	<div class="block-wrapper">
	<?php foreach ( $rss->get_items(0, 6) as $item ) : ?>
		<article class="block">
			<a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">
				<?php $image = LsbFeedUtil::get_image_from_feed_item($item); ?>
				<?php if( $image) : ?>
					<div>
						<img class="thumbnail" src="<?php echo esc_url( $image ); ?>" />
					</div>
				<?php endif; ?>
				<div>
					<h1><?php echo esc_html( $item->get_title() ); ?></h1>
					<?php echo LsbFeedUtil::get_excerpt_from_feed_item($item); ?>
				</div>
			</a>
		</article>
	<?php endforeach; ?>
	</div>

<?php else : ?>

	<?php if(current_user_can('manage_options')) : ?>
		<div class="alert alert-warning">
			<?php LsbFeedUtil::print_error_message($feed_url, $rss) ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
