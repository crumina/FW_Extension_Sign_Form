<?php

if ( !defined( 'FW' ) ) {
    return;
}

/**
 * Generate html markup for registration form.
 *
 * @param $redirect_to string Redirect URL
 */
function crumina_get_reg_form_html( $redirect_to = '' ) {
    global $wp;
    $ext = fw_ext( 'sign-form' );

    $redirect_to = filter_var( $redirect_to, FILTER_VALIDATE_URL );
    $redirect_to = $redirect_to ? $redirect_to : home_url( $wp->request );

    return $ext->get_view( 'form', array(
                'redirect_to' => $redirect_to,
                'forms'       => 'both',
                'redirect'    => 'current',
                'login_descr' => '',
            ) );
}
