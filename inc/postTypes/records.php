<?php

add_action( 'init', 'records' );

function records() {
	$labels = array(
		'name'               => ( 'Recordes'),
		'singular_name'      => ( 'Recorde'),
		'menu_name'          => ( 'Recordes'),
		'name_admin_bar'     => ( 'Recorde'),
		'add_new'            => ( 'Adicionar novo'),
		'add_new_item'       => ( 'Adicionar novo recorde'),
		'new_item'           => ( 'Novo recorde'),
		'edit_item'          => ( 'Editar recorde'),
		'view_item'          => ( 'Ver recorde'),
		'all_items'          => ( 'Todos os recordes'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-star-filled',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title', 'thumbnail', 'editor')
	);

	register_post_type( 'recorde', $args );
}