<!DOCTYPE html>
<html lang="en-US">
<head> 
	<title><?= PAGETITLE; ?></title> 
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="keywords" content="<?= PAGEKEYWORDS; ?>">
	<meta name="description" content="<?= PAGEDESCRIPTION; ?>"> 
	<meta name="author" content="" />	
	<link rel="shortcut icon" href="/static/img/favicon.png" type="image/x-icon">
	<link rel="apple-touch-icon" href="/static/img/favicon.png"> 
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <!--link rel="stylesheet" href="./static/css/reset.css?<?= rand(1,1000); ?>"--> 
    <link rel="stylesheet" href="/static/css/css.css?<?= rand(1,1000); ?>"> 
    <link rel="stylesheet" href="/static/css/popups.css?<?= rand(1,1000); ?>"> 
    <link rel="stylesheet" href="/static/css/swiper.css?<?= rand(1,1000); ?>"> 
    <link rel="stylesheet" href="/static/css/croppie.min.css?<?= rand(1,1000); ?>"> 
    <link rel="stylesheet" href="/static/css/tom-select.css?<?= rand(1,1000); ?>"> 
    <link rel="stylesheet" href="/static/css/style.css?<?= rand(1,1000); ?>"> 
    
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/swiper.js"></script>
    <script src="/static/js/croppie.min.js"></script>
    <script src="/static/js/interact.min.js"></script>
    <script src="/static/js/tom-select.complete.min.js"></script>
	<style> 
		*{ margin:0; padding:0; border:0; font-weight:normal; outline:none; cursor:default; box-sizing:border-box; 
			-moz-box-sizing:border-box; 
			-webkit-box-sizing:border-box; 
			box-sizing:border-box; 
		}
		html,
		body{ padding:0px; margin:0px auto; width:100%; height:100%; text-align:center; font-size:16px; font-weight:400; line-height:1.5em; font-family:"Roboto","Inter","Sans-Serif"; background:#fff; color:#000; 
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		} 
		body{ padding-top:10px; }
		#main_wrapper{ display:flex; flex-flow:column nowrap; justify-content:stretch; align-items:stretch; gap:0; padding:0px; margin:0px; width:100%; min-height:100%; } 
		main{ flex:1 1 100%; width:100%; background:transparent; } 
		main .content{ max-width:1140px; padding:0px; margin:0px auto; } 
		ul, 
		li{ list-style:none; }
		a{ text-decoration:none; }
		@media screen and (max-width:1140px) { 
			main .content{ padding:0px 10px; }
		}
	</style> 
</head>