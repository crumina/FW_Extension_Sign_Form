<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$ext = fw_ext( 'stunning-header' );

$options = array(
    'sign-form' => array(
        'title'    => esc_html__( 'Sign form (popup)', 'crumina' ),
        'type'     => 'tab',
        'priority' => 'high',
        'options'  => array(
            'sign-form-forms'       => array(
                'type'    => 'select',
                'value'   => 'both',
                'label'   => esc_html__( 'Display', 'crumina' ),
                'choices' => array(
                    'both'     => esc_html__( 'Both', 'crumina' ),
                    'login'    => esc_html__( 'Login', 'crumina' ),
                    'register' => esc_html__( 'Register', 'crumina' ),
                )
            ),
            'sign-form-redirect'    => array(
                'type'    => 'select',
                'value'   => 'current',
                'label'   => esc_html__( 'Redirect to', 'crumina' ),
                'choices' => array(
                    'current' => esc_html__( 'Current page', 'crumina' ),
                    'profile' => esc_html__( 'Profile page', 'crumina' ),
                    'custom'  => esc_html__( 'Custom page', 'crumina' ),
                )
            ),
            'sign-form-redirect-to' => array(
                'type'    => 'multi-picker',
                'picker'  => 'sign-form-redirect',
                'choices' => array(
                    'custom' => array(
                        'redirect_to' => array(
                            'label' => esc_html__( 'Redirect URL', 'crumina' ),
                            'type'  => 'text',
                        )
                    )
                )
            ),
            'sign-form-login-descr'           => array(
                'label' => esc_html__( 'Login form description', 'crumina' ),
                'type'  => 'textarea',
            )
        )
    )
);
