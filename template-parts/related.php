
<?php $orig_post = $post;
global $post;
	$categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

$args=array(
	'category__in' => $category_ids,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> 3, // Number of related posts that will be shown.
	'caller_get_posts'=>1,
	'orderby' => 'rand'
);

$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
	echo '<div class="swiper-container related">';
	echo '<div class="swiper-wrapper">';
while( $my_query->have_posts() ) {
$my_query->the_post();?>
	<div class="swiper-slide">
		<?php get_template_part( 'template-parts/card-news') ?>
	</div>
<?
	}
		echo '</div>';
		echo '</div>';
	}
}
$post = $orig_post;
wp_reset_query(); ?>