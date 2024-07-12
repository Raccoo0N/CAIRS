<style>
	#preheader{ flex-grow:0; flex-shrink:0; height:80px; }
	header{ position:fixed; top:0px; left:0px; right:0px; z-index:100; min-height:90px; width:100%; background:#fff; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 0px; } 
	header .content{ max-width:1140px; margin:0px auto; height:100%; display:flex; flex-flow:row nowrap; justify-content:stretch; align-items:center; gap:10px; position:relative; } 
	header .navigation{ flex:1 1 33%; display:flex; flex-flow:row nowrap; justify-content:start; align-items:center; gap:0px; padding:0px; margin:0px; } 
	header .navigation.right{ justify-content:end; } 
	header .navigation .hidden{ display:none; }
	header .logo_wrapper{ flex:1 1 33%; height:90px; } 
	header .logo_wrapper a{ display:flex; height:100%; flex-flow:row nowrap; justify-content:center; align-items:center; gap:0; }
	header .logo_wrapper img{ height:50px; cursor:pointer; } 
	header .navigation li a{ color:rgb(14, 33, 60); padding:13px 20px; cursor:pointer; transition: .3s; transition-timing-function: ease; transition-timing-function: cubic-bezier(.58,.3,.005,1); white-space:nowrap; }
	header .navigation li a:hover, 
	header .navigation li a.active{ color:#55C2C3; border-bottom:solid 3px #55C2C3; } 
	header .burger_wrapper{ display:none; flex:1 1 33%; flex-flow:row nowrap; justify-content:start; align-items:center; gap:0px; padding:0px; margin:0px; }
	#show_burger{ display:flex; width:33px; height:33px; flex-flow:row nowrap; justify-content:center; align-items:center; gap:0; padding:0px; margin:0px; cursor:pointer; transition: all .3s cubic-bezier(.58,.3,.005,1); background:rgba(0, 0, 0, 0.05); border-radius:3px; }
	#burger_hidder{ display:none; } 
	#show_burger *{ width:22px; height:auto; cursor:pointer; }
	#burger_open{} 
	#burger_close{ display:none; } 
	input#burger_hidder:checked ~ ul.left{ display:flex; height:auto; } 
	input#burger_hidder:checked ~ .burger_wrapper + #show_burger + #burger_open{ display:none; }
	input#burger_hidder:checked ~ .burger_wrapper + #show_burger + #burger_close{ display:block; }
	@media screen and (max-width:960px) { 
		header .burger_wrapper{ display:flex; }
		header .content{ padding:0px 10px; }
		header .navigation.left{ display:none; position:fixed; top:90px; left:0; right:0px; background:#fff; flex-flow:column nowrap; justify-content:start; align-items:start; gap:0; height:0; transition: all 1s ease-in-out; } 
		header .navigation li{ width:100%; }
		header .navigation li a{ width:100%; height:40px; display:flex; flex-flow:row nowrap; justify-content:stretch; align-items:center; gap:0; color:#33373d;; font-size:13px; line-height:20px; transition: .3s; transition-timing-function: ease; transition-timing-function: cubic-bezier(.58,.3,.005,1); text-decoration:none; }
		header .navigation li a:hover{ background:#3f444b;; color:#fff; border:0; }
		header .navigation .hidden{ display:block; } 
		header .navigation.right li{ display:none; }
	} 
	
</style>
<div id="preheader"></div>
<header>
	<div class="content">
		<input type="checkbox" id="burger_hidder" autocomplete="off">
		<div class="burger_wrapper">
			<label id="show_burger" for="burger_hidder">
				<svg aria-hidden="true" role="presentation" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg" id="burger_open">
					<path d="M104 333H896C929 333 958 304 958 271S929 208 896 208H104C71 208 42 237 42 271S71 333 104 333ZM104 583H896C929 583 958 554 958 521S929 458 896 458H104C71 458 42 487 42 521S71 583 104 583ZM104 833H896C929 833 958 804 958 771S929 708 896 708H104C71 708 42 737 42 771S71 833 104 833Z"></path>
				</svg>
				<svg aria-hidden="true" role="presentation" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg" id="burger_close">
					<path d="M742 167L500 408 258 167C246 154 233 150 217 150 196 150 179 158 167 167 154 179 150 196 150 212 150 229 154 242 171 254L408 500 167 742C138 771 138 800 167 829 196 858 225 858 254 829L496 587 738 829C750 842 767 846 783 846 800 846 817 842 829 829 842 817 846 804 846 783 846 767 842 750 829 737L588 500 833 258C863 229 863 200 833 171 804 137 775 137 742 167Z"></path>
				</svg> 
			</label>
		</div>
		<ul class="navigation left">
			<li><a href="/about">About</a></li>
			<li><a href="/why-cairs">Why CAIRS</a></li>
			<li><a href="/cairs-plan-tool">CAIRS Plan Tool</a></li>
			<li class="hidden"><a href="#" class="contacts-trigger">Contact us</a></li>
			<?php if( AUTH ){ ?>
				<li class="hidden"><a href="/my-account" class="account-trigger">My Account</a></li>
			<?php } else { ?>
				<li class="hidden"><a href="#" class="login-trigger">Login</a></li> 
			<?php } ?>
		</ul>
		<div class="logo_wrapper">
			<a href="/" class="logo"><img src="/static/img/logo.png" alt=""></a>
		</div>
		<ul class="navigation right">
			<li><a href="#" class="contacts-trigger">Contact us</a></li> 
			<?php if( AUTH ){ ?>
				<li><a href="/my-account" class="account-trigger">My Account</a></li>
			<?php } else { ?> 
				<li><a href="#" class="login-trigger">Login</a></li>
			<?php } ?>
		</ul>
	</div>
</header>

