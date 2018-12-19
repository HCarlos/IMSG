<?php

$data = $_POST['data'];
if (!isset($data)){
	header('Location: http://imsg.mx/');
}else{
	/*
	if ( $c=='0' ){
		$u = $_POST['u'];
		$strgrualu = $_POST['strgrualu'];
		$logoEmp = $_POST['logoEmp'];
		$logoIbo = $_POST['logoIbo'];
	}	
	*/
	parse_str($data);
}



define('FPDF_FONTPATH','font/');


require('../diag/sector.php');


require('../oCenturaPDO.php');
$f = oCenturaPDO::getInstance();
require('../oMetodos.php');
$M = oMetodos::getInstance();

$ro = $f->getQueryPDO(15,$idcontrolmaster);
$rd = $f->getQueryPDO(17,$data);
$ri = $f->getQueryPDO(19,$data);

class PDF_Diag extends PDF_Sector {
	var $nFont;
	var $logoEmp;
    var $cfecha;
    var $fsalida;
    var $IdControlMaster;
    var $lastupdate;
    var $media;

    function Header(){   

		$this->Image('../../../images/web/'.$this->logoEmp,8,8,20,8.95);
		//$this->Image('../../../images/web/'.$this->logoIBO,196,6.44444,10,10);

		$this->setY(10);
		$this->setX(25);

		// /* *********************************************************
		// ** ENCABEZADO
		// ** ********************************************************* */

		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,4,utf8_decode("INGENIERIA EN MANTTO Y SISTEMAS DEL GOLFO"),'',0,'L');
		$this->SetFont('Arial','',6);
		$this->Cell(65,4,utf8_decode("ORDEN: "),'',0,'R');
		$this->SetFont('Arial','B',8);
		$this->Cell(10,4,utf8_decode($this->IdControlMaster),'',1,'L');
		$this->setX(26);
		$this->SetFont('Arial','',6);
		$this->Cell(100,4,utf8_decode("Av. Gregorio Méndez No. 1500-B Fracc. Lidia Esther CP 86040   |   http://www.imsdelgolfo.com.mx"),'',0,'L');
		$this->Cell(64,4,utf8_decode("FECHA DE ENTRADA: "),'',0,'R');
		$this->Cell(10,4,utf8_decode($this->cfecha),'',1,'L');
		$this->setX(26);
		$this->Cell(100,4,utf8_decode("Villahermosa, Tabasco, México   |   01-993-312-600, 312-9713   |   servicio@imsdelgolfo.com.mx"),'',0,'L');
		$this->Cell(64,4,utf8_decode("FECHA DE SALIDA: "),'',0,'R');
		$this->Cell(10,4,utf8_decode($this->fsalida),'',1,'L');
		$this->setX(5);
		$this->Cell(205,1,utf8_decode(""),'B',1,'L');
		$this->setX(5);

		$this->Ln(2);

    }

	function Footer(){

		$this->SetY(-7);
		$this->SetFont('Arial','I',4);
		$this->Cell(0,10,utf8_decode('Última Actualización:').$this->lastupdate,0,0,'L');

		$this->Cell(0,10,utf8_decode('IMSG © ').date('Y'),0,0,'R');

	}

}

$pdf = new PDF_Diag('P','mm',array(215.9, 139.7));
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(TRUE, 0.1);
$pdf->SetLeftMargin(5);

$pdf->IdControlMaster = $idcontrolmaster;
$pdf->nFont = 6;
$pdf->SetFillColor(192,192,192);
$pdf->logoEmp = $logoEmp;
$pdf->lastupdate = $ro[0]->modi_el;
$pdf->cfecha = $M->formatDateSpanish($ro[0]->creado_el,'',1);

$pdf->fsalida = $M->formatDateSpanish($ro[0]->fsalida,'',1);

$pdf->SetFont('Arial','',6);
$pdf->SetTextColor(0,0,0);
$pdf->AddPage();

// Linea 1
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(100,6,utf8_decode("DATOS DE CLIENTE"),'LTRB',0,'C',true);
$pdf->Cell(005,6,utf8_decode(""),'',0,'C');
$pdf->Cell(100,6,utf8_decode("DATOS DEL EQUIPO"),'LTRB',1,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

// Linea 2
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(12,6,utf8_decode("EMPRESA: "),'LB',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(88,6,utf8_decode($ro[0]->empresa),'RB',0,'L');
$pdf->Cell(5,6,utf8_decode(""),'',0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(25,6,utf8_decode("EQUIPO"),'LRB',0,'C',true);
$pdf->Cell(20,6,utf8_decode("MARCA"),'RB',0,'C',true);
$pdf->Cell(25,6,utf8_decode("MODELO"),'RB',0,'C',true);
$pdf->Cell(30,6,utf8_decode("SERIE"),'RB',1,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

// Linea 3
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(13,6,utf8_decode("CONTACTO: "),'LB',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(87,6,utf8_decode($ro[0]->reptte_legal).' | '.utf8_decode($ro[0]->emails_contacto),'RB',0,'L');
$pdf->Cell(5,6,utf8_decode(""),'',0,'C');
if ( isset($rd[0]->equipo) ){
	$pdf->Cell(25,6,utf8_decode($rd[0]->equipo),'LRB',0,'C');
	$pdf->Cell(20,6,utf8_decode($rd[0]->marca),'RB',0,'C');
	$pdf->Cell(25,6,utf8_decode($rd[0]->modelo),'RB',0,'C');
	$pdf->Cell(30,6,utf8_decode($rd[0]->serie),'RB',1,'C');
}else{
	$pdf->Cell(25,6,'','LB',0,'C');
	$pdf->Cell(20,6,'','B',0,'C');
	$pdf->Cell(25,6,'','B',0,'C');
	$pdf->Cell(30,6,'','RB',1,'C');
}

// Linea 4
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(14,6,utf8_decode("TELEFONOS: "),'LB',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(86,6,utf8_decode($ro[0]->tels_contacto).' | '.utf8_decode($ro[0]->cels_contacto),'RB',0,'L');
$pdf->Cell(5,6,utf8_decode(""),'',0,'C');
if ( isset($rd[1]->equipo) ){
	$pdf->Cell(25,6,utf8_decode($rd[1]->equipo),'LRB',0,'C');
	$pdf->Cell(20,6,utf8_decode($rd[1]->marca),'RB',0,'C');
	$pdf->Cell(25,6,utf8_decode($rd[1]->modelo),'RB',0,'C');
	$pdf->Cell(30,6,utf8_decode($rd[1]->serie),'RB',1,'C');
}else{
	$pdf->Cell(25,6,'','LB',0,'C');
	$pdf->Cell(20,6,'','B',0,'C');
	$pdf->Cell(25,6,'','B',0,'C');
	$pdf->Cell(30,6,'','RB',1,'C');
}

// Linea 5
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(13,6,utf8_decode("DIRECCION: "),'LB',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(87,6,utf8_decode($ro[0]->direccion),'RB',0,'L');
$pdf->Cell(5,6,utf8_decode(""),'',0,'C');
if ( isset($rd[2]->equipo) ){
	$pdf->Cell(25,6,utf8_decode($rd[2]->equipo),'LRB',0,'C');
	$pdf->Cell(20,6,utf8_decode($rd[2]->marca),'RB',0,'C');
	$pdf->Cell(25,6,utf8_decode($rd[2]->modelo),'RB',0,'C');
	$pdf->Cell(30,6,utf8_decode($rd[2]->serie),'RB',1,'C');
}else{
	$pdf->Cell(25,6,'','LB',0,'C');
	$pdf->Cell(20,6,'','B',0,'C');
	$pdf->Cell(25,6,'','B',0,'C');
	$pdf->Cell(30,6,'','RB',1,'C');
}

$oYY = $pdf->getY();

$pdf->Ln(2);
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(100,6,utf8_decode("TRABAJO REALIZADO"),'LTRB',1,'C',true);


// Linea 6
$oY = $pdf->getY();
$oX = $pdf->getX();
$pdf->RoundedRect($oX, $oY, 100, 12, 0, '', '');

$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(22,6,utf8_decode("SERVICIO / FALLA: "),'0',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->setX(5);
$pdf->setY($oY+1.5);
$pdf->MultiCell(99, 3, utf8_decode("                                  ".strtoupper(trim(utf8_decode($ro[0]->falla)))),'', 'L');
$pdf->setX(5);

// Linea 7
$pdf->Ln(1.5);
$oY = $pdf->getY();
$oX = $pdf->getX();
$pdf->RoundedRect($oX, $oY, 100, 12, 0, '', '');
$pdf->setY($oY);
$pdf->setX(5);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(22,6,utf8_decode("ACCESORIOS: "),'0',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->setX(5);
$pdf->setY($oY+1.5);
$pdf->MultiCell(99, 3, utf8_decode("                           ".strtoupper(trim(utf8_decode($ro[0]->accesorios)))),'', 'L');
$pdf->setX(5);

// Linea 8
$pdf->Ln(1.5);
$oY = $pdf->getY();
$oX = $pdf->getX();
$pdf->RoundedRect($oX, $oY, 100, 12, 0, '', '');
$pdf->setY($oY);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(22,6,utf8_decode("TRABAJO: "),'0',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->setX(5);
$pdf->setY($oY+1.5);
$pdf->MultiCell(99, 3, utf8_decode("                    ".strtoupper(trim(utf8_decode($ro[0]->trabajo)))),'', 'L');
$pdf->setX(5);

// Linea 9
$pdf->Ln(1.5);
$oY = $pdf->getY();
$oX = $pdf->getX();
$pdf->RoundedRect($oX, $oY, 100, 12, 0, '', '');
$pdf->setY($oY);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(22,6,utf8_decode("OBSERVACIONES: "),'0',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->setX(5);
$pdf->setY($oY+1.5);
$pdf->MultiCell(99, 3, utf8_decode("                                  ".strtoupper(trim(utf8_decode($ro[0]->observaciones)))),'', 'L');
$pdf->setX(5);

// Linea 10

$pdf->setY($oYY+2);

$pdf->setX(110);
$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(100,6,utf8_decode("COSTO DEL SERVICIO"),'LTRB',1,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$pdf->setX(110);
$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(15,6,utf8_decode("CANTIDAD"),'LTRB',0,'R',true);
$pdf->Cell(40,6,utf8_decode("CODIGO"),'LTRB',0,'C',true);
$pdf->Cell(25,6,utf8_decode("PRECIO UNITARIO"),'LTRB',0,'R',true);
$pdf->Cell(20,6,utf8_decode("IMPORTE"),'LTRB',1,'R',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$oYY = $pdf->getY();

$subtotal = 0;
$iva 	  = 0;
$viaticos = 0;
$importe    = 0;
$total    = 0;


// Linea 11
$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
if (  isset($ri[0]->importe) ){
	$pdf->Cell(15,6,$ri[0]->cantidad,'LRB',0,'R');
	$pdf->Cell(40,6,$ri[0]->codigo,'RB',0,'C');
	$pdf->Cell(25,6,number_format($ri[0]->precio_unitario, 2, '.', ','),'RB',0,'R');
	$pdf->Cell(20,6,number_format($ri[0]->subtotal, 2, '.', ','),'RB',1,'R');
	$subtotal += (float)$ri[0]->subtotal;
	$iva 	  += (float)$ri[0]->iva;
	$viaticos += (float)$ri[0]->viaticos;
	$importe  += (float)$ri[0]->importe;
}else{
	$pdf->Cell(15,6,'','LB',0,'R');
	$pdf->Cell(40,6,'','B',0,'R');
	$pdf->Cell(25,6,'','B',0,'R');
	$pdf->Cell(20,6,'','RB',1,'R');
}
$oYY = $pdf->getY();

// Linea 12
$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
if (  isset($ri[1]->importe) ){
	$pdf->Cell(15,6,$ri[1]->cantidad,'LRB',0,'R');
	$pdf->Cell(40,6,$ri[1]->codigo,'RB',0,'C');
	$pdf->Cell(25,6,number_format($ri[1]->precio_unitario, 2, '.', ','),'RB',0,'R');
	$pdf->Cell(20,6,number_format($ri[1]->subtotal, 2, '.', ','),'RB',1,'R');
	$subtotal += (float)$ri[1]->subtotal;
	$iva 	  += (float)$ri[1]->iva;
	$viaticos += (float)$ri[1]->viaticos;
	$importe  += (float)$ri[1]->importe;
}else{
	$pdf->Cell(15,6,'','LB',0,'R');
	$pdf->Cell(40,6,'','B',0,'R');
	$pdf->Cell(25,6,'','B',0,'R');
	$pdf->Cell(20,6,'','RB',1,'R');
}
$oYY = $pdf->getY();

// Linea 13
$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
if (  isset($ri[2]->importe) ){
	$pdf->Cell(15,6,$ri[2]->cantidad,'LRB',0,'R');
	$pdf->Cell(40,6,$ri[2]->codigo,'RB',0,'C');
	$pdf->Cell(25,6,number_format($ri[2]->precio_unitario, 2, '.', ','),'RB',0,'R');
	$pdf->Cell(20,6,number_format($ri[2]->subtotal, 2, '.', ','),'RB',1,'R');
	$subtotal += (float)$ri[2]->subtotal;
	$iva 	  += (float)$ri[2]->iva;
	$viaticos += (float)$ri[2]->viaticos;
	$importe  += (float)$ri[2]->importe;
}else{
	$pdf->Cell(15,6,'','LB',0,'R');
	$pdf->Cell(40,6,'','B',0,'R');
	$pdf->Cell(25,6,'','B',0,'R');
	$pdf->Cell(20,6,'','RB',1,'R');
}
$oYY = $pdf->getY();

// Linea 14
$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
if (  isset($ri[3]->importe) ){
	$pdf->Cell(15,6,$ri[3]->cantidad,'LRB',0,'R');
	$pdf->Cell(40,6,$ri[3]->codigo,'RB',0,'C');
	$pdf->Cell(25,6,number_format($ri[3]->precio_unitario, 2, '.', ','),'RB',0,'R');
	$pdf->Cell(20,6,number_format($ri[3]->subtotal, 2, '.', ','),'RB',1,'R');
	$subtotal += (float)$ri[3]->subtotal;
	$iva 	  += (float)$ri[3]->iva;
	$viaticos += (float)$ri[3]->viaticos;
	$importe  += (float)$ri[3]->importe;
}else{
	$pdf->Cell(15,6,'','LB',0,'R');
	$pdf->Cell(40,6,'','B',0,'R');
	$pdf->Cell(25,6,'','B',0,'R');
	$pdf->Cell(20,6,'','RB',1,'R');
}
$oYY = $pdf->getY();

// $iva = $subtotal * 0.16;
// $total = $subtotal + $iva;
$total = $importe;

// Linea 15

$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
$pdf->Cell(15,6,'','LB',0,'R');
$pdf->Cell(20,6,utf8_decode('VIÁTICOS'),'LBR',0,'L');
$pdf->Cell(20,6,number_format($viaticos, 2, '.', ','),'B',0,'R');
$pdf->Cell(25,6,'SUBTOTAL $','LRB',0,'R');
$pdf->Cell(20,6,number_format($subtotal, 2, '.', ','),'RB',1,'R');
$oYY = $pdf->getY();

// Linea 16

$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','',6);
$pdf->Cell(15,6,'','L',0,'R');
$pdf->Cell(40,6,'','',0,'R');
$pdf->Cell(25,6,'IVA $','LRB',0,'R');
$pdf->Cell(20,6,number_format($iva, 2, '.', ','),'RB',1,'R');
$oYY = $pdf->getY();

// Linea 17

$pdf->setY($oYY);
$pdf->setX(110);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(15,6,'','LB',0,'R');
$pdf->Cell(40,6,'','B',0,'R');
$pdf->Cell(25,6,'TOTAL $','LRB',0,'R');
$pdf->Cell(20,6,number_format($total, 2, '.', ','),'RB',1,'R');
$oYY = $pdf->getY();

$pdf->setY($oYY);

$pdf->Ln(2);
$oY = $pdf->getY();
$oX = $pdf->getX();
$pdf->RoundedRect($oX, $oY, 100, 16, 0, '', '');
$pdf->setY($oY);

// Linea 18
$pdf->Ln(2);
$pdf->setX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(100,3,utf8_decode('* SIN ESTA NOTA DE SERVICIO NO SERA ENTREGADO EL EQUIPO.'),'',1,'L');

// Linea 19
$pdf->setX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(100,3,utf8_decode('* NO NOS HACEMOS RESPONSABLES POR PERDIDAS DE INFORMACIÓN PARCIAL O TOTAL.'),'',0,'L');
$pdf->Cell(5,3,'','',0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(12,3,utf8_decode('ENTREGÓ: '),'',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(60,3,utf8_decode($ro[0]->tecnico_que_entrego),'',1,'L');

// Linea 20
$pdf->setX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(100,3,utf8_decode('* TODA REVISION O DIAGNOSTICO TENDRA UN CARGO DE $ 140.00 MAS IVA.'),'',0,'L');
$pdf->Cell(5,3,'','',0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(12,3,utf8_decode('RECIBIÓ: '),'',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(60,3,utf8_decode($ro[0]->cliente_que_recibio),'',0,'L');
$pdf->Cell(1,3,'','',0,'L');
$pdf->Cell(27,3,'','B',1,'C');

// Linea 21
$pdf->setX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(100,3,utf8_decode('* DESPUES DE 15 DIAS NOTIFICADO EL SERVICIO, NO NOS HACEMOS RESPONSABLES.'),'',0,'L');
$pdf->Cell(5,3,'','',0,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(12,3,utf8_decode('SALIDA:'),'',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(60,3, $M->formatDateSpanish($ro[0]->fsalida,'',1),'',0,'L');
$pdf->Cell(1,3,'','',0,'L');
$pdf->Cell(27,3,'FIRMA DE RECIBIDO','',1,'C');


$pdf->Output();

?>