<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
</head>

<body <?php body_class(); ?>>

	<?php
		do_action('get_header');
		$context = Timber::get_context();
		Timber::render( 'header.twig', $context );
	?>

	<?php
		get_template_part('templates/algoliasearch');
	?>

	<div class="wrap container-fluid" role="document">
		<div class="content row">
			<main class="main <?php echo roots_main_class(); ?>" role="main">
				<?php include roots_template_path(); ?>
			</main><!-- /.main -->
			<?php if (roots_display_sidebar()) : ?>
				<aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
					<?php include roots_sidebar_path(); ?>
				</aside><!-- /.sidebar -->
			<?php endif; ?>
		</div><!-- /.content -->
	</div><!-- /.wrap -->

	<?php get_template_part('templates/footer'); ?>

</body>
</html>
