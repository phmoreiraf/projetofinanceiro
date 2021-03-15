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

if(isset($_POST["salvar"])){
  $principal->inserir();
}

if(isset($_GET["id"])){
  $principal->excluirC($_GET["id"]);
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Gerenciar Categorias</title>
        <link rel="stylesheet" href="css/gerenciarCategorias.css">
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
          <form action="categoria.php" method="post">
          <div class="row">
              <div class="column">
                  <div class="card">
                    <label for="categorias">Adicionar Categoria</label>
                      <input type="text" name="nome" id="nome" class="form-control" required>
                      <div class="text-center">
                      <button type="submit" name="salvar" id="salvar" class="btn2 btn-dangerr">Salvar</button>
                      </div>
                  </div>
              </div>
              <div class="column2">
                
                
                <table class="styled-table">
                  <thead>
                      <tr>
                          <th>NOME CATEGORIA</th>
                          <th></th>
                      </tr>
                  </thead>
                  <?php if($dadoscategoria) :

                  foreach ($dadoscategoria as $categoria) :  ?>
                  <tbody>
                  
       
                      <tr>
                          <td><?php echo $categoria->NOME;?></td>
                          <td>
                          
                          
                          <a href="alterarcategoria.php?id=<?php echo $categoria->ID;?>" class="btn btn-outline-primary posicao"><i class="fa fa-edit"></i></a>
                          <a href="categoria.php?id=<?php echo $categoria->ID;?>" class="btn btn-outline-danger posicao1"><i class="fa fa-trash"></i></a>               
                   </td>
                      </tr>

                      <?php endforeach ?>
                      <?php else : ?>
                        <tr>
                            <td>Nenhuma categoria cadastrada</td>
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