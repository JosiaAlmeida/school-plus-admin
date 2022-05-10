<?php
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  $user = array();
  session_start();
  try {
    $query = "select * from admin where usuario='$usuario' and senha='$senha'";
    $result = $myslq_i->query($query);
    while($row = $result->fetch_assoc()){
        extract($row);
        $item = array(
            'id'=>$id,
            'usuario'=>$usuario,
            'senha'=>$senha
        );
        array_push($user, $item);
    }
    $_SESSION['admin'] = $user[0];
    $myslq_i->close();
  } catch (\Throwable $th) {
    echo $th->getMessage();
  }
?>