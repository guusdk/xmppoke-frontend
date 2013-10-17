<?php

include("common.php");

common_header("");

?>
	<body data-spy="scroll" data-target="#sidebar">

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
					<li><a href="list.php">Test results</a></li>
					<li><a href="directory.php">Public server directory</a></li>
					<li class="active"><a href="#">About</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div>
			<h2>About</h2>
			<p>
				This is a service allowing XMPP users and server administrators to inspect the security of their servers. It can test the TLS configuration and the DNSSEC deployment of XMPP servers. It can give warnings about issues with certificate chains, it can show the list of ciphersuites used by a server and their strength, it will check DANE records and many more.
			</p>
			<p>
				Every server is given a grade from A to F, both for their client to server and server to server TLS configuration. This test is based on the test by SSL Labs, for more info see <a href="https://www.ssllabs.com/projects/rating-guide/index.html">https://www.ssllabs.com/projects/rating-guide/index.html</a>. Scoring 100 on every test is not the goal: this will lead to incompatibility with many XMPP clients. Scoring an A, on the other hand, does also not mean the security can not be improved. For instance: forward secrecy, forced StartTLS and DNSSEC do not (yet) count for the grade.
			</p>
			
			<h3>XMPPoke</h3>
			<p>
				The backend of this service is provided by XMPPoke, which can be found on <a href="https://bitbucket.org/xnyhps/xmppoke">https://bitbucket.org/xnyhps/xmppoke</a>.
			</p>
		</div>

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