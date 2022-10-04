<?php
/*error_reporting(E_ALL);
ini_set('display_errors', true);*/

include_once("controllers/BebidaControler.php");
$bebida = new BebidaControler();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Bebidas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid"> <!-- Bootstrap, usado para o container fluir com o tamanho da janela e/ou com mobile -->
<div class="row">

  <!-- nav -->    	
  <div class="column-sm-4"> 
   <?php include "sidebar.php"; ?>
  </div>
  <div class="column col-sm-7">
    
     <div class="page-header text-muted">Bebidas </div>
      <form class="form-horizontal" action="<?php echo $bebida->getAction(); ?>" method="post"> 
        <fieldset>
          <legend><?php echo $bebida->getLegenda();?> !</legend>

         
          <div class="form-group">
            <label for="nome">Bebida</label>
            <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $bebida->getNome(); ?>" >
          </div>
         
          <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao"  required name="descricao"><?php echo $bebida->getDescricao(); ?></textarea>
          </div>
          
          <div class="form-group">
            <label for="ta">Teor Alcoólico(%)</label>
            <input type="text" class="form-control" id="ta" name="ta" value="<?php echo $bebida->getTa(); ?>"  class="input-xxlarge">
          </div>
          
          <div class="form-group">
            <label for="preco">Preço(R$)</label>
            <input type="text"  required class="form-control" id="preco" name="preco" value="<?php echo $bebida->getPreco(); ?>"  class="input-xxlarge">
          </div> 
          
          <div class="form-group">
            <input name="enviar" id="enviar" type="submit" value="Enviar"  class="btn btn-primary " style="width: 70px; font-weight:800" />
            <a class="btn btn-outline-primary " style="width: 90px; font-weight:800" href="adm.php">Cancelar</a>
          </div>
        </fieldset>
      </form>  
  
   

  <!-- lista -->
  <div class="container-fluid">  
    <div class="page-header text-muted divider">
      Bebidas Cadastradas
    </div>
  </div>
  
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" class="col-sm-3">ID</th>
      <th scope="col">Bebida</th>
      <th scope="col">Descrição</th>
      <th scope="col">TA(%)</th>
      <th scope="col">Preço(R$)</th>
    </tr>
    </thead>
    <tbody>
      <?php                       
        $bebida->imprimeBebidas();   
      ?>   
    </tbody>                     	
  </table>                      
  <!-- /lista -->
  <hr />
  <!-- rodape -->    	
  </div> <!-- /col-7 --> 
  </div>  <!-- /row --> 
 </div>  <!-- /container-fluid -->    
  <!-- script references -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>