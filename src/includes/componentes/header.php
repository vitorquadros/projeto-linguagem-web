<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/header.css?v=<?php echo time(); ?>">
</head>

<?php 
  include_once('./includes/usuarios/funcoes_usuarios.php');
  include_once('./includes/conexao.php');
  $usuario = buscarUsuario($conexao, array($_SESSION['email']));
?>

<body>
<header>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
    </ul>
  </nav>

  <div class="container-login_carrinho">

    <?php if ($_SESSION['logado']) { ?>
      <div class="carrinho">
        <a href="./carrinho.php">Carrinho</a>
      </div>
    <?php } ?>

    <div class="login">

      <?php
        if ($_SESSION['logado']) { ?>
          <a class="perfil" href="./perfil.php">Perfil</a>
      <?php
        if ($usuario && $usuario['admin']) { ?>
        <a class="perfil" id="admin"  href="./admin.php">Administrador</a>
      <?php } ?>
      
      <div class="logado">
        <p>Logado: <?php echo $_SESSION['nome']; ?></p>
        <form action="./includes/usuarios/logica_usuarios.php" method="POST" onsubmit="confirmarSair(event)">
          <input type="submit" name="sair" value="Sair">
        </form>
      </div>
      
      <?php } else { ?>
        <div class="cadastro">
          <a href="./login.php">Fazer login</a>
          <a href="./cadastrar_usuario.php">Cadastrar</a>
        </div>
      <?php } ?>

    </div>
  </div>
</header>
</body>

<script>

function confirmarSair(event) {
  if (!confirm('Tem certeza que deseja encerrar a sessão?')) {
    event.preventDefault();
  }
}

</script>

</html>