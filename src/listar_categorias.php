<!DOCTYPE html>
<html>
<head>
<?php
  include_once('./includes/conexao.php');
  include_once('./includes/categorias/funcoes_categorias.php');
  $categorias = listarCategorias($conexao)
?>
  <title>Categorias</title>
</head>
<body>
  <div>
    <p><a href="./index.php">Inicio</a></p>
    <?php foreach($categorias as $categoria) { ?>
    <div>
      <p><strong>Nome:</strong> <?php echo $categoria['nome']; ?></p>
      <p><strong>Descrição:</strong> <?php echo $categoria['descricao']; ?></p>

      <form action="./includes/categorias/logica_categorias.php" method="post">
        <button type="submit" name="editar" value="<?php echo $categoria['id']; ?>">Editar</button>
        <button type="submit" name="deletar" value="<?php echo $categoria['id']; ?>" onclick="return confirma_excluir()">Deletar</button> 
      </form>
    </div>
    <hr>
    <?php } ?>
  </div>
  
</body>

<script type="text/javascript">
  function confirma_excluir() {
    result = confirm("Tem certeza?")

    if (result == true) return true
    else return false
  }
</script>
</html>