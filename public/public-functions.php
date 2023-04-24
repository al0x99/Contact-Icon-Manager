<?php


function mobile_bar_plugin() {
    if ( wp_is_mobile() ) {
        $gdpr_enabled = get_option( 'gdpr_enabled', false );
        $whatsapp_number = get_option( 'whatsapp_number', '' );
        $phone_number = get_option( 'phone_number', '' );
        $custom_field_enabled = get_option( 'custom_field_enabled', false );
        $custom_field_text = get_option( 'custom_field_text', '' );
        $custom_field_background_color = get_option( 'custom_field_background_color', '#000000' );

        // Options for mobile bar height and icon width
		$bar_height = get_option( 'bar_height', '60' );
		$icon_width = get_option( 'icon_width', '20' );
        $gdpr_icon = get_option( 'gdpr_icon', '' );
        $whatsapp_icon = get_option( 'whatsapp_icon', '' );
        $phone_icon = get_option( 'phone_icon', '' );
        $custom_field_icon = get_option( 'custom_field_icon', '' );

		// Check if at least one option is enabled GDPR | WhatsApp | Phone | Custom Field 
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



    add_action( 'admin_init', 'mobile_bar_plugin_settings_init' );



	function mobile_bar_plugin_admin_style() {
		wp_enqueue_style( 'mobile-bar-plugin-admin-style', plugin_dir_url( __FILE__ ) . 'admin-style.css' );
		wp_enqueue_script( 'mobile-bar-plugin-admin-script', plugin_dir_url( __FILE__ ) . 'admin-script.js', array( 'jquery' ), false, true );
	}
	add_action( 'admin_enqueue_scripts', 'mobile_bar_plugin_admin_style' );

?>