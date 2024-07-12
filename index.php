<?php 
	define('BASE_DIR', dirname(__FILE__)."/");
	include_once BASE_DIR ."init.php"; 
	include_once BASE_DIR ."router.php"; 
	
	if( ISAPI ){ 
		//var_dump( CONTROLLER ."/". ACTION );
		include_once BASE_DIR ."api.php";
		exit();
	} 

	if( !defined('TPL') ){ define('TPL', "404"); } 
	if( !defined('PAGETITLE') ){ define('PAGETITLE', BASE_TITLE ); } 
	if( !defined('PAGEKEYWORDS') ){ define('PAGEKEYWORDS', ""); } 
	if( !defined('PAGEDESCRIPTION') ){ define('PAGEDESCRIPTION', ""); } 
	if( !defined('VISUALISATION') ){ define('VISUALISATION', true ); }
	if( !defined('ADMIN') ){ define( ADMIN, false ); } 

	$head = TPL_DIR ."head". TPL_EXT; 
	if( is_file( $head ) ){ include_once $head; }
?>
<body data-id="<?= UID; ?>">
	<div id="main_wrapper">
		<?php 
			$header = TPL_DIR . "header" . TPL_EXT;
			if( is_file( $header ) ){ include_once $header; } 
		?> 
		<main>
			<?php 
				$tpl = TPL_DIR . TPL . TPL_EXT;
				if( is_file( $tpl ) ){ include_once $tpl; } 
			?> 
		</main>
		<?php 
			$footer = TPL_DIR ."footer". TPL_EXT;
			if( is_file( $footer ) ){ include_once $footer; } 
		?> 
	</div>
	<?php 
		$modals = TPL_DIR ."modals". TPL_EXT;
		if( is_file( $modals ) ){ include_once $modals; }  
		$loader = TPL_DIR ."loader". TPL_EXT;
		if( is_file( $loader ) ){ include_once $loader; } 
		$notify = TPL_DIR ."notify". TPL_EXT;
		if( is_file( $notify ) ){ include_once $notify; }
		if( ADMIN ){
	?> 
	<?php } ?> 
	<?php if( 2 == 3 ){ ?>
		<div id="console"><?= var_dump( $_SESSION ); ?></div> 
	<?php } ?>
</body>
</html>
