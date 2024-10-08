<!DOCTYPE html>

<html lang="en">
<head>
	<title>aMule | Log</title>
	
	<?php
		if ( $_SESSION["auto_refresh"] > 0 ) {
			echo "<meta http-equiv=\"refresh\" content=\"", $_SESSION["auto_refresh"], '">';
		}
	?>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/beercss@3.6.13/dist/cdn/beer.min.css" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.6.13/dist/cdn/beer.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@1.1.2/dist/cdn/material-dynamic-colors.min.js"></script>

</head>


<body>

	<header class="primary-container">
		<nav>
			
			<img src="logo-nav.png" class="circle large">

			<div class="max">
				<h5>
				  aMule Web	
				</h5>
				
				<div>
				<?php
			      	$stats = amule_get_stats();
			    	if ( $stats["id"] == 0 ) {
			    		$ed2k = "Not connected";
			    		$ed2k_status = "red";
			    	} elseif ( $stats["id"] == 0xffffffff ) {
			    		$ed2k = "Connecting ...";
			    		$ed2k_status = "blue";
			    	} else {
			    		$ed2k = "Connected " . (($stats["id"] < 16777216) ? "(low)" : "(high)");
			    		$ed2k_status = (($stats["id"] < 16777216) ? "orange" : "green");
			    	}
			    	if ( $stats["kad_connected"] == 1 ) {
			    		$kad1 = "Connected";
						if ( $stats["kad_firewalled"] == 1 ) {
							$kad2 = "(FW)";
							$kad_status = "orange";
						} else {
							$kad2 = "(OK)";
							$kad_status = "green";
						}
			    	} else {
			    		$kad1 = "Disconnected";
			    		$kad2 = "";
			    		$kad_status = "red";
			    	}

			    	echo '<span>ED2k</span>';
			    	echo '<span class="badge none ', $ed2k_status, '">', $ed2k, '</span>';
			    	echo '<span>KAD</span> ';
			    	echo '<span class="badge none ', $kad_status, '">', $kad1, ' ', $kad2, '</span>';
			    ?>

					<!-- 
					<span>Ed2k</span>
					<span class="badge none orange">
					connected
					</span>

					<span>KAD</span>
					<span class="badge none orange">
					connected
					</span> -->
				</div>
			</div>

			<a href="amuleweb-main-log.php" class="button circle">
				<i>refresh</i>
				<div class="tooltip left">Refresh page</div>
			</a>		

			<button class="circle transparent s">
				<i>menu</i>
				<menu class="no-wrap primary-container left">
					<a href="./amuleweb-main-dload.php">
						<i>download</i>
						<div>Transfer</div>
					</a>
			
					 <a class="" href="./amuleweb-main-shared.php">
						<i>folder_shared</i>
						<div>Shared</div>
					</a>
			
					 <a class="" href="./amuleweb-main-search.php">
						<i>search</i>
						<div>Search</div>
					</a>
			
					  <a class="" href="./amuleweb-main-servers.php">
						<i>dns</i>
						<div>Servers</div>
					  </a>
			
					  <a class="" href="./amuleweb-main-prefs.php">
						<i>settings</i>
						<div>
							Settings
						</div>
					</a>
			
					<a class="" href="./amuleweb-main-log.php">
						<i>description</i>
						<div>Logs</div>
					</a>
			
					<a class="active" href="./login.php">
						<i>logout</i>
						<div>Exit</div>
					</a>			
				</menu>
			</button>
		</nav>
		<div class="small-space">
		</div>
	</header>

	<nav class="fill left l m">

		<a href="./amuleweb-main-dload.php">
			<i>download</i>
			<div>Transfer</div>
		</a>

	 	<a class="" href="./amuleweb-main-shared.php">
			<i>folder_shared</i>
			<div>Shared</div>
		</a>

	 	<a class="" href="./amuleweb-main-search.php">
			<i>search</i>
			<div>Search</div>
		</a>

	  	<a class="" href="./amuleweb-main-servers.php">
			<i>dns</i>
			<div>Servers</div>
	  	</a>

  	    <a class="" href="./amuleweb-main-prefs.php">
			<i>settings</i>
			<div>
				Settings
			</div>
		</a>

	    <a class="" href="./amuleweb-main-log.php">
			<i>description</i>
			<div>Logs</div>
		</a>

	    <a class="active" href="./login.php">
			<i>logout</i>
			<div>Exit</div>
		</a>

  	</nav>

	<main class="responsive">

		<article>
			<h5 class="row">
				<div class="max">
					aMule Log
				</div>

				<a href="amuleweb-main-log.php?rstlog=1" 
				   onclick="return confirm('Do you really want to RESET aMule log?')"
				   class="button circle"
				>
					<i>delete_sweep</i>
					<div class="tooltip left">Clear aMule log</div>
				</a>
			</h5>

			<?php
			$amulelog = '<pre><code>' . amule_get_log($HTTP_GET_VARS['rstlog']) . '</code></pre>';
			echo $amulelog;
			?>
			<!-- <pre><code>log of amule</code></pre> -->
		</article>

		<article>
			<h5 class="row">
				<div class="max">
					Server Log
				</div>

				<a href="amuleweb-main-log.php?rstsrv=1" 
				   onclick="return confirm('Do you really want to RESET server log?')"
				   class="button circle"
				>
					<i>delete_sweep</i>
					<div class="tooltip left">Clear server log</div>
				</a>
			</h5>

		<?php
			$serverlog = '<pre><code>' . amule_get_serverinfo($HTTP_GET_VARS['rstsrv']) . '</code></pre>';
			echo $serverlog;
		?>
			<!-- <pre><code>server log</code></pre> -->
		</article>
	</main>
</body>
</html>
