<footer class="widget-area">
  <div class="wrap container">
    <div class="row">
      <div class="col-sm-6">
        <div class="row">
          <div class="col-md-6">
            <?php dynamic_sidebar('sidebar-footer-1'); ?>
          </div>
          <div class="col-md-6">
            <?php dynamic_sidebar('sidebar-footer-2'); ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-md-6">
            <?php dynamic_sidebar('sidebar-footer-3'); ?>
          </div>
          <div class="col-md-6">
            <?php dynamic_sidebar('sidebar-footer-4'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="content-info container" role="contentinfo">
  <p>© <?php echo date("Y"); ?> <a href="http://lesersøkerbok.no">Leser søker bok</a></p>
</div>

<?php wp_footer(); ?>
