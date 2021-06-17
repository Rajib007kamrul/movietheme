<?php
/* Template Name: Add  Movie-form- Page */
get_header(); ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $movie_name = $_POST["movie_name"];
  $release_date = $_POST["release_date"];
  $movie_rate = $_POST["movie_rate"];
  $movie_genre = $_POST["movie_genre"];
  
  
  // Gather post data.
  $my_post = array(
      'post_type' => 'movie',
      'post_title'    => $movie_name,
      'post_status'   => 'publish',
  );
 
    // Insert the post into the database.
  $post_id = wp_insert_post( $my_post );
  
    if( !empty( $movie_genre )) {
      wp_set_post_terms( $post_id, $movie_genre, 'genre' );
    }
    


  if( isset( $_POST['release_date'] ) ) {
    $date = sanitize_text_field( $_POST['release_date'] );
    update_post_meta( $post_id, 'release_date', $date );
  }

   if( isset( $_POST['movie_rate'] ) ) {
    $rate = $_POST['movie_rate'];
    update_post_meta( $post_id, 'movie_rate', $rate );
  }
  

  // update_post

  echo $post_id;

  exit;
}

?>

<section class="movie-form">
  <div>
    <h2>Movie Form</h2>
    <form method="post">
      <p>
        <label for="name">Movie Name:</label><br>
        <input type="text" id="movie_name" name="movie_name" value=""><br>
        <label for="date">Release Date:</label><br>
        <input type="text" id="p" name="release_date" value=""><br>
        <label for="rate">Rate:</label><br>
        <input type="text" id="comment" name="movie_rate" value=""><br><br>
        <?php
      $terms = get_terms( array(
        'taxonomy' => 'genre',
        'hide_empty' => false,
      ) );
      ?>
        <label for=""> Movie Genree </label>
        <select name="movie_genre[]" id="movie_genre" multiple>
          <option value="">None</option>
          <?php  foreach($terms as $term ) { ?>
          <option value="<?php  echo $term->term_id; ?>"> <?php echo $term->name; ?></option>
          <?php } ?>
        </select> <br>
        <br> <input type="submit" value="Submit">
      </p>
    </form>
  </div>
</section>



<?php get_footer(); ?>