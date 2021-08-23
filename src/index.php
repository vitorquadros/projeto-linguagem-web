<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/global.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./styles/index.css?v=<?php echo time(); ?>" />
    <title>Home</title>
  </head>

  <?php
    session_start(); 
    include_once('./includes/conexao.php');
    include('./includes/componentes/header.php');
    include_once('./includes/carrinho/logica_carrinho.php');
    include_once('./includes/produtos/funcoes_produtos.php');
    include_once('./includes/categorias/funcoes_categorias.php');

    $categorias = listarCategorias($conexao);

    // Buscando produtos no banco de dados

      // Filtrado por categoria
    if (isset($_SESSION['idCategoriaPesquisa'])) {
      $produtos = buscarProdutosPorCategoria($conexao, array($_SESSION['idCategoriaPesquisa']));
      $_SESSION['filtrado']['status'] = true;
      $_SESSION['filtrado']['categoria'] = $_SESSION['idCategoriaPesquisa'];
      unset($_SESSION['idCategoriaPesquisa']);
      unset($_SESSION['pesquisa']);
      // Filtrado por nome
    } else if (isset($_SESSION['nomeProdutoPesquisar'])) {
      $produtos = pesquisarProdutos($conexao, array($_SESSION['nomeProdutoPesquisar']));
      $_SESSION['pesquisa']['status'] = true;
      $_SESSION['pesquisa']['nome'] = trim($_SESSION['nomeProdutoPesquisar'], '%');
      unset($_SESSION['nomeProdutoPesquisar']);
      unset($_SESSION['filtrado']);
      // Todos os produtos
    } else {
      unset($_SESSION['filtrado']);
      unset($_SESSION['pesquisa']);
      $produtos = listarProdutos($conexao);
    }
  ?>

  <body>
    <main>
      <h4>Produtos</h4>
      <!-- PESQUISAR / FILTRAR PRODUTOS -->
      <div class="pesquisa">
        <form action="./includes/produtos/logica_produtos.php" method="GET">
          <input type="hidden" name="page" value="index">
          <select name="idCategoria">
            <option disabled selected>Escolha uma opção</option>
            <?php foreach($categorias as $categoria) { ?>
              <option value="<?php echo $categoria['id']; ?>"
            <?php if ($_SESSION['filtrado']['status'] 
            &&
            $_SESSION['filtrado']['categoria'] == $categoria['id']) { ?>
            selected
            <?php } ?>>
            <?php echo $categoria['nome']; ?></option>
            <?php } ?>
          </select>
          <button type="submit" class="botaoPesquisa" name="pesquisarPorCategoria">Filtrar</button>
             
          <div class="pesquisar">
            <input type="text" name="nome"
            <?php if ($_SESSION['pesquisa']['status']) { ?>
              value="<?php echo $_SESSION['pesquisa']['nome']; ?>"
            <?php } ?>
              placeholder="Nome do produto">
            <button type="submit" class="botaoPesquisa" name="pesquisar">Pesquisar</button>
          </div>
        </form>

      </div>

      <!-- LISTAR PRODUTOS -->
      <div <?php if ($produtos) {?> class="container-produtos" <?php } else {?> id="semProdutos" <?php } ?>>
        <?php if (count($produtos) < 1) { ?>
          <p>Nenhum produto encontrado.</p>
        <?php } ?>
        <?php
          foreach(array_reverse($produtos) as $produto) { ?>
           <div class="produto">
            <form action="./includes/produtos/logica_produtos.php" method="GET">
              <button id="link-produto" name="paginaProduto" value="<?php echo $produto['id']; ?>">
               <img src="img/produtos/<?php echo $produto['imagem']; ?>" alt="Imagem do produto" />
               <p><?php echo $produto['nome']; ?></p>
               <p id="preco">R$ <?php echo number_format($produto['preco'], 2, ",", "."); ?></p>
              </button>
            </form>

             <form action="./includes/carrinho/logica_carrinho.php" method="GET">
               <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
               <?php if ($_SESSION['logado']) {?>
               <button type="submit" name="adicionar">Adicionar ao carrinho</button>
               <?php } else { ?>
                <button><a href="./login.php">Adicionar ao carrinho</a></button>
               <?php } ?>
             </form>
           </div>
          <?php } ?>
      </div>
    </main>
  </body>
</html>
