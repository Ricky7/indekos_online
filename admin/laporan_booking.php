<?php
require('../class/Pdf.php');
require_once "../class/Connect.php";

// format mata uang
$jumlah_desimal = "0";
$pemisah_desimal = ",";
$pemisah_ribuan = ".";

// Instanciation of inherited class
$pdf = new Pdf();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$tgl_awal = $_POST['from'];
$tgl_akhir = $_POST['to'];

$query = "SELECT tbl_indekos.judul, tbl_seller.nama as nama_seller, tbl_user.nama as nama_user, tbl_booking.biaya FROM tbl_indekos INNER JOIN tbl_booking INNER JOIN tbl_seller INNER JOIN tbl_user ON (tbl_booking.id_indekos = tbl_indekos.id_indekos) 
        AND (tbl_booking.id_penjual = tbl_seller.id_seller) AND (tbl_booking.id_pembeli = tbl_user.id_user) WHERE date(tbl_booking.tgl_booking) BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND tbl_booking.status_booking = 'COMPLETED' ORDER BY tbl_booking.id_booking ASC";
$stmt = $db->prepare($query);
$stmt->execute();

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');
//Inisiasi untuk membuat header kolom

$column_judul = "";
$column_nama_seller = "";
$column_booking = "";
$column_nama_user = "";

//For each row, add the field to the corresponding column
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    $judul = $row["judul"];
    $nama_seller = $row["nama_seller"];
    $booking = $row["biaya"];
    $nama_user = $row["nama_user"];
 
    $column_judul = $column_judul.$judul."\n";
    $column_nama_seller = $column_nama_seller.$nama_seller."\n";
    $column_booking = $column_booking.number_format($booking,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."\n";
    $column_nama_user = $column_nama_user.$nama_user."\n";
    
    

//Create a new PDF file
$pdf = new FPDF('P','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'LAPORAN BOOKING',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'ADMIN',0,0,'C');
$pdf->Ln();

}

//Fields Name position
$Y_Fields_Name_position = 30;
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(80,8,'TANGGAL : '.$tgl_awal.' - '.$tgl_akhir,1,0,'C',1);
$pdf->SetX(140);
// $pdf->Cell(35,8,'JENIS SOAL',1,0,'C',1);
// $pdf->SetX(175);
// $pdf->Cell(30,8,$jenis_soal,1,0,'C',1);

//Fields Name position
$Y_Fields_Name_position = 40;
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(110,8,'Judul',1,0,'C',1);

$pdf->SetX(115);
$pdf->Cell(30,8,'Pengiklan',1,0,'C',1);

$pdf->SetX(145);
$pdf->Cell(30,8,'Booking',1,0,'C',1);

$pdf->SetX(175);
$pdf->Cell(30,8,'Pemesan',1,0,'C',1);

$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 48;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(110,6,$column_judul,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(30,6,$column_nama_seller,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(145);
$pdf->MultiCell(30,6,$column_booking,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(175);
$pdf->MultiCell(30,6,$column_nama_user,1,'C');

$pdf->Output();
?>


