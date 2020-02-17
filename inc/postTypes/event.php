<?php

add_action( 'init', 'event' );

function event() {
	$labels = array(
		'name'               => ( 'Eventos'),
		'singular_name'      => ( 'Evento'),
		'menu_name'          => ( 'Eventos'),
		'name_admin_bar'     => ( 'Eventos'),
		'add_new'            => ( 'Adicionar novo'),
		'add_new_item'       => ( 'Adicionar novo evento'),
		'new_item'           => ( 'Novo evento'),
		'edit_item'          => ( 'Editar evento'),
		'view_item'          => ( 'Ver evento'),
		'all_items'          => ( 'Todos os eventos'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-calendar-alt',
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
		'supports'           => array('title', 'thumbnail', 'editor', 'author', 'comments'),
	);

	register_post_type( 'evento', $args );
}

add_action( 'init', 'tags_event' );

function tags_event() {
	$args = [
		'label'         => 'Tags',
		'show-ui'       => true,
		'query_var'     => true,
		'hierarchical'  => false,
		'show_in_rest'  => true,
		'rewrite'       => ['slug' => 'tags/evento'],
	];
	register_taxonomy( 'tags_event', 'evento', $args );
}