<?php

function criarProduto($conexao, $array) {
  try {
    $query = $conexao->prepare("INSERT INTO produtos (nome, descricao, preco, imagem, id_categoria) VALUES (?, ?, ?, ?, ?)");
    $resultado = $query->execute($array);
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function listarProdutos($conexao) {
  try {
    $query = $conexao->prepare("SELECT * FROM produtos");      
    $query->execute();
    $produtos = $query->fetchAll();
    return $produtos;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}


function editarProduto($conexao, $array) {
  if (count($array) == 6) {
    $queryStr = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ?, id_categoria = ? WHERE id = ?";
  } else {
    $queryStr = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, id_categoria = ? WHERE id = ?";
  }

  try {
    $query = $conexao->prepare($queryStr);
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}


function deletarProduto($conexao, $array) {
  try {
    $query = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function deletarProdutosCategoria($conexao, $array) {
  try {
    $query = $conexao->prepare("DELETE FROM produtos WHERE id_categoria = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function buscarProduto($conexao, $array) {
  try {
    $query = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
    
    if ($query->execute($array)) {
      $produto = $query->fetch();
      return $produto;
    } else return false;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}

function buscarProdutosPorCategoria($conexao, $array) {
  try {
    $query = $conexao->prepare("SELECT * FROM produtos WHERE id_categoria = ?");
    
    if ($query->execute($array)) {
      $produtos = $query->fetchAll();
      return $produtos;
    } else return false;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function pesquisarProdutos($conexao, $array) {
  try {
    $query = $conexao->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
 
    if ($query->execute($array)) {
      $produtos = $query->fetchAll();
      return $produtos;
    } else return false;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function upload($imagem, $caminho) {
  $error = array();
  
  // Verificação se é uma imagem
  if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $imagem['type'])) {
    $error[1] = 'Isso não é uma imagem.';
  }
  

      
  if (count($error) == 0) {
  // Pega extensão da imagem
    preg_match('/\.(gif|bmp|png|jpg|jpeg){1}$/i', $imagem['name'], $ext);
          
    // Gera um nome para a imagem
    $nome_imagem = md5(uniqid(time())) . '.' . $ext[1];
          
    // Caminho da imagem
    $caminho_imagem =  '/opt/lampp/htdocs/projeto/src/img/'.$caminho.'/' . $nome_imagem;
          
    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($imagem['tmp_name'], $caminho_imagem);
    return $nome_imagem;
  }
}
?>
    