<?php

add_action( 'init', 'forum' );

function forum() {
	$labels = array(
		'name'               => ( 'Tópicos'),
		'singular_name'      => ( 'Tópico'),
		'menu_name'          => ( 'Tópicos'),
		'name_admin_bar'     => ( 'Tópico'),
		'add_new'            => ( 'Adicionar novo'),
		'add_new_item'       => ( 'Adicionar novo tópico'),
		'new_item'           => ( 'Novo tópico'),
		'edit_item'          => ( 'Editar tópico'),
		'view_item'          => ( 'Ver tópico'),
		'all_items'          => ( 'Todos os tópicos'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-buddicons-forums',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'comments')
	);

	register_post_type( 'forum', $args );
}

add_action( 'init', 'category_forum' );

function category_forum() {
	$args = [
		'label'         => 'Categorias',
		'show-ui'       => true,
		'query_var'     => true,
		'hierarchical'  => true,
		'show_in_rest'  => true,
		'rewrite'       => ['slug' => 'c/forum']
	];
	register_taxonomy( 'category_forum', 'forum', $args );
}



add_action('admin_menu', 'register_rank_page');

function register_rank_page() {
  add_submenu_page( 'edit.php?post_type=forum', 'Ranking', 'Ranking', 'manage_options', 'ranking', 'rank_page_callback' ); 
}

function rank_page_callback() { ?>
<div class="wrap">
	<h1>Ranking</h1>

	<h4>Ainda estou vendo como vou fazer isso</h4>
</div>
<?php }