<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


$perfil = new Usuario();

$dadosuser = $perfil->listarTodos();

//if(isset($_SESSION["usuario"])){
 // $dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}

if(isset($_POST["adicionar"])){
  //chamar a funcao inserir
  
  $perfil->inseriruser();
  }

if(isset($_GET["id"])){
    $perfil->excluir($_GET["id"]);
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Adicionar Usuario</title>
        <link rel="stylesheet" href="css/gerenciarCategorias.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                 

                   
        <h1 class="text-center">Adicionar Usuario</h1>
        <form action="adduser.php" method="POST">
           
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
     
          
                <label for="endereco">Endereco</label>
                <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Avenida ou Rua" required>
         
        
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(00) 00000-0000" oninput="mascara_telefone()" maxlength="14" required>
         
           
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="EX: email@email.com" required> 
         
            
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
       
       
                      <div class="text-center">
                        <button type="submit" name="adicionar" id="adicionar" class="btn2 btn-dangerr">Adicionar</button>
                      </div>
                  </div>
              </div>
              
              <div class="column2">
                
                
                <table class="styled-table">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>NOME</th>
                          <th>EMAIL</th>
                          <th>ENDERECO</th>
                          <th>TELEFONE</th>
                          <th></th>
                      </tr>
                  </thead>
                  <?php if($dadosuser) :
                  foreach ($dadosuser as $usuario) : ?>
                  <tbody>
                  
                  
                      <tr>
                          <td><?php echo $usuario->ID?></td>
                          <td><?php echo $usuario->NOME;?></td>
                          <td><?php echo $usuario->EMAIL;?></td>
                          <td><?php echo $usuario->ENDERECO;?></td>
                          <td><?php echo $usuario->TELEFONE;?></td>
                          <td>

                            <a href="adduser.php?id=<?php echo $usuario->ID;?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                          </td>
                      </tr>

                      <?php endforeach ?>
                      <?php else : ?>
                        <tr>
                            <td>Nenhum usuario cadastrado</td>
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