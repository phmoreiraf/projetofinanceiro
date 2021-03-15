<?php

class Conta{
public $ID;
public $NOME;
public $TIPO_CONTA;
public $ID_CATEGORIAS;

public function listarTodos(){
         
    
    try{


        $bd = new Conexao();
        //crio uma variavel para receber a conexao
        $con = $bd->conectar();
        //criar comando sql para selecionar os alunos
        $sql = $con->prepare("select CONTAS.ID, CONTAS.NOME, CONTAS.TIPO_CONTA, CATEGORIAS.NOME AS CATEGORIAS from CATEGORIAS join CONTAS on CATEGORIAS.ID = CONTAS.ID_CATEGORIAS");
        //executar o comando
        $sql->execute();

       

        if($sql->rowCount() > 0){
           
            return $result = $sql->fetchAll(PDO::FETCH_CLASS);
            
        }

    }catch(PDOException $msg){ // devolver mensagem em caso de erro
        echo "Nao foi possivel listar as contas {$msg->getMessage()}";
}
}

public function inserir(){
    try{
        if(isset($_POST["nome"]) && !empty($_POST["nome"])
        && isset($_POST["tipo"]) && !empty($_POST["tipo"])
        && isset($_POST["categorias"]) && !empty($_POST["categorias"])){

                
                $this->NOME = $_POST["nome"];
                $this->TIPO_CONTA = $_POST["tipo"];
                $this->ID_CATEGORIAS = $_POST["categorias"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into contas(ID,NOME,TIPO_CONTA,ID_CATEGORIAS) 
                values(null,?,?,?)");
               

                $sql->execute(array(
                    $this->NOME,
                    $this->TIPO_CONTA,
                    $this->ID_CATEGORIAS
                ));
                
                if($sql->rowCount() > 0){
                  
                    header("location:contas.php");
                }

            }else{
                header("location:contas.php");
            }
    }catch(PDOException $msg){
        echo "Nao foi possivel inserir uma conta. {$msg->getMessage()}";
    }
}


public function alterar(){
    try{
        if(isset($_POST["alterar"])){
            //var_dump($_POST);die();
            $this->ID = $_GET["id"];
            $this->NOME = $_POST["nome"];
            $this->TIPO_CONTA = $_POST["tipo"];
            $this->ID_CATEGORIAS = $_POST["categorias"];
            

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("update CONTAS set nome = ?, tipo_conta = ?, id_categorias = ? where id = ?");

            $sql->execute(array(
                $this->NOME,
                $this->TIPO_CONTA,
                $this->ID_CATEGORIAS,
                $this->ID
            ));
            //var_dump($sql->debugDumpParams());die();
            if($sql->rowCount() > 0){
                
                header("location:contas.php");
                
            }else{
                //header("location:alterarconta.php");
            }
            
        }

    }catch(PDOException $msg){
        echo "Nao foi possivel alterar a conta {$msg->getMessage()}";
    }
}

public function listarID($ID){

    try{

        if(isset($ID)){
            $this->ID = $ID;

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from CONTAS where id = ?");

            $sql->execute(array($this->ID));

            if($sql->rowCount() > 0){
                return $result = $sql->fetchObject();

                //fetchAll - > linhas / colunas
            }
        }

    }catch(PDOException $msg){
        echo " Nao foi possivel listar a conta: {$msg->getMessage()}";
        }
    }

    public function excluirC($ID){
        try{
        
            if(isset($ID)){
                
                $this->ID = $ID;
        
                    $bd = new Conexao();
                    $con = $bd->conectar();
                    $sql = $con->prepare("delete from CONTAS where id = ?");
                   
        
                    $sql->execute(array($this->ID));
                    
                  
        
                    if($sql->rowCount() > 0){
                        
                        //header("location:categoria.php");
                    }
        
                }else{
                    //header("location:categoria.php");
                }
        
        }catch(PDOException $msg){
            echo "Nao foi possivel excluir a conta {$msg->getMessage()}";
          }
        }

}