<?php
include_once('../conexao.php');
include_once('./funcoes_usuarios.php');

# Cadastrar novo usuário

if (isset($_POST['cadastrar'])) {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $array = array($nome, $email, $senha);

  cadastrarUsuario($conexao, $array);

  $arrayLogin = array($email, $senha);
  $usuario = fazerLogin($conexao,$arrayLogin);

  if ($usuario) {
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['idUsuario'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];

    header('location: ../../index.php');
  } else header('location: ../../login.php');
}

# Fazer login

if (isset($_POST['entrar'])) {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $array = array($email, $senha);
  $usuario = fazerLogin($conexao,$array);

  if ($usuario) {
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['idUsuario'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];

    header('location: ../../index.php');
  } else header('location: ../../login.php');
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
  $array = array($nome, $email, $senha, $id);

  editarUsuario($conexao, $array);

  session_start();
  session_destroy();
  header('location:../../login.php');
}