<?php

session_start();

function buscarProdutos($conexao) {
  try {
    foreach($_SESSION['carrinho'] as $idProduto => $quantidade) {
      $query = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
      $query->bindParam(1, $idProduto);
      $query->execute();
      $produtos[$idProduto] = $query->fetchAll();
      $produtos[$idProduto][0]['quantidade'] = $quantidade;
      $produtos[$idProduto][0]['total'] = $produtos[$idProduto][0]['preco'] * $quantidade;
    }

    return $produtos;
  } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }   
}



?>