<div class="person panel panel-default">
  <div class="panel-body">
    <?php if ( get_field( "lsb_custom_field_person_photo" ) ): ?>
      <img class="above" src="<?php the_field('lsb_custom_field_person_photo') ?>" />
    <?php endif; ?>
    <h2>
      <?php if ( is_archive() ): ?>
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      <?php else: ?>
        <?php echo roots_title(); ?>
      <?php endif; ?>
    </h2>
    <?php if ( get_field( "lsb_custom_field_person_company" ) ): ?>
      <h3>
        <?php the_field( "lsb_custom_field_person_company" ); ?>
      </h3>
    <?php endif; ?>
    <p class="contact-info">
        <?php if( get_field( "lsb_custom_field_person_email" ) ): ?>
          <span class="sr-only"><?php __('E-post:', 'lsb_main'); ?></span> <?php the_field( "lsb_custom_field_person_email" ); ?><br/>
        <?php endif; ?>
        <?php if( get_field( "lsb_custom_field_person_phone" ) ): ?>
          <span class="sr-only"><?php __('Telefon:', 'lsb_main'); ?></span> <?php the_field( "lsb_custom_field_person_phone" ); ?>
          <?php if( get_field( "lsb_custom_field_person_mobile" ) ): ?>
            <span aria-hidden="true">/</span>
          <?php endif ?>
        <?php endif; ?>
        <?php if( get_field( "lsb_custom_field_person_mobile" ) ): ?>
          <span class="sr-only"><?php __('Mobil:', 'lsb_main'); ?></span> <?php the_field( "lsb_custom_field_person_mobile" ); ?>
        <?php endif; ?>
    </p>

    <?php if( get_field( "lsb_custom_field_person_bio") ): ?>
      <p>
        <?php the_field( "lsb_custom_field_person_bio"); ?>
      </p>
    <?php endif; ?>

    <?php if ( get_field( "lsb_custom_field_person_links") ): ?>
      <?php $links = get_field( "lsb_custom_field_person_links"); ?>
      <ul>
        <?php foreach($links as $link): ?>
          <li><a href="<?php echo $link['url'] ?>"><?php echo $link['tag'] ?></a></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if ( get_field( "lsb_custom_field_person_photo" ) ): ?>
      <img class="below" src="<?php the_field('lsb_custom_field_person_photo') ?>" />
    <?php endif; ?>
  </div>
</div>