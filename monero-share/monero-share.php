<?php
/*
Plugin Name:  Monero Share
Plugin URI:   https://wordpress.org/plugins/monero-share/
Description:  Share a browser miner with your users and you both earn XMR
Version:      0.0.62
Author:       VidYen, LLC
Author URI:   https://vidyen.com/
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, version 2 of the License
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* See <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//register_activation_hook(__FILE__, 'vy_monero_share_install'); Not Sure this is needed

/*
//Install the SQL tables for VY twitch
function vy_mshare_install()
{
	//Actually, I can't think of a need for the SQL just yet.
}
*/

//Adding the menu function
add_action('admin_menu', 'vy_monero_share_menu');

function vy_monero_share_menu()
{
	//Only need to install the one menu to explain shortcode usage
  $parent_page_title = "Monero Share";
  $parent_menu_title = 'Monero Share';
  $capability = 'manage_options';
  $parent_menu_slug = 'vy_mshare';
  $parent_function = 'vy_mshare_parent_menu_page';
  add_menu_page($parent_page_title, $parent_menu_title, $capability, $parent_menu_slug, $parent_function);
}

//The actual page... I should throw this on its own include. Down the road maybe.
function vy_mshare_parent_menu_page()
{
	//It's possible we don't use the VYPS logo since no points.
  $vy_logo_url = plugins_url( 'inlcudes/images/vy_logo.png', __FILE__ );
  $vy256_worker_url = plugins_url( 'includes/images/vyworker_001.gif', __FILE__ );
  $twitch_icon_url = plugins_url( 'includes/images/icon-256x256.png', __FILE__ );

  //The HTML output.
	echo '<br><br><img src="' . $twitch_icon_url . '" > ';

	//Static text for the base plugin
	echo
	"<h1>Vidyen Monero Share Monero Miner</h1>
	<p>The plugin uses the VidYen Monero miner to mine while an embedded Monero Share stream is playing. It ties into the Monero Share JS API and only mines while videos are being played.</p>
	<p>Does not use the VidYen Point System rewards, but at same time does not require you user to log in to mine for you. Just a cookie consent via an AJAX post.</p>
	<h2>Player Shortcode Instructions</h2>
	<p>Format:<b>[vy-mshare wallet=(the sites XMR wallet) site=mshare sitetime=(time you want to mine for you) clienttime=(time to mine for client)]</b></p>
	<p>Optional for languages other than English:<b>[vy-twitch disclaimer=\"Your message about cookies and resources\" button=\"the button text\"]</b></p>
	<p>Again this uses Monero Ocean for the backup like the VidYen point system.</p>
	<p>To see your progress towards payout, vist the <a href=\"https://moneroocean.stream/#/dashboard\" target=\"_blank\">dashboard</a> and add your XMR wallet where it says Enter Payment Address at bottom of page. There you can see total hashes, current hash rate, and account option if you wish to change payout rate.</p>
	<p>Keep in mind, unlike Coinhive, you can use this in conjunction with GPU miners to the same pool.</p>
	<p>Working Example: <b>[vy-mshare wallet=8BpC2QJfjvoiXd8RZv3DhRWetG7ybGwD8eqG9MZoZyv7aHRhPzvrRF43UY1JbPdZHnEckPyR4dAoSSZazf5AY5SS9jrFAdb site=mshare sitetime=60 clienttime=360]</b>
  <p>Since this is running on our servers and we expanded the code, VidYen, LLC is the one handling the support. Please go to our <a href=\"https://www.vidyen.com/contact/\" target=\"_blank\">contact page</a> or if you need assistance immediatly, join the <a href=\"https://discord.gg/6svN5sS\" target=\"_blank\">VidYen Discord</a> and PM Felty. (It will ping my phone, so do not abuse. -Felty)</p></p>  <h2>Getting a Monero wallet</h2>
  <p>If you are completely new to Monero and need a wallet address, you can quickly get one at <a href=\"https://mymonero.com/\" target=\"_blank\">My Monero</a> or if you want a more technical or secure wallet visit <a href=\"https://ww.getmonero.org/\" target=\"_blank\">Get Monero</a> on how to create an enanched wallet.</p>
  <p>If you have an iPhone you can always use  <a href=\"https://cakewallet.io/\" target=\"_blank\">Cake Wallet</a>.</p>
	";

	echo '<br><br><img src="' . $vy256_worker_url . '" > ';
}

/*** BEGIN SHORTCODE INCLUDES ***/
include( plugin_dir_path( __FILE__ ) . 'includes/shortcodes/vyms_vy256.php'); //For now just the actual SC [vy-twitch]

/*** BEGIN FUNCTION INCLUDES ***/
include( plugin_dir_path( __FILE__ ) . 'includes/functions/vyms_wallet_check.php'); //Checks if wallet is close to being valid
include( plugin_dir_path( __FILE__ ) . 'includes/functions/vyms_ajax.php'); //Checks if wallet is close to being valid
