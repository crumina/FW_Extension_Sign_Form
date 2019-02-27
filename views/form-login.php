<?php
/**
 * @var int $rand
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
 */
$can_register = get_option( 'users_can_register' );
$ext          = fw_ext( 'sign-form' );
?>
<div class="title h6"><?php esc_html_e( 'Login to your Account', 'crumina' ); ?></div>
<form data-handler="<?php echo esc_attr( $ext->get_config( 'actions/signIn' ) ); ?>" class="<?php echo esc_attr( $ext->get_config( 'selectors/formLogin' ) ); ?> content" method="POST" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
    <input type="hidden" value="<?php echo wp_create_nonce( 'crumina-sign-form' ); ?>" name="_ajax_nonce" />
    <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>"/>

    <?php echo apply_filters( 'login_form_top', '' ); ?>
    <div class="row">
        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <?php do_action( 'logy_before_login_fields' ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group label-floating">
                <label class="control-label"><?php esc_html_e( 'Username', 'crumina' ); ?></label>
                <input class="form-control" name="log" >
            </div>
            <div class="form-group label-floating password-eye-wrap">
                <label class="control-label"><?php esc_html_e( 'Your Password', 'crumina' ); ?></label>
                <a href="#" class="fa fa-fw fa-eye password-eye"></a>
                <input class="form-control" name="pwd"  type="password">
            </div>

            <div class="remember">

                <div class="checkbox">
                    <label>
                        <input name="rememberme" value="forever" type="checkbox">
                        <?php esc_html_e( 'Remember Me', 'crumina' ); ?>
                    </label>
                </div>

                <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot"><?php esc_html_e( 'Forgot my Password', 'crumina' ); ?></a>
            </div>

            <button type="submit" class="btn btn-lg btn-primary full-width"><?php esc_html_e( 'Login', 'crumina' ); ?></button>

            <?php echo apply_filters( 'login_form_bottom', '' ); ?>

            <?php
            if ( $can_register ) {

                if ( $login_descr ) {
                    echo apply_filters( 'the_content', $login_descr );
                } else {
                    echo sprintf( '<p>%s <a href="%s">%s</a> %s</p>', esc_html__( 'Don\'t you have an account?', 'olympus' ), esc_url( wp_registration_url() ), esc_html__( 'Register Now!', 'olympus' ), esc_html__( 'it\'s really simple and you can start enjoing all the benefits!', 'olympus' ) );
                }
            }
            ?>
        </div>
    </div>
</form>