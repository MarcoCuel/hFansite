<?php
	$user_id = get_post_meta(get_the_ID(), 'users', true);
	$user = get_user_by( 'id', $user_id );
	$name = $user->user_login;
?>

<div class="card featured-user">
	<div class="card-body">
		<div class="avatar pixel lg">
			<a href="<?php echo get_author_posts_url('', $name); ?>"><img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $name; ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php the_title(); ?>"></a>
		</div>

		<div class="content w-100">
			<h5><a class="text-inherit" href="<?php echo get_author_posts_url('', $name); ?>" data-toggle="tooltip" title="<?php echo $name; ?>"><?php echo $user->display_name; ?></a></h5>
			<div class="text-muted"><?php the_content(); ?></div>
		</div>
	</div>
</div>