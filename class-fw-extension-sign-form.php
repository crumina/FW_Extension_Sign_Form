<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

class FW_Extension_Sign_Form extends FW_Extension {

    protected function _init() {
        add_shortcode( $this->get_config( 'shortcodeName' ), array( $this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {

        $builder_type = isset( $atts[ 'builder_type' ] ) ? $atts[ 'builder_type' ] : '';

        if ( $builder_type !== 'kc' && function_exists( 'vc_map_get_attributes' ) ) {
            $atts = vc_map_get_attributes( $this->get_config( 'shortcodeName' ), $atts );
        }

        $atts = shortcode_atts( array(
        
        ), $atts );

        wp_localize_script( 'sign-form', 'signFormParams', array(
            'nonce' => wp_create_nonce( 'sign-form-nonce' ),
            'ext'   => $this,
            'atts'  => $atts,
        ) );

        return $this->render_view( 'main', array(
            'ext'  => $this,
            'atts' => $atts,
        ) );
        
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

    public static function kc_mapping() {
        $shortcodeName = fw_ext( 'sign-form' )->get_config( 'shortcodeName' );

        if ( function_exists( 'kc_add_map' ) ) {
            kc_add_map( array(
                $shortcodeName => array(
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
        $ext           = fw_ext( 'sign-form' );
        $shortcodeName = $ext->get_config( 'shortcodeName' );

        if ( function_exists( 'vc_map' ) ) {
            vc_map( array(
                'base'     => $shortcodeName,
                'name'     => esc_html__( 'Sign Form', 'sign-form' ),
                'category' => esc_html__( 'Crumina', 'sign-form' ),
                'icon'     => $ext->locate_URI( '/static/img/builder-ico.svg' ),
                'params'   => array(
                    
                    
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
