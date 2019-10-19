<?php
  include_once "bd.inc.php";
  if(isset($_GET['SenhaDB'])&&isset($_GET['CartaoID'])&&isset($_GET['Nome'])){
    $bd = new BancoDeDados("localhost");
    $bd->setUsuario("root");
    $bd->setSenha($_GET['SenhaDB']);
    $sql = "SELECT * FROM ctrlestacionamento WHERE id IN ( SELECT MAX(id) FROM ctrlestacionamento where cartaoID='".$_GET['CartaoID']."' GROUP BY cartaoID )";
    $resultado = mysqli_query($bd->conectar("dadosRFID"),$sql);
    date_default_timezone_set("America/Sao_Paulo");
    $data = date('m/d/Y H:i:s', time());
    if(mysqli_num_rows($resultado) > 0){
      $linha = mysqli_fetch_assoc($resultado);
      if($linha['saida']==null){
        $sql = "update ctrlestacionamento set saida='".$data."' WHERE id IN ( SELECT MAX(id) FROM ctrlestacionamento where cartaoID='".$_GET['CartaoID']."' GROUP BY cartaoID )";
        mysqli_query($bd->conectar("dadosRFID"),$sql);
      } else {
        $sql = "insert into ctrlestacionamento (nome,cartaoID,entrada) values ('".$_GET['Nome']."','".$_GET['CartaoID']."','".$data."');";
        mysqli_query($bd->conectar("dadosRFID"),$sql);
      }
  } else {
      $sql = "insert into ctrlestacionamento (nome,cartaoID,entrada) values ('".$_GET['Nome']."','".$_GET['CartaoID']."','".$data."');";
    mysqli_query($bd->conectar("dadosRFID"),$sql);
  }
  } else {
    echo "Nao deu";
  }
 ?>
