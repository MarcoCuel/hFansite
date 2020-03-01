<?php

// Theme Supports
add_theme_support( 'custom-logo' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'category-thumbnails' );
add_post_type_support( 'page', 'excerpt' );

// Menu
register_nav_menus( array(
	'primary' => esc_html__( 'Principal' ),
	'footer' => esc_html__( 'Rodapé' ),
) );

// Navbar
require get_template_directory() . '/inc/bootstrap-navwalker.php';

// Scripts
function scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.4.1' );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.12.1/css/all.css', array(), '5.12.1' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '5.3.1' );
	wp_enqueue_style( 'selectize', get_template_directory_uri() . '/assets/css/selectize.css', array(), '0.12.6' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.1' );

	wp_enqueue_script( 'custom-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true );
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', true );
	wp_enqueue_script( 'jqueryCookie', get_template_directory_uri() . '/assets/js/jquery.cookie.js', array(), '1.4.1', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.4.1', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array(), '5.3.1', true );
	wp_enqueue_script( 'selectize', get_template_directory_uri() . '/assets/js/selectize.min.js', array(), '0.12.6', true );
	wp_enqueue_script( 'moment', get_template_directory_uri() . '/assets/js/moment.js', array(), '2.24.0', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'scripts' );

// Paginação
function the_pagination() {
	global $wp_query;

	echo paginate_links( array(
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => '<i class="fas fa-chevron-left"></i>',
		'next_text' => '<i class="fas fa-chevron-right"></i>'
	) );
}

// Comentários melhores
function js_comments_reply() {
	if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'js_comments_reply' );

require_once get_parent_theme_file_path( '/inc/better-comments.php' );
require_once get_parent_theme_file_path( '/inc/better-comments-forum.php' );

//  BBCode
add_filter( 'comment_form_defaults', 'rich_text_comment_form' );
function rich_text_comment_form( $args ) {
	ob_start();
	wp_editor( '', 'comment', array(
		'media_buttons' => true, // show insert/upload button(s) to users with permission
		'textarea_rows' => '10', // re-size text area
		'dfw' => false, // replace the default full screen with DFW (WordPress 3.4+)
		'tinymce' => array(
			'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,bullist,numlist,code,blockquote,link,unlink,outdent,indent,|,undo,redo,fullscreen',
			'theme_advanced_buttons2' => '', // 2nd row, if needed
			'theme_advanced_buttons3' => '', // 3rd row, if needed
			'theme_advanced_buttons4' => '' // 4th row, if needed
		),
		'quicktags' => array(
		   'buttons' => 'strong,em,img,ul,ol,li,code,close'
		)
	) );
	$args['comment_field'] = ob_get_clean();
	return $args;
}





// Compartilhar (Social)
function social_sharing_buttons($content) {
	global $post;
	
	// Get current page URL 
	$socialURL = urlencode(get_permalink());

	// Get current page title
	$socialTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	// $socialTitle = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$socialThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$socialTitle.'&amp;url='.$socialURL.'&amp;via=Habbo';
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$socialURL;
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$socialURL.'&amp;media='.$socialThumbnail[0].'&amp;description='.$socialTitle;
	$whatsappURL = 'https://api.whatsapp.com/send?text='.$socialTitle.' | '.$socialURL;

	// Add sharing button at the end of page/page content
	$variable .= '<div class="social-share">';
	$variable .= '<a href="'. $twitterURL .'" onclick="window.open(this.href,&quot;sharer&quot;,&quot;toolbar=0,status=0,width=626,height=436&quot;); return false;" rel="nofollow"><i class="fab fa-twitter"></i></a>';
	$variable .= '<a href="'.$facebookURL.'" onclick="window.open(this.href,&quot;sharer&quot;,&quot;toolbar=0,status=0,width=626,height=436&quot;); return false;" rel="nofollow"><i class="fab fa-facebook"></i></a>';
	$variable .= '<a href="'.$pinterestURL.'" data-pin-custom="true" onclick="window.open(this.href,&quot;sharer&quot;,&quot;toolbar=0,status=0,width=626,height=436&quot;); return false;" rel="nofollow"><i class="fab fa-pinterest"></i></a>';
	$variable .= '<a href="'.$whatsappURL.'" onclick="window.open(this.href,&quot;sharer&quot;,&quot;toolbar=0,status=0,width=626,height=436&quot;); return false;" rel="nofollow"><i class="fab fa-whatsapp"></i></a>';
	$variable .= '</div>';
	
	return $variable.$content;
};
// add_filter( 'the_content', 'social_sharing_buttons');

// Cria página de Configurações ao ativar o tema
add_action( 'after_switch_theme', 'essential_pages' );

function essential_pages(){
	$new_page_title  = __('Configurações');
	$new_page_content   = '';
	$new_page_template  = 'templates/settings.php';
	$page_check = get_page_by_title($new_page_title);
	// Store the above data in an array
	$new_page = array(
			'post_type'  => 'page', 
			'post_title'    => $new_page_title,
			'post_content'  => $new_page_content,
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_name'  => 'configuracoes'
	);
	// If the page doesn't already exist, create it
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
	}
}

// Post States
add_filter( 'display_post_states', 'ecs_add_post_state', 10, 2 );

function ecs_add_post_state( $post_states, $post ) {

	if( $post->post_name == 'entrar' ) {
		$post_states[] = 'Entrar';
	}

	if( $post->post_name == 'configuracoes' ) {
		$post_states[] = 'Configurações do usuário';
	}

	if( $post->post_name == 'registro' ) {
		$post_states[] = 'Registro';
	}

	return $post_states;
}

// Redirect Login
// add_action(  'login_init', 'user_registration_login_init'  );
// function user_registration_login_init () {
//    if( ! is_user_logged_in() ) {
//     wp_redirect( home_url() . '/entrar' );
//     exit;
//     }
// }


// function admin_stylesheet() {
//   wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/inc/style-admin.css' );
//   wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/inc/style-admin.js' );
// }
// add_action( 'admin_head', 'admin_stylesheet' );