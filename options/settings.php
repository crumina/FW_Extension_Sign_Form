<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$ext = fw_ext( 'stunning-header' );

$options = array(
    'sign-form' => array(
        'title'    => esc_html__( 'Sign form', 'crumina' ),
        'type'     => 'tab',
        'priority' => 'high',
        'options'  => array(
            
        ),
    ),
);
