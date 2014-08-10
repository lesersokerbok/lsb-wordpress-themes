<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
<?php endif; ?>

<section class="book-search">
  <?php get_search_form(); ?>
</section>

<section class="loop">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
<?php endwhile; ?>
</section>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php roots_pagination(); ?>
  </nav>

<?php endif; ?>
