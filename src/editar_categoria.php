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

    if (!isset($_SESSION['categoriaEdit'])) header('location:index.php');
    $_SESSION['categoria'] = $_SESSION['categoriaEdit'];
    unset($_SESSION['categoriaEdit']);
  ?>
  <title>Editando | <?php echo  $_SESSION['categoria']['nome']; ?></title>
</head>
<body>
  
 <main>
    <div class="editar">
      <p id="titulo">Você está editando a categoria <strong><?php echo  $_SESSION['categoria']['nome']; ?></strong></p>

      <form action="./includes/categorias/logica_categorias.php" method="post" onsubmit="validate(event)">
        <input type="hidden" name="id" value="<?php echo  $_SESSION['categoria']['id']; ?>">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo  $_SESSION['categoria']['nome']; ?>">
        <label for="descricao">Descrição</label>
        <input type="text" name="desc" id="desc" value="<?php echo  $_SESSION['categoria']['descricao']; ?>">
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
  let vazios = [];
  let erros = [];

  // Verificação se está vazio

  for (let i = 0; i <= inputs.length - 1; i++) {
    if (inputs[i].value == '' && inputs[i].name != 'desc') {
      vazios.push(inputs[i].name);
      inputs[i].style.border = 'solid 1px red';
    } else {
      inputs[i].style.border = 'solid 1px black';
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