<?php

add_action( 'init', 'partner' );

function partner() {
	$labels = array(
		'name'               => ( 'Parceiros'),
		'singular_name'      => ( 'Parceiro'),
		'menu_name'          => ( 'Parceiros'),
		'name_admin_bar'     => ( 'Parceiro'),
		'add_new'            => ( 'Adicionar novo'),
		'add_new_item'       => ( 'Adicionar novo parceiro'),
		'new_item'           => ( 'Novo parceiro'),
		'edit_item'          => ( 'Editar parceiro'),
		'view_item'          => ( 'Ver parceiro'),
		'all_items'          => ( 'Todos os parceiros'),
		'search_items'       => ( 'Pesquisar'),
		'parent_item_colon'  => ( ''),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	         => 'dashicons-admin-network',
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
		'supports'           => array('title', 'thumbnail')
	);

	register_post_type( 'parceiro', $args );
}


