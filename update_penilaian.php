<!-- letakkan proses update data disini -->

<?php

$id = $_GET['id'];

if (isset($_POST['updatepenilaian'])) {
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];
    $keamanan = $_POST['keamanan'];
    $kebersihan = $_POST['kebersihan'];

    // proses update
    $sql = "UPDATE penilaian SET tahun='$tahun',harga='$harga',fasilitas='$fasilitas',lokasi='$lokasi',keamanan='$keamanan',kebersihan='$kebersihan' WHERE idpenilaian='$id' ";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penilaian");
    }
}

// memanggil data dan memasukan kemasing-masing input

$sql = "SELECT penilaian.idpenilaian,alternatif_kost.code_alternatif,alternatif_kost.nama_alternatif,penilaian.tahun,penilaian.harga,penilaian.fasilitas,penilaian.lokasi,penilaian.keamanan,penilaian.kebersihan 
                FROM alternatif_kost INNER JOIN penilaian ON alternatif_kost.code_alternatif=penilaian.code_alternatif WHERE idpenilaian='$id' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA PENILAIAN</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Kode Alternatif</label>
                            <input type="text" class="form-control" value="<?php echo $row["code_alternatif"] ?>" name="kode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Alternatif</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_alternatif"] ?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" value="<?php echo $row["tahun"] ?>" name="tahun" maxlength="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" name="harga" min="0" max="5" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Fasilitas</label>
                            <input type="number" class="form-control" name="fasilitas" min="0" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                            <input type="number" class="form-control" name="lokasi" min="0" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keamanan</label>
                            <input type="number" class="form-control" name="keamanan" min="0" max="5" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kebersihan</label>
                            <input type="number" class="form-control" name="kebersihan" min="0" max="5" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="updatepenilaian" value="Update">
                        <a class="btn btn-danger" href="?page=penilaian">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>