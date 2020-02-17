// WP_Query arguments
$args = array(
    'posts_per_page'    => 3,
    'post_type'     => 'post',  //choose post type here
    'order' => 'DESC',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
?>
        <!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <!-- post thumbnail -->
    <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="h-entry__image-link">
            <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
        </a>
    <?php endif; ?>
    <!-- /post thumbnail -->

    <!-- post title -->
    <h2 class="p-name">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h2>
    <!-- /post title -->

    <!-- post details -->
    <time datetime="<?php the_time('Y-m-j'); ?>" class="dt-published"><?php the_time('jS F Y'); ?></time>
    <!-- /post details -->

    <?php html5wp_summary('html5wp_index'); // Build your custom callback length in functions.php ?>

    <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="arrow-link">Read the full article</a></p>

    <?php edit_post_link(); ?>

</article>
<!-- /article -->
<?php
    }
} else {
    // no posts found
}

// Restore original Post Data
wp_reset_postdata();