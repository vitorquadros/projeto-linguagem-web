<?php
session_start();
if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();

 # Adiciona o produto no carrinho
 if (isset($_GET['adicionar'])) {
  if(isset($_GET['id'])) {
    $idProduto = $_GET['id'];
    if (!isset($_SESSION['carrinho'][$idProduto])) {
      $_SESSION['carrinho'][$idProduto] = 1;
    } else {
      $_SESSION['carrinho'][$idProduto] += 1;
    }
  
    header('location:../../carrinho.php');
  }
}

# Limpa todos os produtos do carrinho
if (isset($_POST['limpar'])) {
  $_SESSION['carrinho'] = array();
  header('location:../../carrinho.php');
}

# Adiciona +1 na quantidade do produto selecionado
if (isset($_POST['adicionarUm'])) {
  $id = $_POST['id'];

  $_SESSION['carrinho'][$id]++;
  header('location:../../carrinho.php');
}

# Remove 1 na quantidade do produto selecionado
if (isset($_POST['removerUm'])) {
  $id = $_POST['id'];

  $_SESSION['carrinho'][$id]--;

  if ($_SESSION['carrinho'][$id] < 1) {
    unset($_SESSION['carrinho'][$id]);
  }
  header('location:../../carrinho.php');
}

# Remove todos os itens do produto selecionado
if (isset($_POST['limparTodos'])) {
  $id = $_POST['id'];

  unset($_SESSION['carrinho'][$id]);

  header('location:../../carrinho.php');
}

?>