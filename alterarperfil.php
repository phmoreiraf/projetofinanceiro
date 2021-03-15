<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


$perfil = new Usuario();

$dadosuser = $perfil->listarTodos();

//if(isset($_SESSION["usuario"])){
  //$dadosusuario = $perfil->listarID($_SESSION["usuario"]->ID);
//}
if(isset($_GET["id"])){
  $dadosusuario = $perfil->listarID($_GET["id"]);
}

if(isset($_POST["alterar"])){
  $perfil->alterar();
}

if(!isset($_SESSION["usuario"])){
  header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Alterar Perfil</title>
        <link rel="stylesheet" href="css/perfil.css"> 
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
       
          
        
          <form action="alterarperfil.php?id=<?php echo $dadosusuario->ID;?>" class="box" method="post">
            <h1>Perfil</h1>
            <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $dadosusuario->NOME;?>" required>
            <input type="email" name="email" id= "email" placeholder="E Mail" value="<?php echo $dadosusuario->EMAIL;?>" required>
            <input type="password" name="senha" id= "senha" placeholder="Senha" value="<?php echo $dadosusuario->SENHA;?>" required>
            <input type="tel" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $dadosusuario->TELEFONE;?>" oninput="mascara_telefone()" maxlength="14" required>
            <input type="text" name="endereco" id="endereco" placeholder="Endereço" value="<?php echo $dadosusuario->ENDERECO;?>" required>

            <button type="submit" name="alterar" id="alterar" class="btn2 btn-dangerr">Alterar</button>
            <a href="menuprincipal.php">Menu</a>
          </form>
       
          <script type="text/javascript" src="js/mascaras.js"></script>        
</body>

    <footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>

</html>



