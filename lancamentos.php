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

$receitas = $movimentar->listarReceitas();
$despesas = $movimentar->listarDespesas();


//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}

if(isset($_GET["id"])){
  $dadosusuario = $perfil->listarID($_GET["id"]);
}

if(isset($_GET["id"])){
  $dadosconta = $Conta->listarID($_GET["id"]);
}

if(isset($_POST["inserir"])){
  $movimentar->inserir();
}

if(isset($_GET["id"])){
  $movimentar->excluir($_GET["id"]);
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

          <div class="roww">
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
          <form action="lancamentos.php" method="post">
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
                      <input type="number" name="valor" id="valor" class="form-control" required>



                      <div class="text-center">
                        <button type="submit" name="inserir" id="inserir" class="btn2 btn-dangerr">Inserir</button>
                      </div>
                  </div>
              </div>
              <div class="column2">
                
                
                <table class="styled-table">
                  <thead>
                      <tr>
                          <th>CONTA</th>
                          <th>VALOR</th>
                          <th>DATA</th>
                          <th></th>
                      </tr>
                  </thead>
                  <?php if($dadoslancamentos) :
                  foreach ($dadoslancamentos as $movimentacoes) : ?>
                  <tbody>

                  
                      <tr>                
                          <td><?php echo $movimentacoes->CONTA;?></td>
                          <td><?php echo "R$" ?><?php echo $movimentacoes->VALOR_MOVI;?></td>
                          <td><?php echo $movimentacoes->DATA;?></td>
                          <td>

                          <a href="alterarLancamentos.php?id=<?php echo $movimentacoes->ID;?>" class="btn btn-outline-primary posicao"><i class="fa fa-edit"></i></a>
                          <a href="lancamentos.php?id=<?php echo $movimentacoes->ID;?>" class="btn btn-outline-danger posicao1"><i class="fa fa-trash"></i></a>               
                          </td>
                      </tr>

                      <?php endforeach ?>
                      <?php else : ?>
                        <tr>
                            <td>Nenhum lancamento cadastrado</td>
                        </tr>

                      <?php endif;?>
                  </tbody>
              </table>


            </div>
          </div>
          <script type="text/javascript" src="js/mascaras.js"></script>
    </body>
    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>