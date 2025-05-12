<?php

include "config.php";
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Fungsi untuk memformat tanggal dengan nama hari
    public function format_tanggal_id($tanggal)
    {
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $timestamp = strtotime($tanggal);
        $nama_hari = $hari[date('l', $timestamp)];
        $tanggal_hari = date('d', $timestamp);
        $bulan_nomor = date('n', $timestamp);
        $tahun = date('Y', $timestamp);

        return $nama_hari . ', ' . $tanggal_hari . ' ' . $bulan[$bulan_nomor] . ' ' . $tahun;
    }

    function Header()
    {
        $this->SetFont('Helvetica', 'B', 12);
        $this->Image('https://i.pinimg.com/1200x/cf/13/19/cf1319ae519fcbd7f384495dc20bae11.jpg', 10, 10, 25);

        // Set title and address
        $this->SetXY(40, 10); // X dan Y untuk posisi header
        $this->Cell(0, 10, 'SPK PEMILIHAN KOST', 0, 1, 'L');
        $this->SetXY(40, 18); // Pindahkan Y untuk teks alamat
        $this->SetFont('Helvetica', '', 10);
        $this->MultiCell(0, 6, 'Jl. Male, RT 05/RW 03, Kelurahan Kukusan, Kecamatan Beji, Kota Depok, Jawa Barat, 16425 Nomor Telepon 089661498035', 0, 'L');

        // Draw line and adjust Y for content start
        $this->SetY(35); // Set Y untuk garis
        $this->Line(10, 35, 200, 35);
        $this->Ln(10); // Spacing after header
    }

    function Footer()
    {
        $tanggal = $this->format_tanggal_id(date('Y-m-d'));

        // Save the original margin
        $originalRightMargin = $this->rMargin;

        // Set Y untuk footer
        $this->SetY(-50);

        // Set margin kanan untuk bagian footer
        $this->SetRightMargin(14);
        $this->SetFont('Helvetica', '', 10);
        $this->Cell(0, 10, 'Depok, ' . $tanggal, 0, 1, 'R');

        // Set margin kanan untuk bagian "Mengetahui"
        $this->SetRightMargin(29);
        $this->Cell(0, 5, 'Mengetahui,', 0, 1, 'R');

        // Set margin kanan untuk bagian "Admin"
        $this->SetRightMargin(34);
        $this->SetY(-15);
        $this->Cell(0, 2, 'Admin', 0, 1, 'R');

        // Restore the original margin
        $this->SetRightMargin($originalRightMargin);
    }

    // Cek apakah ada cukup ruang untuk konten berikutnya
    function CheckPageBreak($height)
    {
        if ($this->GetY() + $height > $this->PageBreakTrigger) {
            $this->AddPage();
        }
    }
}

// Inisialisasi PDF menggunakan kelas turunan PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Tabel header
$pdf->SetFont('Arial', 'B', 12);

// Judul di atas tabel
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Data Alternatif', 0, 1, 'C');
$pdf->Ln(5);

// Tabel header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(173, 216, 230); // Warna latar header
$pdf->Cell(11, 10, 'Kode', 1, 0, 'C', true);
$pdf->Cell(38, 10, 'Nama Alternatif', 1, 0, 'C', true);
$pdf->Cell(21, 10, 'Kategori', 1, 0, 'C', true);
$pdf->Cell(91, 10, 'Alamat', 1, 0, 'C', true);
$pdf->Cell(29, 10, 'Nomor Telepon', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 9);

$no = 1;
$sql = "SELECT * FROM alternatif_kost ORDER BY code_alternatif ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(11, 10, $row['code_alternatif'], 1, 0, 'C');
    $pdf->Cell(38, 10, $row['nama_alternatif'], 1, 0, 'L');
    $pdf->Cell(21, 10, $row['kategori'], 1, 0, 'L');
    $pdf->Cell(91, 10, $row['alamat'], 1, 0, 'L');
    $pdf->Cell(29, 10, $row['no_tlp'], 1, 1, 'L');
}

$pdf->Output("Laporan_Alternatif.pdf", "I");
exit;
