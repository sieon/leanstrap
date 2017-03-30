<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php wp_head(); ?>
</head>
<body <?php body_class( $class ); ?> >
  <header class="header">
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary" id="primary-navbar" role="navigation">

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="container">


      		<?php if ( get_theme_mod( 'logo', false ) ) { ?>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              <?php echo '<img src="' . esc_url( get_theme_mod( 'logo' ) ) . '">';?>
            </a>
      		<?php } else { ?>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              <?php bloginfo( 'name' ); ?>
            </a>
      		<?php } ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php
              $args = array('theme_location' => 'primary',
                      'container' => '',
                      //'container_class' => 'collapse navbar-collapse',
                      'menu_class' => 'navbar-nav',
                      'fallback_cb' => '',
                                  'menu_id' => 'main-menu',
                                  'walker' => new Upbootwp_Walker_Nav_Menu());
              wp_nav_menu($args);
          ?>
        </div>
      </div>
    </nav>
  </header><!-- ./header -->

  <main class="container site-content pt-2">
  <!-- 上面是复用的头部 -->
