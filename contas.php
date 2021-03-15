<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";

$perfil = new Usuario();
$principal = new Categorias();
$movimentar = new Movimentacoes();
$Conta = new Conta();

$dadosuser = $perfil->listarTodos();

$dadoscategoria = $principal->listarTodos();

$dadoscontas = $Conta->listarTodos();

if(isset($_POST["salvarconta"])){
  $Conta->inserir();
}

if(isset($_GET["id"])){
  $Conta->excluirC($_GET["id"]);
}

//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

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
          <form action="contas.php" method="post">
          <div class="row">
              <div class="column">
                  <div class="card">

                    <label for="nome">Nome</label>
                      <input type="text" name="nome" id="nome" class="form-control" required>

                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-controll" require>
                      <option value="Receitas">Receitas</option>
                      <option value="Despesas">Despesas</option>
                    </select>

                    <label for="categorias">Categoria</label>
                    <select name="categorias" id="categorias" class="form-controll" required>
                      <?php foreach ($dadoscategoria as $categorias) { ?>
                      <option value="<?php echo $categorias->ID; ?>"><?php  echo $categorias->NOME;?></option>
                      <?php } ?>
                    </select>



                      <div class="text-center">
                        <button type="submit" name="salvarconta" class="btn2 btn-dangerr">Salvar</button>
                      </div>
                  </div>
              </div>
              <div class="column2">
                
                
                <table class="styled-table">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>NOME</th>
                          <th>TIPO</th>
                          <th>CATEGORIA</th>
                          <th></th>
                      </tr>
                  </thead>
                  <?php if($dadoscontas) :
                  foreach ($dadoscontas as $contas) : ?>
                  <tbody>

                 
                      <tr>
                          <td><?php echo $contas->ID?></td>
                          <td><?php echo $contas->NOME;?></td>
                          <td><?php echo $contas->TIPO_CONTA;?></td>
                          <td><?php echo $contas->CATEGORIAS;?></td>
                          <td>
                            <a href="alterarConta.php?id=<?php echo $contas->ID;?>" class="btn btn-outline-primary posicao"><i class="fa fa-edit"></i></a>
                            <a href="contas.php?id=<?php echo $contas->ID;?>" class="btn btn-outline-danger posicao1"><i class="fa fa-trash"></i></a>
                          </td>
                      </tr>

                      <?php endforeach ?>
                      <?php else : ?>
                        
                        <tr>
                            <td>Nenhuma conta cadastrada</td>
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