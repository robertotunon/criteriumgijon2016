<section class="sponsors outter">
        <svg class="tapa tapa_up" viewBox="0 0 1920 250" preserveAspectRatio="none">
            <path d="M 1920,10 0,250 0,0 1920,0 z"></path>
        </svg>
        
        <header class="section_header">
            <h1 class="section_title">Sponsors</h1>
        </header>
        <ul class="inner flex">
            <?php
                $args = array(
                    'post_type'         => 'sponsors',
                    'posts_per_page'    => '-1',
                );
                $sponsors_query = new WP_Query( $args );
            ?>

            <?php if ( $sponsors_query->have_posts() ) : ?>
            <?php while ( $sponsors_query->have_posts() ) : $sponsors_query->the_post(); ?>
                <?php get_template_part( 'content', 'sponsors' ); ?>
            <?php endwhile;?>

            <?php else :?>
                <?php echo wpautop( 'Aún no hay ningún sponsor publicado para esta edición.' ); ?>
            <?php endif;?>

            <?php wp_reset_query(); ?>
        </ul>

        <svg class="tapa tapa_down" viewBox="0 0 1920 250" preserveAspectRatio="none">
            <path d="M 1920,250 0,250 0,250 1920,0 z"></path>
        </svg>
    </section>
    <footer class="site_footer">
        <section class="credits inner flex">
            <p class="credits_info santacat">An event by: <a href="http://santacatalina.cc" target="_blank">Santa Catalina</a></p>
            
            <p class="credits_info">Website made with <a href="http://wordpress.org" target="_blank">WordPress</a> · Design by: <a href="http://robertotunon.com" target="_blank">roberto tuñón</a></p>
            
            <p class="credits_logo"><a href="<?php echo get_option('home'); ?>">Criterium Gijón</a></p>
        </section>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>