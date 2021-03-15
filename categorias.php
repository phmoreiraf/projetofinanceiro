<?php

require_once "Conexao.php";

class Categorias{
public $ID;
public $NOME;

public function inserir(){
    try{
        if(isset($_POST["nome"]) && !empty($_POST["nome"])){

                
                $this->NOME = $_POST["nome"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into CATEGORIAS(ID,NOME) 
                values(null,?)");
               

                $sql->execute(array(
                    $this->NOME 
                ));
                
                if($sql->rowCount() > 0){
                  
                    header("location:categoria.php");
                }

            }else{
                header("location:categoria.php");
            }
    }catch(PDOException $msg){
        echo "Nao foi possivel inserir uma categoria. {$msg->getMessage()}";
    }
}

public function listarTodos(){
     

    try{


        $bd = new Conexao();
        //crio uma variavel para receber a conexao
        $con = $bd->conectar();
        //criar comando sql para selecionar os alunos
        $sql = $con->prepare("select * from CATEGORIAS");
        //executar o comando
        $sql->execute();

       

        if($sql->rowCount() > 0){
           
            return $result = $sql->fetchAll(PDO::FETCH_CLASS);
            
        }

    }catch(PDOException $msg){ // devolver mensagem em caso de erro
        echo "Nao foi possivel listar as categorias. {$msg->getMessage()}";
}
}

public function listarID($ID){

    try{

        if(isset($ID)){
            $this->ID = $ID;

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from CATEGORIAS where id = ?");

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


public function excluirC($ID){
try{

    if(isset($ID)){
        
        $this->ID = $ID;

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("delete from CATEGORIAS where id = ?");
           

            $sql->execute(array($this->ID));
            
          

            if($sql->rowCount() > 0){
                
                //header("location:categoria.php");
            }

        }else{
            //header("location:categoria.php");
        }

}catch(PDOException $msg){
    echo "Nao foi possivel excluir a categoria {$msg->getMessage()}";
  }
}

public function alterar(){
    try{
        if(isset($_POST["alterarcategoria"])){
            $this->ID = $_GET["id"];
            $this->NOME = $_POST["nome"];
            
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("update CATEGORIAS set nome = ? where id = ?");

            $sql->execute(array(
                $this->NOME,                 
                $this->ID
            ));

               //var_dump($sql->debugDumpParams());die();            
            if($sql->rowCount() > 0){
                
                header("location:categoria.php");
                
            }else{
                //header("location:alterarcategoria.php");
            }
            
        }

    }catch(PDOException $msg){
        echo "Nao foi possivel alterar o usuario {$msg->getMessage()}";
    }
}
}
