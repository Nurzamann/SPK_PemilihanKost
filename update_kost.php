<!-- letakkan proses update data disini -->

<?php

if (isset($_POST['updatealternatif'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telepon'];

    // proses update
    $sql = "UPDATE alternatif_kost SET nama_alternatif='$nama',kategori='$kategori',alamat='$alamat',no_tlp='$telp' WHERE code_alternatif='$kode'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=kost");
    }
}

// memanggil data dan memasukan kemasing-masing input
$kode = $_GET['code_alternatif'];

$sql = "SELECT * FROM alternatif_kost WHERE code_alternatif='$kode'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA ALTERNATIF KOST</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Kode ALternatif</label>
                            <input type="text" class="form-control" value="<?php echo $row["code_alternatif"]?>" name="kode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Alternatif</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_alternatif"]?>" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control chosen" data-placeholder="Pilih Kategori" name="kategori">
                                <option value="<?php echo $row["kategori"]?>"><?php echo $row["kategori"]?></option>
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
                                <option value="Putra & Putri">Putra & Putri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" value="<?php echo $row["alamat"]?>" name="alamat" maxlength="500" required>
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="text" class="form-control" value="<?php echo $row["no_tlp"]?>" name="telepon" maxlength="100" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="updatealternatif" value="Update">
                        <a class="btn btn-danger" href="?page=kost">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>