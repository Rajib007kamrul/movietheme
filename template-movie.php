<?php
/* Template Name: Add  Movie Page */
get_header(); ?>

<h1>Movie Search</h1>

<?php
      $terms = get_terms( array(
        'taxonomy' => 'genre',
        'hide_empty' => false,
      ) );

      $movieclassterms = get_terms( array(
        'taxonomy' => 'movieclass',
        'hide_empty' => false,
      ) );
      ?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for=""> Movie Genree </label>
  <select name="movie_genre[]" id="movie_genre">
    <option value="">None</option>
    <?php  foreach($terms as $term ) { ?>
    <option value="<?php  echo $term->term_id; ?>"> <?php echo $term->name; ?></option>
    <?php } ?>
  </select>

  <label for=""> Movie class </label>
  <select name="movie_class" id="movie_class">
    <option value="">None</option>

    <?php  foreach($movieclassterms as $term ) { ?>
    <option value="<?php  echo $term->term_id; ?>"> <?php echo $term->name; ?></option>
    <?php } ?>

  </select>
  <label for=""> Release Date </label>
  <select name="movie_release" id="movie_release">
    <option value=""> None</option>
    <option value="2021"> 2021</option>
    <option value="2020"> 2020</option>
    <option value="2019"> 2019</option>
    <option value="2018"> 2018</option>
    <option value="2017"> 2017</option>
    <option value="2016"> 2016</option>
    <option value="2015"> 2015</option>
  </select>

  <label for=""> Rate </label>
  <select name="movie_rate" id="movie_rate">
    <option value=""> None</option>
    <option value="5"> 5</option>
    <option value="4"> 4</option>
    <option value="3"> 3</option>
    <option value="3"> 2</option>
    <option value="1"> 1</option>
    <option value="0"> 0</option>
  </select>
  <br>
  <input type="hidden" name="post_type" value="movie" />
  <input type="submit" value="Search">
</form>

<section>
  <div>
    <h2>Movie 2021</h2>
  </div>
  <div class="row">
    <Table class="table">
      <thead>
        <tr>
          <th>Movie Name</th>
          <th>Release Date</th>
          <th>Hollywood</th>
          <th>Bollywood</th>
          <th>tamil</th>
          <th>chinese</th>
          <th>Rate</th>
          <th>Movie Class</th>
        </tr>
      </thead>
      <tbody>
        <?php

$args = array(
    'post_type'  => 'movie',
    // 'meta_query' =>  array(
    //     'relation' => 'AND',
    //     array(
    //       'key'     => 'movie_rate',
    //       'value'   => 5,
    //       'compare' => '=',
    //     ),

    //     array(
    //       'key'     => 'release_date',
    //       'value'   => 2021,
    //       'compare' => '='
    //     ),
    // )
);
// The Query
$the_query = new WP_Query( $args ); 
// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        global $post;
        $Release = get_post_meta($post->ID,'release_date',true);
        $Rate    = get_post_meta($post->ID,'movie_rate',true);

        $gernreis = wp_get_post_terms( $post->ID, 'genre',array( 'fields' => 'names' ) );
        $movieclass = wp_get_post_terms( $post->ID, 'movieclass',array( 'fields' => 'names' ) );
        
        // echo "<pre>";
        // print_r( $gernreis);
        
        ?>

        <tr>
          <td><?php echo get_the_title(); ?> </td>
          <td><?php echo  $Release ; ?> </td>
          <td>
            <?php if( !empty( $gernreis ) && in_array('Hollywood', $gernreis) ) { echo "Yes"; } else { echo 'N/A';} ?>
          </td>
          <td><?php if( !empty( $gernreis ) && in_array('Bollywood', $gernreis) ) { echo "Yes"; } else { echo 'N/A';} ?>
          </td>
          <td><?php if( !empty( $gernreis ) && in_array('tamil', $gernreis) ) { echo "Yes"; } else { echo 'N/A';} ?>
          </td>
          <td><?php if( !empty( $gernreis ) && in_array('chinese', $gernreis) ) { echo "Yes"; } else { echo 'N/A';} ?>
          </td>
          <td><?php echo  $Rate ; ?>
          </td>
          <td>
            <?php echo implode(",",$movieclass); ?>
          </td>
        </tr>

        <?php     }
      } else {
      // no posts found
      }
      /* Restore original Post Data */
      wp_reset_postdata();
      ?>



      </tbody>
    </Table>
  </div>
</section>

<?php get_footer(); ?>