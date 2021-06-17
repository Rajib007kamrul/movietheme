<?php
/* Template Name: Passport Page */
get_header(); ?>

<section class="gun-gallery">
  <div class="container">

    <h1>Passport Search</h1>

    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="">Area</label>
      <select name="passport_area" id="passport_area">
        <option value="">None</option>
        <option value="ctg">ctg</option>
        <option value="dhk">dhk</option>
        <option value="syl">syl</option>
        <option value="cumilla">cumilla</option>
      </select>
      <label for="">Gender</label>

      <select name="passport_gender" id="passport_gender">
        <option value="">None</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>

      <label for="">Service Type</label>

      <select name="passport_service" id="passport_service">
        <option value="">None</option>
        <option value="regular">regular</option>
        <option value="express">express</option>
      </select>

      <?php
      $passporttypes = get_terms( array(
        'taxonomy' => 'passporttype',
        'hide_empty' => false,
      ) );



      ?>

      <label for="">Passport Type</label>

      <select name="passport_type[]" id="passport_type">
        <option value="">None</option>
        <?php 
        foreach( $passporttypes as $passporttype ) { 
          ?>
        <option value="<?php  echo $passporttype->term_id; ?>"><?php echo $passporttype->name; ?></option>
        <?php } ?>
        <select>

          <input type="hidden" name="post_type" value="passport" />

          <button type=" submit">Search </button>
    </form>





    <div class="row">
      <?php

$args = array(
    'post_type' => 'passport',
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => 'passporttype',
    //         'field'    => 'id',
    //         'terms'    => 54
    //     )
    // )

    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'state',
            'value' => 'Wisconsin',
        ),
        array(
            'key' => 'city',
            'compare' => 'EXISTS',
        ), 
    )
);
// The Query
$the_query = new WP_Query( $args ); 
// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
    ?>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Passport Number</th>
            <th scope="col">Passport Comment </th>
            <th scope="col">Gender</th>
            <th scope="col">Area</th>
            <th scope="col">Service</th>
          </tr>
        </thead>
        <tbody>
          <?php  get_template_part( 'template-parts/content', 'passport'); ?>

        </tbody>
      </table>




      <?php     }
      } else {
      // no posts found
      }
      /* Restore original Post Data */
      wp_reset_postdata();
      ?>
    </div>
  </div>
  </div>
</section>

<?php get_footer(); ?>