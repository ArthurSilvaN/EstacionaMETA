<!DOCTYPE HTML>
<!--
	Linear by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Linear by TEMPLATED</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />

		</noscript>
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper">
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="index.html">Homepage</a></li>
						<li><a href="left-sidebar.html">Left Sidebar</a></li>
						<li class="active"><a href="right-sidebar.html">Right Sidebar</a></li>
						<li><a href="no-sidebar.html">No Sidebar</a></li>
					</ul>
				</nav>
			</div>
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Controle de Acesso</a></h1>
					<span class="tag">By TEMPLATED</span>
				</div>
			</div>
		</div>
	<!-- Header -->

	<!-- Main -->
		<div id="main">
			<div id="tabela">
				<table>
					<tr>
						<th>Nome:</th>
						<th>Entrada:</th>
						<th>Saida:</th>
				<?php
				include_once "php/bd.inc.php";
				  $conexao = mysqli_connect("remotemysql.com","mkhm1crcKZ","oM31TDcS3H", "mkhm1crcKZ", "3306");
				$sql = "select nome,entrada,saida from ctrlestacionamento";
				$resultado = mysqli_query($conexao,$sql);
				if(mysqli_num_rows($resultado) > 0){
					while($linha = mysqli_fetch_assoc($resultado)){
						echo "<tr><td>".$linha['nome']."</td><td>".$linha['entrada']."</td><td>";
						if($linha['saida']!=null){
							echo $linha['saida']."</td></tr>";
						} else {
							echo "Não houve saída</td></tr>";
						}

					}
				}
				echo "</table>";
				 ?>
			</div>
		</div>

		<style>
		table {
  	border-collapse: collapse;
  	width: 80%;
		margin-left: 10%;

	}

	th, td {
  	text-align: left;
  	padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
  	background-color: #4CAF50;
  	color: white;
	}
</style>
	</body>
</html>
