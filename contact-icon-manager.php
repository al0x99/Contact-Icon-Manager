<?php
/*
Plugin Name: Contact Icon Manager
Description: Aggiunge una barra su dispositivi mobili, attiva cookie script, un tasto WhatsApp e un numero di telefono.
Version: 3.0.0
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