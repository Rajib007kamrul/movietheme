<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;1,100;1,200&display=swap"
    rel="stylesheet">
  <title>Weapon-Project</title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <!-- <select class="language-switcher">
            <option value="en"> English </option>
            <option value="bd"> Bangla </option>
          </select> -->
        </div>
        <div class="col-md-6">
          <!-- <ul class="top-right-nav">
            <li> <a href="">Contact</a> <i class="fa fa-arrow-up" aria-hidden="true"></i> </li>
            <li><a href="">Help</a> <i class="fa fa-arrow-up" aria-hidden="true"></i></li>
            <li> <a href="">Settings</a><i class="fa fa-arrow-up" aria-hidden="true"></i></li>
          </ul> -->

          <?php

            $args = array(
              'theme_location' => 'top-menu',
              'container' 	 => 'ul',
              'menu_class'=>	'top-right-nav',

            );

            wp_nav_menu($args);

			    ?>

        </div>
      </div>

      <div class="row">
        <div class="col-md-2">
          <div class="header-logo">
            <ul class="logo">
              <a href="<?php echo esc_url( home_url('/') ) ; ?>">
                <?php
              if(function_exists('the_custom_logo')) {
                the_custom_logo();
              }
                ?>
                <!-- <img src="<?php echo get_template_directory_uri() ?>img/logo.png" class="logoimage"> -->
              </a>
            </ul>
          </div>
        </div>
        <div class="col-md-6">

          <?php

				$args = array(
					'theme_location' => 'main-menu',
					'container' 	 => 'ul',
					'menu_class'=>	'main-menu',

				);

				wp_nav_menu($args);

			?>

        </div>
        <div class="col-md-4">
          <div class="login-container">
            <a class="login-btn">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
              Login </a>
          </div>
        </div>
      </div>
    </div>
  </section>