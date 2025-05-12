<?php

include "config.php";
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Fungsi untuk memformat tanggal
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
            12 => 'Desember',
        ];

        $timestamp = strtotime($tanggal);
        $nama_hari = $hari[date('l', $timestamp)];
        $tanggal_hari = date('d', $timestamp);
        $bulan_nomor = date('n', $timestamp);
        $tahun = date('Y', $timestamp);

        return $nama_hari . ', ' . $tanggal_hari . ' ' . $bulan[$bulan_nomor] . ' ' . $tahun;

    }

    // Fungsi untuk memperbaiki karakter khusus
    public function fix_special_characters($text)
    {
        $replacements = [
            '–' => '-',       // En dash ke hyphen
            '≤' => '<=',
            '≥' => '>=',
            '“' => '"',
            '”' => '"',
            '‘' => "'",
            '’' => "'",
            '…' => '...',
        ];
        return mb_convert_encoding(str_replace(array_keys($replacements), array_values($replacements), $text), 'ISO-8859-1', 'UTF-8');
    }

    function Header()
    {
        $this->SetFont('Helvetica', 'B', 12);
        $this->Image('https://i.pinimg.com/1200x/cf/13/19/cf1319ae519fcbd7f384495dc20bae11.jpg', 10, 10, 25);

        // Set title and address
        $this->SetXY(40, 10); // X dan Y untuk posisi header
        $this->Cell(0, 10, $this->fix_special_characters('SPK PEMILIHAN KOST'), 0, 1, 'L');
        $this->SetXY(40, 18); // Pindahkan Y untuk teks alamat
        $this->SetFont('Helvetica', '', 10);
        $this->MultiCell(0, 6, $this->fix_special_characters('Jl. Male, RT 05/RW 03, Kelurahan Kukusan, Kecamatan Beji, Kota Depok, Jawa Barat, 16425 Nomor Telepon 089661498035'), 0, 'L');

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
$pdf->Cell(0, 10, $pdf->fix_special_characters('Data Crips Kriteria'), 0, 1, 'C');
$pdf->Ln(5);

// Tabel header
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(173, 216, 230); // Warna latar header
$pdf->Cell(10, 10, $pdf->fix_special_characters('No. '), 1, 0, 'C', true);
$pdf->Cell(26, 10, $pdf->fix_special_characters('Kode Kriteria'), 1, 0, 'C', true);
$pdf->Cell(30, 10, $pdf->fix_special_characters('Nama Kriteria'), 1, 0, 'C', true);
$pdf->Cell(95, 10, $pdf->fix_special_characters('Keterangan'), 1, 0, 'C', true);
$pdf->Cell(29, 10, $pdf->fix_special_characters('Nilai Bobot'), 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 9);

$no = 1;
$sql = "SELECT crips_kriteria.idkriteria, crips_kriteria.kode_kriteria, kriteria.nama_kriteria, crips_kriteria.keterangan, crips_kriteria.nilai_bobot 
        FROM kriteria 
        INNER JOIN crips_kriteria ON kriteria.kode_kriteria = crips_kriteria.kode_kriteria 
        ORDER BY idkriteria ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $pdf->CheckPageBreak(40);
    $pdf->Cell(10, 10, $pdf->fix_special_characters($row['idkriteria']), 1, 0, 'C');
    $pdf->Cell(26, 10, $pdf->fix_special_characters($row['kode_kriteria']), 1, 0, 'C');
    $pdf->Cell(30, 10, $pdf->fix_special_characters($row['nama_kriteria']), 1, 0, 'C');
    $pdf->Cell(95, 10, $pdf->fix_special_characters($row['keterangan']), 1, 0, 'L');
    $pdf->Cell(29, 10, $pdf->fix_special_characters($row['nilai_bobot']), 1, 1, 'C');
}

$pdf->Output("Laporan_Crips.pdf", "I");
exit;
