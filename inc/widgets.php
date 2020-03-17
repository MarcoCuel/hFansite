<?php

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id'				 => 'sidebar_top',
			'name'		    => __( 'Sidebar (Topo)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="section-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'id'				 => 'content_top',
			'name'			 => __( 'Conteúdo (Topo)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="section-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'id'				 => 'sidebar_middle',
			'name'		    => __( 'Sidebar (Meio)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="section-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'id'				 => 'content_middle',
			'name'			 => __( 'Conteúdo (Meio)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="section-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'id'				 => 'sidebar_down',
			'name'		    => __( 'Conteúdo (Baixo)' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="section-title"><h3>',
			'after_title'   => '</h3></div>',
		)
	);
}






class Custom_Widget_Noticias extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_noticias', // Base ID
			'Notícias', // Name
			array('description' => __( 'Listagem de notícias'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=post&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="row row-news">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/card', 'news') ?>
						</div>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhum tópico</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Noticias');

class Custom_Widget_Forum extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_forum', // Base ID
			'Fórum', // Name
			array('description' => __( 'Listagem de tópicos'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=forum&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="row row-forum">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/card', 'topic') ?>
						</div>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhum tópico</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Forum');

class Custom_Widget_Evento extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_evento', // Base ID
			'Eventos', // Name
			array('description' => __( 'Listagem de eventos'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=evento&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="row row-event">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/card', 'event') ?>
						</div>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhum evento</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Evento');

class Custom_Widget_Coisas extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_coisas', // Base ID
			'Coisas grátis', // Name
			array('description' => __( 'Listagem de coisas grátis'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=post&category_name=coisas-gratis&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="row">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<?php $cg_available = get_post_meta( get_the_ID(), 'cg_available', true ); ?>
						<div class="col-4 col-sm-3 col-lg-2 <?php if($cg_available == 'nao') { echo "order-6"; } ?>">
							<?php get_template_part( 'template-parts/card', 'free') ?>
						</div>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhuma coisa grátis</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Coisas');

class Custom_Widget_Galeria extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_galeria', // Base ID
			'Galeria', // Name
			array('description' => __( 'Listagem de artes'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=galeria&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="row row-gallery">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<div class="col">
							<?php get_template_part( 'template-parts/card', 'gallery') ?>
						</div>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhuma arte</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Galeria');

class Custom_Widget_Publicidades extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_publicidades', // Base ID
			'Publicidades', // Name
			array('description' => __( 'Listagem de publicidades'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=publicidade&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="card">';
			echo '<div id="carouselAds" class="carousel ads slide" data-ride="carousel">';
			echo '<ol class="carousel-indicators">';
			$count = 0;
				while ($listings->have_posts()) {
				$listings->the_post(); ?>
					<li data-target="#carouselAds" data-slide-to="<?php echo ($count)?>" class="<?php echo ($count == 0) ? 'active' : ''; ?>"></li>
				<?php
				$count++;
				echo $listItem; }
			echo '</ol>';
			echo '<div class="carousel-inner">';
			$count = 0;
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
							<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							<div class="carousel-caption">
								<h5><?php the_title(); ?></h5>
								<div><?php the_content(); ?></div>
							</div>
						</div>
						<?php $count++; ?>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			echo '</div>';
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhuma publicidade</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Publicidades');

class Custom_Widget_Parceiro extends WP_Widget {
	function __construct() {
		parent::__construct(
			'custom_widget_parceiro', // Base ID
			'Parceiro', // Name
			array('description' => __( 'Listagem de parceiros'))
		);
	}

	function widget($args, $instance) { //output
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfListings = $instance['numberOfListings'];
		echo $before_widget;
		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$this->getCustomListings($numberOfListings);
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
		return $instance;
	}	
    
    // widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$numberOfListings = esc_attr($instance['numberOfListings']);
	} else {
		$title = '';
		$numberOfListings = '';
	}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfListings'); ?>">Número de tópicos a exibir:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('numberOfListings'); ?>" name="<?php echo $this->get_field_name('numberOfListings'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $numberOfListings ); ?>" size="3">
		</p>		 
	<?php
	}
	
	function getCustomListings($numberOfListings) { //html
		global $post;
		add_image_size( 'custom_widget_size', 85, 45, false );
		$listings = new WP_Query();
		$listings->query('post_type=parceiro&posts_per_page=' . $numberOfListings );	
		if($listings->found_posts > 0) {
			echo '<div class="card">';
			echo '<div class="card-body text-muted pixel d-flex justify-content-center align-items-center">';
				while ($listings->have_posts()) {
					$listings->the_post(); ?>
						<?php $partner_url = get_post_meta( get_the_ID(), 'partner_url', true );
						if( !empty( $partner_url) ) : ?>
							<a href="<?php echo $partner_url; ?>" target="_blank">
						<?php endif; ?>
							<div class="px-2" data-toggle="tooltip" title="<?php the_title(); ?>">
								<img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							</div>
						<?php if( !empty( $partner_url) ) : ?>
							</a>
						<?php endif; ?>
					<?php
					echo $listItem; 
				}
			echo '</div>';
			echo '</div>';
			wp_reset_postdata(); 
		}else{
			echo '<div class="card">
						<div class="card-body text-center text-muted">
							<strong>Nenhum parceiro</strong>
						</div>
					</div>';
		} 
	}
	
}
register_widget('Custom_Widget_Parceiro');