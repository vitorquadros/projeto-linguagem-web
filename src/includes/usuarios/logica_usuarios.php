<?php

include_once('../conexao.php');
include_once('./funcoes_usuarios.php');
include_once('../produtos/funcoes_produtos.php');

 //debug
  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

# Cadastrar novo usuário

if (isset($_POST['cadastrar'])) {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $imagem = $_FILES['imagem'];



  if (!empty($imagem['name'])) {
    $nome_imagem = upload($imagem, 'usuarios');
    $array = array($nome, $email, $senha, $nome_imagem);
  } else {
    $array = array($nome, $email, $senha);
  }

  $emailArray = array($email);
  if (!verificarEmail($conexao, $emailArray)) {
    cadastrarUsuario($conexao, $array);
  }

  $arrayLogin = array($email, $senha);
  $usuario = fazerLogin($conexao, $arrayLogin);

  if ($usuario) {
    salvarSessao($usuario);
    header('location:../../index.php');
  } else {
    header('location:../../cadastrar_usuario.php');
  }
}

# Fazer login

if (isset($_POST['entrar'])) {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $array = array($email, $senha);
  $usuario = fazerLogin($conexao, $array);

  if ($usuario) {
    $_SESSION['erro'] = false;
    salvarSessao($usuario);
    header('location: ../../index.php');
  } else {
    session_start();
    $_SESSION['erro'] = true;
    header('location: ../../login.php');
   
  }
}

# Encerrar sessão

if (isset($_POST['sair'])) {
  session_start();
  session_destroy();
  header('location:../../index.php');
}

# Alterar dados do usuário

if (isset($_POST['alterar'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $imagem = $_FILES['imagem'];

  if (!empty($imagem['name'])) {
    $nome_imagem = upload($imagem, 'usuarios');
    $array = array($nome, $email, $senha, $nome_imagem, $id);
  } else {
    $array = array($nome, $email, $senha, $id);
  }
  
  editarUsuario($conexao, $array);
  
  session_start();
  session_destroy();
  header('location:../../login.php');
}

if (isset($_POST['deletarPerfil'])) {
  $id = $_POST['idUsuario'];
  $array = array($id);

  if ($id) {
    deletarUsuario($conexao, $array);
    session_start();
    session_destroy();
    header('location:../../login.php');
  }
}

?>