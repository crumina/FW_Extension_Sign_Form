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

$classes   = array( 'registration-login-form', 'mb-0' );
$classes[] = $ext->get_config( 'selectors/formContainer' );
$classes[] = "selected-forms-{$forms}";

if ( $forms !== 'both' ) {
    $classes[] = 'selected-forms-single';
}
?>

<div class="<?php echo implode( ' ', $classes ); ?>">
    <!-- Nav tabs -->
    <?php if ( $can_register && $forms === 'both' ) { ?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#login-panel-<?php echo esc_attr( $rand ); ?>"
                   role="tab">
                    <svg class="olymp-login-icon" data-toggle="tooltip" data-placement="top" data-original-title="Login">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-login-icon"></use>
                    </svg>
					<span class="icon-title">Login</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#register-panel-<?php echo esc_attr( $rand ); ?>"
                   role="tab">
                    <svg class="olymp-register-icon" data-toggle="tooltip" data-placement="top" data-original-title="Registration">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-register-icon"></use>
                    </svg>
					<span class="icon-title">Registration</span>
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