<div class="card event now event-<?php the_ID(); ?>">
	<div class="cover">
		<div class="date">
			<?php
				$event_date = get_post_meta( get_the_ID(), 'event_date', true );
				$event_time = get_post_meta( get_the_ID(), 'event_time', true );
				$event_time_end = get_post_meta( get_the_ID(), 'event_time_end', true );

				setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');

				$time = strtotime($event_date.' '.$event_time);

				$end_time = strtotime($event_date.' '.$event_time_end);

				echo '<div class="month">' . strftime('%h', $time) . '</div>';
				echo '<div class="day">' . strftime('%d', $time) . '</div>';
			?>
		</div>
		<img src="<?php echo the_post_thumbnail_url(); ?>" alt="cover">

		<div class="txt">Acontecendo</div>

		<div class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
	</div>
</div>