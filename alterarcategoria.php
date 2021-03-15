<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


$perfil = new Usuario();
$principal = new categorias();

$dadosuser = $perfil->listarTodos();
$dadoscategoria = $principal->listarTodos();

//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}


if(isset($_GET["id"])){
$dadoscategoria = $principal->listarID($_GET["id"]);
}

if(isset($_POST["alterarcategoria"])){
    $principal->alterar();
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Alterar Categorias</title>
        <link rel="stylesheet" href="css/alterarCategorias.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>

<div class="navbar">
            
            <a href="menuprincipal.php">Home</a>

            <div class="dropdown">
              <button class="dropbtn">Usuários 
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
              <?php if($dadosuser) :
                foreach ($dadosuser as $usuarios) : ?>
                <a href="perfil.php?id=<?php echo $usuarios->ID;?>">Perfil</a>
                <a href="alterarperfil.php?id=<?php echo $usuarios->ID;?>">Alterar Perfil</a>
                <?php endforeach ?>
                    <?php else : ?>
                      <?php endif; ?>
                      <a href="adduser.php">Adicionar Usuario</a>
              </div>
            </div> 

            <div class="dropdown">
                <button class="dropbtn">Gerenciar Cadastros 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="categoria.php">Categoria</a>
                  <a href="contas.php">Contas</a>
                </div>
              </div> 

            <a href="lancamentos.php">Lançamentos</a>
            <div class="sair">
                <a href="sair.php">Sair</a>
            </div>

          </div>
          <form action="alterarcategoria.php?id=<?php echo $dadoscategoria->ID;?>" method="post">
          <div class="row">
              <div class="column">
                  <div class="card">
                    <label>Alterar Categoria</label>
                      <input type="text" name="nome" id="nome" value="<?php echo $dadoscategoria->NOME;?>" class="form-control" required>
                      <div class="text-center">
                      <button type="submit" name="alterarcategoria" id="alterarcategoria" class="btn2 btn-dangerr">Alterar</button>
                      <a class="alterar" href="categoria.php">Voltar</a>
                      </div>
                  </div>
              </div>
              <script type="text/javascript" src="js/mascaras.js"></script>
    </body>
    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>