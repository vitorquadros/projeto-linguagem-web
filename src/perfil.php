<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/perfil.css?v=<?php echo time(); ?>">
  <title>Document</title>
</head>

  <?php
    session_start();
    include('./includes/componentes/header.php');
  ?>

<body>

  <main>
    <div class="perfil_pic">
      <img src="./img/user.png" alt="">
    </div>

    
    <div class="form">
      <h4>Alterar dados</h4>
      <form action="./includes/usuarios/logica_usuarios.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $_SESSION['idUsuario']; ?>">

        <label for="">Nome</label>
        <input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">

        <label for="">Email</label>
        <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>">

        <label for="">Senha</label>
        <input type="text" name="senha">

        <label for="">Confirmar senha</label>
        <input type="text" name="confirmSenha">

        <input type="submit" name="alterar" value="Enviar">
      </form>
    </div>
  </main>
  
</body>
</html>