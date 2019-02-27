<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$cfg = array();

$cfg[ 'builderComponent' ] = 'sign-form';
$cfg[ 'registerLinkSC' ]   = 'register-link';

$cfg[ 'actions' ] = array(
    'signin' => 'crumina-signin-form',
    'signup' => 'crumina-signup-form'
);

$cfg[ 'selectors' ] = array(
    //It will be classes
    'formContainer' => 'crumina-sign-form',
    'formRegister' => 'crumina-sign-form-register',
    'formLogin'    => 'crumina-sign-form-login',
);
