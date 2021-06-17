<?php 
add_action( 'add_meta_boxes', 'custom_meta_post' );


function custom_meta_post() {
    add_meta_box(
        'custom_meta_post',                 // Unique ID
        'Custom Post Meta Title',      // Box title
        'custom_post_meta_callback',  // Content callback, must be of type callable
        [ 'post' ]                          // Post type
    );
}

function custom_post_meta_callback( $post ) {
   $name = get_post_meta( $post->ID, 'custom_meta_name', true );
   $passport = get_post_meta( $post->ID, 'passport_number', true );
?>

<label> name </label>
<input type="text" name="custom_meta_name" id="input" class="form-control" value="
  <?php echo $name; ?>
">

<label> passport number </label>
<input type="text" name="passport_number" id="input" class="form-control" value="
<?php echo $passport; ?>
">

<?php }


function custom_save_post_meta( $post_id, $post ) {

  if( $post->post_type != 'post ')  return ; 
  
  if( isset( $_POST['custom_meta_name'] ) ) {
    $name = sanitize_text_field( $_POST['custom_meta_name'] );
    update_post_meta( $post_id, 'custom_meta_name', $name );
  }
   if( isset( $_POST['passport_number'] ) ) {
    $passport = sanitize_text_field( $_POST['passport_number'] );
    update_post_meta( $post_id, 'passport_number', $passport );
  }

  
}
add_action( 'save_post', 'custom_save_post_meta', 10, 2 );