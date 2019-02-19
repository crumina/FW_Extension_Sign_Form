<?php

$ext = fw_ext( 'sign-form' );

if ( !is_admin() ) {
    wp_enqueue_style( 'crumina-sign-form', $ext->locate_URI( '/static/css/styles.css' ), array(), $ext->manifest->get_version() );
    wp_enqueue_script( 'crumina-sign-form', $ext->locate_URI( '/static/js/scripts.js' ), array(), $ext->manifest->get_version(), true );

    $config              = $ext->get_config();
    $config[ 'ajaxUrl' ] = admin_url( 'admin-ajax.php' );

    wp_localize_script( 'crumina-sign-form', 'ajaxPortfolioConfig', $config );
} else {
    wp_enqueue_style( 'crumina-sign-form-admin', $ext->locate_URI( '/static/css/admin.css' ), array(), $ext->manifest->get_version() );
}