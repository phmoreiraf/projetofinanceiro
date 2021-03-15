<?php

//importar arquivos no php
//include - importar o arquivo da mensagem de erro e continuar (incluir conteudo nas paginas)
//require - importar o aquivo da mensagem de erro e parar a execucao (incluir classes)
//require_once - importar uma unica vez o arquivo
require_once "Conexao.php";


class Usuario{
    //atributos
    public $ID;
    public $NOME;
    public $EMAIL;
    public $SENHA;
    public $ENDERECO;
    public $TELEFONE;
    

        public function inserir(){

            try{
                //testar se recebemos os dados do formulario
                if(isset($_POST["nome"]) && !empty($_POST["nome"])
                && isset($_POST["email"]) && !empty($_POST["email"])
                && isset($_POST["senha"]) && !empty($_POST["senha"])
                && isset($_POST["endereco"]) && !empty($_POST["endereco"])
                && isset($_POST["telefone"]) && !empty($_POST["telefone"])){
    
                    //preencher atributos da classe com os valores da tela
                    $this->NOME = $_POST["nome"];
                    $this->EMAIL = $_POST["email"];
                    $this->SENHA = $_POST["senha"];
                    $this->ENDERECO = $_POST["endereco"];
                    $this->TELEFONE = $_POST["telefone"];
                    
    
                    //criar uma instancia da classe de conexao
    
    
                    $bd = new Conexao();
                    $con = $bd->conectar();
                    $sql = $con->prepare("insert into usuario(ID,NOME,EMAIL,ENDERECO,TELEFONE,SENHA) 
                    values(null,?,?,?,?,?)");
                   
    
                    $sql->execute(array(
                        $this->NOME,
                        $this->EMAIL,
                        $this->ENDERECO,
                        $this->TELEFONE,
                        $this->SENHA
    
                    ));
                    
                    //var_dump ($sql->errorInfo());
                    //testar se o comandos deu certo (0 insert deu errado, 1 insert funcionou)
    
                    if($sql->rowCount() > 0){
                      
                        header("location:index.php");
                    }
    
                }else{
                    header("location:register.php");
                }
            }catch(PDOException $msg){
                echo " Nao possivel inserir um usuario. {$msg->getMessage()}"; 
         } 
    }


    public function alterar(){
        try{
            if(isset($_POST["alterar"])){
                $this->ID = $_GET["id"];
                $this->NOME = $_POST["nome"];
                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];
                $this->ENDERECO = $_POST["endereco"];
                $this->TELEFONE = $_POST["telefone"];
                
    
                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update usuario set nome = ?, email = ?, senha = ?, endereco = ?, telefone = ? where id = ?");
    
                $sql->execute(array(
                    $this->NOME,
                    $this->EMAIL,
                    $this->SENHA,
                    $this->ENDERECO,
                    $this->TELEFONE,                  
                    $this->ID
                ));
    
                   //var_dump($sql->debugDumpParams());die();            
                if($sql->rowCount() > 0){
                    
                    //header("location:alterarperfil.php");
                    
                }else{
                    //header("location:alterarperfil.php");
                }
                
            }
    
        }catch(PDOException $msg){
            echo "Nao foi possivel alterar o usuario {$msg->getMessage()}";
        }
    }

    public function login(){
        try{
    
            if(isset($_POST["email"]) && isset($_POST["senha"])){
                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("select * from usuario where email = ? and senha = ?");
                $sql->execute(array($this->EMAIL, $this->SENHA));

                if($sql->rowCount() > 0){
                    $result = $sql->fetchObject();
                    $_SESSION["usuario"] =  $result->ID;
                    //$_SESSION["usuario"] =  $sql->fetchObject();
                    header("location: menuprincipal.php");
                    
                }else{
                    header("location: index.php");
                    
                }

            }else{
                header("location: index.php");
            }
        }catch(PDOException $msg){
            echo "Nao foi possivel fazer o login. {$msg->getMessage()}";
        }  
    }

    public function listarID($ID){

        try{
    
            if(isset($ID)){
                $this->ID = $ID;
    
                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("select * from usuario where id = ?");
    
                $sql->execute(array($this->ID));
    
                if($sql->rowCount() > 0){
                    return $result = $sql->fetchObject();
    
                    //fetchAll - > linhas / colunas
                }
            }
    
        }catch(PDOException $msg){
            echo " Nao foi possivel listar o usuario: {$msg->getMessage()}";
            }
        }

        public function listarTodos(){
         
    
            try{
    
    
                $bd = new Conexao();
                //crio uma variavel para receber a conexao
                $con = $bd->conectar();
                //criar comando sql para selecionar os alunos
                $sql = $con->prepare("select * from usuario");
                //executar o comando
                $sql->execute();
    
               
    
                if($sql->rowCount() > 0){
                   
                    return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                    
                }
    
            }catch(PDOException $msg){ // devolver mensagem em caso de erro
                echo "Nao foi possivel listar os usuarios {$msg->getMessage()}";
        }
    }

    public function excluir($ID){
        try{
   
            if(isset($ID)){
                
                $this->ID = $ID;
  
                    $bd = new Conexao();
                    $con = $bd->conectar();
                    $sql = $con->prepare("delete from usuario where id = ?");
                   

                    $sql->execute(array($this->ID));
                    
                  
    
                    if($sql->rowCount() > 0){
                        
                        header("location:register.php");
                    }
    
                }else{
                    header("location:adduser.php");
                }
        
        }catch(PDOException $msg){
            echo "Nao foi possivel excluir o usuario {$msg->getMessage()}";
        }
    }

    public function inseriruser(){

        try{
            //testar se recebemos os dados do formulario
            if(isset($_POST["nome"]) && !empty($_POST["nome"])
            && isset($_POST["email"]) && !empty($_POST["email"])
            && isset($_POST["senha"]) && !empty($_POST["senha"])
            && isset($_POST["endereco"]) && !empty($_POST["endereco"])
            && isset($_POST["telefone"]) && !empty($_POST["telefone"])){

                //preencher atributos da classe com os valores da tela
                $this->NOME = $_POST["nome"];
                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];
                $this->ENDERECO = $_POST["endereco"];
                $this->TELEFONE = $_POST["telefone"];
                

                //criar uma instancia da classe de conexao


                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into usuario(ID,NOME,EMAIL,ENDERECO,TELEFONE,SENHA) 
                values(null,?,?,?,?,?)");
               

                $sql->execute(array(
                    $this->NOME,
                    $this->EMAIL,
                    $this->ENDERECO,
                    $this->TELEFONE,
                    $this->SENHA

                ));
                
                //var_dump ($sql->errorInfo());
                //testar se o comandos deu certo (0 insert deu errado, 1 insert funcionou)

                if($sql->rowCount() > 0){
                  
                    header("location:adduser.php");
                    
                }

            }else{
                header("location:adduser.php");
            }
        }catch(PDOException $msg){
            echo " Nao possivel inserir um usuario. {$msg->getMessage()}"; 
     } 
}
} 


