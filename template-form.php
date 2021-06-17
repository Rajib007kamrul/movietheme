<?php
/* Template Name: Add  Passport Page */
get_header(); ?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $passport_name = $_POST["passport_name"];
  $passport_number = $_POST["passport_number"];
  $passport_comment = $_POST["passport_comment"];
  $passport_service = $_POST["passport_service"];
  $passport_gender = $_POST["passport_gender"];
  $passport_area = $_POST["passport_area"];

  $passport_type = $_POST['passport_type'];

  
  // Gather post data.
  $my_post = array(
      'post_type' => 'passport',
      'post_title'    => $passport_name,
      'post_status'   => 'publish',
  );
 
    // Insert the post into the database.
  $post_id = wp_insert_post( $my_post );

    if( !empty( $passport_type )) {
      wp_set_post_terms( $post_id, $passport_type, 'passporttype' );
    }
    
  if( isset( $_POST['passport_name'] ) ) {
    $name = sanitize_text_field( $_POST['passport_name'] );
    update_post_meta( $post_id, 'passport_name', $name );
  }
  
  if( isset( $_POST['passport_number'] ) ) {
    $passport = sanitize_text_field( $_POST['passport_number'] );
    update_post_meta( $post_id, 'passport_number', $passport );
  }

   if( isset( $_POST['passport_service'] ) ) {
    $passport_service = $_POST['passport_service'];
    update_post_meta( $post_id, 'passport_service', $passport_service );
  }
  
  if( isset( $_POST['passport_gender'] ) ) {
    $passport_gender = sanitize_text_field( $_POST['passport_gender'] );
    update_post_meta( $post_id, 'passport_gender', $passport_gender );
  }

  if( isset( $_POST['passport_area'] ) ) {
    $passport_area = $_POST['passport_area'];
    update_post_meta( $post_id, 'passport_area', $passport_area );
  }
  
  if( isset( $_POST['passport_comment'] ) ) {
    $name = sanitize_text_field( $_POST['passport_comment'] );
    update_post_meta( $post_id, 'passport_comment', $name );
  }

  // update_post

  echo $post_id;

  exit;
}

?>


<section class="form">
  <div>
    <h2>Contact Form</h2>
    <form method="post">

      <p>
        <label for="fname">Passport name:</label><br>
        <input type="text" id="passport_name" name="passport_name" value=""><br>
        <label for="passport">Passport Number:</label><br>
        <input type="text" id="p" name="passport_number" value=""><br>
        <label for="lname">comment:</label><br>
        <input type="text" id="comment" name="passport_comment" value=""><br><br>
      </p>

      <?php

      $terms = get_terms( array(
        'taxonomy' => 'passporttype',
        'hide_empty' => false,
      ) );

      print_r($terms);
      
      ?>
      <label for=""> Passport Type </label>
      <select name="passport_type[]" id="passport_type" multiple>
        <option value="">None</option>
        <?php  foreach($terms as $term ) { ?>
        <option value="<?php  echo $term->term_id; ?>"> <?php echo $term->name; ?></option>
        <?php } ?>
      </select>


      <p>
        <label> Service</label><br>
        <input type="checkbox" id="regular" name="passport_service[]" value="regular">
        <label for="regular"> regular</label><br>
        <input type="checkbox" id="express" name="passport_service[]" value="express">
        <label for="express"> express</label><br>

      </p>
      <p>
        <label> Gender </label><br>

        <input type="radio" id="male" name="passport_gender" value="male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="passport_gender" value="female">
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="passport_gender" value="other">
        <label for="other">Other</label>
      </p>
      <label for="passport_area">Choose area</label>

      <select name="passport_area" id="passport_area">

        <option value="">None</option>

        <option value="cumilla"> cumilla</option>
        <option value="ctg">ctg</option>
        <option value="dhk">dhk</option>
        <option value="syl">syl</option>

      </select><br>
      <input type="submit" value="Submit">

    </form>
  </div>
</section>



<?php get_footer(); ?>