<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/editar.css?v=<?php echo time(); ?>">
  <?php
    session_start();
    include('./includes/componentes/header.php');
    include_once('./includes/conexao.php');
    include_once('./includes/categorias/funcoes_categorias.php');
    $categorias = listarCategorias($conexao);
  ?>
  <title>Editando | <?php echo $_SESSION['produtoEdit']['nome']; ?></title>
</head>
<body>
  
 <main>
    <div class="editar">
      <p id="titulo">Você está editando o produto <strong><?php echo $_SESSION['produtoEdit']['nome']; ?></strong></p>

      <form action="./includes/produtos/logica_produtos.php" method="POST" enctype="multipart/form-data" onsubmit="validate(event)">
        <input type="hidden" name="id" value="<?php echo $_SESSION['produtoEdit']['id']; ?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['produtoEdit']['nome']; ?>">

        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo $_SESSION['produtoEdit']['descricao']; ?>">

        <label for="preco">Preço</label>
        <input type="number" name="preco" id="preco" value="<?php echo $_SESSION['produtoEdit']['preco']; ?>">

        <label for="idCategoria">Categoria</label>
        <select name="idCategoria">
          <?php foreach($categorias as $categoria) { ?>
            <option value="<?php echo $categoria['id']; ?>"
              <?php if ($categoria['id'] == $_SESSION['produtoEdit']['id_categoria']) { ?>
              selected
              <?php } ?>
              ><?php echo $categoria['nome']; ?>
            </option>
          <?php } ?>
        </select>

        <label for="imagem">Imagem</label>
        <input type="file" id="imagem" name="imagem">

        <button type="submit" name="alterar">Editar</button>
      </form>

      <p id="back"><a href="./admin.php">Voltar</a></p>

      <div id="erros"></div>

    </div>
 </main>
</body>
<script>
const inputs = document.getElementsByTagName('input');

function validate(event) {
  let errosDiv = document.getElementById('erros');
  
  const nome = document.getElementById('nome').value;
  const descricao = document.getElementById('descricao').value;
  const preco = document.getElementById('preco').value;
  const imagem = document.getElementById('imagem').value;
  let vazios = [];
  let erros = [];

  // Verificação se está vazio

  for (let i = 0; i <= inputs.length - 1; i++) {
    if (inputs[i].value == '' && inputs[i].type != 'file') {
      vazios.push(inputs[i].name);
      if (inputs[i].name != 'imagem') {
        inputs[i].style.border = 'solid 1px red';
      }
      
    } else {
      if(inputs[i].name != 'imagem' && inputs[i].type != 'submit') {
        inputs[i].style.border = 'solid 1px black';
      }
      
    }
  }

  // Mostrando Erros

  if (vazios.length > 0) {
    errosDiv.innerHTML =
      '<strong>Os seguintes campos precisam ser preenchidos:</strong><br>' + vazios;
  } else {
    errosDiv.innerHTML = ' ';
  }

  if (erros.length > 0) {
    errosDiv.innerHTML += '<br><strong>Ocorreram os seguintes erros:</strong> <br>' + erros;
  } else {
    errosDiv.innerHTML += ' ';
  }

  if (erros.length > 0 || vazios.length > 0) {
    event.preventDefault();
  }
}
</script>
</html>