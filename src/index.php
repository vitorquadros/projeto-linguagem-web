<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/index.css?v=<?php echo time(); ?>" />
    <title>Document</title>
  </head>

  <?php
    session_start(); 
    include('./includes/componentes/header.php');
  ?>

  <body>
    <main>
      <h4>Categorias</h4>
      <div class="container-categorias">
        <div class="categoria">
          <img src="img/camisa.png" alt="" />
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
        <div class="categoria">
          <img src="img/camisa.png" alt="" />
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
        <div class="categoria">
          <!-- <img src="img/camisa.png" alt="" /> -->
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
        <div class="categoria">
          <!-- <img src="img/camisa.png" alt="" /> -->
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
        <div class="categoria">
          <!-- <img src="img/camisa.png" alt="" /> -->
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
        <div class="categoria">
          <!-- <img src="img/camisa.png" alt="" /> -->
          <p>Titulo</p>
          <p>Descrição</p>
        </div>
      </div>
    </main>
  </body>
</html>
