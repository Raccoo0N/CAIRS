<style>
	h1{ padding-top:100px; font-weight:700; }
	#retrieve_wrapper{ display:flex; flex-flow:row:nowrap; justify-content:center; align-items:center; gap:0; margin:0; padding:0; width:100%; height:100%; }
	h4 .auth-form__title{ color:#fff; }
</style>
<?php 
	if( ACTION ){
		$USER = User::getInstance(); 
		$code = App::uid( ACTION ); 
		$email = $USER->check_retrieve( array('code'=>$code) ); 
		//var_dump( $email ); 
		if( $email ){
			$user = $USER->get( array('email'=>$email) ); 
			//var_dump( $user ); 
			if( $user ){
?>
				
				<div id="retrieve_wrapper">
					<div class="modal__container" role="dialog" aria-modal="true" data-drawer="password-change">
						<div id="user-registration" class="user-registration">
							<div class="user-registration-EditAccountForm edit-password modal__content auth-form" method="post" data-enable-strength-password="1" data-minimum-password-strength="3">
								<input type="hidden" value="<?= $code; ?>" id="retrieve_code" name="retrieve_code">
								<input type="hidden" id="user_uid" value="<?= md5( $user['ID'] ); ?>" name="uid">
								<h4 class="auth-form__title">Change Password</h4>
								<div class="auth-form__body"> 
									<div class="auth-form-field">
										<input type="password" class="form-field__input auth-form-field__input" name="password_1" id="password_1">
										<div class="auth-form-field__title">New password</div>
										<div class="auth-form-field__tip">(8 char.min, at least one capital letter, number, special char)</div>
									</div>
									<div class="auth-form-field">
										<input type="password" name="password-confirmation" class="form-field__input auth-form-field__input" id="password_2">
										<div class="auth-form-field__title">Confirm new password</div>
									</div> 
								</div>
								<div class="auth-form__actions">
									<input type="hidden" id="_wpnonce" name="_wpnonce" value="b1370b7c77">
									<input type="hidden" name="_wp_http_referer" value="/my-account/">			
									<button type="submit" class="btn btn_inverted auth-form__btn" name="save_change_password">Save changes</button>
									<input type="hidden" name="action" value="save_change_password">
								</div>
							</div>
						</div>				
					</div>				
				</div>

				<script>
					$(document).ready(function(){ 
						$('[data-drawer="password-change"] button[name="save_change_password"]').off().on('click', function(e){
							e.preventDefault(); 
							e.stopPropagation(); 
							var $data = {
								uid: $('#user_uid').val(), 
								code: $('#retrieve_code').val(), 
								password_1: $('#password_1').val(), 
								password_2: $('#password_2').val()
							}
							console.log( $data ); 
							if( $data.uid && $data.code && $data.password_1 && $data.password_2 ){
								$.ajax({
									url:"/api/user/chpass", type:"post", method:"post", data:$data, 
									success: function($r){
										var $obj = typeof $r == "string" ? eval('('+$r+')') : $r; 
										console.log( $obj );
										if( $obj.success ){
											window.location.href = "/"; 
										} 
										if( $obj.error ){
											$('#confirm-modal-title').html("Error: "+($obj.msg ? $obj.msg : ''));
											$('[data-drawer="confirm-modal"]').addClass('is-open');
											$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
											$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
										}
									}, 
									error: function($e){ console.error($e); }
								});
							}
						});
					});
				</script>
<?php
			} 
			else {
				echo '<h1>USER NOT FOUND OR BLOCKED</h1>';
			}
		}
		else {
			echo '<h1>RETRIEVE CODE NOT FOUND</h1>';
		}
	}
	else {
		include_once TPL_DIR ."404". TPL_EXT; 
	}
?>
