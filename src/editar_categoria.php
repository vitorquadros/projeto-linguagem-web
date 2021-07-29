<!DOCTYPE html>
<html>
<head>
  <title>Document</title>
  <?php
    include_once('./includes/conexao.php');
    include_once('./includes/categorias/funcoes_categorias.php');
  ?>
</head>
<body>
  
  <div>
    <h4>Editar categoria</h4>

    <form action="./logica_categorias.php" method="post">
      <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">

      <label for="nome">Nome</label><br>
      <input type="text" name="nome" value="<?php echo $categoria['nome']; ?>"><br>
      <label for="descricao">Descrição</label><br>
      <input type="text" name="desc" value="<?php echo $categoria['descricao']; ?>"><br>
      <br>
      <button type="submit" name="alterar">Editar</button>
    </form>

    <p><a href="../../listar_categorias.php">Voltar</a></p>
  </div>

</body>
</html>