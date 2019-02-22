<?php
/**
 * @var int $rand
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
 */

?>
<div class="title h6"><?php esc_html_e( 'Register to', 'crumina' ); ?> <?php echo get_bloginfo( 'name' ); ?></div>
<form name="registerform" action="<?php echo esc_url( site_url( 'wp-login.php?action=register&type=internal', 'login_post' ) ); ?>" method="post" class="content">
    <?php do_action( 'logy_before_login_fields' ); ?>
    <div class="row">
        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group label-floating is-empty">
                <label class="control-label"><?php esc_html_e( 'First Name', 'crumina' ); ?></label>
                <input class="form-control" name="first_name"  type="text">
            </div>
        </div>
        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group label-floating is-empty">
                <label class="control-label"><?php esc_html_e( 'Last Name', 'crumina' ); ?></label>
                <input class="form-control" name="last_name"  type="text">
            </div>
        </div>
        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group label-floating is-empty">
                <label class="control-label"><?php esc_html_e( 'Your Login', 'crumina' ); ?></label>
                <input type="text" name="user_login" class="form-control" size="20" />
            </div>
            <div class="form-group label-floating is-empty">
                <label class="control-label"><?php esc_html_e( 'Your Email', 'crumina' ); ?></label>
                <input type="email" name="user_email" class="form-control" size="25" />
            </div>
            <button type="submit" class="btn btn-purple btn-lg full-width"><?php esc_html_e( 'Complete Registration!', 'crumina' ); ?></button>
        </div>
    </div>
</form>