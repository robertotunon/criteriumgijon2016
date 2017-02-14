<?php get_header(); ?>

<main class="site_content inner flex" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <section class="main_content">
        <header class="section_header">
            <h1 class="section_title"><?php the_title(); ?></h1>
            <?php if( has_post_thumbnail() ) { ?>
                <figure class="section_image"><?php the_post_thumbnail('full');?></figure>
            <?php } ?>
        </header>
        <article class="content">
            <?php the_content( ); ?>
        </article>
    </section>
    
    <?php endwhile; endif; ?>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>