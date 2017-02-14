<?php
/**
 * Plantilla de contenidos para el listado de Sponsors
 */
	$custom_fields = get_post_custom();
?>
<li class="sponsor <?php echo $post->post_name; ?>">
	<figure>
    	<a href="<?php echo $custom_fields['enlace'][0];?>" alt="Sitio web de <?php echo the_title(); ?>" target="_blank">
    		<?php the_post_thumbnail('full'); ?>
    	</a>
	</figure>
</li>