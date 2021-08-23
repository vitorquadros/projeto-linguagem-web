<?php

require_once('../conexao.php');
require_once('./funcoes_produtos.php');

# Cadastrar novo produto

if (isset($_POST['cadastrar'])) {
  $nome = $_POST['nome'];
  $desc = $_POST['descricao'];
  $preco = $_POST['preco'];
  $idCategoria = $_POST['idCategoria'];
  $imagem = $_FILES['imagem'];

  if (!empty($imagem['name'])) {
    $nome_imagem = upload($imagem, 'produtos');
  }

  $array = array($nome, $desc, $preco, $nome_imagem, $idCategoria);

  criarProduto($conexao, $array);
  header('location:../../admin.php');
}

# Redirecionar para pagina de editar produto

if (isset($_POST['editar'])) {
  $id = $_POST['editar'];
  $array = array($id);
  $produto = buscarProduto($conexao, $array);

  session_start();
  $_SESSION['produtoEdit'] = $produto;

  header('location:../../editar_produto.php');
}    

# Editar produto

if (isset($_POST['alterar'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $desc = $_POST['descricao'];
  $preco = $_POST['preco'];
  $imagem = $_FILES['imagem'];
  $idCategoria = $_POST['idCategoria'];

  if (!empty($imagem['name'])) {
    $nome_imagem = upload($imagem, 'produtos');
    $array = array($nome, $desc, $preco, $nome_imagem, $idCategoria, $id);
  } else {
    $array = array($nome, $desc, $preco, $idCategoria, $id);
  }

  editarProduto($conexao, $array);
  header('location:../../admin.php');
}

# Deletar produto

if (isset($_POST['deletar'])) {
  $id = $_POST['deletar'];
  $array=array($id);

  deletarProduto($conexao, $array);
  header('location:../../admin.php');
}

# Pesquisar por categoria

if (isset($_GET['pesquisarPorCategoria'])) {
  session_start();
  $page = $_GET['page'];
  $id = $_GET['idCategoria'];
  $_SESSION['idCategoriaPesquisa'] = $id;
  header('location:../../'.$page.'.php');
}

if (isset($_GET['pesquisar'])) {
  session_start();
  $page = $_GET['page'];
  $nome = $_GET['nome'];
  $_SESSION['nomeProdutoPesquisar'] = '%'.$nome.'%';
  header('location:../../'.$page.'.php');
}

# Pagina produto

if (isset($_GET['paginaProduto'])) {
  session_start();
  $id = $_GET['paginaProduto'];

  if ($id) $_SESSION['paginaProduto'] = $id;

  header('location:../../produto.php');
}

?>