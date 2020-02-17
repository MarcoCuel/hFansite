<?php

$amount = 5;

global $wpdb;
$results = $wpdb->get_results('
	SELECT
	COUNT(comment_author_email) AS comments_count, comment_author_email, comment_author, comment_author_url, user_id
	FROM '.$wpdb->comments.'
	WHERE comment_author_email != "" AND comment_type = "" AND comment_approved = 1
	GROUP BY comment_author_email
	ORDER BY comments_count DESC, comment_author ASC
	LIMIT '.$amount
); ?>

<ul class='rank'>
	<?php foreach($results as $result) { ?>
		<li>
			<?php
				$user = get_user_by( 'id', $result->user_id );
				$name = $user->user_login;
			?>
			<div class="avatar pixel lg">
				<a href="<?php echo get_author_posts_url('', $name); ?>"><img src="https://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $name; ?>&action=std&direction=2&head_direction=2&img_format=png&gesture=std&headonly=0&size=b" alt="<?php the_title(); ?>"></a>
			</div>
			<div class="content">
				<h6 class='mb-1'>
					<a class="text-inherit" href="<?php echo get_author_posts_url('', $name); ?>" data-toggle="tooltip" title="<?php echo $name; ?>"><?php echo $user->display_name; ?></a>
				</h6>
				<div class="text-muted">
					<strong><?php echo $result->comments_count ?></strong> comentários
				</div>
			</div>
		</li>
	<?php } ?>
</ul>