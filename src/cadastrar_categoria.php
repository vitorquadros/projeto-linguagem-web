<!DOCTYPE html>
<html>
<head>
  <title>Document</title>
</head>
<body>

  <div>
    <h4>Cadastrar nova categoria</h4>
    
    <form action="./includes/categorias/logica_categorias.php" method="post">
      <label for="">Nome</label><br>
      <input type="text" id="nome" name="nome"><br>
      <label for="">Descrição</label><br>
      <input type="text" id="desc" name="desc"><br>
      <br>
      <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <p><a href="./index.php">Voltar</a></p>
  </div>
  
</body>
</html>