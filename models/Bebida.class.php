<?php include_once("Conexao.php");
class Bebida{
    private $legenda = "";
    private $nome = "";
    private $descricao = "";
    private $ta= "";
    private $preco = "";

    function __construct(){
        //inicia sessão  
        session_start();
        $this->con = new Conexao();
        
        //Caso o usuário não esteja autenticado, limpa os dados e redireciona
        if ( !isset($_SESSION['login']) and !isset($_SESSION['senha']) ) {    
        session_destroy(); //Destrói a sessão

        //Limpa
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);

        //Redireciona para a página de autenticação
        header('location:index.php');	
        } else {
            $this->retornaBebidas();
        }
    }

    private function retornaBebidas(){
        //acesso ao banco e tabelas do sistema
        if(!isset($_REQUEST['codigo'])){
            $this->action = "auxiliar.php?incluir=1";
            $this->legenda = "Incluir Bebida";
            $this->nome = "";
            $this->descricao     = "";
            $this->teor  = "";
            $this->preco     = "";
        } else {     
            $this->action = "auxiliar.php?codigoAlt=".$_REQUEST['codigo'];
            $this->legenda = "Alterar";
            $query = "SELECT * FROM bebida WHERE codigo = ".$_REQUEST['codigo'];
            $con = (new Conexao())->get_conexao(); 
            $result = $con->query($query);
            $linha = $result->fetch(PDO::FETCH_OBJ);
            $this->nome = $linha->nome;
            $this->descricao     = $linha->descricao;
            $this->ta  = $linha->ta;
            $this->preco     = $linha->preco; 
        }
    }

    public function imprimeBebidas(){
        $con = (new Conexao())->get_conexao();

        $resultado = $con->prepare("SELECT * FROM bebida");
        $resultado->execute();
        while($linha = $resultado->fetch(PDO::FETCH_OBJ)){        
            echo '<tr> 
            <td scope="row">'.$linha->codigo.'</td>
            <td scope="row">'.$linha->nome.'</td>
            <td scope="row">'.$linha->descricao.'</td>
            <td scope="row">'.$linha->ta.'</td>
            <td scope="row">'.$linha->preco.'</td>
            <td><a class="btn btn-warning" href="adm.php?codigo='.$linha->codigo.'" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg></a></td>
            <td><a class="btn btn-danger" href="auxiliar.php?codigo='.$linha->codigo.'" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
          </svg></a></td>
            </tr>';
        }
    }

    function excluirBebida($codigo){
        //$codigo	= $_REQUEST['codigo'];	
        $con = (new Conexao())->get_conexao();
        //query
        $query = "DELETE FROM bebida WHERE codigo=".$codigo;
        $con->query($query);
        //$this->con->exclui($query);
        header('Location:adm.php');		
    }

    public function alterarBebida($dados){
        $con = (new Conexao())->get_conexao();
        $resultado = $con->prepare("UPDATE bebida SET nome=?, descricao=?,ta=?,preco=? where codigo=?");
        $resultado->bindParam(1, $dados[0]);
        $resultado->bindParam(2, $dados[1]);
        $resultado->bindParam(3, $dados[2]);
        $resultado->bindParam(4, $dados[3]);
        $resultado->bindParam(5, $dados[4]);
        try {
            $resultado->execute();
            header('Location:adm.php');
        } catch (PDOException $erro) {
            echo $erro -> getMessage();
        }
    }

    public function incluirBebida($dados){
        $con = (new Conexao())->get_conexao();
        $resultado = $con->prepare("INSERT INTO bebida(nome, descricao, ta, preco) VALUES(?,?,?,?)");
        $resultado->bindParam(1, $dados[0]);
        $resultado->bindParam(2, $dados[1]);
        $resultado->bindParam(3, $dados[2]);
        $resultado->bindParam(4, $dados[3]);

        try {
            $resultado->execute();
            header('Location:adm.php');
        } catch (PDOException $erro) {
            echo $erro -> getMessage();
        }
    }

    public function getLegenda(){
        return $this->legenda;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getAction(){
        return $this->action;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getTa(){
        return $this->ta;
    }

    public function getPreco(){
        return $this->preco;
    }
}
?>