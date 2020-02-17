<div class="card topic topic-<?php the_ID(); ?>">
	<div class="card-body">
		<div class="avatar pixel lg mr-3">
			<img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo get_the_author_meta('user_login'); ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php echo get_the_author_meta('user_login'); ?>">
		</div>
		<div class="content">
			<h5 class="card-title mb-2 text-ellipsis"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
			<div class="card-text"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" data-toggle="tooltip" title="<?php echo get_the_author_meta('user_login'); ?>"><?php echo get_the_author(); ?></a> <span class="ml-auto text-muted"><i class="far fa-eye ml-3 mr-1"></i> <?php echo getPostViewsClean(get_the_ID()); ?> <a href="<?php the_permalink(); ?>#comments"><i class="far fa-comment-alt ml-3 mr-1"></i> <?php echo get_comments_number(); ?></a></span></div>
		</div>
	</div>
</div>