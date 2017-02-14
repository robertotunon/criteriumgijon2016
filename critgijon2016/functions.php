<?php
/**
 * @package WordPress
 * @subpackage CritGijon2016_Theme
 */

/*--------------------------------------*/
/* Añadiendo soporte y filtros para title
/*--------------------------------------*/
add_theme_support( 'title-tag' );

add_filter( 'document_title_separator', 'custom_title_separator' );
function custom_title_separator( $sep ) {
    $sep = "///";
    return $sep;
}

/*--------------------------------------*/
/* Limpiando wp_head
/*--------------------------------------*/
/*Removes RSD, XMLRPC, WLW, WP Generator, ShortLink and Comment Feed links*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head');
// remove_action( 'wp_head', 'feed_links', 2 ); 
// remove_action('wp_head', 'feed_links_extra', 3 );

/*Removes Emoji code*/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*Removes the REST API*/
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// Remove the annoying:
// <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style> added in the header
function remove_recent_comment_style() {
  global $wp_widget_factory;
  remove_action( 
            'wp_head', 
            array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) 
        );
}
add_action( 'widgets_init', 'remove_recent_comment_style' );


/*--------------------------------------*/
/* Añadiendo css a la cola
/*--------------------------------------*/
function critgijon2016_assets() {
  wp_enqueue_style( 'critgijon2016_styles', get_template_directory_uri() . '/css/critgijon2016.css' );
}
add_action( 'wp_enqueue_scripts', 'critgijon2016_assets' );


/*--------------------------------------*/
/* Desactivar HTML en los comentarios
/*--------------------------------------*/
add_filter('pre_comment_content', 'wp_specialchars');


/*--------------------------------------*/
/* Añadir jquery
/*--------------------------------------*/
// if( !is_admin()) {
//   wp_deregister_script('jquery');
//   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '');
//   wp_enqueue_script('jquery');
// }


/*-------------------------------------------------*/
/* Añadir thumbs a los posts y excerpt a las pages
/*-------------------------------------------------*/
add_action('init', 'my_custom_init');

function my_custom_init() {
  add_theme_support( 'post-thumbnails' );
  add_post_type_support( 'page', 'excerpt' );
}


/*--------------------------------------*/
/* Añadir menu
/*--------------------------------------*/
register_nav_menus( array(
  'main_menu' => 'Menú Principal',
  'social_menu' => 'Menú Redes Sociales',
) );


/*--------------------------------------*/
/* Añadir widget areas
/*--------------------------------------*/
register_sidebar( array (
  'name'      => __( 'header_widgets','att'),
  'id'      => 'header_widgets',
  'description' => __( 'Los widgets que pongas en este area se verán en la cabecera.','att' ),
  'before_widget' => '<aside class="header_widget %2$s clr">',
  'after_widget'  => '</aside>',
  'before_title'  => '',
  'after_title' => '',
) );

register_sidebar( array (
  'name'      => __( 'sidebar_widgets','att'),
  'id'      => 'sidebar_widgets',
  'description' => __( 'Los widgets que pongas en este area se verán en el sidebar general.','att' ),
  'before_widget' => '<aside class="sidebar_widget">',
  'after_widget'  => '</aside>',
  'before_title'  => '<h4 class="widget_title">',
  'after_title' => '</h4>',
) );



/*--------------------------------------*/
/* Longitud de los extractos
/*--------------------------------------*/

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 20 );

function excerpt_leermas() {
       global $post;
	return ' ...';
}
add_filter('excerpt_more', 'excerpt_leermas');


/*----------------------------------------------------*/
/* Paginación de posts vitaminada
/*----------------------------------------------------*/

function vitamin_pagination($pages = '', $range = 4) {  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages){
             $pages = 1;
         }
     }   
 
     if(1 != $pages){
         echo "<nav class='pagination'>";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++){
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";

         echo "</nav>";
     }
}

/*--------------------------------------*/
/* Nube de etiquetas
/*--------------------------------------*/
function custom_tag_cloud($defaults) {
  $args = array(
    'smallest' => .9,
    'largest' => .9,
    'unit' => 'em',
    'number' => 25,
    'format' => 'flat',
    'separator' => "\n",
    'orderby' => 'count',
    'order' => 'ASC',
    'exclude' => '',
    'include' => '',
    'link' => 'view',
    'taxonomy' => 'post_tag',
    'echo' => true
  );
  $args = wp_parse_args( $args, $defaults );
  $tags = get_terms( $args['taxonomy'], array_merge( $args, array( 'orderby' => 'count', 'order' => 'DESC' ) ) ); // Always query top tags

  if ( empty( $tags ) )
    return;
    foreach ( $tags as $key => $tag ) {
      if ( 'edit' == $args['link'] )
        $link = get_edit_tag_link( $tag->term_id, $args['taxonomy'] );
      else
        $link = get_term_link( intval($tag->term_id), $args['taxonomy'] );
      if ( is_wp_error( $link ) )
        return false;
    $tags[ $key ]->link = $link;
    $tags[ $key ]->id = $tag->term_id;
  }

  $return = wp_generate_tag_cloud( $tags, $args ); // Here's where those top tags get sorted according to $args

  $return = apply_filters( 'my_tag_cloud', $return, $args );

  if ( 'array' == $args['format'] || empty($args['echo']) )
    return $return;

  echo $return;
}
add_filter('wp_tag_cloud', 'custom_tag_cloud');


/*--------------------------------------*/
/* Retocando las Galerías
/*--------------------------------------*/
/*
 * @param array $atts El array de salida para los atributos del shortcode.
 * @return array HTML5-ificado de los atributos de galería.
 */
function prefix_gallery_atts( $atts ) {
    $atts['itemtag']    = 'div';
    $atts['icontag']    = 'figure';
    $atts['captiontag'] = 'figcaption';
 
    return $atts;
}
add_filter( 'shortcode_atts_gallery', 'prefix_gallery_atts' );


// function include_thickbox_scripts()
// {
//     // include the javascript
//     wp_enqueue_script('thickbox', null, array('jquery'));

//     // include the thickbox styles
//     wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
// }
// add_action('wp_enqueue_scripts', 'include_thickbox_scripts');


/*--------------------------------------*/
/* Mejorando el Embed de videos
/*--------------------------------------*/
function responsive_video($html, $url, $attr, $post_id) {
  return '<div class="video_container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'responsive_video', 99, 4);

// customize embed settings
function custom_youtube_settings($code){
  if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
    $return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1", $code);
    return $return;
  }
  return $code;
}
add_filter('embed_oembed_html', 'custom_youtube_settings');

// register the shortcode to wrap html around the content
// function responsive_video_shortcode( $atts ) {
//     extract( shortcode_atts( array (
//         'identifier' => ''
//     ), $atts ) );
//     return '<div class="video_container"><iframe src="//www.youtube.com/embed/' . $identifier . '" height="240" width="320" allowfullscreen="" frameborder="0"></iframe></div>';
// }
// add_shortcode ('responsive-video', 'responsive_video_shortcode' );



/*--------------------------------------*/
/* Contact Form 7 sin css ni js
/*--------------------------------------*/
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

?>