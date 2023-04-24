<?php
/*
Plugin Name: Contact Icon Manager
Description: Aggiunge una barra su dispositivi mobili, attiva cookie script, un tasto WhatsApp e un numero di telefono.
Version: 2.1
Author: Alin Sfirschi
Author URI: https://wpaper.it
GitHub Plugin URI: https://github.com/al0x99/Contact-Icon-Manager
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Impedisce l'accesso diretto al file.
}

function mobile_bar_plugin() {
    if ( wp_is_mobile() ) {
        $gdpr_enabled = get_option( 'gdpr_enabled', false );
        $whatsapp_number = get_option( 'whatsapp_number', '' );
        $phone_number = get_option( 'phone_number', '' );
        $custom_field_enabled = get_option( 'custom_field_enabled', false );
        $custom_field_text = get_option( 'custom_field_text', '' );
        $custom_field_background_color = get_option( 'custom_field_background_color', '#000000' );

        // Aggiungi le opzioni per le icone SVG
		$bar_height = get_option( 'bar_height', '60' );
		$icon_width = get_option( 'icon_width', '20' );
        $gdpr_icon = get_option( 'gdpr_icon', '' );
        $whatsapp_icon = get_option( 'whatsapp_icon', '' );
        $phone_icon = get_option( 'phone_icon', '' );
        $custom_field_icon = get_option( 'custom_field_icon', '' );

        if ( $gdpr_enabled || $whatsapp_number || $phone_number || $custom_field_enabled ) {
			$gdpr_button_color = get_option( 'gdpr_button_color', '#000000' );
			$whatsapp_button_color = get_option( 'whatsapp_button_color', '#000000' );
			$phone_button_color = get_option( 'phone_button_color', '#000000' );
            if ( $gdpr_enabled ) {
            ?>
                <script>
                    function custom_hook_cookies_banner() {
                        CookieScript.instance.show() 
                    }
                </script>
            <?php
            }
            ?>
		<style>
			.mobile-bar {
                display: flex;
                flex-direction: row;
                justify-content: stretch;
                align-items: center;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: transparent;
                padding: 10px 0;
                z-index: 9999;
                width: 100%;
                box-sizing: border-box;
				align-items:center;
				height: <?php echo esc_attr( $bar_height ); ?>px;
            }
            .mobile-bar-section {
                flex: 1;
                text-align: center;
                color: #fff;
                padding: 0 2px;
				height: <?php echo esc_attr( $bar_height ); ?>px;
				align-items:center;
				line-height: <?php echo esc_attr( $bar_height ); ?>px;
            }
			.mobile-bar-section img {
				width: <?php echo esc_attr( $icon_width ); ?>px;
				height: auto;
				display: inline-block;
				vertical-align: middle;
			}
            .mobile-bar-section a {
                text-decoration: none;
				color: inherit;
				display: block;
				width: 100%;
				height: 100%;
            }
            .mobile-bar-section:nth-child(1) {
                background-color: <?php echo esc_attr( $gdpr_button_color ); ?>;
            }
            .mobile-bar-section:nth-child(2) {
                background-color: <?php echo esc_attr( $whatsapp_button_color ); ?>;
            }
            .mobile-bar-section:nth-child(3) {
                background-color: <?php echo esc_attr( $phone_button_color ); ?>;
            }
            body {
                margin-bottom: <?php echo esc_attr( $bar_height ); ?>px; /* Aumenta il margine inferiore per evitare che la barra copra il contenuto del sito */
            }

        </style>
		<div class="mobile-bar">
			<?php if ( $gdpr_enabled ) : ?>
				<a href="#" onclick="do_action('custom_hook_cookies_banner')" class="mobile-bar-section">
					<?php if ( $gdpr_icon ) : ?>
						<img src="<?php echo esc_url( $gdpr_icon ); ?>" alt="GDPR Icon" />
					<?php endif; ?>
					<?php echo esc_html( get_option( 'gdpr_button_text', 'C' ) ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $whatsapp_number ) : ?>
				<a href="https://wa.me/<?php echo esc_attr( $whatsapp_number ); ?>" target="_blank" class="mobile-bar-section">
					<?php if ( $whatsapp_icon ) : ?>
						<img src="<?php echo esc_url( $whatsapp_icon ); ?>" alt="WhatsApp Icon" />
					<?php endif; ?>
					<?php echo esc_html( get_option( 'whatsapp_button_text', 'W' ) ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $phone_number ) : ?>
				<a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="mobile-bar-section">
					<?php if ( $phone_icon ) : ?>
						<img src="<?php echo esc_url( $phone_icon ); ?>" alt="Phone Icon" />
					<?php endif; ?>
					<?php echo esc_html( get_option( 'phone_button_text', 'T' ) ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $custom_field_enabled ) : ?>
				<div class="mobile-bar-section" style="background-color: <?php echo esc_attr( $custom_field_background_color ); ?>;">
					<?php if ( $custom_field_icon ) : ?>
						<img src="<?php echo esc_url( $custom_field_icon ); ?>" alt="Custom Field Icon" />
					<?php endif; ?>
					<?php echo esc_html( $custom_field_text ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $map_address = get_option( 'map_address' ) ) : ?>
				<a href="javascript:void(0);" onclick="openMap('<?php echo esc_attr( $map_address ); ?>');" class="mobile-bar-section" style="background-color: <?php echo esc_attr( get_option( 'map_button_color', '#000000' ) ); ?>;">
					<?php if ( $map_icon = get_option( 'map_icon' ) ) : ?>
						<img src="<?php echo esc_url( $map_icon ); ?>" alt="Map Icon" />
					<?php else: ?>
						<?php echo esc_html( get_option( 'map_button_text', 'Mappa' ) ); ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</div>
                <script>
                    function do_action(hook_name) {
                        if (typeof window[hook_name] === 'function') {
                            window[hook_name]();
                        }
                    }

				function openMap(address) {
					var url = 'https://maps.google.com?q=' + encodeURIComponent(address);

					if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
						url = 'maps:?q=' + encodeURIComponent(address);
					} else if (navigator.userAgent.match(/Android/i)) {
						url = 'geo:0,0?q=' + encodeURIComponent(address);
					}

					window.open(url, '_blank');
				}
                </script>
                <?php
            }
        }
    }
    add_action( 'wp_footer', 'mobile_bar_plugin' );

	function mobile_bar_plugin_settings() {
		add_menu_page(
			'Mobile Bar Plugin Settings', // Titolo della pagina
			'Mobile Bar Plugin', // Titolo del menu
			'manage_options', // Capability
			'mobile-bar-plugin', // Slug del menu
			'mobile_bar_plugin_settings_page', // Funzione di callback
			'dashicons-smartphone', // Icona del menu
			1 // Posizione nel menu
		);
	}
    add_action( 'admin_menu', 'mobile_bar_plugin_settings' );

    // Funzione che genera lo shortcode

    function gdpr_shortcode_button( $atts ) {
        ob_start();
        ?>
        <button onclick="CookieScript.instance.show();">GDPR</button>
        <script>
            function custom_hook_cookies_banner() {
                CookieScript.instance.currentState();
            }
        </script>
        <?php
        return ob_get_clean();
    }
    add_shortcode( 'gdpr_button', 'gdpr_shortcode_button' );

    function mobile_bar_plugin_settings_page() {
        // Controlla se l'utente ha i permessi necessari per accedere alle impostazioni del plugin.
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'Non hai i permessi necessari per accedere a questa pagina.' );
        }
        ?>
        <div class="wrap">
            <h1>Plugin interno in fase di test - White Paper</h1>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php
                    settings_fields( 'mobile-bar-plugin-settings-group' );
                    do_settings_sections( 'mobile-bar-plugin-settings-group' );
                ?>
                <table class="form-table">
                    
					<tr valign="top">
						<th scope="row">Indirizzo Mappa</th>
						<td><input type="text" name="map_address" value="<?php echo esc_attr( get_option('map_address') ); ?>" /></td>
					</tr>

					<tr valign="top">
						<th scope="row">Colore di sfondo del pulsante Mappa</th>
						<td><input type="color" name="map_button_color" value="<?php echo esc_attr( get_option('map_button_color') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Testo del pulsante Mappa</th>
						<td><input type="text" name="map_button_text" value="<?php echo esc_attr( get_option('map_button_text') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Icona del pulsante Mappa</th>
						<td>
							<input type="hidden" name="map_icon" class="custom_media_url" value="<?php echo esc_url( get_option( 'map_icon' ) ); ?>">
							<input type="button" class="button custom_media_upload" value="Scegli immagine">
							<?php if ( $icon = get_option( 'map_icon' ) ) : ?>
								<img src="<?php echo esc_url( $icon ); ?>" alt="Map Icon" width="20" class="custom_media_image">
							<?php endif; ?>
							<input type="button" class="button custom_media_remove" value="Rimuovi immagine">
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">Altezza della barra (in pixel)</th>
						<td><input type="number" name="bar_height" value="<?php echo esc_attr( get_option('bar_height') ); ?>" min="0" /></td>
					</tr>

					<tr valign="top">
						<th scope="row">Larghezza delle icone (in pixel)</th>
						<td><input type="number" name="icon_width" value="<?php echo esc_attr( get_option('icon_width') ); ?>" min="0" /></td>
					</tr>

					<tr valign="top">
                        <th scope="row">Shortcode GDPR</th>
                        <td>
                            <?php if ( get_option('gdpr_enabled') ): ?>
                                <input type="text" readonly value="[gdpr_button]" />
                                <span>o</span>
                                <p>Imposta l'ID del pulsante su "csconsentlink" per utilizzarlo come pulsante per aprire i cookie.</p>
                            <?php else: ?>
                                <span>Abilita GDPR per visualizzare lo shortcode.</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">GDPR</th>
                        <td><input type="checkbox" name="gdpr_enabled" value="1" <?php checked(1, get_option('gdpr_enabled'), true); ?> /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Icona GDPR</th>
                        <td>
							<input type="hidden" name="gdpr_icon" class="custom_media_url" value="<?php echo esc_url( get_option( 'gdpr_icon' ) ); ?>">
							<input type="button" class="button custom_media_upload" value="Scegli immagine">
							<?php if ( $icon = get_option( 'gdpr_icon' ) ) : ?>
								<img src="<?php echo esc_url( $icon ); ?>" alt="GDPR Icon" width="20" class="custom_media_image">
							<?php endif; ?>
							<input type="button" class="button custom_media_remove" value="Rimuovi immagine">
						</td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Numero di WhatsApp</th>
                        <td><input type="text" name="whatsapp_number" value="<?php echo esc_attr( get_option('whatsapp_number') ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Icona WhatsApp</th>
                        <td>
							<input type="hidden" name="whatsapp_icon" class="custom_media_url" value="<?php echo esc_url( get_option( 'whatsapp_icon' ) ); ?>">
							<input type="button" class="button custom_media_upload" value="Scegli immagine">
							<?php if ( $icon = get_option( 'whatsapp_icon' ) ) : ?>
								<img src="<?php echo esc_url( $icon ); ?>" alt="WhatsApp Icon" width="20" class="custom_media_image">
							<?php endif; ?>
							<input type="button" class="button custom_media_remove" value="Rimuovi immagine">
						</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Numero di telefono</th>
                        <td><input type="text" name="phone_number" value="<?php echo esc_attr( get_option('phone_number') ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Icona Telefono</th>
                        <td>
							<input type="hidden" name="phone_icon" class="custom_media_url" value="<?php echo esc_url( get_option( 'phone_icon' ) ); ?>">
							<input type="button" class="button custom_media_upload" value="Scegli immagine">
							<?php if ( $icon = get_option( 'phone_icon' ) ) : ?>
								<img src="<?php echo esc_url( $icon ); ?>" alt="Phone Icon" width="20" class="custom_media_image">
							<?php endif; ?>
							<input type="button" class="button custom_media_remove" value="Rimuovi immagine">
						</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Campo personalizzato</th>
                        <td><input type="checkbox" name="custom_field_enabled" value="1" <?php checked(1, get_option('custom_field_enabled'), true); ?> /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Testo del campo personalizzato</th>
                        <td><input type="text" name="custom_field_text" value="<?php echo esc_attr( get_option('custom_field_text') ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Icona del campo personalizzato</th>
                        <td>
							<input type="hidden" name="custom_field_icon" class="custom_media_url" value="<?php echo esc_url( get_option( 'custom_field_icon' ) ); ?>">
							<input type="button" class="button custom_media_upload" value="Scegli immagine">
							<?php if ( $icon = get_option( 'custom_field_icon' ) ) : ?>
								<img src="<?php echo esc_url( $icon ); ?>" alt="Phone Icon" width="20" class="custom_media_image">
							<?php endif; ?>
							<input type="button" class="button custom_media_remove" value="Rimuovi immagine">
						</td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Colore di sfondo del campo personalizzato</th>
                        <td><input type="color" name="custom_field_background_color" value="<?php echo esc_attr( get_option('custom_field_background_color') ); ?>" /></td>
                    </tr>
					<tr valign="top">
						<th scope="row">Colore pulsante GDPR</th>
						<td><input type="color" name="gdpr_button_color" value="<?php echo esc_attr( get_option('gdpr_button_color') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Colore pulsante WhatsApp</th>
						<td><input type="color" name="whatsapp_button_color" value="<?php echo esc_attr( get_option('whatsapp_button_color') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Colore pulsante Telefono</th>
						<td><input type="color" name="phone_button_color" value="<?php echo esc_attr( get_option('phone_button_color') ); ?>" /></td>
					</tr>

					<tr valign="top">
						<th scope="row">Testo pulsante GDPR</th>
						<td><input type="text" name="gdpr_button_text" value="<?php echo esc_attr( get_option('gdpr_button_text') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Testo pulsante WhatsApp</th>
						<td><input type="text" name="whatsapp_button_text" value="<?php echo esc_attr( get_option('whatsapp_button_text') ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Testo pulsante Telefono</th>
						<td><input type="text" name="phone_button_text" value="<?php echo esc_attr( get_option('phone_button_text') ); ?>" /></td>
					</tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    function mobile_bar_plugin_settings_init() {
        register_setting( 'mobile-bar-plugin-settings-group', 'gdpr_enabled' );
        register_setting( 'mobile-bar-plugin-settings-group', 'whatsapp_number' );
        register_setting( 'mobile-bar-plugin-settings-group', 'phone_number' );
        register_setting( 'mobile-bar-plugin-settings-group', 'custom_field_enabled' );
        register_setting( 'mobile-bar-plugin-settings-group', 'custom_field_text' );
        register_setting( 'mobile-bar-plugin-settings-group', 'custom_field_background_color' );

		// testi custom per ciasucn pulsante

		register_setting( 'mobile-bar-plugin-settings-group', 'gdpr_button_text' );
		register_setting( 'mobile-bar-plugin-settings-group', 'whatsapp_button_text' );
		register_setting( 'mobile-bar-plugin-settings-group', 'phone_button_text' );

		// funzione per regolare l'altezza della barra 

		register_setting( 'mobile-bar-plugin-settings-group', 'bar_height' );

		// regolare altezza dell'icona
		register_setting( 'mobile-bar-plugin-settings-group', 'icon_width' );
		
		// Nuove opzioni per colori di ciascun opzione
		
		register_setting( 'mobile-bar-plugin-settings-group', 'gdpr_button_color' );
		register_setting( 'mobile-bar-plugin-settings-group', 'whatsapp_button_color' );
		register_setting( 'mobile-bar-plugin-settings-group', 'phone_button_color' );

        // Registra le opzioni per le icone SVG
		register_setting( 'mobile-bar-plugin-settings-group', 'gdpr_icon', 'mobile_bar_plugin_handle_upload' );
		register_setting( 'mobile-bar-plugin-settings-group', 'whatsapp_icon', 'mobile_bar_plugin_handle_upload' );
		register_setting( 'mobile-bar-plugin-settings-group', 'phone_icon', 'mobile_bar_plugin_handle_upload' );
		register_setting( 'mobile-bar-plugin-settings-group', 'custom_field_icon', 'mobile_bar_plugin_handle_upload' );

		// Registra coordinate mappa e impostazioni
		
		register_setting( 'mobile-bar-plugin-settings-group', 'map_address' );
		register_setting( 'mobile-bar-plugin-settings-group', 'map_button_color' );
		register_setting( 'mobile-bar-plugin-settings-group', 'map_button_text' );
		register_setting( 'mobile-bar-plugin-settings-group', 'map_icon', 'mobile_bar_plugin_handle_upload' );
		
    }
    add_action( 'admin_init', 'mobile_bar_plugin_settings_init' );



	function mobile_bar_plugin_admin_style() {
		wp_enqueue_style( 'mobile-bar-plugin-admin-style', plugin_dir_url( __FILE__ ) . 'admin-style.css' );
		wp_enqueue_script( 'mobile-bar-plugin-admin-script', plugin_dir_url( __FILE__ ) . 'admin-script.js', array( 'jquery' ), false, true );
	}
	add_action( 'admin_enqueue_scripts', 'mobile_bar_plugin_admin_style' );
?>