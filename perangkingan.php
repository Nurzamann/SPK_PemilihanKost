<!-- Proses Perangkingan -->
<?php

if (isset($_POST['proses'])) {

    $tahun = $_POST['tahun'];

    $sql = "SELECT*FROM penilaian WHERE tahun='$tahun' ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        // Mencari nilai min dan max
        $sql = "SELECT min(harga) as mharga, max(fasilitas) as mfasilitas, max(lokasi) as mlokasi, max(keamanan) as mkeamanan, max(kebersihan) as mkebersihan FROM penilaian WHERE tahun='$tahun'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $mharga = $row["mharga"];
        $mfasilitas = $row["mfasilitas"];
        $mlokasi = $row["mlokasi"];
        $mkeamanan = $row["mkeamanan"];
        $mkebersihan = $row["mkebersihan"];

        // proses normalisasi

        $sql = "SELECT*FROM penilaian WHERE tahun='$tahun' ";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {

            // Mengambil data penilaian

            $idpenilaian = $row["idpenilaian"];
            $harga = $row["harga"];
            $fasilitas = $row["fasilitas"];
            $lokasi = $row["lokasi"];
            $keamanan = $row["keamanan"];
            $kebersihan = $row["kebersihan"];

            // Hitung normalisasi

            $nharga = $mharga / $harga;
            $nfasilitas = $fasilitas / $mfasilitas;
            $nlokasi = $lokasi / $mlokasi;
            $nkeamanan = $keamanan / $mkeamanan;
            $nkebersihan = $kebersihan / $mkebersihan;

            // hitung nilai perangkingan

            $preferensi = ($nharga * 30) + ($nfasilitas * 20) + ($nlokasi * 15) + ($nkeamanan * 20) + ($nkebersihan * 15);

            // Simpan data Perangkingan

            $sql = "INSERT INTO perangkingan VALUES (Null,'$idpenilaian','$nharga','$nfasilitas','$nlokasi','$nkeamanan','$nkebersihan','$preferensi')";
            if ($conn->query($sql) === TRUE) {
                header("Location:?page=perangkingan&thn=$tahun");
            }
        }
    } else {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Data Tidak ditemukan</strong>
        </div>
<?php
    }
}
?>

<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>DATA PERANGKINGAN</strong></div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Tahun</label>
                <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                    <option value=""></option>
                    <?php
                    for ($x = date("Y"); $x >= 2020; $x--) {
                    ?>
                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <input class="btn btn-primary mb-2 " type="submit" name="proses" value="Proses">
        </form>

        <table class="table table-bordered" id="myTable">
            <thead>
                <tr align="center">
                    <th width="10px">Rangking</th>
                    <th width="40px">Kode Alternatif</th>
                    <th width="70px">Nama Alternatif</th>
                    <th width="50px">n_Harga</th>
                    <th width="200px">n_Fasilitas</th>
                    <th width="50px">n_Lokasi</th>
                    <th width="50px">n_Keamanan</th>
                    <th width="50px">n_Kebersihan</th>
                    <th width="80px">Preferensi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 1;
                $sql = "SELECT perangkingan.rangking,penilaian.idpenilaian,penilaian.code_alternatif,
                alternatif_kost.nama_alternatif,perangkingan.n_harga,perangkingan.n_fasilitas,perangkingan.n_lokasi,perangkingan.n_keamanan,perangkingan.n_kebersihan,perangkingan.preferensi
                FROM perangkingan 
                INNER JOIN penilaian ON perangkingan.idpenilaian=penilaian.idpenilaian 
                INNER JOIN alternatif_kost ON penilaian.code_alternatif=alternatif_kost.code_alternatif ORDER BY preferensi DESC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['code_alternatif']; ?></td>
                        <td><?php echo $row['nama_alternatif']; ?></td>
                        <td><?php echo $row['n_harga']; ?></td>
                        <td><?php echo $row['n_fasilitas']; ?></td>
                        <td><?php echo $row['n_lokasi']; ?></td>
                        <td><?php echo $row['n_keamanan']; ?></td>
                        <td><?php echo $row['n_kebersihan']; ?></td>
                        <td><?php echo $row['preferensi']; ?></td>

                    </tr>
                <?php
                }
                $conn->close();
                ?>

            </tbody>
        </table>
    </div>
</div>