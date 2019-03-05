<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$manifest = array();

$manifest[ 'name' ]         = esc_html__( 'Sign form', 'crumina' );
$manifest[ 'description' ]  = esc_html__( 'Sign form.', 'crumina' );
$manifest[ 'github_repo' ]  = 'https://github.com/crumina/FW_Extension_Sign_Form';
$manifest[ 'version' ]      = '1.0.11';
$manifest[ 'thumbnail' ]    = plugins_url( 'unyson/framework/extensions/sign-form/static/img/thumbnail.png' );
$manifest[ 'display' ]      = true;
$manifest[ 'standalone' ]   = true;