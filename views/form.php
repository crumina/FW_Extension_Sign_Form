<?php
/**
 * @var string $redirect_to
 */


$ext = fw_ext( 'sign-form' );

if ( is_user_logged_in() ) {
    echo $ext->get_view( 'vcard' );
    return;
}

$rand         = rand( 1000, 9999 );
$can_register = get_option( 'users_can_register' );

if ( function_exists( 'bp_current_component' ) ) {
    if ( bp_current_component() === 'register' ) {
        $can_register = 0;
    }
}
?>

<div class="registration-login-form mb-0 <?php echo esc_attr( $can_register ? 'can-register' : 'can-not-register'  ); ?>">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#login-panel-<?php echo esc_attr( $rand ); ?>"
               role="tab">
                <svg class="olymp-login-icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-login-icon"></use>
                </svg>
            </a>
        </li>
        <?php if ( $can_register ) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#register-panel-<?php echo esc_attr( $rand ); ?>"
                   role="tab">
                    <svg class="olymp-register-icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-register-icon"></use>
                    </svg>
                </a>
            </li>
        <?php } ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="login-panel-<?php echo esc_attr( $rand ); ?>" role="tabpanel" data-mh="log-tab">
            <?php echo $ext->get_view( 'form-login', array(
                'redirect_to' => $redirect_to,
                'rand' => $rand,
            ) ); ?>
        </div>

        <?php if ( $can_register ) { ?>
            <div class="tab-pane" id="register-panel-<?php echo esc_attr( $rand ); ?>" role="tabpanel" data-mh="log-tab">
                <?php echo $ext->get_view( 'form-register' ); ?>
            </div>
        <?php } ?>
    </div>
</div>