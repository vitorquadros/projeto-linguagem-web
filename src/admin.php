<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/admin.css?v=<?php echo time(); ?>">
  <title>Document</title>
</head>

  <?php
    session_start();
    include('./includes/componentes/header.php');
    if (!$_SESSION['logado']) header('location: index.php');
    include_once('./includes/usuarios/funcoes_usuarios.php');
    include_once('./includes/conexao.php');
    $usuario = buscarUsuario($conexao, array($_SESSION['email']));
    if (!$usuario['admin']) header('location: index.php');
  ?>

<body>

  <main>
  <div class="container">
    <div class="container-categorias">
      <div class="gerenciar-categorias">
        <h4>Gerenciar Categorias</h4>
        <form action="./includes/categorias/logica_categorias.php" method="post">
          <label for="">Nome</label>
          <input type="text" id="nome" name="nome">
          <label for="">Descrição</label>
          <input type="text" id="desc" name="desc">
          <label for="">Imagem</label>
          <input type="file" name="imagem">
          <button type="submit" name="cadastrar">+ Nova categoria</button>
        </form>
      </div>

      <div class="listar-categorias">

        <div class="categoria">
          <img src="img/camisa.png" alt="" />
          <p>Titulo</p>
          <p>Descrição</p>
            <div class="buttons">
              <button type="submit">Excluir</button>
              <button type="submit">Editar</button>
            </div>
        </div>

        <div class="categoria">
          <img src="img/camisa.png" alt="" />
            <p>Titulo</p>
            <p>Descrição</p>
            <div class="buttons">
              <button type="submit">Excluir</button>
              <button type="submit">Editar</button>
            </div>
        </div>

        <div class="categoria">
          <img src="img/camisa.png" alt="" />
            <p>Titulo</p>
            <p>Descrição</p>
            <div class="buttons">
              <button type="submit">Excluir</button>
              <button type="submit">Editar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-produtos">
      <div class="produto">
        <img src="img/camisa.png" alt="" />
        <p>Titulo</p>
        <p>Descrição</p>
      </div>
    </div>
  </div>
      
  </main>
  
</body>
</html>