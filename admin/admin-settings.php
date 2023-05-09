<?php

function mobile_bar_plugin_settings() {
    add_menu_page(
        'Mobile Bar Plugin Settings',
        'Mobile Bar Plugin',
        'manage_options',
        'mobile-bar-plugin',
        'mobile_bar_plugin_settings_page',
        'dashicons-smartphone',
        1
    );
}

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
						<th scope="row">Mostra su desktop</th>
						<td><input type="checkbox" name="display_on_desktop" value="1" <?php checked(1, get_option('display_on_desktop'), true); ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row">Mostra su mobile</th>
						<td><input type="checkbox" name="display_on_mobile" value="1" <?php checked(1, get_option('display_on_mobile'), true); ?> /></td>
					</tr>
					
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

						!TODO: Add icon picker
						<!-- <div class="icon-picker"> 
							<img src="<?php echo plugin_dir_url( __FILE__ ); ?>icons/whatsapp.svg" alt="Predefined Icon" width="20" class="predefined_icon">
							<input type="radio" class="icon-picker-radio" name="map_icon_predefined" value="<?php echo plugin_dir_url( __FILE__ ); ?>icons/icon_name.svg">
						</div>
						<div class="icon-picker">
							<span>Nessuna icona predefinita</span>
							<input type="radio" class="icon-picker-radio" name="map_icon_predefined" value="">
						</div> -->
						

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

		// Registra opzione per scegliere dove visualizzare la barra (desktop o mobile)
		register_setting('mobile-bar-plugin-settings-group', 'display_on_desktop');
		register_setting('mobile-bar-plugin-settings-group', 'display_on_mobile');

    }

	function mobile_bar_plugin_admin_style() {
		wp_enqueue_media();
		wp_enqueue_style('mobile-bar-plugin-admin-style', plugin_dir_url(__FILE__).'admin-style.css');
		wp_enqueue_script('mobile-bar-plugin-admin-script', plugin_dir_url(__FILE__).'admin-script.js', array('jquery'), false, true);
	}
	
	add_action('admin_enqueue_scripts', 'mobile_bar_plugin_admin_style');
?>