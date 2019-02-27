<?php
$ext              = fw_ext( 'sign-form' );
$builderComponent = $ext->get_config( 'builderComponent' );
$actionName       = $ext->get_config( 'actions/sign' );

add_action( "wp_ajax_{$actionName}", 'FW_Extension_Sign_Form::sign' );
add_action( "wp_ajax_nopriv_{$actionName}", 'FW_Extension_Sign_Form::sign' );

add_filter( "vc_before_init", 'FW_Extension_Sign_Form::vc_mapping' );

add_filter( 'init', 'FW_Extension_Sign_Form::kc_mapping' );

add_filter( 'registration_errors', '_filter_fw_ext_sign_form_reg_errors', 10, 3 );

function _filter_fw_ext_sign_form_reg_errors( $errors, $sanitized_user_login, $user_email ) {

    $first_name = trim( filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ) );
    $last_name  = trim( filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ) );

    if ( empty( $first_name ) ) {
        $errors->add( 'first_name_error', sprintf( '<strong>%s</strong>: %s', esc_html__( 'ERROR', 'crumina' ), esc_html__( 'Please enter a first name.', 'crumina' ) ) );
    }

    if ( empty( $last_name ) ) {
        $errors->add( 'last_name_error', sprintf( '<strong>%s</strong>: %s', esc_html__( 'ERROR', 'crumina' ), esc_html__( 'Please enter a last name.', 'crumina' ) ) );
    }

    return $errors;
}

add_action( 'after_setup_theme', '_action_fw_ext_sign_form_wpsignup_redirect', 999 );

function _action_fw_ext_sign_form_wpsignup_redirect() {
    $action = isset( $_REQUEST[ 'action' ] ) ? $_REQUEST[ 'action' ] : '';
    $type   = isset( $_REQUEST[ 'type' ] ) ? $_REQUEST[ 'type' ] : '';

    if ( $action === 'register' && $type === 'internal' ) {
        remove_action( 'bp_init', 'bp_core_wpsignup_redirect' );
    }
}

add_action( 'register_form', '_action_fw_ext_sign_form_add_type_field', 999 );

function _action_fw_ext_sign_form_add_type_field() {
    ?>
    <input name="type" value="internal" type="hidden" />
    <?php
}

//
add_action( 'register_form', '_action_fw_ext_sign_form_add_reg_fields' );

function _action_fw_ext_sign_form_add_reg_fields() {
    $first_name = filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
    $last_name  = filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );
    ?>
    <p>
        <label for="first_name"><?php esc_html_e( 'First Name', 'olympus' ) ?><br />
            <input type="text" name="first_name" class="input" value="<?php echo esc_attr( $first_name ); ?>" size="25" /></label>
    </p>
    <p>
        <label for="last_name"><?php esc_html_e( 'Last Name', 'olympus' ) ?><br />
            <input type="text" name="last_name" class="input" value="<?php echo esc_attr( $last_name ); ?>" size="25" /></label>
    </p>
    <?php
}

add_action( 'user_register', '_action_fw_ext_sign_form_save_reg_fields' );

function _action_fw_ext_sign_form_save_reg_fields( $user_id ) {
    $first_name = filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
    $last_name  = filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );

    if ( !empty( $first_name ) ) {
        update_user_meta( $user_id, 'first_name', $first_name );
    }
    if ( !empty( $last_name ) ) {
        update_user_meta( $user_id, 'last_name', $last_name );
    }
}
