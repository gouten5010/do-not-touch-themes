<?php
/*
Plugin Name: Don't Touch Themes
Plugin URI: https://github.com/gouten5010/do-not-touch-themes
Description: We do not want to make a theme chosen, and do not want to let edit of WordPress plug-in and WordPress theme.
Version:0.0.1
Author:GOUTEN
Author URI: http://5010works.com/
License: GPL v2
License URI:
*/

function non_edit_theme_and_plugin() {
	$request_url = "http://".$_SERVER[ "HTTP_HOST"] . $_SERVER["PHP_SELF"];
	$theme_select_url = get_admin_url( 'themes.php', 'themes.php' );
	$theme_isntall_url = get_admin_url( 'themes.php', 'theme-install.php' );

	//テーマ・プラグインの編集をさせないようにする
	if ( !defined ( 'DISALLOW_FILE_EDIT' ) ) {
		define( 'DISALLOW_FILE_EDIT', true );
	}

	//themes.phpにアクセスした場合エラーメッセージを表示
	switch ($request_url) {
		case $theme_select_url:
		case $theme_isntall_url:
			wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ) );
	}
}
add_action('plugins_loaded', 'non_edit_theme_and_plugin');

function remove_theme_select_menus () {
	//テーマメニューを管理画面から除去
	remove_submenu_page( 'themes.php', 'themes.php' );
}
add_action( 'admin_menu', 'remove_theme_select_menus' );

//function remove_role_options(){
//	$roles = get_role('administrator');
//	$caps = array(
//		'switch_themes',
//		'install_themes'
//	);
//	foreach ( $caps as $cap ){
//		$roles->add_cap( $cap );
//	}
//}
//add_action( 'admin_init', 'remove_role_options' );
