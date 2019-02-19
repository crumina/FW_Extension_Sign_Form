<?php

$ext           = fw_ext( 'sign-form' );
$shortcodeName = $ext->get_config( 'shortcodeName' );

add_filter( "vc_before_init", 'FW_Extension_Sign_Form::vc_mapping' );

add_filter( 'init', 'FW_Extension_Sign_Form::kc_mapping' );