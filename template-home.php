<?php
/* Template Name: Home Page */
get_header(); ?>


<!-- <section class="slider">
  <div class="container-fluid">
    <div class="bxslider">
      <div class="row">
        <div class="col-md-6">
          <h1 class="slider-title">Brand new Ak47 short Gun <br>
            <span> -20% Discount </span>
          </h1>
          <p> Lorem Ipsum is simply dummy text of the printing and
            typesetting industry Ipsum has been. </p>
          <a class="btn btn-primary" href="#">Order Now </a>
        </div>
        <div class="col-md-6">
          <a href=""> <img class="slider-image" src="img/image5.png" alt=""></a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <h1 class="slider-title">Brand new Ak47 short Gun 2 <br>
            <span> -20% Discount </span>
          </h1>
          <p> Lorem Ipsum is simply dummy text of the printing and
            typesetting industry Ipsum has been. </p>
          <a class="btn btn-primary" href="#">Order Now </a>
        </div>
        <div class="col-md-6">
          <a href=""> <img class="slider-image" src="img/image5.png" alt=""></a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <h1 class="slider-title">Brand new Ak47 short Gun 3 <br>
            <span> -20% Discount </span>
          </h1>
          <p> Lorem Ipsum is simply dummy text of the printing and
            typesetting industry Ipsum has been. </p>
          <a class="btn btn-primary" href="#">Order Now </a>
        </div>
        <div class="col-md-6">
          <a href=""> <img class="slider-image" src="img/image5.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<section class="gun">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="searchbar">
          <form class="search-form">
            <input type="text" name="search" id="search" placeholder="Find your weapon here" />
            <i class="fa fa-search" aria-hidden="true"> </i>
          </form>
        </div>
        <ul class="searchimg">
          <li>
            <a href=""> <img src="img/image 12.png" alt=""></a>
            <h5> Shotguns </h5>
          </li>
          <li>
            <a href=""> <img src="img/image 13.png" alt=""></a>
            <h5> Carbines </h5>
          </li>

          <li>
            <a href=""> <img src="img/image 14.png" alt=""></a>
            <h5> Machine guns </h5>
          </li>
          <li>
            <a href=""> <img src="img/image 15.png" alt=""></a>
            <h5> Sniper rifles </h5>
          </li>

          <li>
            <a href=""> <img src="img/image 15.png" alt=""></a>
            <h5> Automatic rifles </h5>
          </li>
          <li>
            <a href=""> <img src="img/image 14.png" alt=""></a>
            <h5> Assault rifles </h5>
          </li>
          <li>
            <a href=""> <img src="img/image 13.png" alt=""></a>
            <h5> Defense weapons </h5>
          </li>
          <li>
            <a href=""> <img src="img/image 11.png" alt=""></a>
            <h5> Hand guns </h5>
          </li>

        </ul>
      </div>
    </div>
  </div>
</section> -->

<?php // echo do_shortcode('[rajib_product]') ?>

<section class="gun-gallery">
  <div class="container">
    <div class="title">
      <h3>Gun</h3>
    </div>
    <div class="row owl-carousel">
      <?php
 
 $args = array(
    'post_type' => 'product',
);
// The Query
$the_query = new WP_Query( $args ); 
// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        global $product;
        get_template_part( 'template-parts/content', 'product');
    }
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
<!--
<section class="Rifles-gallery">
  <div class="container">
    <div class="title">
      <h3>Rifles </h3>
    </div>
    <div class="row owl-carousel">

      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun1.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun2.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun3.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun4.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>

      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun1.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun2.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun3.png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun4.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br> <span class="price"> Kr1200 </span></h5>
      </div>
    </div>
  </div>
  </div>
</section>
<section class="Discount">
  <div class="container">
    <div class="row">
      <div class="col-md-6">Discount0</div>
      <div class="col-md-6">Discount0</div>
    </div>
  </div>
</section>
<section class="optics">
  <div class="container">
    <div class="titel">
      <h3>optics</h3>
    </div>
    <div class="row owl-carousel">

      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (1).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (2).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (3).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (4).png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>

      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG.png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (1).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span> </h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (2).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (3).png" alt=""></a>
        <h5> centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/gun-gallery/IMG (4).png" alt=""></a>
        <h5> centerfire-pistol<span> <br>Shortgun</span> <br> <span class="price"> Kr1200 </span></h5>
      </div>
    </div>
  </div>
</section>
<section class="Weapons cabinets ">
  <div class="container">
    <div class="title">
      <h3>Weapons cabinets </h3>
    </div>
    <div class="row owl-carousel">

      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun.png" alt=""></a>
        <h5>centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun1.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun2.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun3.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun4.png" alt=""></a>
        <h5>centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>

      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun.png" alt=""></a>
        <h5>centerfire-pistol<span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>

      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun1.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun2.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun3.png" alt=""></a>
        <h5>centerfire-pistol <span> <br>Shortgun</span> <br><span class="price"> Kr1200 </span></h5>
      </div>
      <div class="col-md-3">
        <a href=""> <img src="img/Rifles/shotgun4.png" alt=""></a>
        <h5>centerfire-pistol<span> <br>Shortgun</span> <br> <span class="price"> Kr1200 </span></h5>
      </div>
    </div>
  </div>
  </div>
</section>
<section class="Felt">
  <div class="container">
    <div class="title">
      <h3>Felt & Våpen Depotet</h3>
    </div>
    <div class="row">
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/Rifles/shotgun1.png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/Rifles/shotgun2.png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/gun-gallery/IMG (1).png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/gun-gallery/IMG (2).png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/Rifles/shotgun3.png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
      <div class="col-md-4 felt-item">
        <a href=""> <img src="img/gun-gallery/IMG (4).png" alt=""></a>
        <h5>10 Pistol 20 Magazine DORO <span>Shortgun</span><br><span class="price">Kr 1200</span></h5>
      </div>
    </div>
  </div>
</section>
<section class="Newsletter">
  <div class="container">
    <div class="newsletter-title">
      <h3>Subscribe to Our Newsletter</h3>
      <p>Be the first to receive exclusive offers and news!</p>
    </div>

    <div class="row subscribe">
      <form action="" class="">
        <input type="text" name="Newsletter" id="Newsletter" placeholder="Enter your email">
        <button class="btn">Order Now</button>
      </form>
      <p>We work to give you the content you want in our newsletters, and if you no longer <br />
        want to receive them, you can easily unsubscribe.</p>
    </div>
</section> -->


<?php get_footer(); ?>