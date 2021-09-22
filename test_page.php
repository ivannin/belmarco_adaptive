<?php
/**
 * Template Name: Для теста
 */
get_header(); ?>
<div class="row">
  <div class="col-sm-3 col-xs-6">
    <?php 
    if (extension_loaded('soap')) {
     echo 'ok';
    }else{
      echo 'none';
    }
    ?>
  </div>
</div>

<?php
get_footer();