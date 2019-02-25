<?php

$ext           = fw_ext( 'sign-form' );
$builderComponent = $ext->get_config( 'builderComponent' );

add_filter( "vc_before_init", 'FW_Extension_Sign_Form::vc_mapping' );

add_filter( 'init', 'FW_Extension_Sign_Form::kc_mapping' );