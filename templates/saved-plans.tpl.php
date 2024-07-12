<?php 
	if( AUTH ){ 
		$PLAN = Plan::getInstance(); 
		$plans = array(); 
		$p = $PLAN->load( array('status'=>2) ); 
		if( $p ){
			foreach( $p as $row ){
				$plans[ $row['id'] ] = $row; 
			}
			unset( $row );
		} 
		//var_dump( $plans );
?>
		<div class="user-cabinet">
			<div class="user-cabinet__container">
				<?php include_once TPL_DIR ."account-dashboard". TPL_EXT; ?>
				<div class="uc-dashboard">
					<?php include_once TPL_DIR ."account-menu". TPL_EXT; ?>
					<div class="uc-dashboard__body saved-plans">
						<ul class="records-list saved-plans__list" id="saved_plans_list"> 
							<?php 
								if( $plans ){
									foreach( $plans as $key=>$row ){
										echo '<li class="saved-plan-item plans-list__item" data-plan-id="'. $key .'"> 
												<div class="saved-plan-item__name">'. $row['name'] .'</div>
												<div class="saved-plan-item__actions">
													<a href="/cairs-plan-tool/plan/'. $key .'" class="btn btn_inverted saved-plan-item__btn open_saved_plan" data-launch="">Launch<br>cairs tool</a>
													<button type="button" class="btn btn_inverted saved-plan-item__btn delete_saved_plan">Delete plan</button>
												</div>
											</li>'; 
									}
									unset( $row );
								}
							?>
						</ul>
					</div>
				</div>
			</div>			
		</div>

		<script>
			function App(){
				return {
					init: function(){
						var $this=this; 
						$this.bind(); 
					}, 
					bind: function(){
						var $this=this; 
						$('#saved_plans_list .open_saved_plan').off().on('click', function(e){ 
							e.preventDefault(); 
							e.stopPropagation(); 
							var $self = $(this); 
							var $wrap = $self.parent().parent();
							var $id = $wrap.attr('data-plan-id'); 
							if( $id ){ window.location.href = "/cairs-plan-tool/plan/"+$id; } 
							else { console.error("id not found"); }
						});
						$('#saved_plans_list .delete_saved_plan').off().on('click', function(e){
							e.preventDefault(); 
							e.stopPropagation(); 
							var $self = $(this); 
							var $wrap = $self.parent().parent();
							var $id = $wrap.attr('data-plan-id'); 
							if( $id ){ 
								$('[data-drawer="confirm-modal"]').addClass('is-open'); 
								$('#confirm-modal-title').html("Are you sure you want to delete saved plan '"+ $('.saved-plan-item__name', $wrap).html() +"'?"); 
								$('[data-drawer="confirm-modal"] [type="submit"]').off().on('click', function(e){ 
									e.preventDefault(); 
									e.stopPropagation(); 
									$('.is-open').removeClass('is-open'); 
									$this.delete_plan( $id ); 
									$('#saved_plans_list li[data-plan-id="1"]').remove(); 
								}); 
								$('[data-drawer-close="confirm-modal"]').off().on('click', function(e){ 
									e.preventDefault(); 
									e.stopPropagation(); 
									$('.is-open').removeClass('is-open'); 
								}); 
							} 
							else { 
								console.error("id not found"); 
							}
						}); 
					}, 
					delete_plan: function( $id ){
						var $this=this; 
						if( $id ){ 
							var $data = { id:$id, status:5 }
							$.ajax({
								url: "/api/plan/edit", type:"post", method:"post", data:$data, 
								success: function($r){
									var $obj = typeof $r == "string" ? eval('('+ $r +')') : $r; 
									console.log($obj);
									if( $obj.success ){
										window.location.reload(); 
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
						}
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


