<?php
class SiteSettings {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'init_settings'  ) );

	}

	public function add_admin_menu() {

		add_options_page(
			esc_html__( 'Site Settings', 'leadeight' ),
			esc_html__( 'Site Settings', 'leadeight' ),
			'manage_options',
			'site_settings',
			array( $this, 'page_layout' )
		);

	}

	public function init_settings() {

		register_setting(
			'settings_group',
			'site_settings'
		);

		add_settings_section(
			'site_settings_section',
			'',
			false,
			'site_settings'
		);

		add_settings_field(
			'phone_number',
			__( 'Phone Number', 'leadeight' ),
			array( $this, 'render_phone_number_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'header_scripts',
			__( 'Header Scripts', 'leadeight' ),
			array( $this, 'render_header_scripts_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'after_body_scripts',
			__( 'After Body Scripts', 'leadeight' ),
			array( $this, 'render_after_body_scripts_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'footer_scripts',
			__( 'Footer Scripts', 'leadeight' ),
			array( $this, 'render_footer_scripts_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'logo_url',
			__( 'Logo URL', 'leadeight' ),
			array( $this, 'render_logo_url_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'logo_url_light',
			__( 'Logo URL (Light)', 'leadeight' ),
			array( $this, 'render_logo_url_light_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'logo_url_mobile',
			__( 'Logo URL for Mobile', 'leadeight' ),
			array( $this, 'render_logo_url_mobile_field' ),
			'site_settings',
			'site_settings_section'
		);
		add_settings_field(
			'logo_url_mobile_light',
			__( 'Logo URL for Mobile (Light)', 'leadeight' ),
			array( $this, 'render_logo_url_mobile_light_field' ),
			'site_settings',
			'site_settings_section'
		);

	}

	public function page_layout() {

		// Check required user capability
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'leadeight' ) );
		}

		// Admin Page Layout
		echo '<div class="wrap">' . "n";
		echo '	<h1>' . get_admin_page_title() . '</h1>' . "n";
		echo '	<form action="options.php" method="post">' . "n";

		settings_fields( 'settings_group' );
		do_settings_sections( 'site_settings' );
		submit_button();

		echo '	</form>' . "n";
		echo '</div>' . "n";

	}

	function render_phone_number_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['phone_number'] ) ? $options['phone_number'] : '';

		// Field output.
		echo '<input type="text" name="site_settings[phone_number]" class="regular-text phone_number_field" placeholder="' . esc_attr__( 'Phone Number', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
		echo '<p class="description">' . __( 'Enter the global phone number you would like to use for the site', 'leadeight' ) . '</p>';

	}

	function render_header_scripts_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['header_scripts'] ) ? $options['header_scripts'] : '';

		// Field output.
		echo '<textarea name="site_settings[header_scripts]" class="regular-text header_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';
		echo '<p class="description">' . __( 'Scripts that run at wp_head', 'leadeight' ) . '</p>';

	}

	function render_after_body_scripts_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['after_body_scripts'] ) ? $options['after_body_scripts'] : '';

		// Field output.
		echo '<textarea name="site_settings[after_body_scripts]" class="regular-text after_body_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';
		echo '<p class="description">' . __( 'Scripts that are run right after body', 'leadeight' ) . '</p>';

	}

	function render_footer_scripts_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['footer_scripts'] ) ? $options['footer_scripts'] : '';

		// Field output.
		echo '<textarea name="site_settings[footer_scripts]" class="regular-text footer_scripts_field" placeholder="' . esc_attr__( '', 'leadeight' ) . '">' . $value . '</textarea>';

	}

	function render_logo_url_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['logo_url'] ) ? $options['logo_url'] : '';

		// Field output.
		echo '<input type="text" name="site_settings[logo_url]" class="regular-text logo_url_field" placeholder="' . esc_attr__( '/dist/assets/images/logo.svg', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
		echo '<p class="description">' . __( 'Logo of the theme. Please note the logo path is relative to the theme location. If empty, the logo will use the demo logo.', 'leadeight' ) . '</p>';

	}

	function render_logo_url_light_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['logo_url_light'] ) ? $options['logo_url_light'] : '';

		// Field output.
		echo '<input type="text" name="site_settings[logo_url_light]" class="regular-text logo_url_light_field" placeholder="' . esc_attr__( '/dist/assets/images/logo.svg', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
		echo '<p class="description">' . __( 'Logo of the theme. Please note the logo path is relative to the theme location. If empty, the logo will use the demo logo.', 'leadeight' ) . '</p>';

	}

	function render_logo_url_mobile_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['logo_url_mobile'] ) ? $options['logo_url_mobile'] : '';

		// Field output.
		echo '<input type="text" name="site_settings[logo_url_mobile]" class="regular-text logo_url_mobile_field" placeholder="' . esc_attr__( '/dist/assets/images/logo.svg', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
		echo '<p class="description">' . __( 'Logo of the theme. Please note the logo path is relative to the theme location. If empty, the logo will use the demo logo.', 'leadeight' ) . '</p>';

	}

	function render_logo_url_mobile_light_field() {

		// Retrieve data from the database.
		$options = get_option( 'site_settings' );

		// Set default value.
		$value = isset( $options['logo_url_mobile_light'] ) ? $options['logo_url_mobile_light'] : '';

		// Field output.
		echo '<input type="text" name="site_settings[logo_url_mobile_light]" class="regular-text logo_url_mobile_light_field" placeholder="' . esc_attr__( '/dist/assets/images/logo.svg', 'leadeight' ) . '" value="' . esc_attr( $value ) . '">';
		echo '<p class="description">' . __( 'Logo of the theme. Please note the logo path is relative to the theme location. If empty, the logo will use the demo logo.', 'leadeight' ) . '</p>';

	}

}

new SiteSettings;