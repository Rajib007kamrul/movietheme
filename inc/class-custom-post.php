<?php
// our custom post type function

function create_post_type() {
  
  register_post_type( 'passport',
    array( 
      'labels' => array(
        'name' => __('passport'),
        'singular_name' => _x( 'passport', 'Passport singular name', 'Passport' ),
        'description' => __('E-passport'),
        'add_new_item'          => __( 'Add New Passport', 'recipe' ),
      ),
      'public' => true,
      'has_archive'=> true,
      'rewrite' => array('slug' => 'Passport'),
      'supports'           => array( 'title' ),
      'show_in_rest' => true,
    )
  );

    $passporttypeargs = array(
        'label'             => __( 'Passport Type', 'textdomain' ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'passporttype' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'passporttype', 'passport', $passporttypeargs);

}

// Hooking up our function to theme setup
add_action( 'init', 'create_post_type' );


function add_custom_passport_meta() {
    
        add_meta_box(
            'add_custom_passport',                 // Unique ID
            'passport information',               // Box title
            'add_custom_passport_callback',      // Content callback, must be of type callable
            [ 'passport']             // Post type
        );
    }

add_action( 'add_meta_boxes', 'add_custom_passport_meta' );

function add_custom_passport_callback( $post ) {
  $name = get_post_meta( $post->ID, 'passport_name', true );
  $passport = get_post_meta( $post->ID, 'passport_number', true );
  $passport_comment= get_post_meta( $post ->ID, 'passport_comment', true);
  $passport_service= get_post_meta( $post ->ID, 'passport_service', false);
  $passport_gender = get_post_meta( $post->ID, 'passport_gender', true );
  $passport_area = get_post_meta( $post->ID, 'passport_area', false );
  
?>

<p>
  <label> name </label>
  <input type="text" name="passport_name" id="input" class="form-control" value="
  <?php echo $name; ?>
">
</p>
<p>
  <label> passport number </label>
  <input type="text" name="passport_number" id="input" class="form-control" value="
<?php echo $passport; ?>">
</p>
<p>
  <label> passport comments </label>
  <textarea rows="4" cols="50" name="passport_comment"> <?php echo $passport_comment; ?> </textarea>
</p>

<p>
  <label> Service<br></label>
  <input type="checkbox" id="regular" name="passport_service[]" value="regular"
    <?php if( !empty( $passport_service ) && in_array('regular', $passport_service) ) { echo "checked"; }  ?>>
  <label for="option1"> regular</label><br>
  <input type="checkbox" id="express" name="passport_service[]" value="express"
    <?php if( !empty( $passport_service ) && in_array('express', $passport_service) ) { echo "checked"; }  ?>>
  <label for="option2"> express</label><br>

</p>

<p>
  <label> Gender <br></label>

  <input type="radio" id="male" name="passport_gender" value="male" <?php checked('male', $passport_gender) ?>>
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="passport_gender" value="female" <?php checked('female', $passport_gender) ?>>
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="passport_gender" value="other">
  <label for="other">Other</label>
</p>

<label for="passport_area">Choose area</label>

<select name="passport_area[]" id="passport_area" multiple>
  <option value="">None</option>
  <!-- <option value="cumilla" <?php selected('cumilla', $passport_area); ?>> cumilla</option> -->
  <option value="cumilla" <?php if( in_array('cumilla',$passport_area) ) { echo "selected"; } ?>> cumilla</option>
  <option value="ctg" <?php if( in_array('ctg',$passport_area) ) { echo "selected"; } ?>>ctg</option>
  <option value="dhk" <?php if( in_array('dhk',$passport_area) ) { echo "selected"; } ?>>dhk</option>
  <option value="syl" <?php if( in_array('syl',$passport_area) ) { echo "selected"; } ?>>syl</option>
</select>

<?php }


function add_custom_passport_save( $post_id, $post ) {

  if( $post->post_type != 'passport ' || $post->post_type != 'movie' )  return ; 
  
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
}
// add_action( 'save_post', 'add_custom_passport_save', 10, 2 );


function passport_custom_columns_list($columns) {
    $columns['passport_gender']     = 'Gender';
    $columns['passport_comment']     = 'comment';
    $columns['passport_service']     = 'service';
    
    
    return $columns;
}

add_filter( 'manage_passport_posts_columns', 'passport_custom_columns_list' );



// let's say we have a CPT called 'product'
function passport_custom_column_values( $column, $post_id ) {

    switch ( $column ) {
        case 'passport_gender':
          echo get_post_meta( $post_id , 'passport_gender' , true );
        break;

        case 'passport_comment':
          echo get_post_meta( $post_id , 'passport_comment' , true );
        break;

        case 'passport_service':
          $service = get_post_meta( $post_id , 'passport_service' , true );
          if ( !empty( $service )) echo implode(" ", $service);
        break;
        
    }
}
add_action( 'manage_passport_posts_custom_column' , 'passport_custom_column_values', 10, 2 );



add_action( 'pre_get_posts', 'books_pre_get_posts');

function books_pre_get_posts( $query ) {
  if ( isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == 'passport'  ) {
    
    $tax_queries = [];
  
    if( !empty( $_GET['passport_type'] ) ) {
        $passport_type = $_GET['passport_type'];
        $tax_queries[] = [
            'taxonomy' => 'passporttype',
            'field' => 'id',
            'terms' => $passport_type,
            'include_children' => true
        ];
    }

    $count_tax_queries = count( $tax_queries );

    if ( $count_tax_queries ) {
        $tax_query = ( $count_tax_queries > 1 ) ? array_merge( array( 'relation' => 'AND' ), $tax_queries ) : $tax_queries;
      //  $query->set( 'tax_query', $tax_query );
    }

    $meta_queries = [];

    if( !empty( $_GET['passport_area'] ) ) {
    
        $passport_area = $_GET['passport_area'];
        
      $area_queries =  array(
                'key'     => 'passport_area',
                'value'   => $passport_area,
                'compare' => '=',
      );

      array_push($meta_queries, $area_queries);
      
    }

    if( !empty( $_GET['passport_gender'] ) ) {
    
        $passport_gender = $_GET['passport_gender'];

        $gender_queries =  array(
            'key'     => 'passport_gender',
            'value'   => $passport_gender,
            'compare' => '=',
        );

      array_push($meta_queries, $gender_queries);

    }

    if( !empty( $_GET['passport_service'] ) ) {
    
        $passport_service = $_GET['passport_service'];

        $service_queries =  array(
            'key'     => 'passport_service',
            'value'   => $passport_service,
            'compare' => '=',
        );

      array_push($meta_queries, $service_queries);

    }

    $count_meta_queries = count( $meta_queries );

      if( $count_meta_queries ) {
          if( $count_meta_queries > 1 ) {
          $relation = array( 'relation' => 'OR' );
          $meta_query = array_merge(  $relation, $meta_queries );
          } else {
            $meta_query = $meta_queries;
          }
          
          error_log(print_r($meta_query,true));
        
          $query->set( 'meta_query', $meta_query );
      }
    return $query;
  }

}