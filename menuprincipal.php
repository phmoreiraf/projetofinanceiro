<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


//criar uma instancia da classe alunos

$perfil = new Usuario();
$movimentar = new Movimentacoes();

$dadosuser = $perfil->listarTodos();

$receitas = $movimentar->listarReceitas();
$despesas = $movimentar->listarDespesas();

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Menu Principal</title>
        <link rel="stylesheet" href="css/index.css">
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
          <div class="row">
              <div class="column">
                  <div class="card">
                      <h3>Receitas</h3>
                    <?php if ($receitas) :
                    foreach ($receitas as $receita) : ?>
                      <p>R$ <?php echo $receita->RECEITAS;?></p>
                    <?php endforeach ?>
                    <?else : ?>
                    <?php endif;?>
                  </div>
              </div>
              <div class="column">
                <div class="card">
                    <h3>Despesas</h3>
                  <?php if ($despesas) : ?>
                  <?php foreach ($despesas as $despesa) : ?>
                    <p>R$ <?php echo $despesa->DESPESAS;?></p>
                  <?php endforeach ?>
                  <?php else : ?>
                  <?php endif; ?>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <h3>Saldo</h3>
                  <?php if ($despesas && $receitas) : 
                  foreach ($despesas as $despesaSaldo) :
                  foreach ($receitas as $receitaSaldo) : ?>
                    <p>R$ <?php echo $receitaSaldo->RECEITAS - $despesaSaldo->DESPESAS; ?></p>
                  <?php endforeach ?>
                  <?php endforeach ?>
                  <?php else : ?>
                  <?php endif;?>
                </div>
            </div>
          </div>
        
          <script type="text/javascript" src="js/mascaras.js"></script>
    </body>
    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>