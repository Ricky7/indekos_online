<?php
include "../class/Connect.php";

// format mata uang
$jumlah_desimal = "0";
$pemisah_desimal = ",";
$pemisah_ribuan = ".";

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d H:i:s');

$tgl_awal = $_POST['from'];
$tgl_akhir = $_POST['to'];


if($_POST['from'] != NULL && $_POST['to'] != NULL) {

    $tgl_awal = $_POST['from'];
    $tgl_akhir = $_POST['to'];
    $tgl = $tgl_awal.' - '.$tgl_akhir;
	$query = "SELECT tbl_indekos.judul, tbl_seller.nama as nama_seller, tbl_user.nama as nama_user, tbl_booking.pajak FROM tbl_indekos INNER JOIN tbl_booking INNER JOIN tbl_seller INNER JOIN tbl_user ON (tbl_booking.id_indekos = tbl_indekos.id_indekos) AND (tbl_booking.id_penjual = tbl_seller.id_seller) AND (tbl_booking.id_pembeli = tbl_user.id_user) WHERE date(tbl_booking.tgl_booking) BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND tbl_booking.status_booking = 'COMPLETED'";
	$stmt = $db->prepare($query);
	$stmt->execute();
} else {
	$tgl = "Keseluruhan";
    $query = "SELECT tbl_indekos.judul, tbl_seller.nama as nama_seller, tbl_user.nama as nama_user, tbl_booking.pajak FROM tbl_indekos INNER JOIN tbl_booking INNER JOIN tbl_seller INNER JOIN tbl_user ON (tbl_booking.id_indekos = tbl_indekos.id_indekos) AND (tbl_booking.id_penjual = tbl_seller.id_seller) AND (tbl_booking.id_pembeli = tbl_user.id_user) WHERE tbl_booking.status_booking = 'COMPLETED' ORDER BY tbl_booking.id_booking ASC";
	$stmt = $db->prepare($query);
	$stmt->execute();
}

require_once("../dompdf/dompdf_config.inc.php");

$total_pajak = 0;

$judul = "";
$seller = "";
$buyer = "";
$pajak = "";

$html = '<h3 align="center">Laporan Keuntungan</h3><br><br>
			<div>Tanggal : '.$tgl.'</div><br>
			<table style="width:100%;" border="1" color="black">
			  <tr>
			  	<th width="55%">Judul Produk</th>
			  	<th width="15%">Pengiklan</th>
			  	<th width="15%">Pemesan</th>
			  	<th width="15%">Pajak</th>
			  </tr>';
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	$judul = $row["judul"];
	$seller = $row["nama_seller"];
	$buyer = $row["nama_user"];
	$pajak = $row["pajak"];
	$total_pajak += $row["pajak"];
	$html .= '<tr>
			  	<td width="55%">'.$judul.'</td>
			  	<td width="15%">'.$seller.'</td>
			  	<td width="15%">'.$buyer.'</td>
			  	<td width="15%">Rp. '.number_format($pajak,$jumlah_desimal,$pemisah_desimal,$pemisah_ribuan).'</td>
			  </tr>';
}
$html .= '<tr>
			<td colspan="2" align="center">Sub Total</td>
			<td colspan="2" align="center">Rp. '.number_format($total_pajak,$jumlah_desimal,$pemisah_desimal,$pemisah_ribuan).'</td>
		  </tr>';
$html .= '</table>';
//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper('a4','portrait');
$dompdf->load_html(html_entity_decode($html));
$dompdf->render();
$dompdf->stream(
  'laporan_keuntungan.pdf',
  array(
    'Attachment' => 0
  )
);
?>