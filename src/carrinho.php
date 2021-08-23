<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/global.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="./styles/carrinho.css?v=<?php echo time(); ?>" />
  <title>Carrinho</title>
</head>

<?php
  $total = 0;
  session_start();
  include_once('./includes/conexao.php');
  include('./includes/componentes/header.php');
  include_once('./includes/carrinho/funcoes_carrinho.php');
 
  // Verificação se o usuário esta logado
  if (!$_SESSION['logado']) header('location: index.php');

  // Buscando os produtos que estão na sessão do carrinho
  $produtos = buscarProdutos($conexao);

  // Calculando o preço total dos produtos
  foreach($produtos as $produto) {
    foreach($produto as $item) {
      $total += $item['total'];
    }
  }
?>

<body>
  <main>
    <div class="produtos" <?php if (count($_SESSION['carrinho']) == 0) { ?> id="sem-itens" <?php } ?>>
      <?php
        if (count($_SESSION['carrinho']) == 0) { ?>
          <p>Carrinho vazio.</p>
          <a id="adicionar" href="index.php">Adicionar itens</a>      
      <?php } else { ?>
        <table class="produto">
          <thead>
            <tr>
              <td colspan="3"><strong>Produto</strong></td>
              <td><strong>Preço</strong></td>
              <td><strong>Quantidade</strong></td>
              <td><strong>Total</strong></td>
            </tr>
          </thead>
          <tbody>
        <?php
        foreach($produtos as $produto) { 
          foreach($produto as $item) { ?>
           <tr>
             <td><img src="img/produtos/<?php echo $item['imagem']; ?>" alt="Imagem do produto"></td>
             <td><?php echo $item['nome']; ?></td>
             <td>
               <form id="form-acoes" action="./includes/carrinho/logica_carrinho.php" method="POST">
                 <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                 <button type="submit" name="limparTodos" id="limparTodos" onclick="confirmarDeleteProdutos(event)">Limpar</button>
                 <button type="submit" name="removerUm">-1</button>
                 <button type="submit" name="adicionarUm">+1</button>
               </form>
             </td>
             <td>R$ <?php echo number_format($item['preco'], 2, ",", "."); ?></td>
             <td><?php echo $item['quantidade']; ?></td>
             <td>R$ <?php echo number_format($item['total'], 2, ",", "."); ?></td>
           </tr>
        <?php }}} ?>
          </tbody>  
        </table>   
    </div>

    <div class="finalizar">
      <p id="total">Total: R$ <?php echo number_format($total, 2, ",", "."); ?></p>
      <button>Finalizar compra</button>
      <form action="./includes/carrinho/logica_carrinho.php" method="POST" onsubmit="confirmarDeleteCarrinho(event)">
        <button type="submit" id="limpar" name="limpar">Limpar Carrinho</button>
      </form>
    </div>

  </main>
  
</body>

<script>

function confirmarDeleteCarrinho(event) {
  if (!confirm('Tem certeza que deseja remover todos os produtos do carrinho?')) {
    event.preventDefault();
  }
}

function confirmarDeleteProdutos(event) {
  if (!confirm('Tem certeza que deseja remover este produto do carrinho?')) {
    event.preventDefault();
  }
}

</script>
</html>