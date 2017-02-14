<article class="item edition">
	<?php if( has_post_thumbnail() ) { ?>
		<figure class="section_image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('thumb');?>
			</a>
		</figure>
	<?php } ?>
	<section class="post_excerpt">
		<h1 class="title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
	</section>
</article>