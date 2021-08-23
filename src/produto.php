<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/global.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="./styles/produto.css?v=<?php echo time(); ?>" />
  <?php
  session_start();
  include_once('./includes/conexao.php');
  require_once('./includes/produtos/funcoes_produtos.php');
  include('./includes/componentes/header.php');

  if (!isset($_SESSION['paginaProduto'])) {
    header('location:./index.php');
  } else {
    $idProduto = $_SESSION['paginaProduto'];
    $produto = buscarProduto($conexao, array($idProduto));
    unset($_SESSION['paginaProduto']);
  }
?>
  <title>Produto | <?php echo $produto['nome']; ?></title>
</head>



<body>
  <main>
    <div class="produto">
      <img src="img/produtos/<?php echo $produto['imagem']; ?>" alt="Imagem do produto">
      <div class="info">
        <p id="title"><?php echo $produto['nome']; ?></p>
        <p id="descricao"><?php echo $produto['descricao']; ?></p>
        <p id="preco">R$ <?php echo number_format($produto['preco'], 2, ",", "."); ?></p>
        <form action="./includes/carrinho/logica_carrinho.php" method="GET">
          <?php if ($_SESSION['logado']) {?>
            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
            <button type="submit" name="adicionar">Adicionar ao carrinho</button>
            <?php } else { ?>
            <button><a href="./login.php">Adicionar ao carrinho</a></button>
          <?php } ?>
        </form>
      </div>
    </div>
  </main>
</body>
</html>