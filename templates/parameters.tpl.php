<?php 
	if( AUTH ){ 
		$params = array(); 
		$PARAM = Parameters::getInstance(); 
		$p = $PARAM->load( array('status'=>2) ); 
		//var_dump( $p );  
		if( $p ){
			foreach( $p as $row ){
				$params[ $row['id'] ] = $row; 
			} 
			unset( $row ); 
		}
?>
		<style>
			[data-start="start"]{ max-width:1140px; display:flex; flex-flow:row nowrap; justify-content:stretch; align-items:stretch; gap:20px; padding:0px; margin:0px auto; } 
			[data-start="start"] .uc-params__tab{ flex:0 0 50%; max-width:50%; } 
			#create-params-form{ flex:0 0 50%; } 
			#params_list{ display:none; flex:0 0 50%; max-width:50%; }
			.tabs__body[data-start="start"], 
			.tabs__body[data-start="start"] * { visibility:visible; } 
			.user-cabinet{ padding-bottom:100px; } 
			#edit-plan-delete-btn{ display:none; }
		</style>

		<div class="user-cabinet">
			<div class="user-cabinet__container">
				<?php include_once TPL_DIR ."account-dashboard". TPL_EXT; ?>
				<div class="uc-dashboard">
					<?php include_once TPL_DIR ."account-menu". TPL_EXT; ?>
					<div class="tabs uc-dashboard__body uc-params" data-component="tabs">

						<div id="response-message" style="display:none;">Parameters saved!</div>

						<form class="uc-params__header" data-elem="tabs.controls">
							<label class="uc-params-tab-btn" data-type="edit">
								<input type="radio" checked="" value="0" name="active-tab">
								<span class="btn uc-params-tab-btn__body">
									<span class="uc-params-tab-btn__caption">CREATE<br>PARAMETERS</span>
								</span>
							</label>
							<label class="uc-params-tab-btn" data-type="list">
								<input type="radio" value="1" name="active-tab">
								<span class="btn uc-params-tab-btn__body">
									<span class="uc-params-tab-btn__caption">VIEW / EDIT<br>PARAMETERS</span>
								</span>
							</label>
						</form>
						<div class="tabs__body uc-params__body" data-elem="tabs.body" data-start="start">
							
							<!--div class="uc-params__tab"-->
								<div id="create-params-form" class="uc-params-form" method="post">
									<div class="uc-params-form__body">
										<div class="uc-params-form__section">
											<div class="uc-params-form-group">
												<h4 class="uc-params-form-group__title">TUNNEL</h4>
												<div class="uc-params-form-group__body">
													<div class="uc-params-form-field">
														<div class="uc-params-form-field__title">Inner diameter</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="tunnel-inner-diameter" maxlength="10">
														</div>
													</div>
													<div class="uc-params-form-field">
														<div class="uc-params-form-field__title">Outer diameter</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="tunnel-outer-diameter" maxlength="10">
														</div>
													</div>
													<div class="uc-params-form-field">
														<div class="uc-params-form-field__title">Depth</div>
														<div class="input-with-units" data-unit="microns">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="tunnel-depth" maxlength="10">
														</div>
													</div>
												</div>
											</div>
											<div class="uc-params-form-group">
												<h4 class="uc-params-form-group__title">Donor cut 1</h4>
												<div class="uc-params-form-group__body">
													<div class="uc-params-form-field uc-params-form__field">
														<div class="uc-params-form-field__title">Diameter</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="donor-cut-1-diameter" maxlength="10">
														</div>
													</div>
													<div class="uc-params-form-field">
														<div class="uc-params-form-field__title">Depth</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="donor-cut-1-depth" maxlength="10">
														</div>
													</div>
												</div>
											</div>
											<div class="uc-params-form-group">
												<h4 class="uc-params-form-group__title">Donor cut 2</h4>
												<div class="uc-params-form-group__body">
													<div class="uc-params-form-field uc-params-form__field">
														<div class="uc-params-form-field__title">Diameter</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="donor-cut-2-diameter" maxlength="10">
														</div>
													</div>
													<div class="uc-params-form-field">
														<div class="uc-params-form-field__title">Depth</div>
														<div class="input-with-units" data-unit="mm">
															<input type="number" class="form-field__input uc-params-form-field__input" value="" name="donor-cut-2-depth" maxlength="10">
														</div>
													</div>
												</div>
											</div>
											<div class="uc-params-form__selected">
												<div class="uc-params-form-group">
													<h4 class="uc-params-form-group__title">Non-femto</h4>
													<div class="uc-params-form-group__body">
														<div class="uc-params-form-field uc-params-form__field">
															<div class="uc-params-form-field__title">Segment width</div>
															<div class="input-with-units" data-unit="microns">
																<input type="number" class="form-field__input uc-params-form-field__input" value="" name="segment-width" maxlength="10">
															</div>
														</div>
														<div class="uc-params-form-field">
															<div class="uc-params-form-field__title">Segment depth</div>
															<div class="input-with-units" data-unit="microns">
																<input type="number" class="form-field__input uc-params-form-field__input" value="" name="segment-depth" maxlength="10">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="uc-params-form__section">
											<div class="uc-params-form-group">
												<div class="uc-params-form-field uc-params-form__field">
													<div class="uc-params-form-field__title">Name of parameters</div>
													<input type="text" class="form-field__input uc-params-form-field__input uc-params-form-field__input_primary" value="" name="parameters_name">
												</div>
											</div>
										</div>
									</div>
									<div class="uc-params-form__actions">
										<input type="hidden" name="parameters_id" value="">
										<button type="submit" class="btn" name="saveParameters">Save</button>
										<button id="edit-plan-cancel-btn" type="button" class="btn">Cancel</button>
										<button id="edit-plan-delete-btn" type="button" class="btn">Delete</button>
									</div>
								</div>
							<!--/div-->
							
							<!--div class="uc-params__tab"-->			
								<ul class="records-list params-list" id="params_list"> 
									<?php 
										if( $params ){ 
											foreach( $params as $key=>$row ){
												echo '<li class="params-list__item" style="margin-bottom:10px;">
															<button type="button" class="btn" data-id="'. $key .'">'. $row['name'] .'</button>
														</li>'; 
											} 
											unset( $row ); 
										}
									?>
								</ul>
							<!--/div-->

						</div>
					</div> 
				</div>
			</div>
		</div>
		
		<script>
			function App(){
				return {
					params: eval('(<?= json_encode( $params ? $params : array() ); ?>)'),
					init: function(){
						var $this=this; 
						$this.bind();
					},
					bind: function(){
						var $this=this; 
						$('.uc-params-tab-btn').off().on('click', function(e){
							var $self = $(this); 
							var $type = $self.data('type'); 
							console.log( $type ); 
							switch( $type ){
								case "edit": 
									$this.clear_params(); 
									$('#params_list').hide(); 
									break; 
								case "list": 
									$('#params_list').show(); 
									break; 
							}
						});
						$('#params_list button').off().on('click', function(e){ 
							e.preventDefault(); 
							e.stopPropagation();
							var $self=$(this); 
							var $wrap = $self.parent().parent();
							var $id=$self.attr('data-id'); 
							$('.btn_active', $wrap).removeClass('btn_active');
							$self.addClass('btn_active');
							if( $id ){ $this.load_params( $id ); } 
						}); 
						// save parameters
						$('[name="saveParameters"]').off().on('click', function(){
							var $data = {
								tunnel_inner_diameter: $('input[name="tunnel-inner-diameter"]').val(), 
								tunnel_outer_diameter: $('input[name="tunnel-outer-diameter"]').val(), 
								tunnel_depth: $('input[name="tunnel-depth"]').val(), 
								donor_cut_1_diameter: $('input[name="donor-cut-1-diameter"]').val(), 
								donor_cut_1_depth: $('input[name="donor-cut-1-depth"]').val(), 
								donor_cut_2_diameter: $('input[name="donor-cut-2-diameter"]').val(), 
								donor_cut_2_depth: $('input[name="donor-cut-2-depth"]').val(), 
								segment_width: $('input[name="segment-width"]').val(), 
								segment_depth: $('input[name="segment-depth"]').val(), 
								name: $('input[name="parameters_name"]').val(), 
								id: $('input[name="parameters_id"]').val() 
							} 
							console.log( $data ); 
							$.ajax({
								url:"/api/parameters/edit", type:"post", method:"post", data:$data, 
								success: function($r){
									var $obj = typeof $r == "string" ? eval('('+$r+')') : $r; 
									console.log( $obj ); 
									if( $obj.success ){
										$('#response-message').show().html("Parameters saved!"); 
										window.location.reload(); 
									} 
									if( $obj.error ){
										$('#confirm-modal-title').html("Error: "+($obj.msg ? $obj.msg : ''));
										$('[data-drawer="confirm-modal"]').addClass('is-open');
										$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
										$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
									}
								}, 
								error: function( $e ){ console.error( $e ); }
							}); 
						}); 
						// cacel edition
						$('#edit-plan-cancel-btn').off().on('click', function(){ 
							$('#confirm-modal-title').html("Are you sure you want to cancel?"); 
							$('[data-drawer="confirm-modal"]').addClass('is-open'); 
							$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $this.clear_params(); $('.is-open').removeClass('is-open'); }); 
							$('[data-drawer-close="confirm-modal"]').off().on('click', function(){ $('.is-open').removeClass('is-open'); }); 
						});
						// delete parameters
						$('#edit-plan-delete-btn').off().on('click', function(){
							var $id = +$('input[name="parameters_id"]').val(); 
							if( $id ){
								$('#confirm-modal-title').html("Are you sure you want to delete parameters?");
								$('[data-drawer="confirm-modal"]').addClass('is-open');
								$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $this.delete_params( $id ); $('.is-open').removeClass('is-open'); }); 
								$('[data-drawer-close="confirm-modal"]').off().on('click', function(){ $('.is-open').removeClass('is-open'); }); 
							}
						});
					},
					clear_params: function(){ 
						var $this=this;
						$('[name="tunnel-inner-diameter]').val("");
						$('[name="tunnel-outer-diameter"]').val(""); 
						$('[name="tunnel-depth"]').val(""); 
						$('[name="donor-cut-1-diameter"]').val(""); 
						$('[name="donor-cut-1-depth"]').val(""); 
						$('[name="donor-cut-2-diameter"]').val(""); 
						$('[name="donor-cut-2-depth"]').val(""); 
						$('[name="segment-width"]').val(""); 
						$('[name="segment-depth"]').val(""); 
						$('[name="parameters_name"]').val(""); 
						$('[name="parameters_id"]').val(""); 
						$('#edit-plan-delete-btn').hide(); 
					}, 
					load_params: function( $id ){ 
						var $this=this;
						var $row = $this.params[ $id ]; 
						console.log("Load params ", $row ); 
						if( $row ){
							$this.draw_params( $row ); 
							$('#edit-plan-delete-btn').show();
						}
					}, 
					draw_params: function( $row ){
						var $this=this; 
						if( $row ){
							$('input[name="tunnel-inner-diameter"]').val( $row.tunnel_inner_diameter );
							$('input[name="tunnel-outer-diameter"]').val( $row.tunnel_outer_diameter ); 
							$('input[name="tunnel-depth"]').val( $row.tunnel_depth ); 
							$('input[name="donor-cut-1-diameter"]').val( $row.donor_cut_1_diameter ); 
							$('input[name="donor-cut-1-depth"]').val( $row. donor_cut_1_depth ); 
							$('input[name="donor-cut-2-diameter"]').val( $row.donor_cut_2_diameter ); 
							$('input[name="donor-cut-2-depth"]').val( $row.donor_cut_2_depth ); 
							$('input[name="segment-width"]').val( $row.segment_width ); 
							$('input[name="segment-depth"]').val( $row.segment_depth ); 
							$('input[name="parameters_name"]').val( $row.name ); 
							$('input[name="parameters_id"]').val( $row.id ); 
							$('#edit-plan-delete-btn').hide(); 
						}
					}, 
					delete_params: function( $id ){
						var $this=this; 
						var $data = {
							id: $id, 
							status: 5  
						}
						$.ajax({
							url:"/api/parameters/edit", type:"post", method:"post", data:$data, 
							success: function($r){
								var $obj = typeof $r == "string" ? eval('('+$r+')') : $r; 
								console.log( $obj ); 
								if( $obj.success ){
									$('#response-message').show().html("Parameters successfully removed"); 
									window.location.reload(); 
								} 
								if( $obj.error ){
									$('#confirm-modal-title').html("Error: "+($obj.msg ? $obj.msg : ''));
									$('[data-drawer="confirm-modal"]').addClass('is-open');
									$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
									$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ e.preventDefault(); e.stopPropagation(); $('[data-drawer="confirm-modal"]').removeClass('is-open'); }); 
								}
							}, 
							error: function( $e ){ console.error( $e ); }
						}); 
					}
				}
			}
			$(document).ready(function(){ 
				window.$app = new App(); 
				$app.init(); 
			}); 
		</script>
<?php 
	} 
	else { 
		include_once TPL_DIR ."404". TPL_EXT; 
	}
?>


