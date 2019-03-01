<?php
/**
 * @var int    $rand
 * @var string $redirect_to
 * @var string $redirect
 * @var string $forms
 * @var string $login_descr
 */
$ext = fw_ext( 'sign-form' );

$classes   = array( 'content' );
$classes[] = $ext->get_config( 'selectors/formRegister' );
$classes[] = $ext->get_config( 'selectors/form' );
?>
<div class="title h6"><?php esc_html_e( 'Register to', 'crumina' ); ?><?php echo get_bloginfo( 'name' ); ?></div>
<form data-handler="<?php echo esc_attr( $ext->get_config( 'actions/signUp' ) ); ?>" name="registerform" class="<?php echo implode( ' ', $classes ); ?>" action="<?php echo esc_url( site_url( 'wp-login.php?action=register&type=internal', 'login_post' ) ); ?>" method="post">

	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
	<input type="hidden" name="redirect" value="<?php echo esc_attr( $redirect ); ?>" />

	<input type="hidden" value="<?php echo wp_create_nonce( 'crumina-sign-form' ); ?>" name="_ajax_nonce" />

	<?php do_action( 'logy_before_login_fields' ); ?>

	<ul class="crumina-sign-form-messages"></ul>

	<div class="row">
		<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="form-group label-floating is-empty">
				<label class="control-label"><?php esc_html_e( 'First Name', 'crumina' ); ?></label>
				<input class="form-control" name="first_name" type="text">
			</div>
		</div>
		<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="form-group label-floating is-empty">
				<label class="control-label"><?php esc_html_e( 'Last Name', 'crumina' ); ?></label>
				<input class="form-control" name="last_name" type="text">
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

			<div class="gdpr">
				<div class="checkbox">
					<label>
						<input name="gdpr" type="checkbox">
						<?php echo $ext::getPrivacyLink(); ?>
					</label>
				</div>

				<p><?php esc_html_e( 'I allow this website to collect and store submitted data.', 'crumina' ); ?></p>
			</div>

			<button type="submit" class="btn btn-purple btn-lg full-width">
				<span><?php esc_html_e( 'Complete Registration!', 'crumina' ); ?></span>
				<span><?php esc_html_e( 'Login', 'crumina' ); ?></span>
				<svg class="icon-loader" stroke="#fff">
					<g fill="none" fill-rule="evenodd" stroke-width="2" transform="translate(1 1)">
						<circle cx="5" cy="50" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="50;5;50;50" />
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="5;27;49;5" />
						</circle>
						<circle cx="27" cy="5" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" from="5" repeatCount="indefinite" to="5" values="5;50;50;5" />
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" from="27" repeatCount="indefinite" to="27" values="27;49;5;27" />
						</circle>
						<circle cx="49" cy="50" r="5">
							<animate attributeName="cy" begin="0s" calcMode="linear" dur="2.2s" repeatCount="indefinite" values="50;50;5;50" />
							<animate attributeName="cx" begin="0s" calcMode="linear" dur="2.2s" from="49" repeatCount="indefinite" to="49" values="49;5;27;49" />
						</circle>
					</g>
				</svg>
			</button>
		</div>
	</div>
</form>