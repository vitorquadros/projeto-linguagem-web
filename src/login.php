<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/cadastrar_usuario.css?v=<?php echo time(); ?>">
  <title>Fazer login</title>
</head>

<?php
session_start();
if ($_SESSION['logado']) header('location:./index.php');
?>

<body>
  

  <div class="container">

    
    <main>
      <h3>Fazer login</h3>
      <form action="./includes/usuarios/logica_usuarios.php" method="POST" onsubmit="validate(event)">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Seu email">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha">

        <button type="submit" name="entrar">Fazer login</button>

      </form>

      <div>
        <span>Não tem uma conta?</span>
        <a href="./cadastrar_usuario.php">cadastrar</a>
        <a id="voltar" href="./index.php">Voltar</a>
      </div>
      

    </main>

    <div id="erros"></div>
  </div>

</body>

<script>
const inputs = document.getElementsByTagName('input');
let errosDiv = document.getElementById('erros');

function validate(event) {
  
  const email = document.getElementById('email').value;
  const senha = document.getElementById('senha').value;
  let vazios = [];
  let erros = [];

  // Verificação se está vazio

  for (let i = 0; i <= inputs.length - 1; i++) {
    if (inputs[i].value == '') {
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