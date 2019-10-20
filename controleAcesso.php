<!DOCTYPE HTML>
<html>
	<head>
		<title>Controle de Acesso</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="icon" href="images/iconSite.png">
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
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="mapa.html">Vagas</a></li>
						<li><a href="controleAcesso.php">Controle</a></li>
						<li><a href="diarioBordo.html">Diário</a></li>
					</ul>
				</nav>
			</div>
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Controle de Acesso</a></h1>
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
