<?php
/**
 * @var int $rand
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
 */
$can_register = get_option( 'users_can_register' );
?>
<div class="title h6"><?php esc_html_e( 'Login to your Account', 'crumina' ); ?></div>
<form class="content" method="POST" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
    <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>"/> <?php echo apply_filters( 'login_form_top', '' ); ?>
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
            <div class="form-group label-floating">
                <label class="control-label"><?php esc_html_e( 'Your Password', 'crumina' ); ?></label>
                <input class="form-control" name="pwd"  type="password">
            </div>

            <div class="remember">

                <div class="checkbox">
                    <label>
                        <input name="rememberme" value="forever" type="checkbox">
                        <?php esc_html_e( 'Remember Me', 'crumina' ); ?>
                    </label>
                </div>
                <a href="<?php echo home_url( '/my-account/lost-password/' ); ?>"
                   class="forgot"><?php esc_html_e( 'Forgot my Password', 'crumina' ); ?></a>
            </div>

            <button type="submit"
                    class="btn btn-lg btn-primary full-width"><?php esc_html_e( 'Login', 'crumina' ); ?></button>

            <?php echo apply_filters( 'login_form_bottom', '' ); ?>

            <?php
            if ( $can_register ) {
                echo apply_filters( 'the_content', $login_descr );
            }
            ?>
        </div>
    </div>
</form>