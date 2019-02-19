<div class="form--login-logout">
    <form name="loginform" class="form-inline" method="POST" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
        <div class="form-group">
            <input class="form-control form-control-sm" name="log" type="text" placeholder="Username"  required>
        </div>
        <div class="form-group">
            <input class="form-control form-control-sm" name="pwd" type="password" placeholder="Password" required>
        </div>
        <input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . filter_input( INPUT_SERVER, 'HTTP_HOST' ) . filter_input( INPUT_SERVER, 'REQUEST_URI' ); ?>" />
        <button type="submit" class="btn btn-primary btn-md-2"><?php esc_html_e( 'Login', 'olympus' ); ?></button>
    </form>
    <a href="#" class="btn btn-primary btn-md-2 login-btn-responsive" data-toggle="modal" data-target="#registration-login-form-popup">Login</a>
</div>