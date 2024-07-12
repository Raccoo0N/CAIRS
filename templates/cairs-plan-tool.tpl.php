<?php 
	$PLAN = Plan::getInstance(); 
	$PARAMS = Parameters::getInstance(); 
	$plan = array(); 
	if( ACTION && ACTION == "plan" && ITEM_ID ){
		$plan_id = (int)ITEM_ID; 
		$plan = $PLAN->get( array('id'=>$plan_id) );
		if( $plan && ( $plan['uid'] == UID || ADMIN ) ){

		} 
		else {
			$plan = array(); 
		}
	}
	$plans = array(); 
	$params = array(); 
	if( AUTH ){ 
		$p = $PLAN->load( array('uid'=>UID, 'status'=>2) );
		if( $p ){
			foreach( $p as $row ){ $plans[ $row['id'] ] = $row; } 
			unset( $row ); 
		} 
		unset( $p );
		$p = $PARAMS->load( array('uid'=>UID, 'status'=>2) );
		if( $p ){
			foreach( $p as $row ){ $params[ $row['id'] ] = $row; }
			unset( $row );
		}
		unset( $p );
	} 
?>
<div id="main_field">
    <div class="tool-layout__wrapper">
      	<div class="container tool-layout__tool" id="wrapper_tool">
        	<div id="topdferapper" class="tool-layout__left">
          		<div id="tool-left-header" class="tool-layout__left-header">Left eye</div>
          		<div class="tool-layout__left-body">
	                <div id="nose_left" class="nose_wrapper nose-decor nose-decor_left tool-layout__nose-decor tool-layout__nose-decor_left">
	                  	<div class="nose-decor__inner">
	                    	<img src="/static/img/nose.png" alt="Nose">
	                  	</div>
	                </div>
            		<div id="canvas_wrapper" class="tool-layout__left-content">
	                  	<div class="tool-layout__output">
	                    	<div class="canvas_render">
	                      		<canvas class="canvas" width="620" height="620"></canvas>
	                      		<div class="photo">
			                        <div class="marker a"></div>
			                        <div class="marker b"></div>
			                        <div class="marker c"></div>
			                        <div class="marker d"></div>
			                        <div class="marker e"></div>
			                        <div class="marker f"></div>
			                        <div class="marker g"></div>
			                        <div class="marker h"></div>
	                      		</div>
	                    	</div>
	                    	<div class="tool-layout-ruler">
								<div data-value="9"></div>
								<div></div>
								<div></div>
								<div data-value="6"></div>
								<div></div>
								<div></div>
								<div data-value="3"></div>
								<div></div>
								<div></div>
								<div data-value="0"></div>
								<div></div>
								<div></div>
								<div data-value="3"></div>
								<div></div>
								<div></div>
								<div data-value="6"></div>
								<div></div>
								<div></div>
								<div data-value="9"></div>
	                    	</div>
	                  	</div>
              			<div id="spiners" class="axis-controls tool-layout__axis-controls">
                			<div class="axis-controls__inner">
                  				<div class="axis-controls__row">
                      				<div class="range-set">
                        				<h3 class="axis_holder range-set__header"><span class="range-set__label">Arc 1 Axis</span></h3>
										<div class="range-set__set">
											<div class="range" data-to="360">
												<button class="btn_left"></button>
												<input id="slider1" class="sliders range-set__slider" type="range" value="270" min="0" max="360" data-type="lines" data-id="1" autocomplete="off">
												<button class="btn_right"></button>
											</div>
											<input type="text" name="axis_1" value="270" class="inputs range-set__value" data-id="1" data-type="angle" autocomplete="off" maxlength="3">
										</div>
                      				</div>
									<div class="range-set">
										<h3 class="axis_holder range-set__header"><span class="range-set__label">Arc 2 Axis</span></h3>
										<div class="range-set__set">
											<div class="range" data-to="360">
												<button class="btn_left"></button>
												<input id="slider2" class="sliders range-set__slider" type="range" value="0" min="0" max="360" data-type="lines" data-id="2" autocomplete="off">  
												<button class="btn_right"></button>
											</div>
											<input type="text" name="axis_2" value="0" class="inputs range-set__value" data-id="2" data-type="angle" maxlength="3" autocomplete="off">
										</div>
									</div>
									<div class="range-set">
										<h3 class="range-set__header"><span class="range-set__label">Incision 1</span></h3>
										<div class="range-set__set">
											<div class="range" data-to="360">
												<button class="btn_left" id="incision_1_btn_left" data-line="1" data-id="1" data-type="incision"></button>
												<input id="slider5" class="sliders range-set__slider" type="range" value="0" min="0" max="360" data-line="0" data-type="incision" data-line="1" data-id="1" autocomplete="off">
												<button class="btn_right" id="incision_1_btn_right"data-line="1" data-id="1" data-type="incision"></button>
											</div>
											<input type="text" name="incision_1" value="0" class="inputs range-set__value" data-line="1" data-id="1" id="incision1" data-type="incision" autocomplete="off" maxlength="3">
										</div>
									</div>
                    			</div>
                  			</div>
							<div class="checkers_row">
								<div class="checkers_cell"></div>
								<div class="checkers_cell">
									<label class="cm-checkbox tool-layout__axis-2-toggle">
										<input type="checkbox" name="is_axis_2" class="axis_hidder" autocomplete="off">
										<span class="cm-checkbox__thumb"></span>
									</label>
								</div>
								<div class="checkers_cell">
									<label class="cm-checkbox tool-layout__satellites-toggle-wrap">
										<input type="checkbox" name="capture_satellites" class="capture_satellites" autocomplete="off" checked="checked">
										<span class="cm-checkbox__thumb"></span>
									</label>
								</div>
							</div>
                  			<div class="axis-controls__row">
								<div class="range-set">
									<h3 class="range-set__header"><span class="range-set__label">Arc 1 Length</span></h3>
									<div class="range-set__set">
										<div class="range" data-to="355">
											<button class="btn_left"></button>
											<input id="slider3" class="sliders range-set__slider" type="range" value="120" min="0" max="355" data-type="arcs" data-id="1" autocomplete="off"> 
											<button class="btn_right"></button>
										</div>
										<input type="text" name="arc_1" value="120" class="inputs range-set__value" data-id="1" id="arc1" data-type="arc" autocomplete="off" maxlength="3"> 
									</div>
								</div>
		                        <div class="range-set">
		                          	<h3 class="range-set__header"><span class="range-set__label">Arc 2 Length</span></h3>
		                          	<div class="range-set__set">
		                            	<div class="range" data-to="355">
		                              		<button class="btn_left"></button>
		                              		<input id="slider4" class="sliders range-set__slider" type="range" value="0" min="0" max="355" data-type="arcs" data-id="2" autocomplete="off">
		                              		<button class="btn_right"></button>
		                            	</div>
		                            	<input type="text" name="arc_2" value="0" class="inputs range-set__value" data-id="2" id="arc2" data-type="arc" autocomplete="off" maxlength="3"> 
		                          	</div>
		                        </div>
								<div class="range-set">
									<h3 class="range-set__header"><span class="range-set__label">Incision 2</span></h3>
									<div class="range-set__set">
										<div class="range" data-to="360">
											<button class="btn_left" disabled="disabled" id="incision_2_btn_left" data-line="1" data-id="2" data-type="incision"></button>
											<input id="slider6" class="sliders range-set__slider" type="range" value="180" min="0" max="360" data-type="incision" data-line="1" data-id="2" autocomplete="off" disabled="disabled">
											<button class="btn_right" disabled="disabled" id="incision_2_btn_right" data-line="1" data-id="2" data-type="incision"></button>
										</div>
										<input type="text" name="incision_2" value="180" class="inputs range-set__value" data-line="1" data-id="2" id="incision2" data-type="incision" autocomplete="off" maxlength="3" disabled="disabled">
									</div>
								</div>
							</div> 
						</div>
            		</div>
            		<div id="nose_right" class="nose_wrapper nose-decor nose-decor_right tool-layout__nose-decor tool-layout__nose-decor_right">
              			<div class="nose-decor__inner">
                			<img src="/static/img/nose.png" alt="Nose">
              			</div>
            		</div>
          		</div>
        	</div>
        	<div id="patient_data" class="form tool-layout__right">
          		<h2 class="form__title">Patient information</h2>
          		<div class="form__body">
            		<section class="form-section">
	                  	<div class="form-section__body">
	                    	<div class="form-group form-group_horizontal span-3">
	                      		<h4 class="form-group__title form-group__title_small">Date of birth</h4>
	                      		<div class="form-group__body">
	                        		<div class="form-field form-field_secondary">
	                          			<select name="birth-date" class="form-field__input">
				                            <option selected="selected"></option>
				                            <option value="1">1</option>
				                            <option value="2">2</option>
				                            <option value="3">3</option>
				                            <option value="4">4</option>
				                            <option value="5">5</option>
				                            <option value="6">6</option>
				                            <option value="7">7</option>
				                            <option value="8">8</option>
				                            <option value="9">9</option>
				                            <option value="10">10</option>
				                            <option value="11">11</option>
				                            <option value="12">12</option>
				                            <option value="13">13</option>
				                            <option value="14">14</option>
				                            <option value="15">15</option>
				                            <option value="16">16</option>
				                            <option value="17">17</option>
				                            <option value="18">18</option>
				                            <option value="19">19</option>
				                            <option value="20">20</option>
				                            <option value="21">21</option>
				                            <option value="22">22</option>
				                            <option value="23">23</option>
				                            <option value="24">24</option>
				                            <option value="25">25</option>
				                            <option value="26">26</option>
				                            <option value="27">27</option>
				                            <option value="28">28</option>
				                            <option value="29">29</option>
				                            <option value="30">30</option>
				                            <option value="31">31</option>
				                        </select>
                      					<div class="form-field__title">Date</div>
                    				</div>
			                        <div class="form-field form-field_secondary">
			                          	<select name="birth-month" class="form-field__input">
				                            <option selected="selected"></option>
				                            <option value="Jan.">Jan.</option>
				                            <option value="Feb.">Feb.</option>
				                            <option value="Mar.">Mar.</option>
				                            <option value="Apr.">Apr.</option>
				                            <option value="May">May</option>
				                            <option value="June">June</option>
				                            <option value="July">July</option>
				                            <option value="Aug.">Aug.</option>
				                            <option value="Sept.">Sept.</option>
				                            <option value="Oct.">Oct.</option>
				                            <option value="Nov.">Nov.</option>
				                            <option value="Dec.">Dec.</option>
			                          	</select>
			                          	<div class="form-field__title">Month</div>
			                        </div>
			                        <div class="form-field form-field_secondary">
			                          	<input type="number" class="form-field__input" name="birth-year" maxlength="4">
			                          	<div class="form-field__title">Year</div>
			                        </div>
                  				</div>
                			</div>
		                    <div class="item form-field span-3">
		                      	<div class="form-field__title">Patient ID</div>
		                      	<input class="form-field__input" type="text" maxlength="50" name="patientid">
		                    </div>
              			</div>
            		</section>
            		<div class="form-section">
              			<div class="form-section__body">
                			<div class="item form-field span-6">
                  				<div class="form-field__title">Notes</div>
                  				<textarea name="notes" class="form-field__input pi-form-field__textarea" maxlength="10240" style="height:120px;"></textarea>
                			</div>
              			</div>
            		</div>
					<div class="form-section">
						<div class="form-section__body form-section__body_big-gap">
							<div class="item form-field span-2">
								<div class="form-field__title">Eye</div>
								<select name="eye" class="form-field__input">
									<option value="left" selected="selected">Left</option>
									<option value="right">Right</option>
								</select>
							</div>
							<div class="item form-field span-2">
								<div class="form-field__title">PRE-OP BCVA</div>
								<input type="text" class="form-field__input" name="bcva" maxlength="100">
							</div>
							<div class="item form-field form-field_title-slim span-2">
								<div class="form-field__title">PRE-OP UCVA</div>
								<input type="text" class="form-field__input" name="ucva" maxlength="100">
							</div>
						</div>
					</div>
            		<section class="form-section form-section_spaced">
              			<h3 class="form-section__title">Refraction</h3>
          				<div class="form-section__body form-section__body_big-gap">
            				<div class="item form-field span-2">
              					<div class="form-field__title">Sphere</div>
              					<select name="refraction_sphere" class="form-field__input">
              						<?php 
              							$i = -12.00;
              							while( $i <= 8.50 ){ 
              								if( $i == 0 ){ 
              									echo '<option selected="" value=""></option>
              											<option selected="0" value="">Plano</option>'; 
              								}
              								echo '<option value="'. $i .'">'. $i .'</option>'; 
              								$i += 0.25;
              							}
              						?>
			                    </select>
            				</div>
            				<div class="item form-field span-2">
              					<div class="form-field__title">Cylinder</div>
          						<select name="refraction_cylinder" class="form-field__input">
			                        <option value="-6.5">-18.00</option>
			                        <option value="-6.5">-18.75</option>
			                        <option value="-6.5">-18.50</option>
			                        <option value="-6.5">-18.25</option>
			                        <option value="-6.5">-18.00</option>
			                        <option value="-6.5">-17.75</option>
			                        <option value="-6.5">-17.50</option>
			                        <option value="-6.5">-17.25</option>
			                        <option value="-6.5">-17.00</option>
			                        <option value="-6.5">-16.75</option>
			                        <option value="-6.5">-16.50</option>
			                        <option value="-6.5">-16.25</option>
			                        <option value="-6.5">-16.00</option>
			                        <option value="-6.5">-15.75</option>
			                        <option value="-6.5">-15.50</option>
			                        <option value="-6.5">-15.25</option>
			                        <option value="-6.5">-15.00</option>
			                        <option value="-6.5">-14.75</option>
			                        <option value="-6.5">-14.50</option>
			                        <option value="-6.5">-14.25</option>
			                        <option value="-6.5">-14.00</option>
			                        <option value="-6.5">-13.75</option>
			                        <option value="-6.5">-13.50</option>
			                        <option value="-6.5">-13.25</option>
			                        <option value="-6.5">-13.00</option>
			                        <option value="-6.5">-12.75</option>
			                        <option value="-6.5">-12.50</option>
			                        <option value="-6.5">-12.25</option>
			                        <option value="-6.5">-12.00</option>
			                        <option value="-6.5">-11.75</option>
			                        <option value="-6.5">-11.50</option>
			                        <option value="-6.5">-11.25</option>
			                        <option value="-6.5">-11.00</option>
			                        <option value="-6.5">-10.75</option>
			                        <option value="-6.5">-10.50</option>
			                        <option value="-6.5">-10.25</option>
			                        <option value="-6.5">-10.00</option>
			                        <option value="-6.5">-9.75</option>
			                        <option value="-6.5">-9.50</option>
			                        <option value="-6.5">-9.25</option>
			                        <option value="-6.5">-9.00</option>
			                        <option value="-6.5">-8.75</option>
			                        <option value="-6.5">-8.50</option>
			                        <option value="-6.5">-8.25</option>
			                        <option value="-6.5">-8.00</option>
			                        <option value="-6.5">-7.75</option>
			                        <option value="-6.5">-7.50</option>
			                        <option value="-6.5">-7.25</option>
			                        <option value="-6.5">-7.00</option>
			                        <option value="-6.25">-6.75</option>
			                        <option value="-6.25">-6.50</option>
			                        <option value="-6.25">-6.25</option>
			                        <option value="-6.00">-6.00</option>
			                        <option value="-5.75">-5.75</option>
			                        <option value="-5.50">-5.50</option>
			                        <option value="-5.25">-5.25</option>
			                        <option value="-5.00">-5.00</option>
			                        <option value="-4.75">-4.75</option>
			                        <option value="-4.50">-4.50</option>
			                        <option value="-4.25">-4.25</option>
			                        <option value="-4.00">-4.00</option>
			                        <option value="-3.75">-3.75</option>
			                        <option value="-3.50">-3.50</option>
			                        <option value="-3.25">-3.25</option>
			                        <option value="-3.00">-3.00</option>
			                        <option value="-2.75">-2.75</option>
			                        <option value="-2.50">-2.50</option>
			                        <option value="-2.25">-2.25</option>
			                        <option value="-2.00">-2.00</option>
			                        <option value="-1.75">-1.75</option>
			                        <option value="-1.50">-1.50</option>
			                        <option value="-1.25">-1.25</option>
			                        <option value="-1.00">-1.00</option>
			                        <option value="-0.75">-0.75</option>
			                        <option value="-0.50">-0.50</option>
			                        <option value="-0.25">-0.25</option>
			                        <option selected="" value=""></option>
			                        <!--option value="None">None</option-->
			                        <option value="DS">DS</option>
			                        <!--option value="SPH">SPH</option-->
			                        <!--option value="0.00">0.00</option-->
			                        <option value="0.25">+0.25</option>
			                        <option value="0.50">+0.50</option>
			                        <option value="0.75">+0.75</option>
			                        <option value="1.00">+1.00</option>
			                        <option value="1.25">+1.25</option>
			                        <option value="1.50">+1.50</option>
			                        <option value="1.75">+1.75</option>
			                        <option value="2.00">+2.00</option>
			                        <option value="2.25">+2.25</option>
			                        <option value="2.50">+2.50</option>
			                        <option value="2.75">+2.75</option>
			                        <option value="3.00">+3.00</option>
			                        <option value="3.25">+3.25</option>
			                        <option value="3.50">+3.50</option>
			                        <option value="3.75">+3.75</option>
			                        <option value="4.00">+4.00</option>
			                        <option value="4.25">+4.25</option>
			                        <option value="4.50">+4.50</option>
			                        <option value="4.75">+4.75</option>
			                        <option value="5.00">+5.00</option>
			                        <option value="5.25">+5.25</option>
			                        <option value="5.50">+5.50</option>
			                        <option value="5.75">+5.75</option>
			                        <option value="6.00">+6.00</option>
			                        <option value="6.25">+6.25</option>
			                        <option value="6.50">+6.50</option>
			                        <option value="6.50">+6.75</option>
			                        <option value="6.50">+7.00</option>
			                        <option value="6.50">+7.25</option>
			                        <option value="6.50">+7.50</option>
			                        <option value="6.50">+7.75</option>
			                        <option value="6.50">+8.00</option>
			                        <option value="6.50">+8.25</option>
			                        <option value="6.50">+8.50</option>
			                        <option value="6.50">+8.75</option>
			                        <option value="6.50">+9.00</option>
			                        <option value="6.50">+9.25</option>
			                        <option value="6.50">+9.50</option>
			                        <option value="6.50">+9.75</option>
			                        <option value="6.50">+10.00</option>
			                        <option value="6.50">+10.25</option>
			                        <option value="6.50">+10.50</option>
			                        <option value="6.50">+10.75</option>
			                        <option value="6.50">+11.00</option>
			                        <option value="6.50">+11.25</option>
			                        <option value="6.50">+11.50</option>
			                        <option value="6.50">+11.75</option>
			                        <option value="6.50">+12.00</option>
			                    </select>
                    		</div>
        					<div class="item form-field form-field_title-slim span-2">
          						<div class="form-field__title">Axis</div>
          						<select name="refraction_axis" class="form-field__input">
			                        <option selected="" value=""></option>
			                        <option value="None">None</option>
			                        <?php 
			                        	for( $i=0; $i<=180; $i++ ){ 
			                        		echo '<option value="'. $i .'">'. $i .'</option>'; 
			                        	}
			                        ?>
          						</select>
        					</div>
        					<div class="form-section__separator"></div>
      					</div>
        			</section>
            		<section class="form-section section-parameters">
              			<h3 class="form-section__title">Parameters</h3>
		                <div class="form-section__body form-section__body_big-gap">
		                    <div class="form-group span-2">
		                      	<h4 class="form-group__title">Tunnel</h4>
		                      	<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units" data-unit="mm">
		                            		<input type="number" class="form-field__input" name="tunnel-inner-diameter" maxlength="10" step="0.1">
		                          		</div>
		                          		<div class="form-field__title">Inner diameter</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<div class="form-group__spacer"></div>
	                      		<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units" data-unit="mm">
		                            		<input type="number" class="form-field__input" name="tunnel-outer-diameter" maxlength="10" step="0.1">
		                          		</div>
		                          		<div class="form-field__title">Outer diameter</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<div class="form-group__spacer_slim"></div>
		                      	<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units " data-unit="microns">
		                            		<input type="text" class="form-field__input" name="tunnel-depth" maxlength="10" step="1">
		                          		</div>
		                          		<div class="form-field__title">Depth</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<h4 class="form-group__title">Outer cut</h4>
	                      		<div class="form-group__body_pi-align">
	                        		<div class="form-field form-field_secondary">
	                          			<div class="input-with-units" data-unit="mm">
	                            			<input type="number" class="form-field__input" name="donor-cut-1-diameter" maxlength="10" step="0.1">
	                          			</div>
	                          			<div class="form-field__title">Diameter</div>
                        			</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<div class="form-group__spacer"></div>
		                      	<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units" data-unit="microns">
		                            		<input type="text" class="form-field__input" name="donor-cut-1-depth" maxlength="10" step="1">
		                          		</div>
		                          		<div class="form-field__title">Depth</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2 row-span-3 self-stretch">
		                      	<div class="form-group__spacer_slim"></div>
		                      	<div class="form-group__body_vertical pb-18">

		                      		<?php if( AUTH ){ ?>
			                      		<div class="form-group__body_vertical pb-18">
                                            <select name="load-params" id="params-select">
                                            	<option value="0" selected>Not selected</option>
                                            	<?php 
                                            		if( $params ){ 
                                            			foreach( $params as $row ){ echo '<option value="'. $row['id'] .'">'. $row['name'] .'</option>'; }
                                            			unset( $row );
                                            		}
                                            	?>
                                            </select>
                                            <!--div class="ts-wrapper select params-select single full has-items">
                                            	<div class="select__control params-select__control" role="combobox" aria-haspopup="listbox" aria-expanded="false" aria-controls="params-select-ts-dropdown" id="params-select-ts-control" tabindex="0">
                                            		<div data-value="0" class="item" data-ts-item="">Load parameters</div>
                                            	</div>
                                            	<div class="ts-dropdown select__dropdown params-select__dropdown single" style="display: none;">
                                            		<div role="listbox" tabindex="-1" class="ts-dropdown-content" id="params-select-ts-dropdown"></div>
                                            	</div>
                                            </div-->
                        					<button id="save-parameters" type="button" data-drawer-open="save-params-modal" class="btn pi-form-field-btn">Save<br>parameters</button>
                                        </div>

			                          	<!--select name="load-params" id="params-select">
			                            	<option value="0">Not selected</option>
			                             	<option value="<?=$key;?>">Parameter name</option>
			                          	</select>
			                        	<button id="save-parameters" type="button" data-drawer-open="save-params-modal" class="btn pi-form-field-btn">Save<br>parameters</button-->
			                        <?php } ?>

		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<h4 class="form-group__title">Inner cut</h4>
		                      	<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units" data-unit="mm">
		                            		<input type="number" class="form-field__input" name="donor-cut-2-diameter" maxlength="10" step="0.1">
		                          		</div>
		                          		<div class="form-field__title">Diameter</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-group span-2">
		                      	<div class="form-group__spacer"></div>
		                      	<div class="form-group__body_pi-align">
		                        	<div class="form-field form-field_secondary">
		                          		<div class="input-with-units" data-unit="microns">
		                            		<input type="text" class="form-field__input" name="donor-cut-2-depth" maxlength="10" step="1">
		                          		</div>
		                          		<div class="form-field__title">Depth</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="tool-form-selected">
		                      	<div class="tool-form-selected__underlay">
		                        	<div class="tool-form-selected__inner">
		                          		<div class="form-group span-2">
		                            		<h4 class="form-group__title">NON-FEMTO</h4>
		                            		<div class="form-group__body_pi-align">
		                              			<div class="form-field form-field_secondary">
		                                			<div class="input-with-units" data-unit="microns">
		                                  				<input type="text" class="form-field__input" name="segment-width" maxlength="10">
		                                			</div>
		                                			<div class="form-field__title">Segment width</div>
		                              			</div>
		                            		</div>
		                          		</div>
		                          		<div class="form-group span-2">
		                            		<div class="form-group__spacer"></div>
		                            		<div class="form-group__body_pi-align">
		                              			<div class="form-field form-field_secondary">
		                                			<div class="input-with-units" data-unit="microns">
		                                  				<input type="text" class="form-field__input" name="segment-depth" maxlength="10">
		                                			</div>
		                                			<div class="form-field__title">Segment depth</div>
		                              			</div>
		                            		</div>
		                          		</div>
		                        	</div>
		                      	</div>
		                    </div>
		                    <div class="form-section__separator"></div>
		                </div>
            		</section>
            		<section class="form-section form-section_spaced">
              			<div class="form-section__body">
                			<div class="item form-field span-6">
                  				<div class="form-field__title">Surgeon</div>
                  				<input class="form-field__input" type="text" name="surgeon_name" maxlength="200">
                			</div>
              			</div>
            		</section>
          		</div>
          		<section class="form__actions">
            		<button class="downloader flex-full-width" id="show_settings"><b>CUSTOMIZATIONS</b></button>
            		<label class="downloader" id="uploader" for="upload">Upload<br>topography<input type="file" id="upload" value="Choose a file" accept=".jpg, .jpeg, .png"></label>
            		<a href="javascript:void(0);" class="downloader fz-12" id="downloader">Download<b>JPEG</b></a>
            		<a href="javascript:void(0);" class="downloader fz-12" id="downloadPdf">Download<b>PDF</b></a>
            	
            		<?php if( AUTH ){ ?>
            			<button type="button" class="downloader" id="save" data-drawer-open="save-plan-modal">Save plan</button>
            		<?php } ?>

          		</section>
          		<a href="" download="" id="save_image"></a>
          		<div id="settings" class="tool-layout__settings">
            		<div class="tool-layout__settings-inner">
              			<h2>CUSTOMIZATIONS</h2>
              			<div class="field"></div>
              			<div class="buttons">
                			<button class="downloader" id="settings_close">Close</button>
              			</div>
            		</div>
          		</div>
        	</div>
      	</div>


      	<section class="plan tool-layout__plan" id="wrapper_intr">
        	<div class="container plan__container">
          		<div class="plan-chart plan__chart">
            		<div class="plan-chart__inner">
              			<div class="nose-decor nose-decor_left nose-decor_flip plan-chart__nose-decor plan-chart__nose-decor_left">
                			<div class="nose-decor__inner">
                  				<img src="/static/img/nose.png" alt="Nose">
                			</div>
              			</div>
              			<div class="plan-chart__chart">
                			<div class="canvas_render">
                  				<canvas class="canvas" width="620" height="620"></canvas>
                  				<div class="photo"></div>
                			</div>
							<div class="tool-layout-ruler">
								<div data-value="9"></div>
								<div></div>
								<div></div>
								<div data-value="6"></div>
								<div></div>
								<div></div>
								<div data-value="3"></div>
								<div></div>
								<div></div>
								<div data-value="0"></div>
								<div></div>
								<div></div>
								<div data-value="3"></div>
								<div></div>
								<div></div>
								<div data-value="6"></div>
								<div></div>
								<div></div>
								<div data-value="9"></div>
							</div>
                			<div class="plan-chart__aye-mark"></div>
              			</div>
              			<div class="nose-decor nose-decor_right nose-decor_flip plan-chart__nose-decor plan-chart__nose-decor_right">
                			<div class="nose-decor__inner">
                  				<img src="/static/img/nose.png" alt="Nose">
                			</div>
              			</div>
        			</div>
          		</div>
          		<div class="plan-form plan__form">
            		<div class="plan-form__inner">
              			<div class="plan-form__logos">
                			<figure class="logo plan-form__logo">
                  				<img src="/static/img/CAIRSPlanLogo.png>" alt="Logo">
                			</figure>
		                    <?php
		                    	if( AUTH ){
		                      		$profile_picture_url = "";
		                      		$image = ( !empty( $profile_picture_url ) ) ? $profile_picture_url : false;
		                      		if($image) {
		                    ?>
		                    <figure class="logo plan-form__logo surgeon-logo">
		                        <img src="/static/img/favicon.png" alt="Surgeon logo">
		                    </figure>
		                    <?php }
		                    } ?>
              			</div>
              			<div class="plan-form__title">INTRAOPERATIVE PLAN</div>
						<div class="plan-form__top">
							<div class="blank-field">
								<h4 class="blank-field__title">Patient initials</h4>
								<div class="blank-field__value f_fullname"></div>
							</div>
							<div class="blank-field">
								<h4 class="blank-field__title">DATE OF BIRTH</h4>
								<div class="blank-field__value f_dateofbirth">00 / 00 / 0000</div>
							</div>
							<div class="blank-field">
								<h4 class="blank-field__title">PATIENT ID</h4>
								<div class="blank-field__value f_patientid"></div>
							</div>
							<div class="blank-field">
								<h4 class="blank-field__title">LEFT OR RIGHT EYE</h4>
								<div class="blank-field__value f_eye">LEFT</div>
							</div>
							<div class="blank-field">
								<h4 class="blank-field__title">Surgeon name</h4>
								<div class="blank-field__value f_surgeon_name"></div>
							</div>
						</div>
              			<div class="plan-form__mid">
							<div class="plan-form-section">
								<h4 class="plan-form-section__title">Channel</h4>
								<div class="plan-form-section__body">
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Width</h4>
										<div class="blank-field__value blank-field__value_slim" data-field="channel_width"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Inner diameter</h4>
										<div class="blank-field__value blank-field__value_slim" data_field="inner_diameter"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Outer diameter</h4>
										<div class="blank-field__value blank-field__value_slim" data-field="outer_diameter"></div>
									</div>
									<div style="display:none;">
										<div class="blank-field blank-field_primary">
											<h4 class="blank-field__title">Depth</h4>
											<div class="blank-field__value blank-field__value_slim" data-field="channel_depth"></div>
										</div>
										<div class="blank-field blank-field_primary">
											<h4 class="blank-field__title">Incision 1&nbsp;axis</h4>
											<div class="blank-field__value blank-field__value_slim" data-field="incision_1_axis"></div>
										</div>
										<div class="blank-field blank-field_primary">
											<h4 class="blank-field__title">Incision 2&nbsp;axis</h4>
											<div class="blank-field__value blank-field__value_slim" data-field="incision_2_axis"></div>
										</div>
									</div>
								</div>
							</div>
                			<div class="plan-form__separator"></div>
							<div class="plan-form-section">
								<h4 class="plan-form-section__title">Implant 1</h4>
								<div class="plan-form-section__body">
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Central axis</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_1_central"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Cw limit</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_1_cw"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">ccw limit</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_1_ccw"></div>
									</div>
								</div>
							</div>
                			<div class="plan-form__separator"></div>
							<div class="plan-form-section">
								<h4 class="plan-form-section__title">Implant 2</h4>
								<div class="plan-form-section__body">
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Central axis</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_2_central"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">Cw limit</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_2_cv"></div>
									</div>
									<div class="blank-field blank-field_primary">
										<h4 class="blank-field__title">ccw limit</h4>
										<div class="blank-field__value blank-field__value_mid" data-field="axis_2_ccw"></div>
									</div>
								</div>
							</div>
              			</div>
              			<div class="plan-form__bottom">
                			<div class="blank-field blank-field_notes">
                  				<div class="blank-field__value">Some notes</div>
                  				<div class="blank-field__title f_notes" data-field="plan_motes"></div>
                			</div>
              			</div>
            		</div>
          		</div>
        	</div>
      	</section>
    </div>
</div>
<div id="output"></div>
<div id="image_loader">
	<div id="image_crop_container"> <div id="upload-demo"></div> </div>
    <button id="save_crop" class="upload-result">SAVE</button>
    <button class="closer" onclick="$('#image_loader').hide();"></button>
</div>
<div id="overlay">
    <div class="spinner"></div>
</div>

<!-- Modals -->
<div class="drawers-group" data-drawers-group="system">
	<?php if( AUTH ){ ?>
		<!-- Save params -->
		<div class="modal sp-modal micromodal-slide" data-drawer="save-params-modal" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1" style="background:rgba(0,0,0,0.3);">
				<div class="modal__container sp-modal__body" role="dialog" aria-modal="true" data-elem="drawer.panel">
					<form class="modal__content sp-modal__form" id="save-params-form">
						<div class="sp-modal-field">
							<div class="sp-modal-field__tip">Create new</div>
							<input type="text" name="params-name" class="sp-modal-field__input">
							<div class="sp-modal-field__title">Name</div>
						</div>
						<select name="params-slot" id="save-params-select" placeholder="Select parameters">
							<option value="0">Not selected</option>
							<?php 
								if( $params ){ 
									foreach( $params as $key=>$row ){ echo '<option value="'. $key .'">'. $row['name'] .'</option>'; } 
									unset( $row );
								} 
							?>
						</select>
						<div class="modal__actions sp-modal__actions">
							<button type="submit" class="modal-btn">Save</button>
							<button type="reset" class="modal-btn" data-drawer-close="save-params-modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#save-parameters').off().on('click', function(){
						$('[data-drawer="save-params-modal"]').addClass('is-open');
					}); 
					$('[data-drawer="save-params-modal"] button[type="submit"]').off().on('click', function(e){ 
						e.preventDefault(); 
						e.stopPropagation();
						console.log("Save params confirmed");
						$('.is-open').removeClass('is-open'); 
					});
					$('button[data-drawer-close="save-params-modal"]').off().on('click', function(e){ 
						e.preventDefault(); 
						e.stopPropagation();
						console.log("Save params canceled");
						$('.is-open').removeClass('is-open');
					});
				});
			</script>
		</div>
	<?php } ?>

	<?php if( AUTH ){ ?>		
		<!-- Save plan -->
		<div class="modal sp-modal micromodal-slide" data-drawer="save-plan-modal" aria-hidden="true">
			<div class="modal__overlay" tabindex="-1" style="background:rgba(0,0,0,0.3);">
				<div class="modal__container sp-modal__body" role="dialog" aria-modal="true" data-elem="drawer.panel">
					<form class="modal__content sp-modal__form" id="save-plan-form">
						<div class="sp-modal-field">
							<div class="sp-modal-field__tip">Create new</div>
							<input type="text" name="plan-name" class="sp-modal-field__input">
							<div class="sp-modal-field__title">Name</div>
						</div>
						<select name="plan-slot" id="save-plan-select" placeholder="Select plan">
							<option value="0">Not selected</option>
							<?php 
								if( $plans ){ 
									foreach( $plans as $key=>$row ){ 
										echo '<option value="'. $key .'">'. $row['name'] .'</option>';
									} 
									unset( $row );
								} 
							?>
						</select>
						<div class="modal__actions sp-modal__actions">
							<button type="submit" class="modal-btn" data-drawer-close="save-plan-modal">Save</button>
							<button type="reset" class="modal-btn" data-drawer-close="save-plan-modal-cancel">Cancel</button>
						</div>
					</form>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#save').off().on('click', function(){
						$('[data-drawer="save-plan-modal"]').addClass('is-open');
					});
					$('[data-drawer="save-plan-modal"] [data-drawer-close="save-plan-modal"]').off().on('click', function(e){ 
						e.preventDefault(); 
						e.stopPropagation();
						console.log("Save plan confirmed");
						$('.is-open').removeClass('is-open'); 
					});
					$('[data-drawer="save-plan-modal"] [data-drawer-close="save-plan-modal-cancel"]').off().on('click', function(e){ 
						e.preventDefault(); 
						e.stopPropagation();
						console.log("Save plan canceled");
						$('.is-open').removeClass('is-open'); 
					});
				});
			</script>
		</div>
	<?php } ?>
</div>
	
<script src="/static/js/main.js"></script>
<?php 
	if( $plan ){
?>
	<script>
		// draw parameters for plan 
	</script>
<?php		
	}
?>
<script> 
	function Tool(){
		return {
			params: eval('(<?= json_encode( $params ? $params : array() ); ?>)'), 
			plans: eval('(<?= json_encode( $plans ? $plans : array() ); ?>)'), 
			init: function(){
				var $this=this; 
				$this.bind(); 
			}, 
			bind: function(){
				var $this=this; 
				$('.modal__overlay').off().on('click', function(){
					$('.is-open').removeClass('is-open');
				});
				$('.modal__container').off().on('click', function(e){
					e.preventDefault(); 
					e.stopPropagation();
				});
				if( $('#params-select').length ){
					var paramsSelect = new TomSelect("#params-select", {
						controlInput: null,
						wrapperClass: "ts-wrapper select params-select",
						controlClass: "select__control params-select__control",
						dropdownClass: "ts-dropdown select__dropdown params-select__dropdown",
						optionClass: "select__option params-select__option",
						onChange: function( $id ){ 
							var $data = $this.params[ $id ]; 
							console.log( $data );
						},
						render: {
							item: function(data, escape) {
								return '<div>' + escape("Load parameters") + '</div>';
							}
						}
					});
				}
			}
		}
	}
	$(document).ready(function(){ 
		window.$tool = new Tool(); 
		$tool.init(); 
	});
</script>