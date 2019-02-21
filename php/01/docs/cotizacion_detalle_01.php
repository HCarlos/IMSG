<?php

$data = $_POST['data'];
if (!isset($data)){
	header('Location: http://imsg.mx/');
}else{
	parse_str($data);
}



define('FPDF_FONTPATH','fonts/');


require('../diag/sector.php');
require('../tcpdf/tcpdf.php');


require('../oCenturaPDO.php');
$f = oCenturaPDO::getInstance();
require('../oMetodos.php');
$M = oMetodos::getInstance();

$ro = $f->getQueryPDO(35,$IdContizacion);
// $rd = $f->getQueryPDO(17,$data);
// $ri = $f->getQueryPDO(19,$data);

class PDF_Diag extends TCPDF {
	var $nFont;
	var $logoEmp;
    var $cfecha;
    var $fsalida;
    var $IdContizacion;
    var $lastupdate;
    var $persona;
    var $empresa;

    function Header(){   

		$this->Image('../../../images/web/'.$this->logoEmp,8,8,30,13.43);
		//$this->Image('../../../images/web/'.$this->logoIBO,196,6.44444,10,10);

		$this->setY(10);
		$this->setX(40);

		// /* *********************************************************
		// ** ENCABEZADO
		// ** ********************************************************* */

		$this->SetTextColor(0,0,0);
		$this->SetFont('courier','B',10);
		$this->Cell(100,4,utf8_decode("INGENIERIA EN MANTTO Y SISTEMAS DEL GOLFO"),'',0,'L');
		$this->SetFont('courier','',8);
		$this->Cell(60,4,"COTIZACIÓN: ",'',0,'R');
		$this->SetFont('courier','B',8);
		$this->Cell(10,4,utf8_decode($this->IdContizacion),'',1,'L');
		$this->setX(40);
		$this->SetFont('courier','',6);
		$this->Cell(190,4,"Av. Gregorio Méndez No. 1500-B Fracc. Lidia Esther CP 86040   |   http://www.imsdelgolfo.com.mx",'',1,'L');
		$this->setX(40);
		$this->Cell(190,4,"Villahermosa, Tabasco, México   |   01-993-312-600, 312-9713  |   cotizaciones@imsdelgolfo.com.mx",'',1,'L');
		$this->setX(5);
		$this->Cell(200,1,utf8_decode(""),'B',1,'L');
		$this->setX(5);
		$this->Ln(2);
		$this->SetFont('courier','B',8);
		$this->Cell(20,4,"CLIENTE: ",'',0,'L');
		$this->SetFont('courier','',8);
		$this->Cell(132,4,$this->persona,'',0,'L');
		$this->SetFont('courier','B',8);
		$this->Cell(15,4,"FECHA: ",'',0,'L');
		$this->SetFont('courier','',8);
		$this->Cell(30,4,$this->cfecha,'',1,'L');
		$this->SetFont('courier','B',8);
		$this->Cell(20,4,"EMPRESA: ",'',0,'L');
		$this->SetFont('courier','',8);
		$this->Cell(170,4,$this->empresa,'',1,'L');
		$this->SetFont('courier','',8);
		$this->setX(5);
		$this->Cell(200,1,"",'B',1,'L');
		$this->setX(5);
		$this->Ln(2);

    }

	function Footer(){

		$this->SetY(-7);
		$this->SetFont('courier','I',4);
		$this->Cell(0,10,'Última Actualización:'.$this->lastupdate,0,0,'L');

		$this->Cell(0,10,'IMSG © '.date('Y'),0,0,'R');

	}

}



//$pdf = new PDF_Diag('P','mm');
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new PDF_Diag(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(TRUE, 0.1);
$pdf->SetLeftMargin(5);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('@DevCH');
$pdf->SetTitle('IMS del Golfo');
$pdf->SetSubject('Cotización');
$pdf->SetKeywords('IMSG, PDF, Cotización, Ingeniería, Mantenimiento, Sistemas');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}



$pdf->IdContizacion = $IdContizacion;
$pdf->nFont = 6;
$pdf->SetFillColor(192,192,192);
$pdf->logoEmp = $logoEmp;
$pdf->lastupdate = $ro[0]->modi_el;
$pdf->persona = $ro[0]->persona;
$pdf->empresa = $ro[0]->empresa;
$pdf->cfecha = $M->formatDateSpanish($ro[0]->creado_el,'',1);


$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);


// Linea 1
$pdf->setX(5);
$pdf->Ln(30);
$pdf->SetFont('courier','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(10,6,"LOTE",'LTRB',0,'C',true);
$pdf->Cell(12,6,"CANT.",'TRB',0,'R',true);
$pdf->Cell(30,6,"MEDIDA",'TRB',0,'C',true);
$pdf->Cell(98,6,"DESCRIPCIÓN",'TRB',0,'C',true);
$pdf->Cell(25,6,"P.V.",'TRB',0,'R',true);
$pdf->Cell(25,6,"IMPORTE",'TRB',1,'R',true);
$pdf->SetFont('courier','',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$rs = $f->getQueryPDO(39,$pdf->IdContizacion);
foreach ($rs as $i => $value) {
	$pdf->setX(5);
	// $pdf->Ln(6);
	//$height = (ceil(($pdf->getStringHeight($rs[$i]->descripcion) / 98)) * 6);

	$pdf->startTransaction();

	$height = $pdf->MultiCell(98, 6, $rs[$i]->descripcion, "BR", 'L', 0, 0, '', '', true, 0, false,true, 0) * 3;

	$pdf = $pdf->rollbackTransaction();

// $height = $pdf2->getY()

	$pdf->Cell(10,$height,$rs[$i]->lote,'LTRB',0,'C');
	$pdf->Cell(12,$height,number_format($rs[$i]->cantidad,2,'.',','),'TRB',0,'R');
	$pdf->Cell(30,$height,$rs[$i]->unidad_medida,'TRB',0,'L');
	
	//$pdf->Cell(98,$height,utf8_decode($rs[$i]->descripcion),'TRB',0,'L');
	
	//$pdf->MultiCell(98, 6, $rs[$i]->descripcion, 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(98, $height, $rs[$i]->descripcion, "BR", 'L', 0, 0, '', '', true, 0, false,true, 0);
	
	//$pdf->MultiCell(98, 40, $rs[$i]->descripcion, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');

	$pdf->Cell(25,$height,number_format($rs[$i]->precio_venta,2,'.',','),'TRB',0,'R');
	$pdf->Cell(25,$height,number_format($rs[$i]->importe,2,'.',','),'TRB',1,'R');
}

$pdf->setX(5);
$pdf->Cell(150,6,"",'TR',0,'C');
$pdf->SetFont('courier','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(25,6,"SUBTOTAL $",'TRB',0,'R',true);
$pdf->SetFont('courier','',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25,6,number_format($ro[0]->subtotal,2,'.',','),'TRB',1,'R');

$pdf->Cell(150,6,"",'R',0,'C');
$pdf->SetFont('courier','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(25,6,"IVA 16% $",'TRB',0,'R',true);
$pdf->SetFont('courier','',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25,6,number_format($ro[0]->iva,2,'.',','),'TRB',1,'R');

$pdf->Cell(150,6,"",'R',0,'C');
$pdf->SetFont('courier','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(92,92,92);
$pdf->Cell(25,6,"TOTAL $",'TRB',0,'R',true);
$pdf->SetFont('courier','',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(25,6,number_format($ro[0]->total,2,'.',','),'TRB',1,'R');

$pdf->Output();

?>