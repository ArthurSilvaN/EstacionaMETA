<?php
session_start();
include_once 'php/conexao.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>EstacionaMETA</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="icon" href="images/iconSite.png">
		<link rel="stylesheet" href="css/fadeIn.css">
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
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper">
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="mapa.php">Vagas</a></li>
						<li><a href="controleAcesso.php">Controle</a></li>
						<li><a href="diarioBordo.html">Diário</a></li>
					</ul>
				</nav>
			</div>
			<div class="container">

				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Estaciona<span id="metaTitulo">META</span></a></h1>
				</div>
			</div>

		</div>

	<!-- Featured -->
		<div id="featured">
			<div class="container">
				<header>
					<h2>Mapa de Vagas</h2>
				</header>
				<p>Visualização em tempo real da informação sobre a disponibilidade das vagas do nosso projeto de estacionamento.</p>
				<div id="controleacesso">
					<form action="#" method="post">
						<select name="estacionamentos">
					<?php
					if($conexao){
						$sql = "SELECT * FROM estacionamentos";
						$stmt = mysqli_stmt_init($conexao);
						//checa se é possivel executar declaracao
						if(mysqli_stmt_prepare($stmt,$sql)){
							mysqli_stmt_bind_param($stmt);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							//checa se estacionamento ja havia sido cadastrado
							if(mysqli_stmt_num_rows($stmt) > 0){
								 $stmt = mysqli_stmt_init($conexao);
									if(mysqli_stmt_prepare($stmt,$sql)){
										mysqli_stmt_bind_param($stmt,"s",$_SESSION['usuarioNome']);
										mysqli_stmt_execute($stmt);
										$resultado = mysqli_stmt_get_result($stmt);
									 while($linha = mysqli_fetch_assoc($resultado)){
										 echo "<option value='".$linha['lugar']."'>".$linha['lugar']."</option>";
									}
								}
							} else {
								echo "<option>Nenhum estacionamento foi cadastrado ainda</option>";
						}
					}
				}
 			?>
		</select>
		<input type="submit" id="buscar" name="buscarEstacionamento" value="🔍">
	</form>
				<hr />

					 <div class="row">
                <?php



					//<section class="4u">
						//<span><img src="images/Ocupado.jpg"></span>
						//<h3>A2</h3>
						//<a class="button button-style1 style="background-color: #e82e2e">Ocupado</a>
					//</section>
					//<section class="4u">
						//<span><img src="images/Livre.jpg"></span>
						//<h3>A3</h3>
						//<a class="button button-style1">Livre</a>
					//</section>
					if(isset($_POST['buscarEstacionamento'])){
					if($conexao){
						$sql = "SELECT sensor1,sensor2,sensor3 FROM sensores WHERE lugar=?";
	          $stmt = mysqli_stmt_init($conexao);
	          //checa se é possivel executar declaracao
	          if(mysqli_stmt_prepare($stmt,$sql)){
	            mysqli_stmt_bind_param($stmt,"s",$_POST['estacionamentos']);
	            mysqli_stmt_execute($stmt);
	            mysqli_stmt_store_result($stmt);
	            if(mysqli_stmt_num_rows($stmt) > 0){
								 $stmt = mysqli_stmt_init($conexao);
								  if(mysqli_stmt_prepare($stmt,$sql)){
										mysqli_stmt_bind_param($stmt,"s",$_POST['estacionamentos']);
									 	mysqli_stmt_execute($stmt);
										$resultado = mysqli_stmt_get_result($stmt);
									 if($row = mysqli_fetch_assoc($resultado)){

                    if($row['sensor1'] < 5) {
                        echo '<section class="4u">';
						    echo '<span><img src="images/Ocupado.jpg"></span>';
						    echo '<h3>A1</h3>';
						    echo '<a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>';
				 	    echo "</section>";
                        } else {
                            echo '<section class="4u">';
						        echo '<span><img src="images/Livre.jpg"></span>';
						        echo '<h3>A1</h3>';
						        echo '<a class="button button-style1">Livre</a>';
				 	        echo "</section>";
                        }
                    if($row['sensor2'] < 5) {
                        echo '<section class="4u">';
						    echo '<span><img src="images/Ocupado.jpg"></span>';
						    echo '<h3>A2</h3>';
						    echo '<a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>';
				 	    echo "</section>";
                        } else {
                            echo '<section class="4u">';
						        echo '<span><img src="images/Livre.jpg"></span>';
						        echo '<h3>A2</h3>';
						        echo '<a class="button button-style1">Livre</a>';
				 	        echo "</section>";
                        }
                    if($row['sensor3'] < 5) {
                        echo '<section class="4u">';
						    echo '<span><img src="images/Ocupado.jpg"></span>';
						    echo '<h3>A3</h3>';
						    echo '<a class="button button-style1" style="background-color: #e82e2e">Ocupado</a>';
				 	    echo "</section>";
                        } else {
                            echo '<section class="4u">';
						        echo '<span><img src="images/Livre.jpg"></span>';
						        echo '<h3>A3</h3>';
						        echo '<a class="button button-style1">Livre</a>';
				 	        echo "</section>";
                        }
											}
				}
			} else echo "Estacionamento Inteligente não implementado: ".$_POST['estacionamentos'];
		} else echo "Erro SQL";
	}
}
				 ?>
			 </div>
			</div>
		</div>

	</body>
</html>
