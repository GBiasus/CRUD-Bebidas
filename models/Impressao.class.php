<?php
//biblioteca fpdf
require_once("lib/fpdf.php");
//include_once("../lib/fpdf.php");
include_once("Conexao.php");

class Impressao{
	private $con;
	private $pdf;

	function __construct(){
		$this->con = new Conexao();
		$this->criaPDF();
	}

	function converte($string){
		return  iconv("UTF-8", "ISO-8859-1",$string);
	}

	function criaPDF(){
		//cria um documento PDF
		$this->pdf = new FPDF('p','mm','A4');

		$this->pdf->AddPage(); //adiconar uma página 
		$this->pdf->Image('images/marca.png');//figura

		//endereco da empresa
		$this->pdf->setFont('arial','',12);
		$this->pdf->Cell(0,20,"Rua Nereu Ramos, s/n, Bairro Universitário",0,1,'L');

		//email para contao
		$this->pdf->setFont('arial','',12);
		$this->pdf->Cell(0,20,"contato@ifsc.edu.br",0,1,'L');

		//dá espaco
		$this->pdf->ln(20);

		//configura a fonte
		$this->pdf->setFont('arial','B',18);
		$this->pdf->Cell(0,5,$this->converte("Relatorio"),0,1,'C');

		//linha abaixo do Titulo relatorio
		$this->pdf->Cell(0,5,"",0,1,'C');

		//dá espaco
		$this->pdf->ln(20);
		$this->pdf = $this->pdf;
	}

	function imprimeById($id){
        $dados = $this->con->get_conexao()->prepare("SELECT * FROM bebida WHERE codigo=?");
        $dados->bindParam(1, $id);
        try {
            $dados->execute();
        } catch (PDOException $erro) {
            echo $erro -> getMessage();
        }

		while($linha = $dados->fetch(PDO::FETCH_OBJ)){
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Codigo"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->codigo,0,1,'L');
			
			
			//configura a fonte Label...........
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Nome"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->nome,0,1,'L');

			//configura a fonte Label............
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Descrição"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->descricao,0,1,'L');
			
			//configura a fonte Label............
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Teor Alcoólico(%)"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->ta,0,1,'L');
			
			
			//configura a fonte Label.........
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Preço"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->preco,0,1,'L');
		}
		$this->pdf->Output();
	}

	function imprimeTodos(){
        $dados = $this->con->get_conexao()->prepare("SELECT * FROM bebida");
        try {
            $dados->execute();
        } catch (PDOException $erro) {
            echo $erro -> getMessage();
        }

		while($linha = $dados->fetch(PDO::FETCH_OBJ)){
			//configura a fonte Label...........
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Nome"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->nome,0,1,'L');
			
			//configura a fonte Label.........
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(70,20,$this->converte("Descrição"),0,0,'L');
		
			//configura a fonte
			$this->pdf->setFont('arial','B',12);
			$this->pdf->Cell(0,20,$linha->descricao,0,1,'L');
		}
		$this->pdf->Output();
	}	
}
?>