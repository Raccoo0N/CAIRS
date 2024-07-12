<?php 
	if( AUTH ){
?>
		<div class="user-cabinet">
			<div class="user-cabinet__container">
				<div class="user-cabinet-header user-cabinet__header">
					<div id="user-registration" class="user-registration 0">
						<?php include_once TPL_DIR ."account-dashboard". TPL_EXT; ?>
						<div class="uc-dashboard">
							<?php include_once TPL_DIR ."account-menu". TPL_EXT; ?>
							<div class="uc-dashboard__body details-body">
								<div id="details-form" class="details-form" method="post" enctype="multipart/form-data">
									<div class="form-field details-form__field">
										<input id="clinic-name" type="text" class="form-field__input" name="clinic-name">
										<label for="clinic-name" class="form-field__title">Clinic name</label>
									</div>
									<div class="form-field details-form__field">
										<input id="surgeon-name" type="text" class="form-field__input" name="surgeon-name">
										<label for="surgeon-name" class="form-field__title">Surgeon name</label>
									</div>
									<div class="user-registration-profile-header">
										<div class="user-registration-img-container surgeon-logo" style="width:100%">
											<img decoding="async" class="profile-preview" alt="profile-picture" src="/static/img/1x1.png">
										</div>
										<div class="button-group">
											<input type="hidden" name="profile-pic-url" id="profile_pic_url" value="">
											<input type="hidden" name="profile-default-image" value="/static/img/1x1.png">
											<button class="button profile-pic-remove downloader details-form__uploader" data-attachment-id="" style="display:none;">Remove logo</button>
											<label type="button" class="button user_registration_profile_picture_upload hide-if-no-js downloader details-form__uploader">
												<input type="file" name="preview" style="display:none;"> Upload logo
											</label>
											<input type="file" id="ur-profile-pic" name="profile-pic" class="profile-pic-upload" accept="image/jpeg,image/gif,image/png" style="display:none">
										</div>
									</div>
									<div class="details-form__actions">
										<button type="submit" class="btn details-form__save-btn" name="save-details">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 

		<script>
			$(document).ready(function(){
				$('[name="save-details"]').off().on('click', function(e){
					var $data = {
						clinic: $('#clinic-name').val(), 
						surgeon: $('#surgeon-name').val(),  
						preview: $('.profile-preview').attr('src')
					} 
					console.log( $data );
				});
			});
		</script>
<?php 
	} 
	else {
		include_once TPL_DIR ."404". TPL_EXT; 
	}
?>


