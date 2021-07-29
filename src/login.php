<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/cadastrar_usuario.css">
  <title>Cadastrar Usuário</title>
</head>
<body>
  

  <div class="container">
  <a href="#">Voltar</a> <!-- TODO -->
    
    <main>
      <h3>Fazer login</h3>
      <form action="./includes/usuarios/logica_usuarios.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Seu email">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha">

        <button type="submit" name="entrar">Fazer login</button>

      </form>

      <div>
        <span>Não tem uma conta?</span>
        <a href="./cadastrar_usuario.php">cadastrar</a>
      </div>
      

    </main>

  </div>

</body>

<script>

</script>
</html>