<?php

function salvarSessao($usuario) {
  session_start();
  $_SESSION['logado'] = true;
  $_SESSION['idUsuario'] = $usuario['id'];
  $_SESSION['nome'] = $usuario['nome'];
  $_SESSION['email'] = $usuario['email'];
  $_SESSION['avatar'] = $usuario['avatar'];
}

function cadastrarUsuario($conexao,$array) {
  if (count($array) == 4) {
    $queryStr = "INSERT INTO usuarios (nome, email, senha, avatar) VALUES (?, ?, ?, ?)";
  } else {
    $queryStr = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
  }

  try {
    $query = $conexao -> prepare($queryStr);
    $resultado = $query -> execute($array);
            
    return $resultado;
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function fazerLogin($conexao, $array) {
  try {
    $query = $conexao -> prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    if ($query -> execute($array)) {
      $usuario = $query -> fetch();
      if ($usuario) return $usuario;
      else return false;
    } 
    else return false;
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}

function buscarUsuario($conexao, $array) {
  try {
    $query = $conexao -> prepare("SELECT * FROM usuarios WHERE email = ?");
    if ($query -> execute($array)) {
      $usuario = $query -> fetch();
      if ($usuario) return $usuario;
      else return false;
    } 
    else return false;
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}

function editarUsuario($conexao, $array) {
  if (count($array) == 5) {
    $queryStr = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, avatar = ? WHERE id = ?";
  } else {
    $queryStr = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
  }

  try {
    $query = $conexao->prepare($queryStr);
    $resultado = $query->execute($array);   
    return $resultado;
  }catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function verificarEmail($conexao, $array) {
  try {
    $query = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
    if ($query -> execute($array)) {
      $usuario = $query -> fetch();
      if ($usuario) return $usuario;
      else return false;
    } else return false;
  }catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function deletarUsuario($conexao, $array) {
  try {
    $query = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}
?>