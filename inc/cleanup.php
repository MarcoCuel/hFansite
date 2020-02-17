<?php

function admin_wp_remove_logo() {
  global $wp_admin_bar;

  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'admin_wp_remove_logo' );


function alt_admin_footer () {
	echo '<span>Desenvolvido por <a href="http://marcocuel.com/" target="_blank">Marco Cuel</a></span>';
}
add_filter('admin_footer_text', 'alt_admin_footer');