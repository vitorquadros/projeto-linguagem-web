<?php

function cadastrarUsuario($conexao,$array) {
  try {
    $query = $conexao -> prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $resultado = $query -> execute($array);
            
    return $resultado;
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function fazerLogin($conexao,$array){
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

function buscarUsuario($conexao, $array){
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

function editarUsuario($conexao, $array){
  try {
    $query = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  }catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function teste(){
  echo 'teste';
}