<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="styles/cadastrar_usuario.css?v=<?php echo time(); ?>">
<title>Cadastrar Usuário</title>
</head>

<?php
  session_start();
  if ($_SESSION['logado']) header('location:./index.php');
?>

<body>
  <div class="container">

    <main>
      <h3>Fazer cadastro</h3>
      <form action="./includes/usuarios/logica_usuarios.php" method="POST" enctype="multipart/form-data" onsubmit="validate(event)">
      
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Seu nome">

        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Seu email">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha">

        <label for="confirmSenha">Confirmar Senha</label>
        <input type="password" name="confirmSenha" id="confirmSenha" placeholder="Repita a senha">

        <label for="imagem">Imagem de perfil</label>
        <input type="file" name="imagem">

        <button type="submit" name="cadastrar">Cadastrar</button>

      </form>

      <div>
        <span>Já tem conta?</span>
        <a href="./login.php">acessar</a>
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
 
  let email = document.getElementById('email').value;
  let senha = document.getElementById('senha').value;
  let confirm = document.getElementById('confirmSenha').value;
  let vazios = [];
  let erros = [];
  
  // Verificação se está vazio
  
  for (let i = 0; i <= inputs.length - 1; i++) {
    if (inputs[i].value == '' && inputs[i].type != 'file') {
      vazios.push(inputs[i].name);
    
      inputs[i].style.border = 'solid 1px red';
      
    } else {
      if (inputs[i].type != 'file') {
        inputs[i].style.border = 'solid 1px black';
      }
    }
  }
  
  // Validação senha igual
  if (senha != confirm) {
    erros.push(' As senhas não são iguais');
  }
  
  // Validação tamanho da senha
  
  if (senha.length < 6 || senha.length > 24) {
    erros.push(' A senha não tem no minimo 6 e no maximo 24 caracteres');
  }
  
  // Validação email
  
  if (!(email.includes('@') && email.includes('.'))) {
    erros.push(' O formato do email é incorreto');
  }
  
  // Mostrando Erros
  
  if (vazios.length > 0) {
    errosDiv.innerHTML = '<strong>Os seguintes campos precisam ser preenchidos:</strong><br>' + vazios;
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