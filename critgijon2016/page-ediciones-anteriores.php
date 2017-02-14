<?php get_header(); ?>
<main class="site_content inner flex" role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section class="main_content" role="main">

			<header class="section_header">
				<h1 class="section_title"><?php the_title(); ?></h1>
				
				<?php if( has_post_thumbnail() ) { ?>
					<figure class="section_image">
						<?php the_post_thumbnail('full' );?>
					</figure>
				<?php } ?>
			</header>

			<article class="content <?php echo get_post_field('post_name') ?>">
				<?php the_content( ); ?>

				<?php
				$args = array(
					'post_type'       => 'page',
					'post_parent'     => $post->ID,
					'post_status'     => 'publish',
					'posts_per_page'  => '-1',
				);
				$childs_query = new WP_Query( $args );
				?>
				<?php if ( $childs_query->have_posts() ) : ?>
				<section class="editions flex">
				<?php while ( $childs_query->have_posts() ) : $childs_query->the_post()?>
						
					<?php get_template_part( 'content', 'editions' ); ?>
				<?php endwhile;?>
				<?php else :?>
				    <?php echo wpautop( 'En estos momentos no hay ningún artículo de Actualidad publicado.' ); ?>
				<?php endif;?>
				<?php wp_reset_query(); ?>
				</section>
			</article>
		</section>
	<?php endwhile; endif; ?>

	<?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>