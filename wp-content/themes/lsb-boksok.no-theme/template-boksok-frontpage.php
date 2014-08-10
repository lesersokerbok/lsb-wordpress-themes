<?php
/*
Template Name: Boksøk Frontpage Template
*/
?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<?php if( have_rows('frontpage_list') ): ?>

      <?php while ( have_rows('frontpage_list') ) : the_row(); ?>

          <?php
          $taxQuery = null;

          $age = null;
          $age = get_sub_field('age');
          if ($age) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_age',
              'field' => 'id',
              'terms' => $age
            );
          }

          $customization = null;
          $customization = get_sub_field('customization');
          if ($customization) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_customization',
              'field' => 'id',
              'terms' => $customization
            );
          }

          $author = null;
          $author = get_sub_field('author');
          if ($author) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_author',
              'field' => 'id',
              'terms' => $author
            );
          }

          $genre = null;
          $genre = get_sub_field('genre');
          if ($genre) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_genre',
              'field' => 'id',
              'terms' => $genre
            );
          }

          $topic = null;
          $topic = get_sub_field('topic');
          if ($topic) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_topic',
              'field' => 'id',
              'terms' => $topic
            );
          }

          $language = null;
          $language = get_sub_field('language');
          if ($language) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_language',
              'field' => 'id',
              'terms' => $language
            );
          }

          $publisher = null;
          $publisher = get_sub_field('publisher');
          if ($publisher) {
            $taxQuery[] = array(
              'taxonomy' => 'lsb_tax_publisher',
              'field' => 'id',
              'terms' => $publisher
            );
          }

          $args = array(
              'post_type' => 'lsb_book',
              'tax_query' => $taxQuery
          );

          $wp_query = new WP_Query( $args );

          ?>

          <?php if ( $wp_query->have_posts() ) : ?>
            <div class="row book-list">
              <h2><?php the_sub_field('list-header'); ?></h2>
              <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>

          <?php wp_reset_query(); ?>

      <?php endwhile; ?>

  <?php endif; ?>
