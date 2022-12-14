<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', true);*/
//COLOCAR O AUXILIAR PARA CHAMAR AS BEBIDAS DIRETO
include_once("controllers/UsuarioControler.php");
include_once("controllers/BebidaControler.php");

$senha = "";
$email = "";

if(isset($_GET['login'])){
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    
    $user = new UsuarioControler($email, $senha);
    $user->validaAcesso();
} else if(isset($_GET['sair'])){
    if($_REQUEST['sair']==1){
        //finalizar sessão
        session_destroy();
        //Redireciona para a página de autenticação
        header('location:index.php');
    } else {
        header('location:sessao.php');
    }
}

if(isset($_REQUEST['codigo'])){
    $bebida = new BebidaControler();
    $codigo	= $_REQUEST['codigo'];
    $bebida->excluirBebida($codigo);
}

if(isset($_REQUEST['codigoAlt'])){
    $dados[] = $_REQUEST['nome'];
    $dados[] = $_REQUEST['descricao'];
    $dados[] = $_REQUEST['ta'];
    $dados[] = $_REQUEST['preco'];
    $dados[] = $_REQUEST['codigoAlt'];

    $bebida = new BebidaControler();
    $bebida->alterarBebida($dados);
}

if(isset($_REQUEST['incluir'])){
    $dados[] = $_REQUEST['nome'];
    $dados[] = $_REQUEST['descricao'];
    $dados[] = $_REQUEST['ta'];
    $dados[] = $_REQUEST['preco'];

    $bebida = new BebidaControler();
    $bebida->incluirBebida($dados);
}

if(isset($_REQUEST['opcao'])){
    $bebida = new BebidaControler();
    if($_REQUEST['opcao']==1){
        $bebida->imprimeTodos();
    } else if($_REQUEST['opcao']==2){
        $bebida->imprimeById($_REQUEST['codigoImp']);
    }
}
?>