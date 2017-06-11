<header role="banner">
			<aside class="lsb_voice vFact_DoNotReadAloud">
				<h1 class="lsb_voice__title"><?php _e('Lytt til teksten: ', 'lsb') ?></h1>
				<div class="btn-group" role="group">
					<button type="button" class="lsb_voice__play btn btn-default btn-xs" aria-label="<?php _e('Start opplesing', 'lsb') ?>">
						<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
					</button>
					<button type="button" class="lsb_voice__stop btn btn-default btn-xs" aria-label="<?php _e('Stopp opplesing', 'lsb') ?>">
						<span class="glyphicon glyphicon-stop" aria-hidden="true"></span>
					</button>
					<button type="button" class="lsb_voice__settings btn btn-default btn-xs" aria-label="<?php _e('Innstillinger', 'lsb') ?>">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					</button>
				</div>
				<a type="button" class="lsb_voice__help btn btn-link btn-xs" aria-label="<?php _e('Hjelpetekst', 'lsb') ?>">
					<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
				</a>
			</aside>
	<div class="navbar navbar-default navbar-static-top lsb-navbar-site">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">

				<div class="navbar-right">
					<?php if (has_nav_menu('primary_navigation')) : ?>
						<button type="button" class="btn btn-default navbar-btn lsb-navbar-btn-action collapsed" data-toggle="collapse" data-target="#primary-collapse" aria-expanded="false">
							<span class="sr-only"><?php esc_html_e( 'Meny', 'lsb' ); ?></span>
							<span class="glyphicon glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
						</button>
					<?php else : ?>
						<button type="button" class="btn btn-default navbar-btn lsb-navbar-btn-action collapsed" data-toggle="collapse" data-target="#search-collapse" aria-expanded="false">
							<span class="sr-only"><?php esc_html_e( 'Søk', 'lsb' ); ?></span>
							<span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default navbar-btn lsb-navbar-btn-action collapsed" data-toggle="collapse" data-target="#primary-collapse" aria-expanded="false">
							<span class="sr-only"><?php esc_html_e( 'Meny', 'lsb' ); ?></span>
							<span class="glyphicon glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
						</button>
					<?php endif; ?>
				</div>

				<a class="navbar-brand" href="/">
					<?php get_template_part('templates/logo'); ?>
					<span><?php bloginfo( 'name' ); ?></span>
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="primary-collapse">
				<?php
					if (has_nav_menu('primary_navigation')) :
						wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav navbar-left'));
					endif;
				?>

				<div class="navbar-right">
					<?php
						if (has_nav_menu('secondary_navigation')) :
							wp_nav_menu(array(
								'theme_location' => 'secondary_navigation',
								'menu_class' => 'nav navbar-nav',
								'depth' => 1
							));
						endif;
					?>
				</div>

				<?php
					if (!has_nav_menu('primary_navigation')) :
						get_search_form();
					endif;
				?>

			</div><!-- /.navbar-collapse -->

		</div><!-- /.container-fluid -->
	</div>

	<?php if(!has_nav_menu('primary_navigation')) : ?>
		<div class="navbar navbar-default navbar-static-top lsb-navbar-search collapse" id="search-collapse">
			<div class="container-fluid">
				<?php get_search_form(); ?>
			</div><!-- /.container-fluid -->
		</div>
	<?php endif; ?>

	<?php if(is_front_page() && has_nav_menu('main_navigation')) : ?>
		<div class="navbar navbar-default navbar-static-top lsb-navbar-page">
			<div class="container-fluid">
				<?php
						wp_nav_menu(array(
							'theme_location' => 'main_navigation',
							'menu_class' => 'nav navbar-nav',
							'depth' => 1,
							'link_after' => '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
						));
				?>
			</div><!-- /.container-fluid -->
		</div>
	<?php endif; ?>

</header>
