<?php
// our custom post type function

function create_post_type_movie() {

  register_post_type( 'movie',
    array( 
      'labels' => array(
        'name' => __('movie'),
        'singular_name' => _x( 'movie', 'movie singular name', 'Passport' ),
        'description' => __('movie'),
        'add_new_item'          => __( 'Add New movie', 'recipe' ),
      ),
      'public' => true,
      'has_archive'=> true,
      'rewrite' => array('slug' => 'movie'),
      'supports'           => array( 'title' ),
      'show_in_rest' => true,
    )
  );

  $genreargs = array(
      'label'             => __( 'Genre', 'textdomain' ),
      'hierarchical'      => true,
      'public'            => true,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'genre' ),
      'show_in_rest'      => true,
  );

  register_taxonomy( 'genre', 'movie', $genreargs );


    $movieclass = array(
        'label'             => __( 'Movie Class', 'textdomain' ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'ratting' ),
        'show_in_rest'      => true,
    );


  register_taxonomy( 'movieclass', 'movie', $movieclass );
    
  
}

// Hooking up our function to theme setup
add_action( 'init', 'create_post_type_movie' );


function add_custom_movie_meta() {
    
        add_meta_box(
            'add_custom_movie',            // Unique ID
            'movie information',           // Box title
            'add_custom_movie_callback',   // Content callback, must be of type callable
            [ 'movie']           // Post type
        );
    }

add_action( 'add_meta_boxes', 'add_custom_movie_meta' );

// callback


function add_custom_movie_callback( $post ) {
  $Release = get_post_meta( $post->ID, 'release_date', true );
  $Rate = get_post_meta( $post->ID, 'movie_rate', true );
  
?>

<p>
  <label> Release Date </label>
  <input type="text" name="release_date" id="jquery-datepicker" class=" form-control" value="
  <?php echo $Release; ?>
">
</p>
<p>
  <label> Rate </label>
  <input type="text" name="movie_rate" id="input" class="form-control" value="
  <?php echo $Rate; ?>
">
</p>

<?php 
wp_add_inline_script( 'jquery-ui-datepicker', '(function($) {
  $(\'#jquery-datepicker\').datepicker();
}(jQuery));' );
}

// callback


// save_post


function add_custom_movie_meta_save($post_id, $post){


  
  if(  $post->post_type != 'movie' )  return ; 

  if( isset( $_POST['release_date'] ) ) {
    $Release = sanitize_text_field( $_POST['release_date'] );
    update_post_meta( $post_id, 'release_date', $Release );
  }
  if( isset( $_POST['movie_rate'] ) ) {
    $Rate = sanitize_text_field( $_POST['movie_rate'] );
    update_post_meta( $post_id, 'movie_rate', $Rate );
  }
} 

add_action( 'save_post', 'add_custom_movie_meta_save', 10, 2 );

// save_post


function hkdc_admin_styles() {
  wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
}
add_action('admin_print_styles', 'hkdc_admin_styles');
function hkdc_admin_scripts() {
  wp_enqueue_script( 'jquery-ui-datepicker' );

  // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
    wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );
}
add_action('admin_enqueue_scripts', 'hkdc_admin_scripts');

// add date 

function movie_custom_columns_list($columns) {
    $columns['release_date']     = 'Release';
    $columns['movie_rate']     = 'Rate';
    
    return $columns;
}

add_filter( 'manage_movie_posts_columns', 'movie_custom_columns_list' );

// add date

// let's say we have a CPT called 'product'
function movie_custom_column_values( $column, $post_id ) {

    switch ( $column ) {
        case 'release_date':
          echo get_post_meta( $post_id , 'release_date' , true );
        break;

        case 'movie_rate':
          echo get_post_meta( $post_id , 'movie_rate' , true );
        break;
    }
}
add_action( 'manage_movie_posts_custom_column' , 'movie_custom_column_values', 10, 2 );



add_action( 'pre_get_posts', 'movie_pre_get_posts');

function movie_pre_get_posts( $query ) {
  if ( isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] == 'movie'  ) {
  
    $tax_queries = [];
    
    if( !empty( $_GET['movie_genre'] ) ) {
        
        $movie_genre = $_GET['movie_genre'];
        
        $genre_queries = array(
          'taxonomy' => 'genre',
          'field'    => 'id',
          'terms'    => $movie_genre 
      );

      array_push( $tax_queries, $genre_queries );
    }

  if( !empty( $_GET['movie_class'] ) ) {
        
        $movie_class = $_GET['movie_class'];
        
        $class_queries =  array(
            'taxonomy' => 'movieclass',
            'field'    => 'id',
            'terms'    => $movie_class
        );

        array_push( $tax_queries, $class_queries );
    }

          $count_tax_queries = count( $tax_queries );

    if( $count_tax_queries ) {
          if( $count_tax_queries > 1 ) {
          $relation = array( 'relation' => 'AND' );
          $tax_query = array_merge(  $relation, $tax_queries );
          } else {
            $tax_query = $tax_queries;
          }
          
          error_log(print_r($tax_query,true));
        
          $query->set( 'tax_query', $tax_query );
      }

    
    // meta_queries
    
    $meta_queries = [];
    
    if( !empty( $_GET['movie_release'] ) ) {
    
        $movie_release = $_GET['movie_release'];
        
      $release_queries =  array(
                'key'     => 'release_date',
                'value'   => $movie_release,
                'compare' => '=',
      );

      array_push($meta_queries, $release_queries);
      
    }

    if( !empty( $_GET['movie_rate'] ) ) {
      
        $rate = $_GET['movie_rate'];
      
        $rate_queries = array(
            array(
                'key'     => 'movie_rate',
                'value'   => $rate,
                'compare' => '=',
            )
        );
          array_push($meta_queries, $rate_queries);
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

  }
    
  
  return $query;
 }