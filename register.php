<?php

header ("Content-type:text/html; charset=utf8");

require_once "classes/Usuario.php";
require_once "classes/categorias.php";
require_once "classes/movimentacoes.php";
require_once "classes/Conta.php";


//criar uma instancia da classe alunos

$perfil = new Usuario();

//verificar se clicou no botao salvar

if(isset($_POST["cadastrar"])){
//chamar a funcao inserir alunos

$perfil->inserir();
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Registrar</title>
</head>

<body>
            <form action="register.php" class="box" method="post">
            <h1>Registrar no Mesadinha</h1>
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E Mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="tel" name="telefone" placeholder="Telefone" oninput="mascara_telefone()" maxlength="14" required>
            <input type="text" name="endereco" placeholder="Endereço" required>

            <button type="submit" name="cadastrar" id="cadastrar" class="btn2 btn-dangerr">Cadastrar</button>
            <a href="index.php">Logar</a>
            <script type="text/javascript" src="js/mascaras.js"></script>
        </form>

</body>
<footer>
      <p>Mesadinha Project <a href="#"> LTDA</a></p>
    </footer>
</html>