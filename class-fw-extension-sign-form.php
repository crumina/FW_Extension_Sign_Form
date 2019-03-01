<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

class FW_Extension_Sign_Form extends FW_Extension {

    protected function _init() {
        add_shortcode( $this->get_config( 'builderComponent' ), array( $this, 'builderComponent' ) );
        add_shortcode( $this->get_config( 'registerLinkSC' ), array( $this, 'registerLink' ) );
    }

    public function builderComponent( $atts ) {
        global $wp;

        $builder_type = isset( $atts[ 'builder_type' ] ) ? $atts[ 'builder_type' ] : '';

        if ( $builder_type !== 'kc' && function_exists( 'vc_map_get_attributes' ) ) {
            $atts = vc_map_get_attributes( $this->get_config( 'builderComponent' ), $atts );
        }

        $atts = shortcode_atts( array(
            'forms'       => 'both',
            'redirect'    => 'current',
            'redirect_to' => '',
            'login_descr' => '',
                ), $atts );

        $redirect_to = filter_var( $atts[ 'redirect_to' ], FILTER_VALIDATE_URL );

        if ( $redirect_to && $atts[ 'redirect' ] === 'custom' ) {
            $atts[ 'redirect_to' ] = $redirect_to;
        } else {
            $atts[ 'redirect_to' ] = home_url( $wp->request );
        }

        wp_localize_script( 'sign-form', 'signFormParams', array(
            'nonce' => wp_create_nonce( 'sign-form-nonce' ),
            'ext'   => $this,
            'atts'  => $atts,
        ) );

        return $this->render_view( 'form', $atts );
    }

    public function registerLink( $atts ) {
        $atts = shortcode_atts( array(
            'url'  => '',
            'text' => '',
                ), $atts );

        $atts[ 'url' ] = filter_var( $atts[ 'url' ], FILTER_VALIDATE_URL );

        $url  = $atts[ 'url' ] ? $atts[ 'url' ] : esc_url( wp_registration_url() );
        $text = $atts[ 'text' ] ? $atts[ 'text' ] : esc_html__( 'Register Now!', 'crumina' );

        return "<a href='{$url}'>{$text}</a>";
    }

    /**
     * @param string $name View file name (without .php) from <extension>/views directory
     * @param  array $view_variables Keys will be variables names within view
     * @param   bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
     * @return string HTML
     */
    final public function get_view( $name, $view_variables = array(), $return = true ) {
        $full_path = $this->locate_path( '/views/' . $name . '.php' );

        if ( !$full_path ) {
            trigger_error( 'Extension view not found: ' . $name, E_USER_WARNING );
            return;
        }

        return fw_render_view( $full_path, $view_variables, $return );
    }

    public static function signIn() {
        check_ajax_referer( 'crumina-sign-form' );

        $errors = array();

        $log         = filter_input( INPUT_POST, 'log' );
        $pwd         = filter_input( INPUT_POST, 'pwd' );
        $rememberme  = filter_input( INPUT_POST, 'rememberme' );
        $redirect    = filter_input( INPUT_POST, 'redirect' );
        $redirect_to = filter_input( INPUT_POST, 'redirect_to', FILTER_VALIDATE_URL );

        if ( !$log ) {
            $errors[ 'log' ] = esc_html__( 'Login is required', 'crumina' );
        }

        if ( !$pwd ) {
            $errors[ 'pwd' ] = esc_html__( 'Password is required', 'crumina' );
        }

        if ( !empty( $errors ) ) {
            wp_send_json_error( array(
                'errors' => $errors,
            ) );
        }

        $user = wp_signon( array(
            'user_login'    => $log,
            'user_password' => $pwd,
            'remember'      => $rememberme,
                ) );

        if ( is_wp_error( $user ) ) {
            wp_send_json_error( array(
                'message' => $user->get_error_message(),
            ) );
        }

        if ( $redirect === 'profile' && function_exists( 'bp_core_get_user_domain' ) ) {
            $redirect_to = bp_core_get_user_domain( $user->ID );
        }

        wp_send_json_success( array(
            'redirect_to' => $redirect_to ? $redirect_to : ''
        ) );
    }

    public static function signUp() {
        check_ajax_referer( 'crumina-sign-form' );

        $errors = array();

        $user_login  = filter_input( INPUT_POST, 'user_login' );
        $user_email  = filter_input( INPUT_POST, 'user_email', FILTER_VALIDATE_EMAIL );
        $first_name  = filter_input( INPUT_POST, 'first_name' );
        $last_name   = filter_input( INPUT_POST, 'last_name' );
        $gdpr        = filter_input( INPUT_POST, 'gdpr' );
        $redirect_to = filter_input( INPUT_POST, 'redirect_to', FILTER_VALIDATE_URL );

        if ( !$user_login ) {
            $errors[ 'user_login' ] = esc_html__( 'Login is required', 'crumina' );
        }

        if ( !$user_email ) {
            $errors[ 'user_email' ] = esc_html__( 'Email is required', 'crumina' );
        }

        if ( !$first_name ) {
            $errors[ 'first_name' ] = esc_html__( 'First name is required', 'crumina' );
        }

        if ( !$last_name ) {
            $errors[ 'last_name' ] = esc_html__( 'Last name is required', 'crumina' );
        }

        if ( !$gdpr ) {
            $errors[ 'gdpr' ] = esc_html__( 'GDPR is required', 'crumina' );
        }

        if ( !empty( $errors ) ) {
            wp_send_json_error( array(
                'errors' => $errors,
            ) );
        }

        $user_id = register_new_user( $user_login, $user_email );

        if ( is_wp_error( $user_id ) ) {
            wp_send_json_error( array(
                'message' => $user->get_error_message(),
            ) );
        }

        // Authorize user
        wp_set_auth_cookie( $user_id, true );

        if ( $redirect === 'profile' && function_exists( 'bp_core_get_user_domain' ) ) {
            $redirect_to = bp_core_get_user_domain( $user_id );
        }

        wp_send_json_success( array(
            'redirect_to' => $redirect_to ? $redirect_to : ''
        ) );
    }

    public static function getPrivacyLink() {
        $page = get_option( 'wp_page_for_privacy_policy' );

        if ( $page ) {
            $status = get_post_status( $page );
            if ( $status === 'publish' ) {
                return sprintf( '%s <a href="%s" target="_blank">%s</a>', esc_html__( 'Accept', 'crumina' ), get_permalink( $page ), esc_html__( 'Privacy Policy', 'crumina' ) );
            }
        }

        return esc_html__( 'Accept Privacy Policy', 'crumina' );
    }

    public static function kc_mapping() {
        $builderComponent = fw_ext( 'sign-form' )->get_config( 'builderComponent' );

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map( array(
                $builderComponent => array(
                    'name'     => esc_html__( 'Sign Form', 'sign-form' ),
                    'category' => esc_html__( 'Crumina', 'sign-form' ),
                    'icon'     => 'kc-sign-form-icon',
                    'params'   => array(
                        array(
                            'type'  => 'hidden',
                            'name'  => 'builder_type',
                            'value' => 'kc'
                        )
                    )
                )
            ) );
        }
    }

    public static function vc_mapping() {
        $ext              = fw_ext( 'sign-form' );
        $builderComponent = $ext->get_config( 'builderComponent' );

        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                'base'     => $builderComponent,
                'name'     => esc_html__( 'Sign Form', 'sign-form' ),
                'category' => esc_html__( 'Crumina', 'sign-form' ),
                'icon'     => $ext->locate_URI( '/static/img/builder-ico.svg' ),
                'params'   => array(
                    array(
                        'heading'    => esc_html__( 'Display', 'crumina' ),
                        'param_name' => 'forms',
                        'type'       => 'dropdown',
                        'value'      => array(
                            esc_html__( 'Both', 'crumina' )     => 'both',
                            esc_html__( 'Login', 'crumina' )    => 'login',
                            esc_html__( 'Register', 'crumina' ) => 'register',
                        ),
                        'std'        => 'both',
                    ),
                    array(
                        'heading'    => esc_html__( 'Redirect to', 'crumina' ),
                        'param_name' => 'redirect',
                        'type'       => 'dropdown',
                        'value'      => array(
                            esc_html__( 'Current page', 'crumina' ) => 'current',
                            esc_html__( 'Profile page', 'crumina' ) => 'profile',
                            esc_html__( 'Custom page', 'crumina' )  => 'custom',
                        ),
                        'std'        => 'current',
                    ),
                    array(
                        'heading'    => esc_html__( 'Redirect URL', 'crumina' ),
                        'param_name' => 'redirect_to',
                        'type'       => 'textfield',
                        'dependency' => array(
                            'element' => 'redirect',
                            'value'   => 'custom',
                        )
                    ),
                    array(
                        'heading'     => esc_html__( 'Login form description', 'crumina' ),
                        'param_name'  => 'login_descr',
                        'type'        => 'textarea',
                        'description' => esc_html__( 'You can use [register_link text="" url=""] shortcode', 'crumina' ),
                        'dependency'  => array(
                            'element' => 'forms',
                            'value'   => array( 'both', 'login' ),
                        )
                    ),
                    array(
                        'type'       => 'hidden',
                        'param_name' => 'builder_type',
                        'value'      => 'vc'
                    )
                )
            ) );
        }
    }

}
