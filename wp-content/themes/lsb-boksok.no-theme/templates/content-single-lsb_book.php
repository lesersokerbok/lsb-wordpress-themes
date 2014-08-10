<article <?php post_class('full'); ?>>
  <div class="entry-content">
    <header>
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <p class="meta">
        <?php if(get_the_terms($post->ID, 'lsb_tax_author')): ?>
          Forfatter: <?php the_terms($post->ID, 'lsb_tax_author') ?>
          <br/>
        <?php endif; ?>

        <?php if(get_the_terms($post->ID, 'lsb_tax_illustrator')): ?>
          Illustratør: <?php the_terms($post->ID, 'lsb_tax_illustrator') ?>
          <br/>
        <?php endif; ?>

        <?php if(get_the_terms($post->ID, 'lsb_tax_translator')): ?>
          Oversetter: <?php the_terms($post->ID, 'lsb_tax_translator') ?>
          <br/>
        <?php endif; ?>

        <?php if(get_the_terms($post->ID, 'lsb_tax_publisher')): ?>
          Forlag: <?php the_terms($post->ID, 'lsb_tax_publisher') ?>
          <br/>
        <?php endif; ?>
      </p>
    </header>
    <p><?php the_field('lsb_review'); ?></p>
    <?php if(get_field('lsb_quote')): ?>
      <blockquote><?php the_field('lsb_quote'); ?></blockquote>
    <?php endif; ?>
    <p class="meta">
      ISBN: <?php the_field('lsb_isbn'); ?><br/>
      Utgitt: <?php the_field('lsb_published_year'); ?><br/>
      Antall sider: <?php the_field('lsb_pages'); ?><br/>
      Passer for: <?php the_terms($post->ID, 'lsb_tax_age') ?>
    </p>
  </div>
  <div class="entry-image">
    <?php if ( has_post_thumbnail() && get_field('lsb_look_inside')): ?>
      <a href="<?php the_field('lsb_look_inside'); ?>" target="_blank"><?php the_post_thumbnail('large'); ?></img></a>
    <?php elseif (has_post_thumbnail()): ?>
      <?php the_post_thumbnail('large'); ?></img>
    <?php else: ?>
      <img src="http://dummyimage.com/300x450/eeeeee/eeeeee.jpg"></img>
    <?php endif; ?>
  </div>
  <footer>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
  </footer>
</article>
