<?php
$term_list = wp_get_post_terms($post->ID, 'category_gallery');
foreach($term_list as $term_single) {
	if ($term_single->slug === 'destaque') :
		$featured = "<div class='featured' data-toggle='tooltip' data-placement='bottom' title='Destaque'><i class='fas fa-star'></i></div>";
	endif;
}

$list = get_query_var('list');
if ($list): ?>

	<div class="card list gallery gallery-<?php the_ID(); ?>">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="cover">
			<?php echo $featured; ?>
			<img src="<?php echo the_post_thumbnail_url(); ?>" alt="cover">
		</div></a>
	</div>

<?php else: ?>

	<div class="card gallery gallery-<?php the_ID(); ?>">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="cover">
			<?php echo $featured; ?>
			<img src="<?php echo the_post_thumbnail_url(); ?>" alt="cover">
			<div class="infos">
				<h5 class="mb-3"><?php echo the_title(); ?></h5>
				<div class="text-muted mb-3">
					<?php $content = wp_strip_all_tags( get_the_content() ); echo mb_strimwidth($content, 0, 100, '...');?>
				</div>
				<small class="text-muted mt-auto"><?php echo get_the_date(); ?></small>
			</div>
		</div></a>
		<div class="card-body py-3">
			<div class="w-100">
				<div class="card-text text-muted d-flex justify-content-end">
					<div class="user-avatar sm mr-2">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
					</div> 
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></a> 

					<span class="ml-auto text-muted d-flex justify-content-end"> 
						<span class="mr-3"><a href="<?php the_permalink(); ?>#comments"><i class="fas fa-comment-alt mr-1"></i> <?php echo get_comments_number(); ?></a></span> 
						<?php echo get_simple_likes_button( get_the_ID() ); ?>
					</span>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>