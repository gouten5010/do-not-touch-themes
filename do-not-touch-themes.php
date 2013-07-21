<?php
/*
Plugin Name: Don't Touch Themes
Plugin URI: https://github.com/gouten5010/do-not-touch-themes
Description: We do not want to make a theme chosen, and do not want to let edit of WordPress plug-in and WordPress theme.
Version:0.1.1
Author:GOUTEN
Author URI: http://5010works.com/
License: GPL v2
License URI:
*/

function non_edit_theme_and_plugin() {
	/*
	テーマ・プラグインの編集をさせないようにする
	(DISALLOW_FILE_MODSを使用する場合は削除するコト)
	*/
	if ( !defined ( 'DISALLOW_FILE_EDIT' ) ) {
		define( 'DISALLOW_FILE_EDIT', true );
	}
	/*
	テーマ・プラグインの新規インストールとアップデート、編集をさせないようにする
	*/
	//if ( !defined ( 'DISALLOW_FILE_MODS' ) ) {
	//	define('DISALLOW_FILE_MODS',true);
	//}
}
add_action('plugins_loaded', 'non_edit_theme_and_plugin');

function remove_theme_select_menus () {
	/*
	「テーマ」メニューを管理画面から除去
	*/
	remove_submenu_page( 'themes.php', 'themes.php' );
}
add_action( 'admin_menu', 'remove_theme_select_menus' );

function remove_role_options( $caps, $cap ) {
	$capabilities = array(
		'switch_themes',
		'install_themes' //DISALLOW_FILE_MODSを使用する場合は削除してもいい
	);
	if (in_array($cap, $capabilities)) {
		$caps[] = 'do_not_allow';
	}
	return $caps;
}
add_filter('map_meta_cap', 'remove_role_options', 10, 2);
