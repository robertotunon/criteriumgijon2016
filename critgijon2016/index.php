<?php get_header('home'); ?>

<main class="site_content inner flex">
	<section class="main_content home_news flex">
		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$args = array(
				'post_type'			=> 'post',
				'posts_per_page'	=> '4',
				'paged'				=> $paged,
			);
		    $homenews_query = new WP_Query( $args );
	    ?>

        <?php if ( $homenews_query->have_posts() ) : ?>
        <?php while ( $homenews_query->have_posts() ) : $homenews_query->the_post(); ?>
            <?php get_template_part( 'content', 'homenews' ); ?>
        <?php endwhile;?>

        <?php else :?>
            <?php echo wpautop( 'En estos momentos no hay ningún artículo de Actualidad publicado.' ); ?>
        <?php endif;?>

		<?php if (function_exists('vitamin_pagination')) {
			vitamin_pagination($actualidad_query->max_num_pages);
		} ?>
		<?php wp_reset_query(); ?>
	</section>
	
	<?php get_sidebar(); ?>

</main>


<?php get_footer(); ?>