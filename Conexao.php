<?php

// estrutura de um objeto contendo atributose metodos
// atributos sao as carasteristicas do objeto ( seriam os campos de uma tabela )
session_start();

// metodos sao acoes do objeto (CRUD _> inserir; deletar; atualizar; selecionar)
class Conexao{

// atributos para uma conexao com banco de dados sao 4( servidor; banco; usuario; senha)
// visibilidade -> public ; private
private $servidor;
private $banco;
private $usuario;
private $senha;

//metodos -> function

function __construct() // sera executado toda vez que instanciar a classe
{
    $this->servidor = "localhost"; //this faz referencia a classe
    $this->banco = "PROJETO_MESADINHA";
    $this->usuario = "root";
    $this->senha = "";
}

// metodo para conectar o banco de dados
// visibilidade public deixa o metodo visivel fora da classe
    public function conectar(){
        try { //tratar a execucao do codigo
        //criar conexao com o PDO
        //new instanciar uma classe (gerar um novo objeto baseado na classe)
        $con = new PDO("mysql:host={$this->servidor};dbname={$this->banco};charset=utf8;",$this->usuario, $this->senha);
        
        return $con; //retornando a conexao
        }catch(PDOException $msg){ // devolver mensagem caso de erro
            echo "Nao possivel possivel conectar com o banco de dados {$msg->getMessage()}";
        }
  
    }
}

