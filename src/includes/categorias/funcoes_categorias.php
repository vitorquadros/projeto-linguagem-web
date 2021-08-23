<?php
function criarCategoria($conexao,$array){
  try {
    $query = $conexao->prepare("INSERT INTO categorias (nome, descricao) VALUES (?, ?)");
    $resultado = $query->execute($array);
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

function listarCategorias($conexao){
  try {
    $query = $conexao->prepare("SELECT * FROM categorias");      
    $query->execute();
    $categorias = $query->fetchAll();
    return $categorias;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}


function editarCategoria($conexao, $array){
  try {
    $query = $conexao->prepare("UPDATE categorias SET nome = ?, descricao = ? WHERE id = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}


function deletarCategoria($conexao, $array){
  try {
    $query = $conexao->prepare("DELETE FROM categorias WHERE id = ?");
    $resultado = $query->execute($array);   
    return $resultado;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
  
}

function buscarCategoria($conexao,$array){
  try {
    $query = $conexao->prepare("SELECT * FROM categorias WHERE id = ?");
    
    if($query->execute($array)){
      $categoria = $query->fetch();
      return $categoria;
    } else return false;
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  
}
?>
