<?php
require_once('../conexao.php');
require_once('./funcoes_categorias.php');

# Cadastrar nova categoria

if(isset($_POST['cadastrar'])){
  $nome = $_POST['nome'];
  $desc = $_POST['desc'];
  $array = array($nome, $desc);

  criarCategoria($conexao, $array);
  header('location:../../index.php');
}

# Redirecionar para pagina de editar categoria

if(isset($_POST['editar'])){
  $id = $_POST['editar'];
  $array = array($id);

  $categoria = buscarCategoria($conexao, $array);
  require_once('../../editar_categoria.php');
}    

# Editar categoria

if(isset($_POST['alterar'])){
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $desc = $_POST['desc'];
  $array = array($nome, $desc, $id);

  editarCategoria($conexao, $array);
  header('location:../../listar_categorias.php');
}

# Deletar categoria

if(isset($_POST['deletar'])){
  $id = $_POST['deletar'];
  $array=array($id);

  deletarCategoria($conexao, $array);
  header('Location:../../listar_categorias.php');
}

?>