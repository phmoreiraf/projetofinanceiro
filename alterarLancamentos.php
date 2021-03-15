<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


$perfil = new Usuario();
$movimentar = new Movimentacoes();
$Conta = new Conta();

$dadosuser = $perfil->listarTodos();
$dadoslancamentos = $movimentar->listarTodos();
$dadosconta = $Conta->listarTodos();

//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}

if(isset($_GET["id"])){
    $dadosusuario = $perfil->listarID($_GET["id"]);
  }

if(isset($_GET["id"])){
    $dadoslancamento = $movimentar->listarID($_GET["id"]);
  }

if(isset($_POST["alterar"])){
  $movimentar->alterar();
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

//$hoje = date('d/m/Y');
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lancamentos</title>
        <link rel="stylesheet" href="css/gerenciarLancamentos.css">
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
          <form action="alterarLancamentos.php?id=<?php echo $dadoslancamento->ID;?>" method="post">
          <div class="row">
              <div class="column">
                  <div class="card">

                  <label for="conta">Conta</label>
                    <select name="conta" id="conta" class="form-controll" require>
                      <?php foreach ($dadosconta as $conta) { ?>
                      <option value="<?php echo $conta->ID;?>"><?php echo $conta->NOME;?></option>
                      <?php } ?>
                    </select>

                    <label for="valor">Valor</label>
                      <input type="number" name="valor" id="valor" value="<?php echo $dadoslancamento->VALOR_MOVI;?>" class="form-control" required>



                      <div class="text-center">
                        <button type="submit" name="alterar" id="alterar" class="btn2 btn-dangerr">Alterar</button>
                      </div>
                  </div>
              </div>
              <script type="text/javascript" src="js/mascaras.js"></script>
    </body>
    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>