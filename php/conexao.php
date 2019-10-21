<?php



    $HOST = "localhost";
    $BANCO = "dados";
    $USUARIO = "root";
    $SENHA = "";

    $conexao = mysqli_connect($HOST,$USUARIO,$SENHA,$BANCO);
  try {
    $PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);
  } catch (PDOException $e) {

    echo "Erro de conexao, detalhes: " . $e->getMessage();

  }

?>
