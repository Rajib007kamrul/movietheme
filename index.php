<?php get_header(); ?>

<?php 
if( have_posts() ):
  while(have_posts()): the_post(); 
  global $post;
  //echo "<pre>";
  // print_r( $post );
  $name = get_post_meta( $post->ID, 'custom_meta_name', true );
  $passport = get_post_meta( $post->ID, 'passport_number', true );
?>
<div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>); ">
  <div class="hero-content">
    <div class="hero-text">
      <h2><?php the_title(); ?></h2>
      <?php echo $name; ?>
      <?php echo $passport; ?>
    </div>
  </div>
</div>

<div class="main-content container">
  <main class="text-center content-text clear">
    <?php echo wp_trim_words( get_the_content(), 20, '....' ) 
    //the_content(); ?>
    <a href="<?php the_permalink(); ?>">Read More </a>
  </main>
</div>


<?php endwhile;

else:
    echo 'no post found';
endif;?>


<?php get_footer(); ?>