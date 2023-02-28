<?php
/**
 * Plugin Name: TWG Google Analytics
 * Description: This is a simple plugin to add Google Analytics code in a WordPress website
 * Version: 1.0
 * Author: Deepanker Verma
 * Author URI: https://deepankerverma.com
 */

// Add the settings page
function twg_add_google_analytics_settings_page() {
    add_options_page(
        'Google Analytics Settings',
        'TWG oogle Analytics',
        'manage_options',
        'google-analytics-settings',
        'twg_render_google_analytics_settings_page'
    );
}
add_action( 'admin_menu', 'twg_add_google_analytics_settings_page' );

// Render the settings page
function twg_render_google_analytics_settings_page() {
    ?>
    <div class="wrap">
        <h2>Google Analytics Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'google-analytics-settings-group' ); ?>
            <?php do_settings_sections( 'google-analytics-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Google Analytics Tracking Code:</th>
                    <td><textarea name="twg_google_analytics_tracking_code"><?php echo esc_attr( get_option('twg_google_analytics_tracking_code') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register the settings
function twg_register_google_analytics_settings() {
    register_setting( 'google-analytics-settings-group', 'twg_google_analytics_tracking_code' );
}
add_action( 'admin_init', 'twg_register_google_analytics_settings' );

// Add the tracking code to the header
function twg_add_google_analytics_tracking_code() {
    $tracking_code = get_option( 'twg_google_analytics_tracking_code' );
    if ( ! empty( $tracking_code ) ) {
        ?>
        <?php echo $tracking_code; ?>
        <?php
    }
}
add_action( 'wp_head', 'twg_add_google_analytics_tracking_code' );