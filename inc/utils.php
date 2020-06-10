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
	wp_editor( '', 'comment' );
	$args['comment_field'] = ob_get_clean();
	return $args;
}

add_filter( 'ajax_query_attachments_args', 'wpb_show_current_user_attachments' );

// Assinantes podem fazer uploads
function add_theme_caps() {
    // gets the author role
    $role = get_role( 'subscriber' );

    $role->add_cap( 'upload_files' ); 
    $role->add_cap( 'unfiltered_upload' );
}

add_action( 'admin_init', 'add_theme_caps');
add_action( 'init', 'add_theme_caps');

// Filtro Mídias (Apenas suas imagens)
function wpb_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts') ) {
        $query['author'] = $user_id;
    }
    return $query;
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


// function admin_stylesheet() {
//   wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/inc/style-admin.css' );
//   wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/inc/style-admin.js' );
// }
// add_action( 'admin_head', 'admin_stylesheet' );