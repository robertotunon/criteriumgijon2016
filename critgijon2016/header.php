<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <link href="<?php bloginfo( 'template_directory' ); ?>/img/criteriumgijon2016.ico" rel="icon" type="image/x-icon" />
    
    <meta name="Description" content="<?php bloginfo('description'); ?> ">
    
    <meta itemprop="image" content="<?php bloginfo( 'template_directory' ); ?>/img/criteriumgijon2016.jpg">
    
    <meta property="og:title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <meta property="og:description" content="<?php bloginfo('name'); ?>, <?php bloginfo('description'); ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php bloginfo('url'); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:image" content="<?php bloginfo( 'template_directory' ); ?>/img/criteriumgijon2016.jpg">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,700" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

    <?php if(is_page('contacto')) {
            if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
                wpcf7_enqueue_scripts();
            };
            if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
                wpcf7_enqueue_styles();
            };
        };
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(!empty($class) ? $class : null); ?>>
    <header class="site_header">
	    <section class="inner flex">
			<h1 class="site_title">
                <a href="<?php echo get_option('home'); ?>">
                    Criterium <span class="gijon">Gijón</span> <span class="year">2016</span>
                </a>
            </h1>
            
            <?php if ( is_active_sidebar( 'header_widgets' ) ) : 
                dynamic_sidebar( 'header_widgets' );
            endif; ?>
            
		</section>
		<section class="outter">
            <article class="event-info">
                <p class="thanks"><span class="serif">lots of</span> Thanks <span class="serif">to</span> everybody</p>
                <p class="next">See you next year!</p>
                
				<!-- <time class="date" datetime="2016-07-23">
					<span class="month">July</span> <span class="day">23</span><span class="ordinal">th</span>
				</time>
				<p class="address">Viesques <span class="campus">Campus</span></p>
				<p class="schedule">
				15:00 - WARM UP <br>
				17:30 - WOMEN’S RACE <br>
				19:00 - MEN’S RACE
				</p> -->
			</article>
		</section>

		<svg class="tapa tapa_down" viewBox="0 0 1920 250" preserveAspectRatio="none">
			<path d="M 1920,250 0,250 0,250 1920,0 z"></path>
		</svg>
	    <?php
        $main_menu = array(
            'theme_location'  => 'main_menu',
            'menu'            => '',
            'container'       => 'nav',
            'container_class' => 'main_nav',
            'menu_class'      => 'main_menu inner flex',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        );
        wp_nav_menu( $main_menu );
        ?>
    </header>