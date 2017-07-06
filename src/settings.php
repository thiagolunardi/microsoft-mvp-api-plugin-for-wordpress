<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 include_once( 'scripts.php' );
/**
 * custom option and settings
 */
function msmvpapi_settings_init ( ) {

    // register a new setting for "msmvpapi" page
    register_setting( 'msmvpapi', 'msmvpapi_api_key' );
    register_setting( 'msmvpapi', 'msmvpapi_client_id' );
    register_setting( 'msmvpapi', 'msmvpapi_client_secret' );
    
    // register a new section in the "msmvpapi" page
    add_settings_section(
        'msmvpapi_section_developers',
        __( 'MVP API - that will directly enable you to use your own ideas to create and enhance your own MVP experience.', 'msmvpapi' ),
        'msmvpapi_section_developers_cb',
        'msmvpapi'
    );

    // register a new field in the "msmvpapi_section_developers" section, inside the "msmvpapi" page
    add_settings_field(
        'msmvpapi_field_api_key', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'API Key', 'msmvpapi' ),
        'msmvpapi_field_api_key_cb',
        'msmvpapi',
        'msmvpapi_section_developers',
        [
            'label_for' => 'msmvpapi_field_api_key'
        ]
    );
    
    // register a new field in the "msmvpapi_section_developers" section, inside the "msmvpapi" page
    add_settings_field(
        'msmvpapi_field_client_id', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'Client ID', 'msmvpapi' ),
        'msmvpapi_field_client_id_cb',
        'msmvpapi',
        'msmvpapi_section_developers',
        [
            'label_for' => 'msmvpapi_field_client_id'
        ]
    );  

    // register a new field in the "msmvpapi_section_developers" section, inside the "msmvpapi" page
    add_settings_field(
        'msmvpapi_field_client_secret', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'Client Secret', 'msmvpapi' ),
        'msmvpapi_field_client_secret_cb',
        'msmvpapi',
        'msmvpapi_section_developers',
        [
            'label_for' => 'msmvpapi_field_client_secret'
        ]
    );  
}
 
/**
 * register our msmvpapi_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'msmvpapi_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function msmvpapi_section_developers_cb( $args ) {
    msmvpapi_msoauthscript ( );
 ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'For more information, just access ', 'msmvpapi' ); ?><a href="https://mvp.microsoft.com/en-us/Opportunities/my-opportunities-api-getting-started">here</a></p>
 <?php
}


// api_key field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function msmvpapi_field_api_key_cb( $args ) {
    // get the value of the setting we've registered with register_setting()
    $api_key = get_option( 'msmvpapi_api_key' );
    // output the field
?>
    <input type="text"
           name="msmvpapi_api_key"
           value="<?= isset($api_key) ? esc_attr($api_key) : ''; ?>" />
    <p class="description">
        <?php esc_html_e( 'The key that comes from ', 'msmvpapi' ); ?><a href="https://apps.dev.microsoft.com/">Microsoft Application Registration Portal</a>
    </p>
<?php
}
// client_secret field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function msmvpapi_field_client_secret_cb( $args ) {
    // get the value of the setting we've registered with register_setting()
    $api_key = get_option( 'msmvpapi_client_secret' );
    // output the field
?>
    <input type="text"
           name="msmvpapi_client_secret"
           value="<?= isset($api_key) ? esc_attr($api_key) : ''; ?>" />
    <p class="description">
        <?php esc_html_e( 'The key that comes from ', 'msmvpapi' ); ?><a href="https://mvpapi.portal.azure-api.net/">MVP API Developer Portal</a>
    </p>
<?php
}

// client_id field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function msmvpapi_field_client_id_cb( $args ) {
    // get the value of the setting we've registered with register_setting()
    $api_key = get_option( 'msmvpapi_client_id' );
    // output the field
?>
    <input type="text"
           name="msmvpapi_client_id"
           value="<?= isset($api_key) ? esc_attr($api_key) : ''; ?>" />
    <p class="description">
        <?php esc_html_e( 'The key that comes from ', 'msmvpapi' ); ?><a href="https://mvpapi.portal.azure-api.net/">MVP API Developer Portal</a>
    </p>
<?php
}
 
/**
 * top level menu
 */
function msmvpapi_options_page() {
    // add top level menu page
    add_menu_page(
        'Microsoft MVP API',
        'MS-MVP API',
        'manage_options',
        'ms-mvp-api',
        'msmvpapi_options_page_html'
    );
}
 
/**
 * register our msmvpapi_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'msmvpapi_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function msmvpapi_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    
    // add error/update messages
    
    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'msmvpapi_messages', 'msmvpapi_message', __( 'Settings Saved', 'msmvpapi' ), 'updated' );
    }
    
    // show error/update messages
    settings_errors( 'msmvpapi_messages' );
?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
<?php
            // output security fields for the registered setting "msmvpapi"
            settings_fields( 'msmvpapi' );
            // output setting sections and their fields
            // (sections are registered for "msmvpapi", each field is registered to a specific section)
            do_settings_sections( 'msmvpapi' );
            // output save settings button
            submit_button( 'Save Settings' );
?>
<a href="#" class="app-login" >Login</a>
        </form>
    </div>
 <?php
}