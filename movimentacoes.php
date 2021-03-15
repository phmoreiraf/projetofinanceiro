<?php

class Movimentacoes{
    public $ID;
    public $VALOR_MOVI;
    public $SALDO;
    public $ID_CONTA;


public function listarTodos(){
         
    
    try{


        $bd = new Conexao();
        //crio uma variavel para receber a conexao
        $con = $bd->conectar();
        //criar comando sql para selecionar os alunos
        $sql = $con->prepare("select MOVIMENTACAO.ID, MOVIMENTACAO.VALOR_MOVI, MOVIMENTACAO.DATA,CONTAS.NOME AS CONTA from MOVIMENTACAO join CONTAS on CONTAS.ID = MOVIMENTACAO.ID_CONTA");
        //executar o comando
        $sql->execute();

       

        if($sql->rowCount() > 0){
           
            return $result = $sql->fetchAll(PDO::FETCH_CLASS);
            
        }

    }catch(PDOException $msg){ // devolver mensagem em caso de erro
        echo "Nao foi possivel listar o lancamento {$msg->getMessage()}";
}
}

public function inserir(){
    try{
        if(isset($_POST["valor"]) && !empty($_POST["valor"])
        && isset($_POST["conta"]) && !empty($_POST["conta"])){

                
                $this->VALOR_MOVI = $_POST["valor"];
                $this->ID_CONTA = $_POST["conta"];
                $this->DATA = date('Y/m/d');

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into MOVIMENTACAO(ID,VALOR_MOVI,DATA,ID_CONTA) 
                values(null,?,?,?)");
               

                $sql->execute(array(
                    $this->VALOR_MOVI,
                    $this->DATA,
                    $this->ID_CONTA
                    
                ));
                //var_dump($sql->debugDumpParams());die();  
                if($sql->rowCount() > 0){
                  
                    header("location:lancamentos.php");
                }

            }else{
                header("location:lancamentos.php");
            }
    }catch(PDOException $msg){
        echo "Nao foi possivel inserir um lancamento. {$msg->getMessage()}";
    }
}


public function alterar(){
    try{
        if(isset($_POST["alterar"])){
            $this->ID = $_GET["id"];
            $this->VALOR_MOVI = $_POST["valor"];
            $this->DATA = date('Y/m/d');
            $this->ID_CONTA = $_POST["conta"];
            

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("update MOVIMENTACAO set valor_movi = ?, data = ?, id_conta = ? where id = ?");

            $sql->execute(array(
                $this->VALOR_MOVI,
                $this->DATA,
                $this->ID_CONTA,
                $this->ID
            ));

            if($sql->rowCount() > 0){
                
                header("location:lancamentos.php");
                
            }else{
                //header("location:alterarconta.php");
            }
            
        }

    }catch(PDOException $msg){
        echo "Nao foi possivel alterar o lancamento {$msg->getMessage()}";
    }
}

public function listarID($ID){

    try{

        if(isset($ID)){
            $this->ID = $ID;

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from MOVIMENTACAO where id = ?");

            $sql->execute(array($this->ID));

            if($sql->rowCount() > 0){
                return $result = $sql->fetchObject();

                //fetchAll - > linhas / colunas
            }
        }

    }catch(PDOException $msg){
        echo " Nao foi possivel listar o lancamento {$msg->getMessage()}";
        }
    }

    public function excluir($ID){
        try{
        
            if(isset($ID)){
                
                $this->ID = $ID;
        
                    $bd = new Conexao();
                    $con = $bd->conectar();
                    $sql = $con->prepare("delete from MOVIMENTACAO where id = ?");
                   
        
                    $sql->execute(array($this->ID));
                    
                  
        
                    if($sql->rowCount() > 0){
                        
                        //header("location:categoria.php");
                    }
        
                }else{
                    //header("location:categoria.php");
                }
        
        }catch(PDOException $msg){
            echo "Nao foi possivel excluir o lancamento {$msg->getMessage()}";
          }
        }

        public function listarDespesas(){
         
    
            try{
        
        
                $bd = new Conexao();
                
                $con = $bd->conectar();
               
                $sql = $con->prepare("select sum(MOVIMENTACAO.VALOR_MOVI) as DESPESAS from CONTAS join MOVIMENTACAO on CONTAS.ID = MOVIMENTACAO.ID_CONTA where CONTAS.TIPO_CONTA = 'Despesas';");
      
                $sql->execute();
        
               
        
                if($sql->rowCount() > 0){
                   
                    return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                    
                }
        
            }catch(PDOException $msg){ // devolver mensagem em caso de erro
                echo "Nao foi possivel listar a despesa. {$msg->getMessage()}";
        }
        }

        public function listarReceitas(){
         
    
            try{
        
        
                $bd = new Conexao();
                
                $con = $bd->conectar();
               
                $sql = $con->prepare("select sum(MOVIMENTACAO.VALOR_MOVI) as RECEITAS from CONTAS join MOVIMENTACAO on CONTAS.ID = MOVIMENTACAO.ID_CONTA where CONTAS.TIPO_CONTA = 'Receitas';");
      
                $sql->execute();
        
               
        
                if($sql->rowCount() > 0){
                   
                    return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                    
                }
        
            }catch(PDOException $msg){ // devolver mensagem em caso de erro
                echo "Nao foi possivel listar a receita. {$msg->getMessage()}";
        }
    }

        //public function GetSaldo(){
            //try{

                //$bd = new Conexao();

                //$con = $bd->conectar();
                
                //$sql1 = $con->prepare("select sum(MOVIMENTACAO.VALOR_MOVI) as DESPESAS from CONTAS join MOVIMENTACAO on CONTAS.ID = MOVIMENTACAO.ID_CONTA where CONTAS.TIPO_CONTA = 'Despesas'");
                //$sql2 = $con->prepare("select sum(MOVIMENTACAO.VALOR_MOVI) as RECEITAS from CONTAS join MOVIMENTACAO on CONTAS.ID = MOVIMENTACAO.ID_CONTA where CONTAS.TIPO_CONTA = 'Receitas';");

                //$sql1->execute();
                //$sql2->execute();

                //$saldo = $sql1 - $sql2;
                //$return = $saldo;

            //}catch(PDOException $msg){
                //echo "Nao foi possivel obter o saldo. {$msg->getMessage()}";
            //}
        //}

}
