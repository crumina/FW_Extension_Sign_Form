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

$classes   = array( 'content' );
$classes[] = $ext->get_config( 'selectors/formLogin' );
$classes[] = $ext->get_config( 'selectors/form' );
?>
<div class="title h6"><?php esc_html_e( 'Login to your Account', 'crumina' ); ?></div>
<form data-handler="<?php echo esc_attr( $ext->get_config( 'actions/signIn' ) ); ?>" class="<?php echo implode( ' ', $classes ); ?>" method="POST" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
    <input type="hidden" value="<?php echo wp_create_nonce( 'crumina-sign-form' ); ?>" name="_ajax_nonce" />
    
    <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>"/>
    <input type="hidden" name="redirect" value="<?php echo esc_attr( $redirect ); ?>"/>

    <?php echo apply_filters( 'login_form_top', '' ); ?>
    <?php do_action( 'logy_before_login_fields' ); ?>
    
    <ul class="crumina-sign-form-messages"></ul>
    
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

            <button type="submit" class="btn btn-lg btn-primary full-width">
				<span><?php esc_html_e( 'Login', 'crumina' ); ?></span>
				<svg class="icon-loader" stroke="#fff">
					<g fill="none" fill-rule="evenodd" stroke-width="2" transform="translate(1 1)">
						<circle cx="5" cy="50" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="50;5;50;50"/>
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="5;27;49;5"/>
						</circle>
						<circle cx="27" cy="5" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" from="5" repeatCount="indefinite" to="5" values="5;50;50;5"/>
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" from="27" repeatCount="indefinite" to="27" values="27;49;5;27"/>
						</circle>
						<circle cx="49" cy="50" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="50;50;5;50"/>
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" from="49" repeatCount="indefinite" to="49" values="49;5;27;49"/>
						</circle>
					</g>
				</svg>
			</button>

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