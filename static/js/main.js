$(document).ready(function(){
	window.$app = new App();
	$app.init(".canvas");
	
	var mainWrapper = $('#wrapper_tool');
	var intrWrapper = $('#wrapper_intr');
	
	$('#downloader').on('click', function() {
		$('body').addClass('render');
		$('#overlay').css('display', 'flex');
		copyVisualization();
		html2canvas( mainWrapper[0] ).then( canvas => {
			var $output = document.querySelector('#output');
			$output.innerHTML = "";
			$output.appendChild( canvas );
			var $tmpc = document.querySelector('#output canvas');
			var $ctx = $tmpc.getContext('2d');
			$tmpc.toBlob(function(blob){
				var link = document.createElement('a');
				link.download = 'patient-information.jpg';
				link.href = URL.createObjectURL(blob);
				link.click();
				URL.revokeObjectURL(link.href);
			}, "image/jpeg");
		});
		$('body').removeClass('render');
		
		html2canvas(intrWrapper[0]).then(canvas => {
			var $output = document.querySelector('#output');
			$output.innerHTML = "";
			$output.appendChild( canvas );
			var $tmpc = document.querySelector('#output canvas');
			var $ctx = $tmpc.getContext('2d');
			$tmpc.toBlob(function(blob){
				var link = document.createElement('a');
				link.download = 'intraoperative-plan.jpg'; //$file_name;
				link.href = URL.createObjectURL(blob);
				link.click();
				URL.revokeObjectURL(link.href);
			}, "image/jpeg");
			$('#overlay').hide();
		});
	});
	
	$('#downloadPdf').on('click', function() {
		$('body').addClass('render');
		$('#overlay').css('display', 'flex');
		//copyVisualization();
		var mainWidth = mainWrapper.outerWidth();
		var mainHeight = mainWrapper.outerHeight();
		var intrWidth = intrWrapper.outerWidth();
		var intrHeight = intrWrapper.outerHeight();
		
		html2canvas(mainWrapper[0], { scale: 1 }).then(canvas => {
			var imgData = canvas.toDataURL('image/png');

			var pdf = new jspdf.jsPDF({
				orientation: 'landscape',
				unit: 'px',
				format: [mainWidth, mainHeight],
				compressPdf: true
			});
			
			pdf.addImage(imgData, 'PNG', 0, 0, mainWidth, mainHeight);
			pdf.save('patient-information.pdf');
		});
		$('body').removeClass('render');
		
		html2canvas(intrWrapper[0], { scale: 1 }).then(canvas => {
			var imgData = canvas.toDataURL('image/png');

			var pdf = new jspdf.jsPDF({
				orientation: 'landscape',
				unit: 'px',
				format: [intrWidth, intrHeight],
				compressPdf: true
			});

			pdf.addImage(imgData, 'PNG', 0, 0, intrWidth, intrHeight);
			pdf.save('intraoperative-plan.pdf');
			$('#overlay').hide();
		});
	});
	
	function copyVisualization() {
		var canvas = document.querySelector('#wrapper_tool canvas');
		var canvas2 = document.querySelector('#wrapper_intr canvas');
		var ctx = canvas2.getContext('2d');
		
		ctx.clearRect(0, 0, canvas2.width, canvas2.height);
		
		$('body').addClass('render-intr');
		$app.process();
		ctx.drawImage(canvas, 0, 0, canvas.width, canvas.height);
		$('body').removeClass('render-intr');
		$app.process();
	}

	function App(){
		return { 
			trace: false, 
			canvas: false,  // canvas
			ctx: false,     // context
			x: 0,           // canvas x
			y: 0,           // canvas y 
			w: 620,         // canvas width 
			h: 620,         // canvas height 
			r: 270,         // base radius 
			center: { 
				x: 0, 
				y: 0 
			}, 
			sys: { 
				width:1, 
				color:"#000000", 
				font: "600 15px Roboto", 
				eye:"left" 
			}, 
			inner_cut: 0, 			// 
			outer_cut: 0, 			//
			inner_cut_mult: 60, 	// 6mm
			outer_cut_mult: 70, 	// 7mm
			cut_divisor: 90, 		// max cut 9mm
			inner_tunnel_mult: 60, 	// 6mm
			outer_tunnel_mult: 70,	// 7mm
			inner_tunnel: 0, 		//
			outer_tunnel: 0, 		//
			tunnel_divisor: 90,		// max tunnel 9mm
			topography: { 
				opacity: 0.7 
			}, 
			capture_satellites: true, 
			lines: [
				// AXIS 1
				{
					angle: -270, 
					width: 1.5, 
					color: '#FF0000', 
					opacity: 1, 
					max: 360, 
					visibility: 1, 					// DEPRECATED
					shift: 1, 
					name: "Arc 1 axis", 
					visual: '<div style="width:100%; height:10px; border-top:solid 3px #FF0000; border-bottom:solid 3px #FF0000; margin:10px 0px 0px 0px;"></div>', 
					arcs: [
						{ 
							angle: 120, 
							radius: 195, 			// DEPRECATED
							color: '#758FAD', 
							opacity: 0.5, 
							width: 20, 				// DEPRECATED
							max: 355, 
							shift: 0, 
							visibility: 1,			// DEPRECATED
							name:"Arc 1", 
							visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>', 
							inner_cut: 0, 
							inner_cut_mult: 60,
							outer_cut: 0,
							outer_cut_mult: 70,  
							tapering: {
								left: { 
									visibility: 0,
									width: 50, 
									length: 15 
								}, 
								right: {
									visibility: 0, 
									width: 50, 
									length: 15
								}
							}, 
							thin: {
								visibility: 0, 
								width: 50, 
								length: 30
							}, 
							info: { 
								radius: 280, 
								shift: 175, 
								color: "#999999", 
								opacity: 1, 
								width: 1, 
								dash: [ 6, 8 ], 
								visibility: 1, 
								visual:'<div style="width:0%; height:30%; border-left:solid 4px #0000FF; margin:5px 0px 0px 0px;"></div>' 
							}
						} 
						// DEPRECATED
							// ADDITIONAL ARCS
							//{ angle:120, radius:180, color:'#758FAD', opacity:1, width:4, max:355, shift:0, visibility:0, name:"Arc 1b", 
							//	visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>' },
							//{ angle:120, radius:165, color:'#758FAD', opacity:0.5, width:4, max:355, shift:0, visibility:0, name:"Arc 1c", 
							//	visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>' }
					],
					// INCISIONS 
					capture_satellites: true, 
					incisions: [
						{ 
							name:"Incision 1", 
							angle: 180, 
							radius: 230, 
							shift: 87, 
							max: 360, 
							color: "#FF0000", 
							opacity: 1, 
							width: 1.5, 
							visibility:1, 
							deffer: 270, 
							visual:'<div style="width:0%; height:30%; border-left:solid 4px #FF0000; margin:5px 0px 0px 0px;"></div>' 
						},
						{ 
							name:"Incision 2", 
							angle: 0, 
							radius: 230, 
							shift: 87, 
							max: 360, 
							color: "#FF0000", 
							opacity: 1, 
							width: 1.5, 
							visibility: 1, 
							deffer: 90, 
							visual:'<div style="width:0%; height:30%; border-left:solid 4px #FF0000; margin:5px 0px 0px 0px;"></div>' 
						},
					],
				}, 
				// AXIS 2
				{ 
					angle: -90, 
					width: 1.5, 
					color: '#0000FF', 
					opacity: 1, 
					max: 360, 
					visibility: 0, 
					shift: 1, 
					name: "Arc 2 axis", 
					visual:'<div style="width:100%; height:10px; border-top:solid 3px #0000FF; border-bottom:solid 3px #0000FF; margin:10px 0px 0px 0px;"></div>', 
					arcs: [
						{ 
							angle: 120, 
							radius: 188, 
							color: '#758FAD', 
							opacity: 0.5, 
							width: 20, 
							max: 355, 
							shift: 0, 
							visibility: 1, 
							name: "Arc 2", 
							visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>', 
							inner_cut: 0, 
							inner_cut_mult: 60, 
							outer_cut: 0,
							outer_cut_mult: 70,  
							tapering: {
								left: { 
									visibility: 0,
									width: 50, 
									length: 15 
								}, 
								right: {
									visibility: 0, 
									width: 50, 
									length: 15
								}
							}, 
							thin: {
								visibility: 0, 
								width: 50, 
								length: 45
							}, 
							info: { 
								radius: 280, 
								shift: 175, 
								color: "#999999", 
								opacity: 1, 
								width: 1, 
								dash: [ 6, 8 ], 
								visibility: 1, 
								visual:'<div style="width:0%; height:30%; border-left:solid 4px #0000FF; margin:5px 0px 0px 0px;"></div>' 
							}
						} 
						// DEPRECATED 
							// ADDITIONAL ARCS
							//{ angle:120, radius:173, color:'#758FAD', opacity:1, width:4, max:355, shift:0, visibility:0, name:"Arc 2b", 
							//	visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>' },
							//{ angle:120, radius:157, color:'#758FAD', opacity:1, width:4, max:355, shift:0, visibility:0, name:"Arc 2c", 
							//	visual:'<div style="width:100%; height:0; border-bottom:solid 3px #758FAD; margin:15px 0px 0px 0px;"></div>' }
					], 
					capture_satellites: false 
				} 
			],
			helpers: [
				{ name:"Helper 1", angle: 30, max:360, color:"#000000", opacity:1, width:1, dash: [2,5], visibility:0, 
					visual:'<div style="width:100%; height:0px; border-top:dotted 2px #4cb846; margin:15px 0px 0px 0px;"></div>' },
				{ name:"Helper 2", angle: 60, max:360, color:"#000000", opacity:1, width:1, dash: [2,5], visibility:0, 
					visual:'<div style="width:100%; height:0px; border-top:dotted 2px #0000FF; margin:15px 0px 0px 0px;"></div>' },
				{ name:"Helper 3", angle: 120, max:360, color:"#000000", opacity:1, width:1, dash:[10,5], visibility:0, 
					visual:'<div style="width:100%; height:0px; border-top:dashed 2px #4cb846; margin:15px 0px 0px 0px;"></div>' },
				{ name:"Helper 4", angle: 150, max:360, color:"#000000", opacity:1, width:1, dash:[10,5], visibility:0, 
					visual:'<div style="width:100%; height:0px; border-top:dashed 2px #0000FF; margin:15px 0px 0px 0px;"></div>' }
			],
			PI: Math.PI, 
			init: function( $name ){
				var $this=this;
				$this.canvas = document.querySelector($name);
				$this.ctx = $this.canvas.getContext('2d'); 
				$this.center.x = $this.w / 2; 
				$this.center.y = $this.h / 2;
				$this.inner_cut = $this.lines[0].arcs[0].inner_cut = $this.r / $this.cut_divisor * $this.inner_cut_mult; 
				$this.outer_cut = $this.lines[0].arcs[0].outer_cut = $this.r / $this.cut_divisor * $this.outer_cut_mult; 
				for( var $i=0; $i<$this.lines.length; $i++ ){
					var $axis = $this.lines[$i]; 
					for( var $j=0; $j<$axis.arcs.length; $j++ ){
						var $arc = $axis.arcs[$j]; 
						$arc.inner_cut = $this.r / $this.cut_divisor * $arc.inner_cut_mult;
						$arc.outer_cut = $this.r / $this.cut_divisor * $arc.outer_cut_mult; 
					}
				}
				$this.inner_tunnel = $this.r / $this.tunnel_divisor * $this.inner_tunnel_mult; 
				$this.outer_tunnel = $this.r / $this.tunnel_divisor * $this.outer_tunnel_mult; 
				$this.draw_settings();
				$this.process();
				$this.bind();
				$this.crop_image();
				// Photo
				interact('.canvas_render .photo').resizable({
					edges: { left: true, right: true, bottom: true, top: true }, // resize from all edges and corners
					listeners: { move: resizeListener },
					modifiers: [
						interact.modifiers.restrictSize({ min: { width: 100, height: 100 } })
					],
					inertia: true
				}).draggable({ 
					inertia: true, 
					autoScroll: true,
					listeners: { move: dragMoveListener }
				}).resizable({
					modifiers: [ 
						interact.modifiers.aspectRatio({ ratio:1 }) 
					] 
				});
				function dragMoveListener( event ){ 
					document.querySelectorAll('.canvas_render .photo').forEach(function(target) {
						var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
						var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
						target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
						target.setAttribute('data-x', x);
						target.setAttribute('data-y', y);
					});
				}
				function resizeListener(event) {
					document.querySelectorAll('.canvas_render .photo').forEach(function(target) {
						var x = (parseFloat(target.getAttribute('data-x')) || 0);
						var y = (parseFloat(target.getAttribute('data-y')) || 0);
						// Обновляем стили элемента
						target.style.width = event.rect.width + 'px';
						target.style.height = event.rect.height + 'px';
						// Перемещаем элемент при изменении размера от верхнего или левого края
						x += event.deltaRect.left;
						y += event.deltaRect.top;
						target.style.transform = 'translate(' + x + 'px,' + y + 'px)';
						target.setAttribute('data-x', x);
						target.setAttribute('data-y', y);
					});
				}
				window.dragMoveListener = dragMoveListener;
				
				// set axis scroll to start
				$('#spiners input[data-id="1"]').val( Math.abs( $this.lines[0].angle ) );
				$('#spiners input[data-id="2"]').val( Math.abs( $this.lines[1].angle ) );
				$('#slider1').val( Math.abs( $this.lines[0].angle ) );
				$('#slider2').val( Math.abs( $this.lines[1].angle ) );
				$('#arc1').val( $this.lines[0].arcs[0].angle );
				$('#arc2').val( $this.lines[1].arcs[0].angle );
				$('#slider3').val( $this.lines[0].arcs[0].angle );
				$('#slider4').val( $this.lines[1].arcs[0].angle );
				
				$('#slider5').val( Math.abs( $this.lines[0].incisions[0].angle ) );
				$('#slider6').val( Math.abs( $this.lines[0].incisions[1].angle ) );
				$('#incision1').val( Math.abs( $this.lines[0].incisions[0].angle ) );
				$('#incision2').val( Math.abs( $this.lines[0].incisions[1].angle ) );

				$('select[name="eye"] option').removeAttr('selected');
				$('select[name="eye"] option[value="'+ $this.sys.eye +'"]').attr('selected', "selected"); 

				$('input[name="donor-cut-2-diameter"]').val( $this.inner_cut_mult / 10 ); 
				$('input[name="donor-cut-1-diameter"]').val( $this.outer_cut_mult / 10 ); 
				$('input[name="segment-width"]').val( ( $this.outer_tunnel_mult - $this.inner_tunnel_mult ) / 2 * 100 ); 

				$('input[name="tunnel-inner-diameter"]').val( $this.inner_tunnel_mult / 10 ); 
				$('input[name="tunnel-outer-diameter"]').val( $this.outer_tunnel_mult / 10 );

				$('input[name="segment-depth"]').val( $('input[name="donor-cut-2-depth"]').val() ); 

				$this.setCurrentEye( $('select[name="eye"]').val() );

			}, 
			bind: function(){ 
				var $this=this;
				//
				// AXIS SLIDERS && INPUTS
				$('.inputs').off().on('keyup', function(){
					var $self = $(this);
					var $wrap = $self.parent(); 
					var $top = $wrap.parent(); 
					var $type = $self.data('type');
					var $id = +$self.data('id') - 1;
					var $val = +$self.val();
					switch( $type ){
						case "arc": 
							var $line = $this.lines[ $id ];
							for( var $i=0; $i<$line.arcs.length; $i++ ){
								$line.arcs[ $i ].angle = $val > $line.arcs[ $i ].max ? $line.arcs[ $i ].max : $val;
							} 
							break;
						case "angle": 
							var $line = $this.lines[ $id ]
							$line[ $type ] = -( $val > $line[ $type ].max ? $line[ $type ].max : $val ); 
							$this.set_incisions_from_axis( $id );
							break;
						case "incision": 
							var $line_id = $self.data('line') - 1; 
							var $axis = $this.lines[ $line_id ];
							$axis.incisions[ $id ].angle = -( $val > $axis.incisions[ $id ].max ? $axis.incisions[ $id ].max : $val ); 
							$this.set_incisions_from_inputs( $line_id, $id );
							break;
					} 
					$('.sliders', $wrap).val( $self.val() );
					$this.process();
				}).on('change', function(){
					var $self = $(this);
					var $wrap = $self.parent(); 
					var $top = $wrap.parent();
					var $type = $self.data('type');
					var $id = +$self.data('id') - 1;
					var $val = +$self.val();
					switch( $type ){ 
						case "arc":
							var $line = $this.lines[ $id ];
							for( var $i=0; $i<$line.arcs.length; $i++ ){
								$line.arcs[ $i ].angle = $val > $line.arcs[ $i ].max ? $line.arcs[ $i ].max : $val;
							} 
							break;
						case "angle": 
							var $line = $this.lines[ $id ];
							$line[ $type ] = -( $val > $line[ $type ].max ? $line.max : $val ); 
							$this.set_incisions_from_axis( $id );
							break;
						case "incision": 
							var $line_id = $self.data('line') - 1; 
							var $axis = $this.lines[ $line_id ];
							$axis.incisions[ $id ].angle = -( $val > $axis.incisions[ $id ].max ? $axis.incisions[ $id ].max : $val ); 
							$this.set_incisions_from_inputs( $line_id, $id );
							break;
					} 
					$('.sliders', $wrap).val( $self.val() );
					$this.process();
				});
				$('.sliders').off().on('input', function(){
					var $self = $(this);
					var $wrap = $self.parent().parent().parent();
					$('input', $wrap).val( $self.val() );
					$('.inputs', $wrap).val( $self.val() ).change();
				});
				$('#spiners .btn_left').on('click', function(){
					var $self=$(this);
					var $wrap = $self.parent().parent().parent();
					var $range = $('input[type="range"]', $wrap);
					var $val = +$range.val();
					var $new_val = $val - 1;
					var $type = $range.attr('data-type');
					var $id = +$range.attr('data-id') - 1;
					switch( $type ){ 
						case "arcs": 
							var $axis = $this.lines[ $id ];
							for( var $i=0; $i<$axis.arcs.length; $i++ ){ 
								var $new_val = $new_val > $axis.arcs[ $i ].max ? $axis.arcs[ $i ].max : ( $new_val < 0 ? 0 : $new_val ); 
								$axis.arcs[ $i ].angle = $new_val;
								$range.val( $new_val );
							} 
							break;
						case "lines": 
							var $axis = $this.lines[ $id ];
							$new_val = $new_val > $axis.max ? $axis.max : ( $new_val < 0 ? 0 : $new_val );
							$axis.angle = -( $new_val );
							$this.set_incisions_from_axis( $id );
							$range.val( $new_val );
							break;
						case "incision": 
							var $line_id = $self.data('line') - 1; 
							var $axis = $this.lines[ $line_id ];
							var $incision = $axis.incisions[ $id ]; 
							$incision.angle = -( $new_val > $incision.max ? $incision.max : ( $new_val < 0 ? 0 : $new_val ) ); 
							$range.val( $new_val ); 
							//console.log( $line_id, $incision.angle );
							if( !$self.attr('disabled') ){
								$this.set_incisions_from_inputs( $line_id, $id, $new_val ); 
							}
							break;
					} 
					$('input[type="text"]', $wrap).val( $new_val );
					$this.process();
				});
				$('#spiners .btn_right').on('click', function(){
					var $self=$(this);
					var $wrap = $self.parent().parent().parent();
					var $range = $('input[type="range"]', $wrap);
					var $val = +$range.val();
					var $new_val = $val + 1;
					var $type = $range.attr('data-type');
					var $id = +$range.attr('data-id') - 1;
					switch( $type ){ 
						case "arcs":
							var $axis = $this.lines[ $id ];
							for( var $i=0; $i<$axis.arcs.length; $i++ ){ 
								$new_val = $new_val > $axis.arcs[ $i ].max ? $axis.arcs[ $i ].max : ( $new_val < 0 ? 0 : $new_val );
								$axis.arcs[ $i ].angle = $new_val;
							} 
							$range.val( $new_val );
							break;
						case "lines": 
							var $axis = $this.lines[ $id ];
							$new_val = $new_val > $axis.max ? $axis.max : ( $new_val < 0 ? 0 : $new_val );
							$axis.angle = -( $new_val );  
							$this.set_incisions_from_axis( $id );
							$range.val( $new_val );
							break;
						case "incision": 
							var $line_id = $self.data('line') - 1; 
							var $axis = $this.lines[ $line_id ]; 
							var $incision = $axis.incisions[ $id ];
							$incision.angle = -( $new_val > $incision.max ? $incision.max : ( $new_val < 0 ? 0 : $new_val ) ); 
							$range.val( $new_val ); 
							//console.log( $line_id, $incision.angle );
							if( !$self.attr('disabled') ){
								$this.set_incisions_from_inputs( $line_id, $id, $new_val ); 
							} 
							break;
					} 
					$('input[type="text"]', $wrap).val( $new_val );
					$this.process();
				}); 
				$('input[name="capture_satellites"]').off().on('change', function(){
					$this.lines[0].capture_satellites = $this.capture_satellites = $('input[name="capture_satellites"]').is(':checked'); 
					if( $this.capture_satellites ){ 
						$('#incision_2_btn_left').attr('disabled', "disabled"); 
						$('#incision_2_btn_right').attr('disabled', "disabled"); 
						$('#slider6').attr('disabled', "disabled"); 
						$('input[name="incision_2"]').attr('disabled', "disabled"); 
					} 
					else {
						$('#incision_2_btn_left').removeAttr('disabled');
						$('#incision_2_btn_right').removeAttr('disabled');
						$('#slider6').removeAttr('disabled');
						$('input[name="incision_2"]').removeAttr('disabled');
					} 
					$this.process();
				}); 
				$('input[name="is_axis_2"]').on('change', function(){ 
					$this.lines[ 1 ].visibility = $('input[name="is_axis_2"]').is(':checked') ? 1 : 0;
					$this.process();
				}); 
				//
				// CANVAS 
				$this.canvas.onmousemove = function($e){ } 
				$this.canvas.onmousedown = function($e){ }
				$this.canvas.onmouseup = function($e){ } 
				//
				// SETTINGS
				$('#show_settings').off().on('click', function(){ $('#settings').toggle(); });
				$('#settings_close').off().on('click', function(){ $('#settings').toggle(); });
				$('#settings input').off().on('change', function(){
					var $self=$(this);
					var $wrap = $self.parent().parent();
					var $rel = $wrap.attr('data-rel');
					var $parent = $wrap.attr('data-parent');
					var $id = $wrap.attr('data-id');
					var $key = $self.attr('name');
					var $type = $self.attr('type');
					var $val = $self.val();
					var $photos = document.querySelectorAll('.canvas_render .photo'); //console.log("Change rel: "+ $rel +", parent: "+ $parent +", id: "+ $id +", key: "+ $key +", value: "+ $val);
					switch( $rel ){
						case "lines": 
							$this.lines[ $id ][ $key ] = $type == "checkbox" ? ( $self.is(':checked') ? 1 : 0 ) : $val;
							break;
						case "satellites": 
							$this.line[0].satellites[ $id ][ $key ] = $type == "checkbox" ? ( $self.is(':checked') ? 1 : 0 ) : $val;
							break;
						case "arcs":
							$this.lines[ $parent ].arcs[ $id ][ $key ] = $type == "checkbox" ? ( $self.is(':checked') ? 1 : 0 ) : $val; 
							if( $key == "inner_cut_mult" ){
								$this.lines[ $parent ].arcs[ $id ].inner_cut_mult *= 10; 
								$this.lines[ $parent ].arcs[ $id ].inner_cut = $this.r / $this.cut_divisor * $this.lines[ $parent ].arcs[ $id ].inner_cut_mult;
							}
							if( $key == "outer_cut_mult" ){
								$this.lines[ $parent ].arcs[ $id ].outer_cut_mult *= 10; 
								$this.lines[ $parent ].arcs[ $id ].outer_cut = $this.r / $this.cut_divisor * $this.lines[ $parent ].arcs[ $id ].outer_cut_mult; 
							}
							break;
						case "helpers": 
							$this.helpers[ $id ][ $key ] = $type == "checkbox" ? ( $self.is(':checked') ? 1 : 0 ) : $val;
							break;
						case "photo": 
							$photos.forEach(function(photo) {
								photo.style.opacity = $val;
							});
							break;
					} 
					$this.process();
				}); 
				//
				// PATIENT INPUTS
				$('input[name="donor-cut-2-diameter"]').off().on('change', function(){
					var $val = $(this).val() * 10; 
					if( $val >= $this.outer_cut_mult ){ $val = $this.outer_cut_mult - 1; } 
					//if( $val >= $this.inner_tunnel_mult ){ $val = $this.inner_tunnel_mult + 0.1; }
					if( $val > $this.cut_divisor ){ $val = $this.cut_divisor; }
					if( $val < 0 ){ $val = 0; } 
					$(this).val( ( $val / 10 ).toFixed( 1 ) );
					$this.inner_cut_mult = $this.lines[0].arcs[0].inner_cut_mult = $val; 
					$this.inner_cut = $this.lines[0].arcs[0].inner_cut = $this.r / $this.cut_divisor * $val;  
					if( $val <= $this.inner_tunnel_mult ){ 
						$this.inner_tunnel_mult = $val - 1; 
						$this.inner_tunnel = $this.r / $this.tunnel_divisor * $this.inner_tunnel_mult; 
						$('input[name="tunnel-inner-diameter"]').val( ( $this.inner_tunnel_mult / 10 ).toFixed( 1 ) );
					}
					$('input[name="segment-width"]').val( ( $this.outer_cut_mult - $this.inner_cut_mult ) / 2 * 100 );
					$this.process(); 
					$('[data-field="Inner_diameter"]').html( $(this).val() );
				}); 
				$('input[name="donor-cut-1-diameter"]').off().on('change', function(){
					var $val = $(this).val() * 10;  
					if( $val <= $this.inner_cut_mult ){ $val = $this.inner_cut_mult + 1; }
					//if( $val >= $this.outer_tunnel_mult ){ $val = $this.outer_tunnel_mult - 0.1; }
					if( $val > $this.cut_divisor ){ $val = $this.cut_divisor; }
					if( $val < 0 ){ $val = 0; } 
					$(this).val( ( $val / 10 ).toFixed( 1 ) ); 
					$this.outer_cut_mult = $this.lines[0].arcs[0].outer_cut_mult = $val;  
					$this.outer_cut = $this.lines[0].arcs[0].outer_cut = $this.r / $this.cut_divisor * $val; 
					if( $val >= $this.outer_tunnel_mult ){ 
						$this.outer_tunnel_mult = $val + 1; 
						$this.outer_tunnel = $this.r / $this.tunnel_divisor * $this.outer_tunnel_mult; 
						$('input[name="tunnel-outer-diameter"]').val( ( $this.outer_tunnel_mult / 10 ).toFixed( 1 ) );
					} 
					$('input[name="segment-width"]').val( ( $this.outer_cut_mult - $this.inner_cut_mult ) / 2 * 100 );
					$this.process();
					$('[data-field="Outer_diameter"]').html( $(this).val() );
				}); 
				$('input[name="tunnel-outer-diameter"]').off().on('change', function(){
					var $val = $(this).val() * 10; 
					if( $val <= $this.inner_tunnel_mult ){ $val = $this.inner_tunnel_mult + 1; }
					if( $val > $this.tunnel_divisor ){ $val = $this.tunnel_divisor; }
					if( $val < 0 ){ $val = 0; } 
					$(this).val( ( $val / 10 ).toFixed( 1 ) ); 
					$this.outer_tunnel_mult = $val;  
					$this.outer_tunnel = $this.r / $this.tunnel_divisor * $val; 
					if( $val <= $this.outer_cut_mult ){ 
						$this.outer_cut_mult = $this.lines[0].arcs[0].outer_cut_mult = $val - 1 
						$this.outer_cut = $this.lines[0].arcs[0].outer_cut = $this.r / $this.cut_divisor * $this.outer_cut_mult; 
						$('input[name="donor-cut-1-diameter"]').val( ( $this.outer_cut_mult / 10 ).toFixed( 1 ) );
					}
					$this.process();
				}); 
				$('input[name="tunnel-inner-diameter"]').off().on('change', function(){ 
					var $val = $(this).val() * 10; 
					if( $val >= $this.outer_tunnel_mult ){ $val = $this.outer_tunnel_mult - 1; }
					if( $val > $this.tunnel_divisor ){ $val = $this.tunnel_divisor; }
					if( $val < 0 ){ $val = 0; } 
					$(this).val( ( $val / 10 ).toFixed( 1 ) );
					$this.inner_tunnel_mult = $val; 
					$this.inner_tunnel = $this.r / $this.tunnel_divisor * $val; 
					if( $val >= $this.inner_cut_mult ){ 
						$this.inner_cut_mult = $this.lines[0].arcs[0].inner_cut_mult = $val + 1 
						$this.inner_cut = $this.lines[0].arcs[0].inner_cut = $this.r / $this.cut_divisor * $this.inner_cut_mult; 
						$('input[name="donor-cut-2-diameter"]').val( ( $this.inner_cut_mult / 10 ).toFixed( 1 ) );
					}
					$this.process();
				});
				$('input[name="donor-cut-2-depth"]').on('change', function(){
					$('input[name="segment-depth"]').val( $(this).val() ); 
				});
				$('select[name="eye"]').off().on('change', function(){ 
					var $self = $(this);
					$this.setCurrentEye($self.val()); 
					$this.fill_plan(); 
				}); 
				$('textarea[name="notes"]').on('change', function(){ 
					var $self = $(this); 
					var $val = $self.val(); 
					$this.fill_plan(); 
				});  
				// SETUP TAPERING
				$('#settings .line[data-rel="taper"] input').off().on('change', function(){ 
					var $self=$(this); 
					var $wrap = $self.parent().parent(); 
					var $type = $self.attr('name'); 
					var $axis = $this.lines[ +$wrap.data('line') ]; 
					var $arc = $axis.arcs[ +$wrap.data('arc') ]; 
					var $taper = $arc.tapering[ $wrap.data('key') ];
					switch( $type ){
						case "width": 
							var $val = +$self.val(); 
							$val = ( $val > 100 ? 100 : ( $val < 0 ? 0 : $val ) );
							$taper.width = $val;
							$self.val( $val );
							break; 
						case "length":
							var $val = +$self.val(); 
							$val = ( $val > 30 ? 30 : ( $val < 5 ? 5 : $val ) );
							$taper.length = $val; 
							$self.val( $val );
							break;
						case "visibility": 
							$taper.visibility = $self.is(':checked') ? true : false;
							break; 
					} 
					$this.process();
				}); 
				// SETUP THINNING 
				$('#settings .line[data-rel="thinning"] input').off().on('change', function(){ 
					var $self=$(this); 
					var $wrap = $self.parent().parent(); 
					var $type = $self.attr('name'); 
					var $axis = $this.lines[ +$wrap.data('line') ]; 
					var $arc = $axis.arcs[ +$wrap.data('arc') ]; 
					var $thin = $arc.thin;
					switch( $type ){
						case "width": 
							var $val = +$self.val(); 
							$val = ( $val > 100 ? 100 : ( $val < 0 ? 0 : $val ) );
							$thin.width = $val;
							$self.val( $val );
							break; 
						case "length":
							var $val = +$self.val(); 
							$val = ( $val > 45 ? 45 : ( $val < 5 ? 5 : $val ) );
							$thin.length = $val; 
							$self.val( $val );
							break;
						case "visibility": 
							$thin.visibility = $self.is(':checked') ? true : false;
							break; 
					} 
					$this.process();
				}); 
			},
			//
			// HELPERS
			// 
			setCurrentEye: function(val){ 
				var $this=this;
				$('.nose_wrapper').hide();
				$('#nose_'+ val).show();
				$('#tool-left-header').text(val+' eye');
				$('html').attr("data-eye", val);
				$this.sys.eye = val;
				$this.process();
			},
			save_jpg: function(filename, data, $type ) { 
				var $this=this;
				var blob = new Blob( [data], {type: $type});
				if( window.navigator.msSaveOrOpenBlob ){
					window.navigator.msSaveBlob( blob, filename );
				}
				else{
					var elem = window.document.createElement('a');
					elem.href = window.URL.createObjectURL(blob);
					elem.download = filename;
					document.body.appendChild(elem);
					elem.click();
					document.body.removeChild(elem);
				}
			}, 
			text: function( $text, $x, $y, $params ){
				var $this=this;
				$this.ctx.beginPath();
				$this.ctx.textAlign = $params && $params.align ? $params.align : "center";
				$this.ctx.textBaseline = $params && $params.baseline ? $params.baseline : "middle";
				$this.ctx.font = $params && $params.font ? $params.font : "normal 12px Arial";
				$this.ctx.fillStyle = $params && $params.color ? $params.color : "#000000";
				$this.ctx.strokeStyle = $params && $params.scolor ? $params.scolor : "#000000";
				if( $params && $params.shadow ){ 
					$this.ctx.shadowColor = "#000000";
					$this.ctx.shadowOffsetX = 5;
					$this.ctx.shadowOffsetY = 5;
					$this.ctx.shadowBlur = 5;
				}
				if( $params && $params.stroke ){ $this.ctx.strokeText( $text, $x, $y ); }
				else { $this.ctx.fillText( $text, $x, $y ); }
				$this.ctx.stroke();
				$this.ctx.closePath();
			}, 
			gradient: function(){
				var $this=this;
				var $gradient = $this.ctx.createLinearGradient( 0, 0, 0, 60 );
				$gradient.addColorStop( 0.0, 'rgba(0, 0, 255, 1)' );
				$gradient.addColorStop( 0.3, 'rgba(128, 0, 255, 0.6)' );
				$gradient.addColorStop( 0.6, 'rgba(0, 0, 255, 0.4)' );
				$gradient.addColorStop( 1.0, 'rgba(0, 255, 0, 0.2)' );
				$this.ctx.fillStyle = $gradient;
				return $gradient;
			}, 
			pattern: function( $img ){
				var $this=this;
				var $pattern = $this.ctx.createPattern( $img, 'repeat' );
				$this.ctx.fillStyle = $pattern;
				return $pattern;
			},
			line: function( $x1, $y1, $x2, $y2, $width, $color, $dash, $cap ){
				var $this=this;
				$this.ctx.closePath();
				$this.ctx.beginPath();
				$this.ctx.lineWidth = $width ? $width : 1;
				$this.ctx.strokeStyle = $color ? $color : "black";
				$this.ctx.lineCap = $cap ? $cap : "square"; // butt, square round
				$this.ctx.setLineDash( ( $dash && $dash.length ) ? $dash : [] );
				$this.ctx.moveTo( $x1, $y1 );
				$this.ctx.lineTo( $x2, $y2 );
				$this.ctx.stroke();
				$this.ctx.closePath();
				return true;
			}, 
			arc: function( $x, $y, $radius, $start, $end, $direction, $width, $color, $fill, $dash ){ 
				var $this = this;
				$this.ctx.closePath();
				$this.ctx.beginPath();
				$this.ctx.lineWidth = $width ? $width : 1;
				$this.ctx.setLineDash( ( $dash && $dash.length ) ? $dash : [] );
				$this.ctx.strokeStyle = $color ? $color : "black";
				if( $fill ){ $this.ctx.fillStyle = $fill; } 
				$this.ctx.arc( $x, $y, $radius, $start*($this.PI/180), $end*($this.PI/180), $direction ); // $direction true ccw false cw 
				if( $fill ){ $this.ctx.fill(); }
				$this.ctx.stroke();
				$this.ctx.closePath();
				return true;
			}, 
			filled_arch: function( $x, $y, $radius, $start, $end, $direction, $width, $color ){
				var $this=this;
				$this.ctx.closePath();
				$this.ctx.beginPath();
				$this.ctx.lineWidth = 1;
				$this.ctx.setLineDash( [] );
				$this.ctx.strokeStyle = $color ? $color : "black";
				$this.ctx.fillStyle = $color ? $color : "black";
				$this.ctx.arc( $x, $y, $radius, $start*($this.PI/180), $end*($this.PI/180), $direction, 1, ( $color ? $color : "black" ) );
				$this.ctx.arc( $x, $y, $radius-$width, $end*($this.PI/180), $start*($this.PI/180), !$direction, 1, ( $color ? $color : "black" ) );
				$this.ctx.fill();
				$this.ctx.stroke();
				$this.ctx.closePath();
				return true;
			},
			show_photo: function(){
				var $this=this;
				$('.photo').show();
			},
			crop_image: function(){
				var $uploadCrop;

				function readFile(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();
						
						reader.onload = function (e) {
							$('.upload-demo').addClass('ready');
							$uploadCrop.croppie('bind', {
								url: e.target.result
							}).then(function(){
								$('.cr-slider').attr('max', 5);
								console.log('jQuery bind complete');
							});
							
						}
						
						reader.readAsDataURL(input.files[0]);
					}
					else {
						swal("Sorry - you're browser doesn't support the FileReader API");
					}
				}

				function popupResult(result) { 
					console.log( result );
					//var $image = $('img', result.src).attr('src');
					//console.log( $image );
					$('.photo').css('background-image', 'url('+ result.src +')').show();
					$('#image_loader').hide();
					$('#upload').val("");
				}

				$uploadCrop = $('#upload-demo').croppie({
					viewport: {
						width: 620,
						height: 620,
						type: 'circle'
					},
					enableExif: true
				});

				$('#upload').on('change', function () { 
					$('#image_loader').css('display', "flex");
					readFile(this);
				}).on('click', function(){
					$('#upload').val("");
				});
				
				$('.upload-result').on('click', function (ev) { 
					$uploadCrop.croppie('result', {
						type: 'base64',
						size: { width:480, height:480 }
					}).then(function (resp) {
						popupResult({
							src: resp
						});
					});
				});
			},
			deg2rad: function( $a ){
				var $this=this;
				return $a * ( $this.PI / 180 )
			}, 
			hexToRgbA: function(hex, opacity){
				var c;
				if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
					c= hex.substring(1).split('');
					if(c.length== 3){
						c= [c[0], c[0], c[1], c[1], c[2], c[2]];
					}
					c= '0x'+c.join('');
					return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+','+ ( typeof opacity != "undefined" ? opacity : 1 ) +')';
				}
				console.log('Bad Hex');
			},
			coords_from_angle: function( $x, $y, $radius, $angle ){
				var $this = this;
				var $angle = $this.deg2rad( $angle );
				var $coord = {
					x: $x + $radius * Math.cos( $angle ), 
					y: $y + $radius * Math.sin( $angle )
				} 
				return $coord;
			}, 
			horde_length: function( $a, $b ){
				var $this=this; 
				//d = sqrt (x2 — x1)^2 + (y2 — y1)^2)
				if( $this.trace ) console.log( $a );
				var $distance = Math.sqrt( Math.pow( $a.x - $b.x, 2 ) + Math.pow( $a.y - $b.y, 2 ) ); 
				if( $this.trace ) console.log( $distance );
				return $distance;
			},
			radius_from_horde: function( $a, $b, $h ){
				var $this=this;
				//R = h / [1 - cos(φ/2)]
				//R = h/2 + W2/(8 × h) 
				var W = $this.horde_length( $a, $b ); 
				//var $radius = ( $h / 2 ) + ( ( W * 2 ) / ( 8 * $h ) ); 
				var $radius = ( Math.pow( W, 2 ) - ( 4 * Math.pow( $h, 2 ) ) ) / ( 8 * $h ); 
				if( $this.trace ) console.log( $radius );
				return $radius; 
			},
			set_incisions_from_axis: function( $line_id, $incision_id ){
				var $this=this; 
				var $trace = $this.trace; 
				var $axis = $this.lines[ $line_id ]; 
				var $axis_angle = Math.abs( $axis.angle );
				//var $incision = $line.incisions[ $incision_id ]; 
				if( $axis.incisions && $axis.incisions.length && $axis.incisions.length > 1 ){ 
					if( $axis.capture_satellites || $this.capture_satellites ){ 
						var $inc1 = $axis.incisions[ 0 ]; 
						var $inc1_angle = Math.abs( $inc1.angle ); 
						$inc1.angle = $axis_angle + $inc1.deffer; 
						$inc1.angle = -( Math.abs( $inc1.angle ) > 360 ? $inc1.angle - 360 : $inc1.angle ); 
						//$inc1.angle = -( Math.abs( $inc1.angle ) > 360 ? Math.abs( $inc1.angle ) - 360 : Math.abs( $inc1.angle ) );
						var $ang = $inc1.angle; 
						$ang = Math.abs( $ang > 0 ? 360 - $ang : ( Math.abs( $ang ) > 360 ? Math.abs( $ang ) - 360 : $ang ) );
						$('#slider5').val( $ang );
						$('#incision1').val( $ang );
						var $inc2 = $axis.incisions[ 1 ]; 
						var $inc2_angle = Math.abs( $inc2.angle ); 
						$inc2.angle = $axis_angle + $inc2.deffer;
						$inc2.angle = -( Math.abs( $inc2.angle ) >360 ? $inc2.angle - 360 : $inc2.angle ); 
						//$inc2.angle = -( Math.abs( $inc2.angle ) > 360 ? Math.abs( $inc2.angle ) - 360 : Math.abs( $inc2.angle ) );
						var $ang = $inc2.angle; 
						$ang = Math.abs( $ang > 0 ? 360 - $ang : ( Math.abs( $ang ) > 360 ? Math.abs( $ang ) - 360 : $ang ) );
						$('#slider6').val( $ang );
						$('#incision2').val( $ang );
						//if( $trace ) console.log("axis_angle "+ $axis_angle +" inc1_angle "+ $inc1.angle +" inc2_angle "+ $inc2.angle );
					} 
					else { 
						var $inc1 = $axis.incisions[ 0 ]; 
						var $inc1_angle = Math.abs( $inc1.angle ); 
						$inc1.deffer = Math.abs( $inc1_angle - $axis_angle );
						var $inc2 = $axis.incisions[ 1 ]; 
						var $inc2_angle = Math.abs( $inc2.angle );
						$inc2.deffer = Math.abs( $inc2_angle - $axis.angle ); 
						//if( $trace ) console.log("axis_angle "+ $axis_angle +" inc1_deffer "+ $inc1.deffer +" inc2_deffer "+ $inc2.deffer );
						// deffer 2 
					}
					/*
					if( $axis.capture_satellites ){
						$axis.incisions[ 0 ].angle = $axis.incisions[ 0 ].deffer + $axis.angle; 
						var $ang = $axis.incisions[ 0 ].angle;  
							$ang = Math.abs( $ang > 0 ? 360 - $ang : $ang ); 
						$('input[name="incision_1"]').val( $ang ); 
						$('#slider5').val( $ang ); 
						$axis.incisions[ 1 ].angle = $axis.incisions[ 1 ].deffer + $axis.angle; 
						$ang = $axis.incisions[ 1 ].angle;  
							$ang = Math.abs( $ang > 0 ? 360 - $ang : $ang );
						$('input[name="incision_2"]').val( $ang ); 
						$('#slider6').val( $ang ); 
					}
					else {
						$axis.incisions[ 0 ].$axis = Math.abs( Math.abs( $axis.angle ) - Math.abs( $axis.incisions[ 0 ].angle ) ); 
						$axis.incisions[ 1 ].$axis = Math.abs( Math.abs( $axis.angle ) - Math.abs( $axis.incisions[ 1 ].angle ) ); 
					}
					*/
				} 
			}, 
			set_incisions_from_inputs: function( $line_id, $incision_id, $val ){
				var $this=this; 
				var $trace = $this.trace; 
				var $axis = $this.lines[ $line_id ]; 
				var $axis_angle = Math.abs( $axis.angle );
				var $id = $incision_id; 
				var $incision = $axis.incisions[ $incision_id ]; 
				var $incision_angle = Math.abs( $incision.angle );
				$incision.deffer =  ( $incision_angle > $axis_angle ) ? $incision_angle - $axis_angle : -( $axis_angle - $incision_angle ); 
				if( $trace ) console.log( $incision.deffer );
				if( ( $axis.capture_satellites || $this.capture_satellites ) && !$id ){
					$axis.incisions[ 1 ].deffer = -$incision.deffer; 
					$axis.incisions[ 1 ].angle = -( $axis_angle + $axis.incisions[1].deffer ); 
					$axis.incisions[ 1 ].angle = $axis.incisions[ 1 ].angle < -360 ? $axis.incisions[ 1 ].angle + 360 : $axis.incisions[ 1 ].angle; 
					$ang = $axis.incisions[ 1 ].angle; 
					$ang = Math.abs( $ang > 0 ? 360 - $ang : ( Math.abs( $ang ) > 360 ? $ang+360 : $ang ) );
					$('#slider6').val( $ang );
					$('#incision2').val( $ang );
					//if( $trace ) console.log("axis_angle: "+ $axis_angle +" inc1_deffer: "+ $incision.deffer +" inc2_deffer "+ $axis.incisions[1].deffer );
				} 
				/*
				if( !$self.attr('disabled') ){
					$this.lines[0].satellites[ $id ].angle = -( $new_val > $this.lines[0].satellites[ $id ].max ? $this.lines[0].satellites[ $id ].max : $new_val ); 
					$this.lines[ 0 ].satellites[ $id ].deffer = Math.abs( Math.abs( $this.lines[ 0 ].angle ) - Math.abs( $this.lines[ 0 ].satellites[ $id ].angle ) ); 
					console.log( $this.lines[ 0 ].satellites[ $id ].deffer );
					if( $this.capture_satellites && !$id ){
						$this.lines[ 0 ].satellites[ 1 ].deffer = $this.lines[ 0 ].satellites[ $id ].deffer - 180; 
						$this.lines[ 0 ].satellites[ 1 ].angle = 180 + $this.lines[ 0 ].satellites[ $id ].angle; 
						$ang = $this.lines[ 0 ].satellites[ 1 ].angle; 
						$ang = Math.abs( $ang > 0 ? 360 - $ang : $ang );
						$('#slider6').val( $ang );
						$('#incision2').val( $ang );
					}
					console.log( $this.lines[ 0 ].satellites[ $id ].deffer ); 
				}
				*/
			},
			fill_plan: function(){ 
				var $this=this;
				$('[data-field="Notes"]').html( $('textarea[name="notes"]').val() );
				$('[data-field="Eye_selector"]').html( $('select[name="eye"]').val() );
				$('[data-field="Implant_1"]').html( Math.abs( $this.lines[ 0 ].angle ) );
				$('[data-field="Incision_1"]').html( Math.abs( $this.lines[ 0 ].incisions[ 0 ].angle ) );
				$('[data-field="Incision_2"]').html( Math.abs( $this.lines[ 0 ].incisions[ 1 ].angle ) );
				$('[data-field="Implant_2"]').html( Math.abs( $this.lines[ 1 ].angle ) );

				//(Tunnel OUTER DIAMETER - Tunnel INNER DIAMETER)/2
				var $inner = $('[name="tunnel-inner-diameter"]').val() * 1; 
				var $outer = $('[name="tunnel-outer-diameter"]').val() * 1; 
				var $width = ( $outer - $inner ) / 2;
				$('[data-field="channel_width"]').html( $width ); 
				$('[data-field="inner_diameter"]').html( $inner ); 
				$('[data-field="outer_diameter"]').html( $outer ); 
				//$('[data-field="channel_depth"]').html(); 
				$('[data-field="incision_1_axis"]').html( Math.abs( $this.lines[ 0 ].incisions[ 0 ].angle ) ); 
				$('[data-field="incision_2_axis"]').html( Math.abs( $this.lines[ 0 ].incisions[ 1 ].angle ) ); 
				$('[data-field="axis_1_central"]').html( Math.abs( $this.lines[ 0 ].angle ) ); 
				// 
				// $this.lines[0].arcs[0].tapering.right.width
				// 
				var $cw1 = $this.lines[0].arcs[0].tapering.right.visibility ? 
								( $this.lines[0].angle + $this.lines[0].arcs[0].angle / 2 + $this.lines[0].arcs[0].tapering.right.width ) : 
								( $this.lines[0].angle + $this.lines[0].arcs[0].angle / 2 );  
				var $cw2 = $this.lines[0].arcs[0].tapering.left.visibility ? 
								( $this.lines[0].angle - $this.lines[0].arcs[0].angle / 2 - $this.lines[0].arcs[0].tapering.left.width ) : 
								( $this.lines[0].angle - $this.lines[0].arcs[0].angle / 2 ); 
				$('[data-field="axis_1_cw"]').html( $cw1 ); 
				$('[data-field="axis_1_ccw"]').html( $cw2 ); 
				$('[data-field="axis_2_central"]').html( Math.abs( $this.lines[ 1 ].angle ) ); 
				var $cw3 = $this.lines[1].arcs[0].tapering.right.visibility ? 
								( $this.lines[1].angle + $this.lines[1].arcs[0].angle / 2 + $this.lines[1].arcs[0].tapering.right.width ) : 
								( $this.lines[1].angle + $this.lines[1].arcs[0].angle / 2 ); 
				var $cw4 = $this.lines[1].arcs[0].tapering.left.visibility ? 
								( $this.lines[1].angle - $this.lines[1].arcs[0].angle / 2 - $this.lines[1].arcs[0].tapering.left.width ) : 
								( $this.lines[1].angle - $this.lines[1].arcs[0].angle / 2 ); 
				$('[data-field="axis_2_cw"]').html( $cw3 ); 
				$('[data-field="axis_2_ccw"]').html( $cw4 ); 
				$('[data-field="plan_notes"]').html( $('textarea[name="notes"]').val() ); 
			},
			//
			// DRAW
			//
			field: function(){
				var $this = this;
				// clear
				// circles 
				var $rads = [ 220, 160, 95 ];
				$this.arc( $this.center.x, $this.center.y, $this.r, 0, 360, false, 2.5, "#c7c7c7" ); // main outer circle
				//$this.arc( $this.center.x, $this.center.y, $this.r-12, 0, 360, false, 1.5, "#c7c7c7" );
				
				if( !$this.middle_thin ){ 
					$this.arc( $this.center.x, $this.center.y, $this.inner_tunnel, 0, 360, false, 2.5, "#888888", "", [10,15] ); 	// Inner tunnel
				}
				$this.arc( $this.center.x, $this.center.y, $this.outer_tunnel, 0, 360, false, 2.5, "#888888", "", [10,15] );	// Outer tunnel 
				
				// grades
				var $grades = [ 0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170 ];
				for( var $i=0; $i<$grades.length; $i++ ){ 
					var $helper1 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r + 0, -( $grades[ $i ] ) );
					var $helper2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r + 50, 180-(360-(-$grades[ $i ])) );
					$this.line( 
						$helper1.x, 
						$helper1.y, 
						$helper2.x, 
						$helper2.y, 
						( $grades[$i] == 0 || $grades[ $i ] == 90 ? 2.5 : 
							( $grades[$i] == 30 || $grades[ $i ] == 60 || $grades[ $i ] == 120 || $grades[ $i ] == 150 ? 1.5 : 
								$this.sys.width 
							) 
						), 
						( 
							$grades[$i] == 0 || $grades[$i] == 30 || $grades[$i] == 60 || $grades[ $i ] == 90 || $grades[ $i ] == 120 || $grades[ $i ] == 150 ? "#000000" : 
								"#989898" 
						), 
						[ 25, $this.r * 2 - 50 ] 
					);
				} 

				var $font1 = "600 13px Inter";
				var $font2 = "bold 15px Inter";
				var $color1 = "#989898";
				var $color2 = "#000000";
				var $shift = 18;
				var $coord = $this.coords_from_angle( $this.center.x-3, $this.center.y+9, $this.r+$shift-7, 0 ); // 0
					$app.text( "180°", $coord.x, $coord.y, { color: $color1, font: $font1, align: "left" } );
				$coord = $this.coords_from_angle( $this.center.x+5, $this.center.y-7, $this.r+$shift, 0 );
					$app.text( "0°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+8, $this.center.y+10, $this.r+$shift, -30 ); // 30
					$app.text( "210°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x+8, $this.center.y-6, $this.r+$shift, -30 );
					$app.text( "30°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y+4, $this.r+$shift, -60 ); // 60
					$app.text( "240°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y-13, $this.r+$shift, -60 );
					$app.text( "60°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y+5, $this.r+$shift, -90 ); // 90
					$app.text( "270°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y-11, $this.r+$shift, -90 );
					$app.text( "90°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x-2, $this.center.y+4, $this.r+$shift, -120 ); // 120
					$app.text( "300°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x-2, $this.center.y-13, $this.r+$shift, -120 );
					$app.text( "120°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x-9, $this.center.y+10, $this.r+$shift, -150 ); // 150
					$app.text( "330°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x-8, $this.center.y-6, $this.r+$shift, -150 );
					$app.text( "150°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x-5, $this.center.y+9, $this.r+$shift, -180 ); // 180
					$app.text( "0°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x-4, $this.center.y-7, $this.r+$shift, -180 );
					$app.text( "180°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x-8, $this.center.y+8, $this.r+$shift, -210 ); // 210
					$app.text( "210°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x-8, $this.center.y-8, $this.r+$shift, -210 );
					$app.text( "30°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x-2, $this.center.y, $this.r+$shift, -240 ); // 240
					$app.text( "60°", $coord.x, $coord.y, { color: $color1, font: $font1 } );
				$coord = $this.coords_from_angle( $this.center.x-2, $this.center.y+16, $this.r+$shift, -240 );
					$app.text( "240°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y-2, $this.r+$shift, -270 ); // 270
					$app.text( "90°", $coord.x, $coord.y, { color: $color1, font: $font1 } );				
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y+14, $this.r+$shift, -270 );
					$app.text( "270°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y, $this.r+$shift, -300 ); // 300
					$app.text( "120°", $coord.x, $coord.y, { color: $color1, font: $font1 } );				
				$coord = $this.coords_from_angle( $this.center.x+2, $this.center.y+16, $this.r+$shift, -300 );
					$app.text( "300°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
				$coord = $this.coords_from_angle( $this.center.x+8, $this.center.y-8, $this.r+$shift, -330 ); // 330
					$app.text( "150°", $coord.x, $coord.y, { color: $color1, font: $font1 } );				
				$coord = $this.coords_from_angle( $this.center.x+8, $this.center.y+8, $this.r+$shift, -330 );
					$app.text( "330°", $coord.x, $coord.y, { color: $color2, font: $font2 } );
			}, 
			process: function(){
				var $this=this;
				$this.ctx.clearRect( 0, 0, 800, 800 );
				$this.field();
				var $font = "600 15px Inter";
				var $color = "#000000";
				var is_render = $('body').hasClass('render-intr') ? true : false;

				// helpers lines
				for( var $i=0; $i<$this.helpers.length; $i++ ){
					var $row = $this.helpers[ $i ];
					if( $row.visibility ){
						var A = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r + 10, -( $row.angle ) );
						var B = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r + 10, 180 - ( 360 - ( -$row.angle ) ) );
						$this.line( A.x, A.y, B.x, B.y, $row.width, $this.hexToRgbA( $row.color, $row.opacity ), $row.dash );
					}
				}				
				// process tool
				for( var $i=0; $i<$this.lines.length; $i++ ){
					var $line = $this.lines[ $i ];
					if( $line.visibility ){
						// Axis
						//var $coord = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, $line.angle );
						//var $coord2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, 180-(360-($line.angle)) );
						// Arcs
						if( $line.arcs && $line.arcs.length ){ 
							for( var $j=0; $j<$line.arcs.length; $j++ ){
								var $arc = $line.arcs[ $j ];
								if( +$arc.visibility ){ 
									$this.draw_arc( $i, $j ); 
									$this.draw_arc_info( $i, $j );
								} 
								else { 
									$arc = {} 
								}
							} 
						}

						$this.draw_axis( $i );

						if( $line.incisions && $line.incisions.length ){ 
							$this.draw_incisions( $i );
						}
					}
				} 
				

			}, 
			draw_axis: function( $id ){
				var $this=this; 
				var $font = "700 16px Inter";
				var $color = "#000000"; 
				var $line = $this.lines[ $id ]; 
				var is_render = $('body').hasClass('render-intr') ? true : false;
				var $acc = $line.shift / 2;
				var A = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r - 40, $line.angle + $acc );
				var B = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r - 40, 180 - ( 360 - ( $line.angle - $acc ) ) );
				var C = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r - 40, $line.angle - $acc );
				var D = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r - 40, 180 - ( 360 - ( $line.angle + $acc ) ) );
				
				if( !is_render ){
					$this.line( A.x, A.y, B.x, B.y, $line.width, $this.hexToRgbA( $line.color, $line.opacity ) );
					$this.line( C.x, C.y, D.x, D.y, $line.width, $this.hexToRgbA( $line.color, $line.opacity ) );
				}
				else{
					var A = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r, $line.angle );
					var B = $this.coords_from_angle( $this.center.x, $this.center.y, -120, 180-(360-($line.angle)) );
					
					var text_angle = Math.abs( $line.angle );
					var text_shift = ( text_angle > 9 && text_angle < 100 ) ? 23 : ( text_angle > 99 ? 25 : 17 );
					var C = $this.coords_from_angle( $this.center.x, $this.center.y, -120+text_shift, 180-(360-($line.angle)) );
					
					$this.line( A.x, A.y, B.x, B.y, 1, $this.hexToRgbA("#888888", 1), [ 6, 8 ] );
					$this.text( text_angle+"°", C.x, C.y, { color: $color, font: $font } );
				}
			}, 
			draw_incisions: function( $line_id ){
				var $this=this; 
				var $trace= $this.trace;
				var $line = $this.lines[ $line_id ];
				if( $line.incisions ){ 
					for( var $k=0; $k<$line.incisions.length; $k++ ){
						var $row = $line.incisions[ $k ]; 
						if( +$row.visibility ){
	                        var A = $this.coords_from_angle( $this.center.x, $this.center.y, $row.radius, $row.angle ); 
	                        	if( $trace ) $this.text( "A", A.x, A.y, { color: $this.sys.color, font: $this.sys.font } ); 
	                        var B = $this.coords_from_angle( $this.center.x, $this.center.y, $row.radius - $row.shift, $row.angle ); 
	                        	if( $trace ) $this.text( "B", B.x, B.y, { color: $this.sys.color, font: $this.sys.font } ); 
	                        $this.line( A.x, A.y, B.x, B.y, $row.width, $this.hexToRgbA( $row.color, $row.opacity) );
	                        
	                        var text_angle = Math.abs( $row.angle > 0 ? 360 - $row.angle : $row.angle );
							var text_shift = ( text_angle > 9 && text_angle < 100 ) ? 23 : ( text_angle > 99 ? 25 : 17 );
							var C = $this.coords_from_angle( $this.center.x, $this.center.y, $row.radius - $row.shift - text_shift, $row.angle );
								$this.text( text_angle+"°", C.x, C.y, { color: $this.sys.color, font: $this.sys.font } );
	                    }
	                }
				}
			},
			draw_arc: function( $line_id, $arc_id ){
				var $this = this; 
				var $trace = $this.trace; 
				var $line = $this.lines[ $line_id ]; 
				var $arc = $line.arcs[ $arc_id ]; 
				var $inner_cut = $arc.inner_cut; 
				var $outer_cut = $arc.outer_cut;
				var $arc_width = $outer_cut - $inner_cut; 
				var $font = "700 16px Inter";
				var $color = "#000000"; 
				var $a = $line.angle; 
				var $r1 = $outer_cut; 
				var $r2 = $inner_cut; 
				var $taper_left_width = 0;
				var $taper_right_width = 0; 
				var $thin_width = 0;
				//$arc.thin.visibility = false; 
				// MAIN ARC POINTS
				var $a = $line.angle + $arc.angle / 2;
				if( $arc.tapering && $arc.tapering.right && $arc.tapering.right.visibility ){
					$taper_right_width = ( $arc.tapering.right.width ) / 100 / 2;
					$a -= $arc.tapering.right.length;
				}
				// right top
				var A = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $a );
					if( $trace ) $this.text( "A", A.x, A.y, { color:$color, font:$font } ); 
				var $b = $line.angle - $arc.angle / 2;
				if( $arc.tapering && $arc.tapering.left && $arc.tapering.left.visibility ){
					$taper_left_width =  ( $arc.tapering.left.width ) / 100 / 2;
					$b += $arc.tapering.left.length;
				}
				// left top
				var B = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $b );
					if( $trace ) $this.text( "B", B.x, B.y, { color:$color, font:$font } ); 
				// left bottom
				var C = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut, $b );
					if( $trace ) $this.text( "C", C.x, C.y, { color:$color, font:$font } );
				// right bottom 
				var D = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut, $a );
					if( $trace ) $this.text( "D", D.x, D.y, { color:$color, font:$font } ); 
				// TAPER LEFT POINTS
				if( $arc.tapering && $arc.tapering.left && $arc.tapering.left.visibility ){
					// upper curve
					var B1 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $b - $arc.tapering.left.length / 2 ); 
						if( $trace ) $this.text( "B1", B1.x, B1.y, { color:$color, font:$font } ); 
					var B2 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut - ( $arc_width * $taper_left_width ), $b - $arc.tapering.left.length ); 
						if( $trace ) $this.text( "B2", B2.x, B2.y, { color:$color, font:$font } ); 
					var B3 = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut + ( $arc_width * $taper_left_width ), $b - $arc.tapering.left.length ); 
						if( $trace ) $this.text( "B3", B3.x, B3.y, { color:$color, font:$font } ); 
					// lower curve
					var B4 = $this.coords_from_angle( $this.center.x, $this.center.y, ( $arc.tapering.left.length <= 15 ? $inner_cut : $inner_cut + ( $arc_width * 0.25 ) ), $b - $arc.tapering.left.length / 2 ); 
						if( $trace ) $this.text( "B4", B4.x, B4.y, { color:$color, font:$font } ); 
				}
				// TAPER RIGHT POINTS
				if( $arc.tapering && $arc.tapering.right && $arc.tapering.right.visibility ){
					// lower curve
					var D1 = $this.coords_from_angle( $this.center.x, $this.center.y, ( $arc.tapering.right.length <= 15 ? $inner_cut : $inner_cut + ( $arc_width * 0.25 ) ), $a + $arc.tapering.right.length / 2 ); 
						if( $trace ) $this.text( "D1", D1.x, D1.y, { color:$color, font:$font } ); 
					var D2 = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut + ( $arc_width * $taper_right_width ), $a + $arc.tapering.right.length ); 
						if( $trace ) $this.text( "D2", D2.x, D2.y, { color:$color, font:$font } ); 
					var D3 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut - ( $arc_width * $taper_right_width ), $a + $arc.tapering.right.length ); 
						if( $trace ) $this.text( "D3", D3.x, D3.y, { color:$color, font:$font } ); 
					// lower curve
					var D4 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $a + $arc.tapering.right.length / 2 ); 
						if( $trace ) $this.text( "D4", D4.x, D4.y, { color:$color, font:$font } ); 
				}
				// THIN POINTS 
				if( $arc.thin && $arc.thin.visibility ){ 
					$thin_width = ( $arc.thin.width ) / 100 / 2; 
					$thin_mult = 2; 
					var A1 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $line.angle + $arc.thin.length / 2 );
						if( $trace ) $this.text( "A1", A1.x, A1.y, { color:$color, font:$font } ); 
					var A2 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut - ( $arc_width * $thin_width ) * ( $arc.thin.width > 50 ? 1.5 : 2 ), $line.angle );
						if( $trace ) $this.text( "x", A2.x, A2.y, { color:$color, font:$font } ); 
					var A3 = $this.coords_from_angle( $this.center.x, $this.center.y, $outer_cut, $line.angle - $arc.thin.length / 2 );
						if( $trace ) $this.text( "A3", A3.x, A3.y, { color:$color, font:$font } ); 
					var C1 = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut, $line.angle - $arc.thin.length / 2 );
						if( $trace ) $this.text( "C1", C1.x, C1.y, { color:$color, font:$font } ); 
					var C2 = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut + ( $arc_width * $thin_width ) * ( $arc.thin.width > 50 ? 2 : 3 ), $line.angle );
						if( $trace ) $this.text( "C2", C2.x, C2.y, { color:$color, font:$font } ); 
					var C3 = $this.coords_from_angle( $this.center.x, $this.center.y, $inner_cut, $line.angle + $arc.thin.length / 2 );
						if( $trace ) $this.text( "C3", C3.x, C3.y, { color:$color, font:$font } ); 

					//var $height = ( ( $this.outer_cut - $this.inner_cut ) * $thin_width ) * 2;
					//var $point = $this.outer_cut - $height; 
					//var $radius = $this.radius_from_horde( A1, A3, $height ); 
					//var $thin_center = $this.coords_from_angle( $this.center.x, $this.center.y, $point + $radius, $line.angle ); 
					//if( $trace ) console.log( $thin_center );
					//$this.ctx.fillStyle = "#000000"; 
					//$this.ctx.beginPath(); 	
					//$this.ctx.arc( $thin_center.x, $thin_center.y, $radius, 0, $this.deg2rad( 360 ), 1 ); 
					//$this.ctx.fill(); 
					//$this.ctx.closePath();
				}

				$this.ctx.lineWidth = 1;
				$this.ctx.strokeStyle = "black";
				$this.ctx.fillStyle = $this.hexToRgbA( $arc.color, $arc.opacity);
				$this.ctx.beginPath(); 																									// start path from upper right point of base arc
				if( $arc.thin && $arc.thin.visibility ){																				// if arc thin
					$this.ctx.arc( $this.center.x, $this.center.y, $outer_cut-1, $this.deg2rad( $a ), $this.deg2rad( $line.angle + $arc.thin.length / 2 ), 1 ); 	// A to A1 
					$this.ctx.quadraticCurveTo( A2.x, A2.y, A3.x, A3.y );																	// A1 to A3 through A2 
					$this.ctx.arc( $this.center.x, $this.center.y, $outer_cut-1, $this.deg2rad( $line.angle - $arc.thin.length / 2 ), $this.deg2rad( $b ), 1 );	// A3 to B 
					//var $height = ( ( $this.outer_cut - $this.inner_cut ) * $thin_width ) * 2;
					//var $point = $this.outer_cut - $height; 
					//var $radius = $this.radius_from_horde( A1, A3, $height ); 
					//var $thin_center = $this.coords_from_angle( $this.center.x, $this.center.y, $point + $radius, $line.angle ); 
					//$this.ctx.arc( $this.center.x, $this.center.y, $this.outer_cut-1, $this.deg2rad( $a ), $this.deg2rad( $line.angle + $arc.thin.length / 2 ), 1 ); 	// A to A1 
					//$this.ctx.arc( $thin_center.x, $thin_center.y, $point + $radius, $this.deg2rad( $line.angle - $arc.thin.length / 2 ), $this.deg2rad( $line.angle + $arc.thin.length / 2 ), 0 ); 	// A1 to A3																// A1 to A3 through A2 
					//$this.ctx.arc( $this.center.x, $this.center.y, $this.outer_cut-1, $this.deg2rad( $line.angle - $arc.thin.length / 2 ), $this.deg2rad( $b ), 1 );	// A3 to B
				} 
				else {																													// if !arc thin
					$this.ctx.arc( $this.center.x, $this.center.y, $outer_cut-1, $this.deg2rad( $a ), $this.deg2rad( $b ), 1 ); 	// A to B 
				} 
				if( $arc.tapering && $arc.tapering.left && $arc.tapering.left.visibility ){												// if left taper
					$this.ctx.quadraticCurveTo( B1.x, B1.y, B2.x, B2.y ); 																// B to B2 through B1 
					$this.ctx.lineTo( B3.x, B3.y );																						// B2 to B3 
					$this.ctx.quadraticCurveTo( B4.x, B4.y, C.x, C.y );																	// B3 to C through B4
				}
				else {																													// if !left taper
					$this.ctx.lineTo( C.x, C.y );																						// B to C
				}																														// next points 
				if( $arc.thin && $arc.thin.visibility ){																				// if arc thin
					$this.ctx.arc( $this.center.x, $this.center.y, $inner_cut-1, $this.deg2rad( $b ), $this.deg2rad( $line.angle - $arc.thin.length / 2 ), 0 ); 	// C to C1 
					$this.ctx.quadraticCurveTo( C2.x, C2.y, C3.x, C3.y );																// C1 to C3 through C2  
					$this.ctx.arc( $this.center.x, $this.center.y, $inner_cut-1, $this.deg2rad( $line.angle + $arc.thin.length / 2 ), $this.deg2rad( $a ), 0 );	// C3 to В through C2
				}
				else {																													// if !arc.thin
					$this.ctx.arc( $this.center.x, $this.center.y, $inner_cut+1, $this.deg2rad( $b ), $this.deg2rad( $a ), 0 ); 	// C to D
				}
				if( $arc.tapering && $arc.tapering.right && $arc.tapering.right.visibility ){											// if right taper
					$this.ctx.quadraticCurveTo( D1.x, D1.y, D2.x, D2.y );																// D to D2 through D1 
					$this.ctx.lineTo( D3.x, D3.y );																						// D2 to D3 
					$this.ctx.quadraticCurveTo( D4.x, D4.y, A.x, A.y );																	// D3 to A through D4
				} 
				else { 																													// if !right taper
					$this.ctx.lineTo( A.x, A.y );																						// D to A
				}																														// path complete
				//$this.ctx.stroke(); 
				$this.ctx.fill(); 
				$this.ctx.closePath(); 
			}, 
			draw_arc_info: function( $line_id, $arc_id ){
				var $this=this; 
				var $line = $this.lines[ $line_id ]; 
				var $arc = $line.arcs[ $arc_id ];
				if( $arc.info && $arc.info.visibility ){ 
					var $start = ( $arc.angle / 2 );
						$start = $start > 177.5 ? 177.5 : ( $start < -177.5 ? -177.5 : $start );
					var $a = $line.angle + $start;
					var $b = $line.angle - $start;
					var A = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius, $b );
					var B = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius - $arc.info.shift, $b );
					var C = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius - $arc.info.shift - 35, $b );
					$this.line( A.x, A.y, B.x, B.y, $arc.info.width, $this.hexToRgbA( $arc.info.color, $arc.info.opacity ), $arc.info.dash );
					var $text1 = Math.abs( $line.angle ) + $arc.angle / 2 < 361 ? 
									Math.abs( $line.angle ) + $arc.angle / 2 : 
									Math.abs( Math.abs( $line.angle ) + $arc.angle / 2 ) - 360;
					$app.text( $text1+"°", C.x, C.y, { color: $this.sys.color, font: $this.sys.font } );
					var D = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius, $a );
					var E = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius - $arc.info.shift, $a );
					var F = $this.coords_from_angle( $this.center.x, $this.center.y, $arc.info.radius - $arc.info.shift - 35, $a );
					$this.line( D.x, D.y, E.x, E.y, $arc.info.width, $this.hexToRgbA( $arc.info.color, $arc.info.opacity ), $arc.info.dash );
					var $text2 = Math.abs( $line.angle ) - $arc.angle / 2 > 0 ? 
									Math.abs( $line.angle ) - $arc.angle / 2 : 
									360 - Math.abs( Math.abs( $line.angle ) - $arc.angle / 2 );
					$app.text( $text2+"°", F.x, F.y, { color: $this.sys.color, font: $this.sys.font } ); 
				}
			},
			//
			// CUSTOMIZATIONS
			//
			draw_settings: function(){
				var $this=this; 
				// Topography
				var $tmps = '<div class="line" data-rel="photo" data-id="0">'+ 
								'<div class="item"> <span>Topography</span></div>'+ 
								'<div class="item"> <span>Opacity</span> <input type="text" value="'+ $this.topography.opacity +'" name="opacity" maxlength="3" /> </div>'+ 
								'<div class="item"> </div>'+ 
								'<div class="item"> </div>'+ 
								'<div class="item"> </div>'+ 
								'<div class="item"> </div>'+ 
							'</div>';
				$('#settings .field').append( $tmps );
				// Axis
				for( var $i=0; $i<$this.lines.length; $i++ ){
					var $row = $this.lines[ $i ];
					var $tmps = '<div class="line" data-rel="lines" data-id="'+ $i +'">'+ 
									'<div class="item"> <span>'+ $row.name +'</span>'+ $row.visual +'</div>'+ 
									'<div class="item"> <span>Shift</span> <input type="text" value="'+ $row.shift +'" name="shift" maxlength="2" /> </div>'+ 
									'<div class="item"> <span>Width</span> <input type="text" value="'+ $row.width +'" name="width" maxlength="2" /> </div>'+ 
									'<div class="item"> <span>Opacity</span> <input type="text" value="'+ $row.opacity +'" name="opacity" maxlength="3" /> </div>'+ 
									'<div class="item"> <span>Color</span> <input type="color" value="'+ $row.color +'" name="color" /> </div>'+ 
									'<div class="item"> '+
										( 
											$i == 0 ? '' : ''
											//'<span>Visibility</span> <input type="checkbox" name="visibility" value="" '+ ( $row.visibility ? 'checked="checked"' : '' ) +' />' 
										)+ 
									'</div>'+
								'</div>';
					$('#settings .field').append( $tmps );
					// Arks
					if( $row.arcs && $row.arcs.length ){
						for( var $j=0; $j<$row.arcs.length; $j++ ){
							var $arc = $row.arcs[ $j ];
							// ARC MAIN
							var $tmps = '<div class="line" data-rel="arcs" data-id="'+ $j +'" data-parent="'+ $i +'">'+ 
									'<div class="item"> <span>'+ $arc.name +'</span>'+ $arc.visual +'</div>'+ 
									'<div class="item"> '+
										( $i ? '<span>Inner Cut</span> <input type="text" value="'+ ( $arc.inner_cut_mult / 10 ).toFixed(1) +'" name="inner_cut_mult" maxlength="3" />' : '' )+ 
									'</div>'+ 
									'<div class="item"> '+
										( $i ? '<span>Outer Cut</span> <input type="text" value="'+ ( $arc.outer_cut_mult / 10 ).toFixed(1) +'" name="outer_cut_mult" maxlength="3" />' : '' )+ 
									'</div>'+ 
									'<div class="item"> <span>Opacity</span> <input type="text" value="'+ $arc.opacity +'" name="opacity" maxlength="3" /> </div>'+ 
									'<div class="item"> <span>Color</span> <input type="color" value="'+ $arc.color +'" name="color" /> </div>'+ 
									'<div class="item"> '+ 
										( 
											( $i == 0 && $j == 0 ) || ( $i == 1 && $j == 0 ) ? '' : 
												'<span>Visibility</span> <input type="checkbox" value="" name="visibility" '+ ( $arc.visibility ? 'checked="checked"' : '' ) +' />' 
										)+ 
									'</div>'+ 
								'</div>';
							$('#settings .field').append( $tmps ); 
							// ARC TAPER
							if( $arc.tapering ){
								for( var $key in $arc.tapering ){ 
									var $taper = $arc.tapering[ $key ]; 
									var $html = '<div class="line" data-rel="taper" data-id="0" data-key="'+ $key +'" data-line="'+ $i +'" data-arc="'+ $j +'">'+ 
													'<div class="item"> <span>'+ $arc.name +' Tapering '+ ( $key == "left" ? "CCW" : "CW" ) +'</span></div>'+ 
													'<div class="item"> <span>Width</span> <input type="text" value="'+ $taper.width +'" name="width" maxlength="3" /> </div>'+ 
													'<div class="item"> <span>Length</span> <input type="text" value="'+ $taper.length +'" name="length" maxlength="2" /> </div>'+ 
													'<div class="item"> </div>'+ 
													'<div class="item"> </div>'+ 
													'<div class="item"><span>Visibility</span> <input type="checkbox" value="" name="visibility" '+ ( $taper.visibility ? 'checked="checked"' : '' ) +' /></div>'+ 
												'</div>'; 
									$('#settings .field').append( $html ); 
								}
							} 
							// ARC THIN
							if( $arc.thin ){
								var $html = '<div class="line" data-rel="thinning" data-id="0" data-line="'+ $i +'" data-arc="'+ $j +'">'+ 
												'<div class="item"> <span>'+ $arc.name +' Thinning</span></div>'+ 
												'<div class="item"> <span>Width</span> <input type="text" value="'+ $arc.thin.width +'" name="width" maxlength="3" /> </div>'+ 
												'<div class="item"> <span>Length</span> <input type="text" value="'+ $arc.thin.length +'" name="length" maxlength="2" /> </div>'+ 
												'<div class="item"> </div>'+ 
												'<div class="item"> </div>'+ 
												'<div class="item"><span>Visibility</span> <input type="checkbox" value="" name="visibility" '+ ( $arc.thin.visibility ? 'checked="checked"' : '' ) +' /></div>'+ 
											'</div>'; 
								$('#settings .field').append( $html ); 
							}
						}
					} 
					// INCISIONS
					if( $row.incisions ){
						for( var $j=0; $j< $row.incisions.length; $j++ ){
							var $sat = $row.incisions[ $j ];
							var $tmps = '<div class="line" data-rel="satellites" data-id="0" data-parent="'+ $i +'">'+ 
											'<div class="item"> <span>'+ $sat.name +'</span>'+ $sat.visual +'</div>'+ 
											'<div class="item"> <span>Radius</span> <input type="text" value="'+ $sat.radius +'" name="radius" maxlength="3" /> </div>'+
											'<div class="item"> <span>Width</span> <input type="text" value="'+ $sat.width +'" name="width" maxlength="3" /> </div>'+ 
											'<div class="item"> <span>Opacity</span> <input type="text" value="'+ $sat.opacity +'" name="opacity" maxlength="3" /> </div>'+ 
											'<div class="item"> <span>Color</span> <input type="color" value="'+ $sat.color +'" name="color" /> </div>'+ 
											'<div class="item"> </div>'+ //<span>Visibility</span> <input type="checkbox" value="" name="visibility" '+ ( $sat.visibility ? 'checked="checked"' : '' ) +' /> </div>'+ 
										'</div>';
							$('#settings .field').append( $tmps ); 
						}
					}
				} 
				// Helpers
				for( var $i=0; $i<$this.helpers.length; $i++ ){
					var $row = $this.helpers[ $i ];
					var $tmps = '<div class="line" data-rel="helpers" data-id="'+ $i +'">'+ 
									'<div class="item"> <span>'+ $row.name +'</span>'+ $row.visual +'</div>'+ 
									'<div class="item"> <span>Angle</span> <input type="text" value="'+ $row.angle +'" name="angle" maxlength="3" /> </div>'+ 
									'<div class="item"> <span>Width</span> <input type="text" value="'+ $row.width +'" name="width" maxlength="3" /> </div>'+ 
									'<div class="item"> <span>Opacity</span> <input type="text" value="'+ $row.opacity +'" name="opacity" maxlength="3" /> </div>'+ 
									'<div class="item"> <span>Color</span> <input type="color" value="'+ $row.color +'" name="color" /> </div>'+ 
									'<div class="item"> <span>Visibility</span> <input type="checkbox" value="" name="visibility" '+ ( $row.visibility ? 'checked="checked"' : '' ) +' /> </div>'+ 
								'</div>';
					$('#settings .field').append( $tmps );
				} 
			},
			//
			//
			//
			//========================================================= DEPRECATED ===================================================================
			//
			//
			//
			//! DEPRECATED
			tapers: {
				left: {
					visibility: 1,
					width: 30, 
					length: 15 
				}, 
				right: {
					visibility: 1, 
					width: 30, 
					length: 15
				}
			},
			//! DEPRECATED
			tapering: function( $dir ){
				var $this=this; 
				if( $dir ){ 
					var $start = ( $this.lines[0].arcs[0].angle / 2 ); 
					$start = $start > 177.5 ? 177.5 : ( $start < -177.5 ? -177.5 : $start ); 
					var $a = $dir == "right" ? $this.lines[0].angle + $start : $this.lines[0].angle - $start; 
					var $font = "600 15px Inter";
					var $color = "#000000"; 
					var $width = ( 100 - $this.tapers[$dir].width ) / 100 / 2;
					var $length = $this.tapers[ $dir ].length;
					// COORDS
					var A = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a );
						//$this.text( "a", A.x, A.y, { color:$color, font:$font } );
					var B = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut + ( ( $this.outer_cut - $this.inner_cut ) * $width ), ( $dir == "right" ? $a + $length : $a - $length ) );
						//$this.text( "b", B.x, B.y, { color:$color, font:$font } );
					var C = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut - ( ( $this.outer_cut - $this.inner_cut ) * $width ), ( $dir == "right" ? $a + $length : $a - $length ) ); 
						//$this.text( "c", C.x, C.y, { color:$color, font:$font } );
					var D = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a ); 
						//$this.text( "d", D.x, D.y, { color:$color, font:$font } ); 
					// CURVES 
					var E = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, ( $dir == "right" ? $a + $length / 2 : $a - $length / 2 ) ); 
						//$this.text( "e", E.x, E.y, { color:$color, font:$font } );
					var F = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, ( $dir == "right" ? $a + $length / 2: $a - $length / 2 ) ); 
						//$this.text( "f", F.x, F.y, { color:$color, font:$font } );

					$this.ctx.fillStyle = $this.hexToRgbA( $this.lines[0].arcs[0].color, $this.lines[0].arcs[0].opacity);
					$this.ctx.beginPath(); 
					$this.ctx.moveTo( A.x, A.y ); 
					$this.ctx.quadraticCurveTo( E.x, E.y, B.x, B.y ); 
					//$this.ctx.lineTo( B.x, B.y );
					$this.ctx.lineTo( C.x, C.y );
					$this.ctx.quadraticCurveTo( F.x, F.y, D.x, D.y );
					//$this.ctx.lineTo( D.x, D.y );
					$this.ctx.fill(); 
					$this.ctx.closePath();
				}
			}, 
			//! DEPRECATED
			thinker: function(){
				var $this=this; 
				var $font = "600 15px Inter";
				var $color = "#000000"; 
				var $a = $this.lines[0].angle; 
				var $r1 = $this.outer_cut; 
				var $r2 = $this.inner_cut; 
				var $length = 30; 
				/*var A = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut + 50, $a );
					$this.text( "a", A.x, A.y, { color:$color, font:$font } );
				var B = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a + $length );
					$this.text( "b", B.x, B.y, { color:$color, font:$font } ); 
				var C = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a - $length ); 
					$this.text( "c", C.x, C.y, { color:$color, font:$font } ); 
				var D = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut + 10, $a );
					$this.text( "d", D.x, D.y, { color:$color, font:$font } );

				$this.ctx.fillStyle = "#FFFFFF";
				$this.ctx.beginPath(); 
				$this.ctx.moveTo( B.x, B.y ); 
				$this.ctx.quadraticCurveTo( A.x, A.y, C.x, C.y ); 
				//$this.arc( $this.center.x, $this.center.y, $this.inner_cut, $a - $length, $a + $length, false, 1, "#FF0000", false, false ); 
				$this.ctx.quadraticCurveTo( D.x, D.y, B.x, B.y );
				//$this.ctx.lineTo( B.x, B.y );
				//$this.ctx.lineTo( C.x, C.y );
				//$this.ctx.quadraticCurveTo( F.x, F.y, D.x, D.y );
				//$this.ctx.lineTo( D.x, D.y );
				$this.ctx.fill(); 
				$this.ctx.closePath(); */

				var $deffer = 15;
				var $a1 = $a + $this.lines[0].arcs[0].angle / 2;
				var v1 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a1 );
					$this.text( "v1", v1.x, v1.y, { color:$color, font:$font } ); 
				var $a2 = $a - $this.lines[0].arcs[0].angle / 2;
				var v2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a2 );
					$this.text( "v2", v2.x, v2.y, { color:$color, font:$font } ); 
				var v3 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a );
					$this.text( "v3", v3.x, v3.y, { color:$color, font:$font } ); 
				var v4 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a2 );
					$this.text( "v4", v4.x, v4.y, { color:$color, font:$font } );

				$this.ctx.lineWidth = 1;
				$this.ctx.strokeStyle = "black";
				$this.ctx.fillStyle = $this.hexToRgbA( $this.lines[0].arcs[0].color, 0.5); //$this.lines[0].arcs[0].opacity);
				$this.ctx.beginPath(); 
				//$this.ctx.moveTo( v1.x, v1.y ); 
				//$this.ctx.lineTo( v1.x, v1.y );
				//$this.ctx.quadraticCurveTo( v3.x, v3.y, v2.x, v2.y ); 
				//$this.ctx.arcTo( v1.x, v1.y, v2.x, v2.y, $this.outer_cut );
				$this.ctx.arc( $this.center.x, $this.center.y, $this.outer_cut-1, $this.deg2rad( $a1 ), $this.deg2rad( $a2 ), 1 ); 
				$this.ctx.lineTo( v4.x, v4.y );
				$this.ctx.arc( $this.center.x, $this.center.y, $this.inner_cut+1, $this.deg2rad( $a2 ), $this.deg2rad( $a1 ), 0 ); 
				$this.ctx.lineTo( v1.x, v1.y );
				$this.ctx.stroke(); 
				$this.ctx.fill(); 
				$this.ctx.closePath(); 



			}, 
			//! DEPRECATED
			arc_taper: function( $dir ){ 
				var $this=this; 
				var $start = ( $this.lines[0].arcs[0].angle / 2 );
				$start = $start > 177.5 ? 177.5 : ( $start < -177.5 ? -177.5 : $start );
				if( $dir == "right" ){
					var $a = $this.lines[0].angle + $start; 
					var $coord1 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a - 10 ); //$this.text( "x", $coord1.x, $coord1.y, { color: '#000000', font:"600 15px Inter" } );
					var $coord2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut + ( ( $this.outer_cut - $this.inner_cut ) / 2 ) , $a ); //$this.text( "y", $coord2.x, $coord2.y, { color: '#000000', font:"600 15px Inter" } ); 
					var $coord3 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a - 10 ); //$this.text( "z", $coord3.x, $coord3.y, { color: '#000000', font:"600 15px Inter" } );
					$this.ctx.fillStyle = $this.hexToRgbA( $this.lines[0].arcs[0].color, $this.lines[0].arcs[0].opacity);
					$this.ctx.beginPath();
					$this.ctx.moveTo( $coord1.x, $coord1.y );
					$this.ctx.lineTo( $coord2.x, $coord2.y );
					$this.ctx.lineTo( $coord3.x, $coord3.y );
					$this.ctx.fill(); 
					$this.ctx.closePath(); 
				}
				if( $dir == "left" ){
					var $a = $this.lines[0].angle - $start; 
					var $coord1 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.outer_cut, $a + 10 ); //$this.text( "x", $coord1.x, $coord1.y, { color: '#000000', font:"600 15px Inter" } );
					var $coord2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut + ( ( $this.outer_cut - $this.inner_cut ) / 2 ) , $a ); //$this.text( "y", $coord2.x, $coord2.y, { color: '#000000', font:"600 15px Inter" } ); 
					var $coord3 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.inner_cut, $a + 10 ); //$this.text( "z", $coord3.x, $coord3.y, { color: '#000000', font:"600 15px Inter" } );
					$this.ctx.fillStyle = $this.hexToRgbA( $this.lines[0].arcs[0].color, $this.lines[0].arcs[0].opacity);
					$this.ctx.beginPath();
					$this.ctx.moveTo( $coord1.x, $coord1.y );
					$this.ctx.lineTo( $coord2.x, $coord2.y );
					$this.ctx.lineTo( $coord3.x, $coord3.y );
					$this.ctx.fill(); 
					$this.ctx.closePath();
				}
			}, 
			//! DEPRECATED
			arc_thick: function(){
				var $this = this; 
				
				//$app.text( ".", $coord1.x, $coord1.y, { color:"black", font:"600 15px Inter" } );
				//ellipse(x, y, radiusX, radiusY, rotation, startAngle, endAngle, counterclockwise) 
				var $x = ( $this.outer_cut - $this.inner_cut ) / 2 + $this.inner_cut; 
				var $coord1 = $this.coords_from_angle( $this.center.x, $this.center.y, $x, $this.lines[0].angle );
				var $r1 = $this.lines[0].arcs[0].angle > 60 ? 55 : 25; 
				var $r2 = $this.outer_cut - $this.inner_cut;
				//$this.ctx.lineWidth = 1;
				//$this.ctx.strokeStyle = "black";
				//$this.ctx.lineCap = "square"; // butt, square round
				//$this.ctx.setLineDash( [3,3] );
				$this.ctx.fillStyle = $this.hexToRgbA( $this.lines[0].arcs[0].color, $this.lines[0].arcs[0].opacity );
				$this.ctx.beginPath();
				$this.ctx.ellipse( $coord1.x, $coord1.y, $r1, $r2, $this.deg2rad( $this.lines[0].angle + 90 ), 0, 2 * Math.PI, true); 
				$this.ctx.fill(); 
				//$this.ctx.stroke(); 
				$this.ctx.closePath();  

				var is_render = $('body').hasClass('render-intr') ? true : false;
				var $line = $this.lines[0];
				if( $line.visibility ){
					// Axis
					var $coord = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, $line.angle );
					var $coord2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, 180-(360-($line.angle)) );

					var $acc = $line.shift/2;
					var $coord7 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, $line.angle+$acc );
					var $coord8 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, 180-(360-($line.angle-$acc)) );
					var $coord9 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, $line.angle-$acc );
					var $coord10 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, 180-(360-($line.angle+$acc)) );
					
					if(!is_render){
						$this.line( $coord7.x, $coord7.y, $coord8.x, $coord8.y, $line.width, $this.hexToRgbA($line.color, $line.opacity) );
						$this.line( $coord9.x, $coord9.y, $coord10.x, $coord10.y, $line.width, $this.hexToRgbA($line.color, $line.opacity) );
					}
					else{
						var $coord7 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r, $line.angle );
						var $coord8 = $this.coords_from_angle( $this.center.x, $this.center.y, -120, 180-(360-($line.angle)) );
						
						var text_angle = Math.abs($line.angle);
						var text_shift = (text_angle > 9 && text_angle < 100) ? 23 : (text_angle > 99 ? 25 : 17);
						var $text_coord = $this.coords_from_angle( $this.center.x, $this.center.y, -120+text_shift, 180-(360-($line.angle)) );
						
						$this.line( $coord7.x, $coord7.y, $coord8.x, $coord8.y, 1, $this.hexToRgbA("#888888", 1), [6,8] );
						$app.text( text_angle+"°", $text_coord.x, $text_coord.y, { color: $color, font: $font } );
					}
				}
			},
			//! DEPRECATED
			arc_thin: function(){ 
				console.log("thin");
				var $this = this; 
				//ellipse(x, y, radiusX, radiusY, rotation, startAngle, endAngle, counterclockwise) 
				var $r1 =  $this.inner_cut + ( ( $this.outer_cut - $this.inner_cut ) * 0.8 )//$this.outer_tunnel - ( ( $this.outer_tunnel - $this.inner_tunnel ) * 0.8 ); 
				var $r2 = $this.r * 0.6;
				$this.ctx.lineWidth = 0; //1;
				$this.ctx.strokeStyle = "transparent"; // "black";
				$this.ctx.lineCap = "square"; // butt, square round
				//$this.ctx.setLineDash( [3,3] );
				$this.ctx.fillStyle = "white";
				$this.ctx.beginPath();
				$this.ctx.ellipse( $this.center.x, $this.center.y, $r1, $r2, $this.deg2rad( $this.lines[0].angle ), $this.deg2rad( 60 ), $this.deg2rad( 300 ), true );// 2 * Math.PI, true); 
				$this.ctx.fill(); 
				$this.ctx.stroke(); 
				$this.ctx.closePath(); 

				$this.arc( $this.center.x, $this.center.y, $this.inner_tunnel, 0, 360, false, 2.5, "#888888", "", [10,15] );

				var is_render = $('body').hasClass('render-intr') ? true : false;
				var $line = $this.lines[0];
				if( $line.visibility ){
					// Axis
					var $coord = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, $line.angle );
					var $coord2 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r+10, 180-(360-($line.angle)) );

					var $acc = $line.shift/2;
					var $coord7 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, $line.angle+$acc );
					var $coord8 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, 180-(360-($line.angle-$acc)) );
					var $coord9 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, $line.angle-$acc );
					var $coord10 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r-40, 180-(360-($line.angle+$acc)) );
					
					if(!is_render){
						$this.line( $coord7.x, $coord7.y, $coord8.x, $coord8.y, $line.width, $this.hexToRgbA($line.color, $line.opacity) );
						$this.line( $coord9.x, $coord9.y, $coord10.x, $coord10.y, $line.width, $this.hexToRgbA($line.color, $line.opacity) );
					}
					else{
						var $coord7 = $this.coords_from_angle( $this.center.x, $this.center.y, $this.r, $line.angle );
						var $coord8 = $this.coords_from_angle( $this.center.x, $this.center.y, -120, 180-(360-($line.angle)) );
						
						var text_angle = Math.abs($line.angle);
						var text_shift = (text_angle > 9 && text_angle < 100) ? 23 : (text_angle > 99 ? 25 : 17);
						var $text_coord = $this.coords_from_angle( $this.center.x, $this.center.y, -120+text_shift, 180-(360-($line.angle)) );
						
						$this.line( $coord7.x, $coord7.y, $coord8.x, $coord8.y, 1, $this.hexToRgbA("#888888", 1), [6,8] );
						$app.text( text_angle+"°", $text_coord.x, $text_coord.y, { color: $color, font: $font } );
					} 
				}
			}, 
			//
			//
			//
			//========================================================= DEPRECATED ===================================================================
			//
			//
			//
		}
	}
});