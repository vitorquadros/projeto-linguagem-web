<head>
  <link rel="stylesheet" href="styles/header.css?v=<?php echo time(); ?>">
</head>

<?php 
  include_once('./includes/usuarios/funcoes_usuarios.php');
  include_once('./includes/conexao.php');
  $usuario = buscarUsuario($conexao, array($_SESSION['email']));
?>

<header>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Categorias</a></li>
      <li><a href="#">Categorias</a></li>
    </ul>
  </nav>

  <div class="container-login_carrinho">

    <div class="carrinho">
      <!-- <img src="img/carrinho.png" alt="" /> FIX -->
      <a href="#">Carrinho</a>
    </div>

    <div class="login">

      <?php
        if ($_SESSION['logado']) { ?>
          <!-- <img src="img/user.png" alt="" /> FIX --> 
          <a class="perfil" href="./perfil.php">Perfil</a>

      <?php
        if ($usuario && $usuario['admin']) { ?>
        <a class="perfil" href="./admin.php">Admin Área</a>
      <?php } ?>
      
      <div class="logado">
        <p>Logado: <?php echo $_SESSION['nome']; ?></p>
        <form action="./includes/usuarios/logica_usuarios.php" method="POST">
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