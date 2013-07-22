<?php
/*
Plugin Name: Don't Touch Themes
Plugin URI: https://github.com/gouten5010/do-not-touch-themes
Description: We do not want to make a theme chosen, and do not want to let edit of WordPress plug-in and WordPress theme. After all the setup and edits finish, please validate this plug-in.
Version:0.1.2
Author:GOUTEN
Author URI: http://5010works.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//プラグインとテーマのインストール・更新を無効化
function non_edit_theme_and_plugin() {
	if (!defined('DISALLOW_FILE_MODS')) {
		define('DISALLOW_FILE_MODS',true);
	}
}
add_action('plugins_loaded', 'non_edit_theme_and_plugin');

//テーマ選択の無効化
function remove_role_options($caps, $cap) {
	$capabilities = array(
		'switch_themes'
	);
	if (in_array($cap, $capabilities)) {
		$caps[] = 'do_not_allow';
	}
	return $caps;
}
add_filter('map_meta_cap', 'remove_role_options', 10, 2);
