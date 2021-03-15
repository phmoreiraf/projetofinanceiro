<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


//criar uma instancia da classe alunos

$perfil = new Usuario();

//verificar se clicou no botao salvar

if(isset($_POST["logar"])){
//chamar a funcao inserir alunos

$perfil->login();
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Tela de Login</title>
</head>

<body>
            <form action="" class="box" method="post">
            <h1>Login</h1>
            <input type="email" name="email" placeholder="E Mail" required>
            <input type="password" name="senha" placeholder="Senha" required>

            <button type="submit" name="logar" id="logar" class="btn2 btn-dangerr">Logar</button>
            <a href="register.php">Registrar</a>
            
        </form>
        <script type="text/javascript" src="js/mascaras.js"></script>
</body>
<footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>