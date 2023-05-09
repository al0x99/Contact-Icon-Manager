<?php
/*
Plugin Name: Contact Icon Manager
Description: Plugin che permette di aggiungere una barra fissa con dismensione regolabile in cui inserire icone di contatto e link ad essi associati con push al datalayer degli eventi
Version: 3.2.5
Author: Alin Sfirschi
Author URI: https://wpaper.it
GitHub Plugin URI: https://github.com/al0x99/Contact-Icon-Manager
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include all admin and public functions
require_once plugin_dir_path( __FILE__ ) . 'admin/admin-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'public/public-functions.php';

?>