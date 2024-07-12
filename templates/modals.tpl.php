<div class="drawers-group" data-drawers-group="system">
	<?php if( !AUTH ){ ?>	
		<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="registration" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1">
				<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">
					<div class="ur-frontend-form">
						<form method="post" class="register modal__content auth-form" data-form-id="596" data-enable-strength-password="1" data-minimum-password-strength="3" data-captcha-enabled="1">
							<h4 class="auth-form__title">Register</h4>
							<div class="auth-form__body">
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="first_name" type="text" class="input-text   input-text ur-frontend-field   form-field__input auth-form-field__input" name="first_name" id="first_name" placeholder="" required="required" data-label="First Name">
									<div class="auth-form-field__title">First Name  <span class="required" title="required">*</span></div>					
								</div>
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="last_name" type="text" class="input-text   input-text ur-frontend-field   form-field__input auth-form-field__input" name="last_name" id="last_name" placeholder="" required="required" data-label="Last Name"><div class="auth-form-field__title">Last Name  <span class="required" title="required">*</span></div>					
								</div>
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="user_email" type="email" class="input-text   input-email ur-frontend-field   form-field__input auth-form-field__input" name="user_email" id="user_email" placeholder="" required="required" data-label="Email">
									<div class="auth-form-field__title">Email  <span class="required" title="required">*</span></div>					
								</div>
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="user_pass" type="password" class="input-text  input-password ur-frontend-field   form-field__input auth-form-field__input" name="user_pass" id="user_pass" placeholder="" value="" required="required" data-label="Password">
									<div class="auth-form-field__title">Password  <span class="required" title="required">*</span></div>
									<div class="auth-form-field__tip">(8 char.min, at least one capital letter, number, special char)</div>					
								</div>
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="user_confirm_password" type="password" class="input-text  input-password ur-frontend-field   form-field__input auth-form-field__input" name="user_confirm_password" id="user_confirm_password" placeholder="" value="" required="required" data-label="Confirm Password">
									<div class="auth-form-field__title">Confirm Password  <span class="required" title="required">*</span></div>					
								</div>
								<div class="auth-form-field ur-form-grid">
									<input data-rules="" data-id="user_code" type="text" class="input-text   input-text ur-frontend-field   form-field__input auth-form-field__input" name="user_code" id="user_code" placeholder="" required="required" data-label="Password retrieval code">
									<div class="auth-form-field__title">Password retrieval code  <span class="required" title="required">*</span></div>					
								</div>
							</div>
							<div id="ur-recaptcha-node"> 
								<div id="node_recaptcha_register_undefined" class="g-recaptcha">
									<div style="width: 304px; height: 78px;">
										<div>
											<iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-s8uz23j4jn58" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="/anchor.php"></iframe>
										</div>
										<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
									</div>
									<iframe style="display: none;"></iframe>
								</div>
							</div>						
							<div class="auth-form__actions">
								<button type="submit" class="btn btn_inverted auth-form__btn ur-submit-button" conditional_rules="&quot;&quot;">Submit</button>
							</div>
							<div style="clear:both"></div>
							<input type="hidden" name="ur-user-form-id" value="596">
							<input type="hidden" name="ur-redirect-url" value="https://cairsplan.com/my-account/">
							<input type="hidden" id="ur_frontend_form_nonce" name="ur_frontend_form_nonce" value="5fd74623b1">
						</form>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				// reg
				$('[data-drawer-open="registration"]').off().on('click', function(){
					$('.is-open').removeClass('is-open'); 
					$('[data-drawer="registration"]').addClass('is-open');
				});
				$('[data-drawer="registration"] .ur-submit-button').off().on('click', function(e){ 
					e.preventDefault(); 
					e.stopPropagation();
					var $data = {
						first_name: $('[data-drawer="registration"] #first_name').val(),
						last_name: $('[data-drawer="registration"] #last_name').val(), 
						user_email: $('[data-drawer="registration"] #user_email').val(), 
						user_pass: $('[data-drawer="registration"] #user_pass').val(), 
						user_confirm_password: $('[data-drawer="registration"] #user_confirm_password').val(), 
						user_code: $('[data-drawer="registration"] #user_code').val()
					}
					console.log( $data ); 
					$.ajax({
						url:"/api/user/reg", type:"post", method:"post", data:$data, 
						success:function($r){
							var $obj = typeof $r == "string" ? eval('('+$r+')') : $r; 
							console.log( $obj );
							if( $obj.success ){
								window.location.reload(); 
							} 
							if( $obj.error ){
								console.errorr("Error: "+ ($obj.msg ? $obj.msg : ''));
							}
						}, 
						error: function($e){ console.error( $e ); }
					});
					$('.is-open').removeClass('is-open');
				});
			});
		</script>
	<?php } ?>

	<?php if( !AUTH ){ ?>
		<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="password-recovery" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1">
				<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">				
					<form class="modal__content auth-form" method="post">
						<h4 class="auth-form__title">FORGOT PASSWORD</h4>
						<div class="auth-form__body">
							<!--div class="auth-form-field">
								<input type="text" name="first-name" class="form-field__input auth-form-field__input">
								<div class="auth-form-field__title">First name</div>
							</div>
							<div class="auth-form-field">
								<input type="text" name="last-name" class="form-field__input auth-form-field__input">
								<div class="auth-form-field__title">Last name</div>
							</div-->
							<div class="auth-form-field">
								<input class="form-field__input auth-form-field__input" type="email" name="user_login" id="user_login">
								<div class="auth-form-field__title">Email</div>
							</div>
							<!--div class="auth-form-field">
								<input type="text" name="recovery-code" class="form-field__input auth-form-field__input">
								<div class="auth-form-field__title">Password recovery code</div>
							</div-->
						</div>
						<div class="auth-form__actions">
							<input type="hidden" name="ur_reset_password" value="true">
							<button type="submit" class="btn btn_inverted auth-form__btn">Reset password</button>
							<input type="hidden" id="_wpnonce" name="_wpnonce" value="5dca4ccdcd">
							<input type="hidden" name="_wp_http_referer" value="/">	
						</div>
					</form>				
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('[data-drawer-open="password-recovery"]').off().on('click', function(){
						$('.is-open').removeClass('is-open'); 
						$('[data-drawer="password-recovery"]').addClass('is-open');
					});
					$('[data-drawer="password-recovery"] .auth-form__btn').off().on('click', function(e){
						e.preventDefault(); 
						e.stopPropagation();
						var $data = {
							email: $('[data-drawer="password-recovery"] input[name="user_login"]').val() 
						} 
						console.log( $data ); 
						$.ajax({
							url:"/api/user/retrieve", type:"post", method:"post", data:$data, 
							success: function( $r ){
								var $obj = typeof $r == "string" ? eval('('+$r+')') : $r; 
								console.log( $obj ); 
								if( $obj.success ){ 
									$('#confirm-modal-title').html("Retrieve code sent to email "+$data.email);
									$('[data-drawer="confirm-modal"]').addClass('is-open');
									$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('.is-open').removeClass('is-open'); }); 
									$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('.is-open').removeClass('is-open'); }); 
								} 
								if( $obj.error ){
									$('#confirm-modal-title').html("Error: "+($obj.msg ? $obj.msg : ''));
									$('[data-drawer="confirm-modal"]').addClass('is-open');
									$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
									$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
								}
							}, 
							error: function( $e ){ console.error( $e );  }
						});
					});
				});
			</script>
		</div>
	<?php } ?>

	<?php if( !AUTH ){ ?>
		<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="login" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1">
				<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">
					<div id="user-registration" class="user-registration">
						<div class="ur-frontend-form">
							<form class="modal__content auth-form login-form login" method="post">
								<div class="auth-form__body">
									<div class="auth-form-field">
										<input placeholder="" type="text" class="form-field__input auth-form-field__input" name="username" id="username" style="">
										<div class="auth-form-field__title">Email</div>
									</div>
									<div class="auth-form-field">
										<input placeholder="" class="form-field__input auth-form-field__input" type="password" name="password" id="password" style="">
										<div class="auth-form-field__title">Password</div>
									</div>
								</div>
								<div class="auth-form__actions auth-form__actions_col">		
									<input type="hidden" id="user-registration-login-nonce" name="user-registration-login-nonce" value="1950809597"><input type="hidden" name="_wp_http_referer" value="/">						
									<button type="submit" class="btn btn_inverted auth-form__btn login-form__btn" id="user_registration_ajax_login_submit">Login</button>
									<span></span>
									<input type="hidden" name="redirect" value="">
									<button type="button" class="auth-form__text-btn auth-form__text-btn_uppercase" data-drawer-open="registration">Register</button>
									<button type="button" class="auth-form__text-btn" data-drawer-open="password-recovery">Forgot password</button>
								</div>
							</form>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				$('.login-trigger').off().on('click', function(){ 
					$('.is-open').removeClass('is-open'); 
					$('[data-drawer="login"]').addClass('is-open');
				});
				$('#user_registration_ajax_login_submit').off().on('click', function(e){ 
					e.preventDefault(); 
					e.stopPropagation();
					var $data = {
						username: $('[data-drawer="login"] #username').val(), 
						password: $('[data-drawer="login"] #password').val()
					} 
					console.log( $data ); 
					$.ajax({
						url:"/api/user/auth", type:"post", method:"post", data:$data, 
						success: function($r){
							var $obj = typeof $r == "string" ? eval('('+$r+')') : $r;
							console.log( $r ); 
							if( $obj.success ){
								window.location.href = "/my-account"; 
							} 
							if( $obj.error ){
								$('#confirm-modal-title').html("Error: "+($obj.msg ? $obj.msg : ''));
								$('[data-drawer="confirm-modal"]').addClass('is-open');
								$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
								$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
							}
						}, 
						error: function($e){ console.error($e); }
					});
					$('.is-open').removeClass('is-open');
				});
			});
		</script>
	<?php } ?>


	<?php if( 2 == 3 ){ ?>
	<!-- Log out confirmations -->
		<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="logout-confirm" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1">
				<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">
					<div class="modal__content logout-msg">YOU HAVE LOGGED OUT</div>
				</div>
			</div>
		</div>
	<?php } ?> 

<!-- Confirm -->
	<div class="modal sp-modal micromodal-slide drawer_modal drawer_initialized" data-drawer="confirm-modal" aria-hidden="true">
		<div class="modal__overlay" tabindex="-1">
			<div class="modal__container sp-modal__body" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">
				<div class="modal__content">
					<div class="modal__title"><h2 id="confirm-modal-title">Dynamic title</h2></div>
					<form class="sp-modal__form" id="confirm-modal-form">
						<div class="modal__actions sp-modal__actions">
							<button type="submit" class="modal-btn">Yes</button>
							<button type="button" class="modal-btn" data-drawer-close="confirm-modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



<!-- Contact Us form -->
	<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="contact-us" aria-hidden="true">
		<div class="modal__overlay" tabindex="-1">
			<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">		
				<div class="wpcf7 js" id="wpcf7-f595-o1" lang="en-US" dir="ltr">
					<div class="screen-reader-response">
						<p role="status" aria-live="polite" aria-atomic="true"></p> 
						<ul></ul>
					</div>
					<form action="/#wpcf7-f595-o1" method="post" class="wpcf7-form modal__content auth-form init" aria-label="Contact form" novalidate="novalidate" data-status="init">
						<div style="display: none;">
							<input type="hidden" name="_wpcf7" value="595">
							<input type="hidden" name="_wpcf7_version" value="5.9.5">
							<input type="hidden" name="_wpcf7_locale" value="en_US">
							<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f595-o1">
							<input type="hidden" name="_wpcf7_container_post" value="0">
							<input type="hidden" name="_wpcf7_posted_data_hash" value="">
						</div>
						<div class="auth-form__body">
							<div class="auth-form-field">
								<span class="wpcf7-form-control-wrap" data-name="cfname">
									<input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-field__input" aria-required="true" aria-invalid="false" type="text" name="cfname">
								</span>
								<div class="auth-form-field__title">Name</div>
							</div>
							<div class="auth-form-field">
								<span class="wpcf7-form-control-wrap" data-name="cfemail">
									<input size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email form-field__input" aria-required="true" aria-invalid="false" type="email" name="cfemail">
								</span>
								<div class="auth-form-field__title">E-mail</div>
							</div>
							<div class="auth-form-field">
								<span class="wpcf7-form-control-wrap" data-name="message">
									<textarea cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-field__input" aria-required="true" aria-invalid="false" name="message"></textarea>
								</span>
								<div class="auth-form-field__title">Message</div>
							</div>
						</div>
						<div class="auth-form__actions">
							<button type="submit" class="btn btn_inverted auth-form__btn">Submit</button>
						</div>
						<div class="wpcf7-response-output" aria-hidden="true"></div>
					</form>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){ 
				$('.contacts-trigger').off().on('click', function(){ 
					$('.is-open').removeClass('is-open'); 
					$('[data-drawer="contact-us"]').addClass('is-open');
				});
				$('[data-drawer="contact-us"] .auth-form__btn').off().on('click', function(e){
					var $data = {
						name: $('[data-drawer="contact-us"] input[name="cfname"]').val(), 
						email: $('[data-drawer="contact-us"] input[name="cfemail"]').val(), 
						message: $('[data-drawer="contact-us"] textarea[name="message"]').val() 
					} 
					console.log( $data ); 
					$('.is-open').removeClass('is-open');
				}); 
			});
		</script>
	</div>


	<?php if( AUTH ){ ?>
		<div class="modal micromodal-slide drawer_modal drawer_initialized" data-drawer="password-change" aria-hidden="true" style="--z-index: 1;">
			<div class="modal__overlay" tabindex="-1">
				<div class="modal__container" role="dialog" aria-modal="true" data-elem="drawer.panel" tabindex="-1">
					<div id="user-registration" class="user-registration">
						<form class="user-registration-EditAccountForm edit-password modal__content auth-form" method="post" data-enable-strength-password="1" data-minimum-password-strength="3">
							<h4 class="auth-form__title">Change Password</h4>
							<div class="auth-form__body">
								<div class="auth-form-field">
									<input type="password" class="form-field__input auth-form-field__input" name="password_current" id="password_current">
									<div class="auth-form-field__title">Current password</div>
								</div>
								<div class="auth-form-field">
									<input type="password" class="form-field__input auth-form-field__input" name="password_1" id="password_1">
									<div class="auth-form-field__title">New password</div>
									<div class="auth-form-field__tip">(8 char.min, at least one capital letter, number, special char)</div>
								</div>
								<div class="auth-form-field">
									<input type="password" name="password-confirmation" class="form-field__input auth-form-field__input" id="password_2">
									<div class="auth-form-field__title">Confirm new password</div>
								</div>
								<div class="auth-form-field">
									<input type="text" name="recovery-code" class="form-field__input auth-form-field__input">
									<div class="auth-form-field__title">New recovery code</div>
								</div>
							</div>
							<div class="auth-form__actions">
								<input type="hidden" id="_wpnonce" name="_wpnonce" value="b1370b7c77">
								<input type="hidden" name="_wp_http_referer" value="/my-account/">			
								<button type="submit" class="btn btn_inverted auth-form__btn" name="save_change_password">Save changes</button>
								<input type="hidden" name="action" value="save_change_password">
							</div>
						</form>
					</div>				
				</div>
			</div>
		</div> 
		<script>
			$(document).ready(function(){
				$('[data-drawer-open="password-change"]').off().on('click', function(){
					$('.is-open').removeClass('is-open'); 
					$('[data-drawer="password-change"]').addClass('is-open');
				}); 
				$('[data-drawer="password-change"] button[name="save_change_password"]').off().on('click', function(e){
					e.preventDefault(); 
					e.stopPropagation(); 
					var $data = {
						password_current: $('#password_current').val(), 
						password_1: $('#password_1').val(), 
						password_2: $('#password_2').val(), 
						code: $('[data-drawer="password-change"] [name="recovery-code"]').val() 
					}
					console.log( $data ); 
				});
			});
		</script>
	<?php } ?>

</div>

<script>
	$(document).ready(function(){ 
		$('.modal__overlay').off().on('click', function(){
			$('.is-open').removeClass('is-open');
		});
		$('.modal__container').off().on('click', function(e){
			e.preventDefault(); 
			e.stopPropagation();
		});
	});
</script>



