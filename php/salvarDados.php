<?php

  if(isset($_GET['SenhaDB'])&&isset($_GET['CartaoID'])&&isset($_GET['Nome'])){

    $sql = "SELECT * FROM ctrlestacionamento WHERE id IN ( SELECT MAX(id) FROM ctrlestacionamento where cartaoID='".$_GET['CartaoID']."' GROUP BY cartaoID )";
    $conexao = mysqli_connect("remotemysql.com","mkhm1crcKZ",$_GET['SenhaDB'], "mkhm1crcKZ", "3306");
    if($conexao){
    $resultado = mysqli_query($conexao,$sql) or die ("Erro no resultado") ;
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m/d/Y H:i:s', time());
    if(mysqli_num_rows($resultado) > 0){
      $linha = mysqli_fetch_assoc($resultado);
      if($linha['saida']==null){
        $sql = "update ctrlestacionamento set saida='".$data."' WHERE id IN ( SELECT * from  ( SELECT MAX(id) FROM ctrlestacionamento where cartaoID='".$_GET['CartaoID']."' GROUP BY cartaoID )alias) ";
        mysqli_query($conexao,$sql) or die ("Erro: ao adicionar saida");
      } else {
        $sql = "insert into ctrlestacionamento (nome,cartaoID,entrada) values ('".$_GET['Nome']."','".$_GET['CartaoID']."','".$data."');";
        mysqli_query($conexao,$sql) or die("Erro: ao adicionar novo");;
      }
      echo 'Sucesso!';
  } else {
      $sql = "insert into ctrlestacionamento (nome,cartaoID,entrada) values ('".$_GET['Nome']."','".$_GET['CartaoID']."','".$data."');";
      mysqli_query($conexao,$sql) or die ("Erro: ao adicionar novo") ;
  }
    } else {
        echo "Erro na conexão";
    }
  } else {
    echo "Preencha todos os campos (SenhaDB,Nome,CartaoID)";
  }
 ?>
