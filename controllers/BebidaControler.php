<?php
include_once("models/Bebida.class.php");
include_once("models/Impressao.class.php");
class BebidaControler{

    private $bebida;

    function __construct(){
        $this->bebida = new Bebida();
    }

    public function imprimeBebidas(){
        $this->bebida->imprimeBebidas();
    }

    public function incluirBebida($dados){
        $this->bebida->incluirBebida($dados);
    }

    public function excluirBebida($cod){
        $this->bebida->excluirBebida($cod);
    }

    public function alterarBebida($dados){
        $this->bebida->alterarBebida($dados);
    }

    public function imprimeTodos(){
        $impressao = new Impressao();
        $impressao->imprimeTodos();
    }

    public function imprimeById($id){
        $impressao = new Impressao();
        $impressao->imprimeById($id);
    }

    function getLegenda(){
        return $this->bebida->getLegenda();
    }

    function getNome(){
        return $this->bebida->getNome();
    }

    function getAction(){
        return $this->bebida->getAction();
    }

    function getDescricao(){
        return $this->bebida->getDescricao();
    }

    function getTa(){
        return $this->bebida->getTa();
    }

    function getPreco(){
        return $this->bebida->getPreco();
    }
}
?>