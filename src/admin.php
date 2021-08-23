<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/global.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/admin.css?v=<?php echo time(); ?>">
  <title>Área Administrador</title>
</head>

  <?php
    session_start();
    include('./includes/componentes/header.php');
    include_once('./includes/conexao.php');
    include_once('./includes/usuarios/funcoes_usuarios.php');
    include_once('./includes/categorias/funcoes_categorias.php');
    include_once('./includes/produtos/funcoes_produtos.php');

    // Verificação se o usuário esta logado
    if (!$_SESSION['logado']) header('location: index.php');
    $usuario = buscarUsuario($conexao, array($_SESSION['email']));

    // Verificação se o usuário é admin
    if (!$usuario['admin']) header('location: index.php');
    $categorias = listarCategorias($conexao);

    // Buscando produtos no banco de dados

      // Filtrado por categoria
    if (isset($_SESSION['idCategoriaPesquisa'])) {
      $produtos = buscarProdutosPorCategoria($conexao, array($_SESSION['idCategoriaPesquisa']));
      $_SESSION['filtrado']['status'] = true;
      $_SESSION['filtrado']['categoria'] = $_SESSION['idCategoriaPesquisa'];
      unset($_SESSION['idCategoriaPesquisa']);
      unset($_SESSION['pesquisa']);
      // Filtrado por nome
    } else if (isset($_SESSION['nomeProdutoPesquisar'])) {
      $produtos = pesquisarProdutos($conexao, array($_SESSION['nomeProdutoPesquisar']));
      $_SESSION['pesquisa']['status'] = true;
      $_SESSION['pesquisa']['nome'] = trim($_SESSION['nomeProdutoPesquisar'], '%');
      unset($_SESSION['nomeProdutoPesquisar']);
      unset($_SESSION['filtrado']);
      // Todos os produtos
    } else {
      unset($_SESSION['filtrado']);
      unset($_SESSION['pesquisa']);
      $produtos = listarProdutos($conexao);
    }
    
  ?>

<body>

  <main>
  <div class="container">
    <div class="container-categorias">

      <div class="gerenciar-categorias">
        <h4>Gerenciar Categorias</h4>
        <form action="./includes/categorias/logica_categorias.php" method="post" onsubmit="validateCategoria(event)">
          <label for="">Nome</label>
          <input type="text" id="nomeCategoria" name="nome">

          <label for="">Descrição</label>
          <input type="text" id="descCategoria" name="desc">
         
          <button type="submit" class="botaoAdicionar" name="cadastrar">+ Nova categoria</button>
        </form>
        <div id="erros-categorias"></div>
      </div>
      

      <div class="listar-categorias">
      <?php
        foreach(array_reverse($categorias) as $categoria) { ?>
        <div class="categoria">
          <p><?php echo $categoria['nome']; ?></p>
            <div class="buttons">
              <form action="./includes/categorias/logica_categorias.php" method="POST">
                <button type="submit" class="botaoEditar botaoFuncao" name="editar" value="<?php echo $categoria['id']; ?>">Editar</button>
                <button onclick="confirmarExcluirCategoria(event)" type="submit" class="botaoDeletar botaoFuncao" name="deletar" value="<?php echo $categoria['id']; ?>">Excluir</button>
                <button onclick="confirmarExcluirCategoriaProdutos(event)" type="submit" class="botaoDeletar botaoFuncao" name="deletarTodos" value="<?php echo $categoria['id']; ?>">Excluir produtos</button>
              </form>  
            </div>
        </div>
        <?php } ?>
      </div>
    </div>

    <!-- PRODUTOS -->

    <div class="container-produtos">
      <div class="gerenciar-produtos">
        <h4>Gerenciar produtos</h4>
        <form action="./includes/produtos/logica_produtos.php" method="POST" enctype="multipart/form-data" onsubmit="validateProduto(event)">
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome">
          <label for="descricao">Descrição</label>
          <input type="text" name="descricao" id="descricao">
          <label for="preco">Preço</label>
          <input type="number" name="preco" id="preco">
          <label for="idCategoria">Categoria</label>
          <select name="idCategoria" id="idCategoria">
          <option disabled selected value="null">Escolha uma opção</option>
            <?php foreach(array_reverse($categorias) as $categoria) { ?>
              <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
            <?php } ?>
          </select>
          <label for="imagem">Imagem</label>
          <input type="file" name="imagem" id="imagem">
          <button type="submit" class="botaoAdicionar" name="cadastrar">+ Novo produto</button>
        </form>
        <div id="erros-produtos"></div>
      </div>

      <hr>

      <div class="pesquisa">
          <form action="./includes/produtos/logica_produtos.php" method="GET">
            <input type="hidden" name="page" value="admin">
            <select name="idCategoria" id="idCategoriaPesquisa">
            <option disabled selected value="null">Escolha uma opção</option>
              <?php foreach($categorias as $categoria) { ?>
                <option value="<?php echo $categoria['id']; ?>"
                <?php if ($_SESSION['filtrado']['status'] 
                &&
                $_SESSION['filtrado']['categoria'] == $categoria['id']) { ?>
                selected
                <?php } ?>>
                <?php echo $categoria['nome']; ?></option>
              <?php } ?>
            </select>
            <button type="submit" class="botaoPesquisa" name="pesquisarPorCategoria">Filtrar</button>
             
            <div class="pesquisar">
            <input type="text" name="nome" id="nomePesquisa"
            <?php if ($_SESSION['pesquisa']['status']) { ?>
              value="<?php echo $_SESSION['pesquisa']['nome']; ?>"
            <?php } ?>
              placeholder="Nome do produto">
            <button type="submit" class="botaoPesquisa" name="pesquisar">Pesquisar</button>
            </div>
          </form>
        </div>
         
        <?php if (count($produtos) > 0) { ?>
        <p id="produtos-count">Produtos registrados: <strong><?php echo count($produtos); ?></strong></p>
        <?php } ?>

      <div <?php if ($produtos) {?> class="listar-produtos" <?php } else {?> class="semProdutos" <?php } ?>>
        
      <?php
          if (!$produtos) { ?>
          <p>Não há produtos registrados.</p>
          <?php } else { 
          foreach(array_reverse($produtos) as $produto) { ?>
           <div class="produto">
             <img src="img/produtos/<?php echo $produto['imagem']; ?>" alt="Imagem do produto" />
             <p><?php echo $produto['nome']; ?></p>
             <p><strong>R$ <?php echo number_format($produto['preco'], 2, ",", "."); ?></strong></p>
             <div class="buttons">
              <form action="./includes/produtos/logica_produtos.php" method="POST">
                <button type="submit" class="botaoEditar botaoFuncao" name="editar" value="<?php echo $produto['id']; ?>">Editar</button>
                <button onclick="confirmarExcluirProduto(event)" type="submit" class="botaoDeletar botaoFuncao" name="deletar" value="<?php echo $produto['id']; ?>">Excluir</button>
              </form>  
            </div>
           </div>
          <?php }} ?>
      </div>
    </div>
  </div>
  </main>
</body>

<script>

function confirmarExcluirProduto(event) {
  if (!confirm('Tem certeza que deseja DELETAR este produto?')) {
    event.preventDefault();
  }
}

function confirmarExcluirCategoria(event) {
  if (!confirm('Tem certeza que deseja DELETAR esta categoria?\n\nTodos os produtos relacionados a esta categoria serão deletados.')) {
    event.preventDefault();
  }
}

function confirmarExcluirCategoriaProdutos(event) {
  if (!confirm('Tem certeza que deseja DELETAR todos os produtos relacionados a esta categoria?')) {
    event.preventDefault();
  }
}

let inputsNome = ['nome', 'descricao', 'preco', 'idCategoria', 'imagem'];
let inputs = [];
for(let i=0; i <= inputsNome.length - 1; i++) {
  inputs.push(document.getElementById(inputsNome[i]));
}

function validateProduto(event) {
  let errosDiv = document.getElementById('erros-produtos');
  const nome = document.getElementById('nome').value;
  const descricao = document.getElementById('descricao').value;
  const preco = document.getElementById('preco').value;
  const idCategoria = document.getElementById('idCategoria').value;
  const imagem = document.getElementById('imagem').value;
  let vazios = [];
  let erros = [];

  // Verificação se está vazio

  for (let i = 0; i <= inputs.length - 1; i++) {
    if (inputs[i].value == '') {
      vazios.push(inputs[i].name);
      if (inputs[i].type != 'file') {
        inputs[i].style.border = 'solid 1px red';
      }
    } else {
      if (inputs[i].type != 'file') {
        inputs[i].style.border = 'solid 1px black';
      }
    }
  }

  if (idCategoria == 'null') {
    vazios.push('idCategoria');
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

function validateCategoria(event) {
  let errosDiv = document.getElementById('erros-categorias');
  const nome = document.getElementById('nomeCategoria');

  let vazios = [];
  let erros = [];

  // Verificação se está vazio

  
  if (nome.value == '') {
    vazios.push(nome.name);
    nome.style.border = 'solid 1px red';
  } else {
    nome.style.border = 'solid 1px black';
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