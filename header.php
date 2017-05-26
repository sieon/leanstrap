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
      <div class="container">
        <div class="text-center pb-2 pt-2">
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <?php wp_nav_menu(
  					array(
  						'theme_location'  => 'primary',
  						'container_class' => 'mr-auto',
  						'container_id'    => '',
  						'menu_class'      => 'navbar-nav nav-border mr-auto',
  						'fallback_cb'     => '',
  						'menu_id'         => 'main-nav',
  						'walker'          => new WP_Bootstrap_Navwalker(),
  					)
  				); ?>

          <form class="form-inline my-2 my-lg-0 float-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
            <input class="form-control mr-sm-2" type="text" placeholder="输入关键字" name="s">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">搜索</button>
          </form>
        </div>
      </div>
      <script>
      	jQuery(document).ready(function(){
      		jQuery('ul.navbar-nav').superfish();
      	});
      </script>
    </nav>
  </header><!-- ./header -->

  <main class="site-content">
  <!-- 上面是复用的头部 -->

  <!-- <div class="header-bg">

  </div> -->
