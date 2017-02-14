<article class="item flex">
	<figure class="post_image">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('medium'); ?>
		</a>
	</figure>
	<section class="post_excerpt">
		<h1 class="title">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
		<p class="excerpt"><?php the_excerpt(); ?></p>
	</section>
</article>