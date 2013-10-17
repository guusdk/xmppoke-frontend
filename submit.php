<?php

include("common.php");

$domain = $_POST["domain"];
$type = $_POST["mode"];

$error = NULL;

if(preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", idn_to_ascii($domain)) && ($type === "c2s" || $type === "s2s")) {

	if ($type === "c2s") {
		$type = "client";
	} else {
		$type = "server";
	}

	pg_prepare($dbconn, "find_result", "SELECT * FROM test_results WHERE server_name = $1 AND type = $2 ORDER BY test_date DESC LIMIT 1");

	$res = pg_execute($dbconn, "find_result", array($domain, $type));

	$result = pg_fetch_object($res);

	if ($result && (time() - strtotime($result->test_date)) < 60 * 60) {
		$error = '"' . htmlspecialchars($domain) . '" was tested too recently. Try again in an hour.';
	} else {
		exec("LUA_PATH='?.lua;/opt/xmppoke/usr/share/lua/5.1/?.lua;/usr/share/lua/5.1/?.lua;' LUA_CPATH='?.so;/opt/xmppoke/usr/lib/lua/5.1/?.so;/usr/lib/lua/5.1/?.so' /opt/xmppoke/bin/luajit /opt/xmppoke/bin/xmppoke --cafile=/etc/ssl/certs/ca-certificates.crt --db_password='" . escapeshellarg($dbpass) . "' --mode=$type -d=15 '" . escapeshellarg($domain) . "' >/dev/null 2>/dev/null &");

		header("Refresh: 2;result.php?domain=" . urlencode($domain) . "&type=$type");
	}

} else {
	$error = '"' . htmlspecialchars($domain) . '" is not a valid domain name.';
}

common_header("");

?>

	<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">IM Observatory</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="list.php">Test results</a></li>
					<li><a href="directory.php">Public server directory</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">

<?php
if ($error) {
?>
		<h1>Error</h1>

		<div class="alert alert-block alert-danger">
			<?= $error ?>
		</div>

<?php
} else {
?>
		<h1>Queueing test...</h1>
<?php
}
?>

		<div class="footer">
			<p>Some rights reserved.</p>
		</div>
	</div> <!-- /container -->

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="./js/jquery.js"></script>
	<script src="./js/jquery.timeago.js"></script>
	<script src="./js/bootstrap.js"></script>

	<script src="./js/main.js"></script>

	</body>
</html>