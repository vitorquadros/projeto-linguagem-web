<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/perfil.css?v=<?php echo time(); ?>">
  <title>Perfil</title>
</head>

  <?php
    session_start();
    include('./includes/componentes/header.php');

    // Verificação se o usuário esta logado
    if (!$_SESSION['logado']) header('location: index.php');
  ?>

<body>

  <main>
  <h4>Alterar dados de cadastro</h4>
    <div class="container">
      <div class="perfil_pic">
        <img src="./img/usuarios/<?php echo $_SESSION['avatar']; ?>" alt="Imagem de perfil">
      </div>

      
      <div class="form">
        
        <form action="./includes/usuarios/logica_usuarios.php" method="POST" enctype="multipart/form-data" onsubmit="validate(event)">
        <input type="hidden" name="id" value="<?php echo $_SESSION['idUsuario']; ?>">

          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>">

          <label for="email">Email</label>
          <input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>">

          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha">

          <label for="confirmSenha">Confirmar senha</label>
          <input type="password" name="confirmSenha" id="confirmSenha">

          <label for="imagem">Foto de perfil</label>
          <input type="file" name="imagem" id="imagem">

          <input type="submit" name="alterar" value="Salvar">
        </form>
        <div id="erros"></div>
      </div>
    </div>

    <form action="./includes/usuarios/logica_usuarios.php" method="POST">
      <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario']; ?>">
      <button id="deletarPerfil" name="deletarPerfil" onclick="confirmarExcluirUsuario(event)">Deletar perfil</button>
    </form>
    
  </main>
  
</body>
<script>
  function confirmarExcluirUsuario(event) {
    if (!confirm('Tem certeza que deseja excluir a sua conta permanentemente?')) {
      event.preventDefault();
    }
  }

  const inputs = document.getElementsByTagName('input');

 function validate(event) {
 let errosDiv = document.getElementById('erros');

 let nome = document.getElementById('nome').value;
 let email = document.getElementById('email').value;
 let senha = document.getElementById('senha').value;
 let confirm = document.getElementById('confirmSenha').value;
 let imagem = document.getElementById('imagem').value;
 let vazios = [];
 let erros = [];
 
 
 
 // Verificação se está vazio
 
 for (let i = 0; i <= inputs.length - 1; i++) {
   if (inputs[i].value == '' && inputs[i].type != 'file') {
     vazios.push(inputs[i].name);
     inputs[i].style.border = 'solid 1px red';
   } else {
     if (!(inputs[i].type == 'file') && !(inputs[i].type == 'submit')) {
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