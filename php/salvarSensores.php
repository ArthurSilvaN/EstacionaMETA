<?php

  include_once 'conexao.php';

  if(isset($_GET['sensor1'])&&isset($_GET['sensor2'])&&isset($_GET['sensor3'])&&isset($_GET['lugar'])){
    if($conexao){
      $sql = "SELECT * FROM estacionamentos WHERE lugar=?";
      $stmt = mysqli_stmt_init($conexao);
      if(mysqli_stmt_prepare($stmt,$sql)){
        mysqli_stmt_bind_param($stmt,"s",$_GET['lugar']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) > 0){
          $sql = "SELECT * FROM sensores WHERE lugar=?";
          $stmt = mysqli_stmt_init($conexao);
          if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$_GET['lugar']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) > 0){
              $sql = "UPDATE sensores set sensor1 = ?,sensor2 = ?,sensor3 = ? WHERE lugar=?";
              $stmt = mysqli_stmt_init($conexao);
              if(mysqli_stmt_prepare($stmt,$sql)){
                mysqli_stmt_bind_param($stmt,"ssss",$_GET['sensor1'],$_GET['sensor2'],$_GET['sensor3'],$_GET['lugar']);
                mysqli_stmt_execute($stmt);
                echo 'Sucesso!';
              } else echo "Erro SQL";
            } else {
              $sql = "INSERT INTO sensores(sensor1,sensor2,sensor3,lugar) VALUES(?,?,?,?);";
              $stmt = mysqli_stmt_init($conexao);
              if(mysqli_stmt_prepare($stmt,$sql)){
                mysqli_stmt_bind_param($stmt,"ssss",$_GET['sensor1'],$_GET['sensor2'],$_GET['sensor3'],$_GET['lugar']);
                mysqli_stmt_execute($stmt);
                echo 'Sucesso!';
              } else echo "Erro SQL";
            }
          } else echo "Erro SQL";
        } else echo "Estacionamento não encontrado: ".$_GET['lugar'];
      } else echo "Erro SQL";
    } else echo "Erro na conexão";
  } else echo "Preencha todos os campos";

?>
