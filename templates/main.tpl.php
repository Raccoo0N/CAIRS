<?php

?>
<style> 
	main .h1{ height:506px; display:flex; flex-flow:column nowrap; justify-content:center; align-items:center; gap:0; padding:0px; margin:0px; padding:90px 0px; background:transparent url('/static/img/image-asset.jpg') center center no-repeat; background-size:cover }
	main .h1 h1{ color:#fff; font-size: 77px; line-height:77px; text-align:center; margin-bottom:20px; }
	main .h1 h2{ color:#fff; font-size: 24px; line-height:36px; text-align:center; margin-bottom:35px; } 
	main .h1 a{ display:flex; width:250px; height:67px; flex-flow:row nowrap; justify-content:center; align-items:center; gap:0; color:#0C243C; font-weight:500; font-size:15px; background:#55C2C3; border-radius:30px; padding:0px; margin:0px auto; cursor:pointer; text-decoration:none; } 

	main .content{ max-width:1140px; margin:0px auto; height:100%; display:flex; flex-flow:column nowrap; justify-content:center; align-items:center; gap:0px; }
	#what_is_cairs{ padding:40px 0px; } 
	#what_is_cairs .content{ display:flex; flex-flow:row nowrap; justify-content:space-around; align-items:start; gap:20px; padding:0px; margin:0px auto; } 
	#what_is_cairs .content img{ width:50%; max-width:550px; height:auto; } 
	#what_is_cairs .content .info{ flex:1 1 50%; max-width:550px; } 
	#what_is_cairs .content .info h2{ color:rgb(12, 36, 60); font-size:90px; line-height:90px; padding:0px; margin:0px auto 35px auto; text-align:center; }
	#what_is_cairs .content .info p{ margin:0px; padding:0px; color:#000; font-size:16px; line-height:24px; text-align:left; } 

	#info_slider{ height:630px; background:#dedede; } 
	#info_slider .slider{ width:100%; height:630px; } 
	#info_slider .slider .swiper{ width:100%; height:100%; position:relative; }
	#info_slider .slider .swiper-wrapper{ width:100%; height:100%; display:flex; flex-flow:row nowrap; justify-content:start; align-items:start; gap:0; }

	#info_slider .slider .swiper-slide{ flex:0 0 100%; height:100%; display:flex; flex-flow:row nowrap; justify-content:center; align-items:center; gap:0; padding:0; margin:0; background-position:center center; background-repeat:no-repeat; background-size:cover; cursor:grab; }
	#info_slider .slider [data-slide="1"]{ background-image:url('/static/img/AroHa_00101.jpg'); }
	#info_slider .slider [data-slide="2"]{ background-image:url('/static/img/20140228_Trade151_00461.jpg'); }
	#info_slider .slider [data-slide="3"]{ background-image:url('/static/img/image-asset.jpeg'); }
	#info_slider .slider .swiper-slide p{ color:#000; font-size:48px; line-height:53px; padding:0px; margin:0px; max-width:70%; text-align:center; } 

	.swiper-button{ position:absolute; top:0px; bottom:0px; }
	.swiper-button svg{ width:41px; height:41px; cursor:pointer; position:absolute; top:50%; margin:-20px 0px 0px 0px; }
	.swiper-button-prev{ left:0px; }
	.swiper-button-prev svg{ left:0; }
	.swiper-button-next{ right:0px; }
	.swiper-button-next svg{ right:0; } 

	@media screen and (max-width:760px) { 
		#info_slider{ height:320px; } 
		#info_slider .slider{ width:100%; height:320px; } 
		#info_slider .slider .swiper-slide p{ font-size:24px; line-height:28px; }
	}

	#cairs_results{ padding:70px 0px;  }
	#cairs_results .content{ margin:0px auto; }
	#cairs_results h2{ max-width:740px; color:#0C243C; font-size:90px; line-height:90px; padding:0px; margin:0px auto 35px auto; text-align:center; }
	#cairs_results p{ max-width:550px; color:#0C243C; font-size:16px; line-height:24px; padding:0px; margin:0px auto 70px auto; text-align:center; } 
	#cairs_results img{ display:block; width:100%; max-width:550px; height:auto; margin:0px auto 40px auto; } 
	#cairs_results em{ display:block; width:100%; max-width:550px; color:rgb(29, 29, 29); font-size:16px; line-height:24px; text-align:left; padding:0px; margin:0px auto; } 

	#cairs_plan_description{ padding:20px 0px 80px 0px; } 
	#cairs_plan_description .content{ display:flex; flex-flow:row nowrap; justify-content:stretch; align-items:stretch; gap:20px; position:relative; } 
	#cairs_plan_description .left{ flex:1 1 50%; text-align:center; } 
	#cairs_plan_description .left.start{ padding-top:220px; }
	#cairs_plan_description .left p{ max-width:450px; margin:0px auto 20px auto; color:#000; font-size:16px; line-height:24px; }
	#cairs_plan_description .right{ flex:1 1 50%; text-align:center; } 
	#cairs_plan_description .right.end{ background-image:url('/static/img/AroHa_0380.jpg'); background-repeat:no-repeat; background-position:center top; background-size:auto 100%; }
	#cairs_plan_description h2{ position:absolute; top:0; left:0; right:0; display:flex; flex-flow:row nowrap; justify-content:stretch; align-items:center; gap:0; color:rgb(12, 36, 60); font-size:192px; line-height:192px; } 
	#cairs_plan_description h2 .left{ color:rgb(12, 36, 60); font-size:192px; line-height:192px; text-align:center; }
	#cairs_plan_description h2 .right{ color:rgb(85, 194, 195); font-size:192px; line-height:192px; text-align:center; }
	@media screen and (max-width:1024px) { 
		#cairs_plan_description .content{ flex-flow:column nowrap; }
		#cairs_plan_description .left.start{ order:2; flex:1 1 100%; max-width:100%; padding:0px 10px; } 
		#cairs_plan_description .left.start p{ max-width:100%; }
		#cairs_plan_description .right.end{ order:1; flex:0 auto; background-position:center center; background-size:100% auto; height:405px; width:100%; }  
		#cairs_plan_description h2{ flex-flow:column nowrap; padding-top:20px; } 
		#cairs_plan_description h2 .left{ flex:1 1 100%; order:1; } 
		#cairs_plan_description h2 .right{ flex:1 1 100%; order:2; color:rgb(12, 36, 60); }
	} 
	@media screen and (max-width:900px) { 
		main .h1{ height:620px; padding:0px; } 
	} 
	@media screen and (max-width:760px) { 
		#what_is_cairs .content{ flex-flow:column nowrap; padding:0px 10px; }
		#what_is_cairs .content img{ width:100%; max-width:100%; margin:0px auto; } 
		#what_is_cairs .content .info{ width:100%; max-width:100%; margin:0px auto; } 
		main .h1{ height:330px; }
	}
</style>
<div class="h1">
	<h1>CAIRS PLAN</h1>
	<h2>Physician information resource for planning <br>Corneal Allogenic Intrastromal Ring Segment <br>“CAIRS” surgery</h2>
	<a href="/cairs-plan-tool">Go to the CAIRS planning tool</a>
</div>

<section id="what_is_cairs">
	<div class="content">
		<img src="/static/img/color_map.png" alt="">
		<div class="info">
			<h2>What is CAIRS?</h2>
			<p style="margin-bottom:60px;"><b>C</b>orneal <b>A</b>llogenic <b>I</b>ntrastromal <b>R</b>ing <b>S</b>egments (“CAIRS”) is the next generation of Minimally Invasive Corneal Surgery (“MICS”) and an entirely new approach to treating corneal ectasia.</p>
			<p>CAIRS was first described by Dr Soosan Jacob in 2018 as a new treatment for keratoconus. It involves the implantation of a ring of donor corneal tissue into a peripheral channel with the aim of flattening and regularising the cornea. This leads to improved corneal shape and better visual quality.</p>
		</div>
	</div>
</section>

<section id="info_slider"> 
	<div class="slider">
		<div class="swiper">
			<div class="swiper-wrapper"> 
				<div class="swiper-slide" data-slide="1">
					<p>CAIRS allows you to reshape the cornea without removal of tissue</p>
				</div>
				<div class="swiper-slide" data-slide="2">
					<p>CAIRS is rapid, sutureless, reversible and associated with quick recovery</p>
				</div>
				<div class="swiper-slide" data-slide="3">
					<p>CAIRS allows corneal surgeons to improve vision in a wide range of ectasia patients without more invasive corneal transplants.</p>
				</div>
			</div>
			<div class="swiper-pagination"></div> 
			<div class="swiper-button swiper-button-prev" role="button" tabindex="0" aria-label="Previous slide" aria-controls="swiper-wrapper-13e05cc93c98f38e">
				<svg aria-hidden="true" class="e-font-icon-svg e-eicon-chevron-left" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
					<path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
				</svg>
				<!--span class="elementor-screen-only">Previous slide</span-->
			</div>
			<div class="swiper-button swiper-button-next" role="button" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-13e05cc93c98f38e">
				<svg aria-hidden="true" class="e-font-icon-svg e-eicon-chevron-right" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
					<path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
				</svg>
				<!--span class="elementor-screen-only">Next slide</span-->
			</div>
		</div>
	</div>
	<script> 
	    var swiper = new Swiper(".swiper", {
	    	loop: true,
			direction: "horizontal",
			slidesPerView: 1,
			threshold: 5, 
			autoplay: {
			    delay: 5000,
			},
			on: {
                slideChange: function(data) { 
                	console.log( data );
                    let slideIndex = data.activeIndex; 
                }
            },
	      	navigation: {
	        	nextEl: ".swiper-button-next",
	        	prevEl: ".swiper-button-prev",
	      	}
	    }); 
	</script>
</section> 
<section id="cairs_results">
	<div class="content">
		<h2>CAIRS delivers results.</h2>
		<p>In our experience, mean gain in uncorrected vision is 3 lines , and 2 lines in corrected vision. At least 3 lines of vision is gained in half of patients uncorrected (up to 11 lines) and a quarter of patients corrected. No patients lost > 1 line of vision. (submitted for publication)</p>
		<img src="/static/img/chart.png"alt="">
			<em>Dr Gunn’s results from all CAIRS cases. More than 50% of patients gain at least 3 lines of UDVA</em>
	</div>
</section>
<section id="cairs_plan_description">
	<div class="content">
		<div class="left start">
			<p>This website was developed to give information about CAIRS and to provide tools for planning cases for Eye Physicians.</p>
			<p>All of the advice presented here is general in nature. Drs Gunn and Cronin do not provide medical advice through this website and use of the site is at the discretion and risk of the operating surgeon. We accept no legal liability for its use.</p>
			<br><br>
			<p>This website was developed to give information about CAIRS and to provide tools for planning cases for Eye Physicians.</p>
			<p>All of the advice presented here is general in nature. Drs Gunn and Cronin do not provide medical advice through this website and use of the site is at the discretion and risk of the operating surgeon. We accept no legal liability for its use.</p>
		</div>
		<div class="right end"></div>
		<h2>
			<div class="left">CAIRS</div>
			<div class="right">PLAN</div>
		</h2>
	</div>
</section>
