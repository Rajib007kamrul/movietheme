<?php global $product; ?>
<div class="col-md-3">
  <?php 
        if( has_post_thumbnail() ) {
          the_post_thumbnail("woocommerce_thumbnail");
        }
      ?>
  <a href="">
    <img src="img/gun-gallery/IMG.png" alt="">
  </a>
  <h5> <?php the_title();  ?> <span> <br>Shortgun</span> <br><span class="price">
      <?php //echo $product->get_regular_price(); ?>
      <?php //echo $product->get_sale_price(); ?>
      <?php echo $product->get_price_html(); ?>
    </span></h5>

  <?php woocommerce_template_loop_add_to_cart(); ?>

</div>