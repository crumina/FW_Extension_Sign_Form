<?php
/**
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
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

<div id="<?php echo esc_attr( $ext->get_config( 'selectors/formContainer' ) ); ?>" class="registration-login-form mb-0 selected-forms-<?php echo esc_attr( $forms ); ?>">
    <!-- Nav tabs -->
    <?php if ( $can_register && $forms === 'both' ) { ?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#login-panel-<?php echo esc_attr( $rand ); ?>"
                   role="tab">
                    <svg class="olymp-login-icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-login-icon"></use>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#register-panel-<?php echo esc_attr( $rand ); ?>"
                   role="tab">
                    <svg class="olymp-register-icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-register-icon"></use>
                    </svg>
                </a>
            </li>
        </ul>
    <?php } ?>

    <div class="tab-content">
        <?php if ( ($forms === 'login' || $forms === 'both' ) ) { ?>
            <div class="tab-pane" id="login-panel-<?php echo esc_attr( $rand ); ?>" role="tabpanel" data-mh="log-tab">
                <?php
                echo $ext->get_view( 'form-login', array(
                    'rand'        => $rand,
                    'login_descr' => $login_descr,
                    'redirect_to' => $redirect_to,
                    'redirect'    => $redirect,
                    'forms'       => $forms,
                ) );
                ?>
            </div>
        <?php } ?>

        <?php if ( $can_register && ($forms === 'register' || $forms === 'both') ) { ?>
            <div class="tab-pane" id="register-panel-<?php echo esc_attr( $rand ); ?>" role="tabpanel" data-mh="log-tab">
                <?php
                echo $ext->get_view( 'form-register', array(
                    'rand'        => $rand,
                    'login_descr' => $login_descr,
                    'redirect_to' => $redirect_to,
                    'redirect'    => $redirect,
                    'forms'       => $forms,
                ) );
                ?>
            </div>
        <?php } ?>
    </div>
</div>