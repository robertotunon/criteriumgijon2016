<?php get_header(); ?>

<main class="site_content inner flex" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <section class="main_content">
        <header class="single_header">
            <h1 class="single_title"><?php the_title(); ?></h1>
            <time class="date"><?php the_time( get_option( 'date_format' ) ); ?></time>
        </header>
        <article class="content">
            <?php the_content( ); ?>
        </article>
    </section>

    <?php endwhile; endif; ?>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>