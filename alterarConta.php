<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";

$perfil = new Usuario();
$principal = new Categorias();
$Conta = new Conta();

$dadosuser = $perfil->listarTodos();

$dadoscategoria = $principal->listarTodos();

$dadosconta = $Conta->listarTodos();

if(isset($_GET["id"])){
  $dadosconta = $Conta->listarID($_GET["id"]);
}

if(isset($_POST["alterar"])){
  $Conta->alterar();
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}


//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}

?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Contas</title>
        <link rel="stylesheet" href="css/gerenciarContas.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
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
          <form action="alterarConta.php?id=<?php echo $dadosconta->ID;?>" method="post">
          <div class="row">
              <div class="column">
                  <div class="card">

                    <label for="nome">Nome</label>
                      <input type="text" name="nome" id="nome" value="<?php echo $dadosconta->NOME;?>" class="form-control" required>

                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-controll" require>
                      <option value="Receitas">Receitas</option>
                      <option value="Despesas">Despesas</option>
                    </select>

                    <label for="categorias">Categoria</label>
                    <select name="categorias" id="categorias" class="form-controll" require>
                      <?php foreach ($dadoscategoria as $categorias) { ?>
                      <option value="<?php echo $categorias->ID;?>"><?php echo $categorias->NOME;?></option>
                      <?php } ?>
                    </select>


                      <div class="text-center">
                        <button type="submit" name="alterar" id="alterar" class="btn2 btn-dangerr">Alterar</button>
                        <a class="alterar" href="contas.php">Voltar</a>                          
                      </div>
                  </div>
              </div>
              </form>
              <script type="text/javascript" src="js/mascaras.js"></script>
    </body>
    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>