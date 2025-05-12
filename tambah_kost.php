<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpanalternatif'])) {


    // ambil data dari inputnya 
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telepon'];

    // validasi
    $sql = "SELECT*FROM alternatif_kost WHERE code_alternatif ='$kode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Kode Sudah Digunakan</strong>
        </div>
<?php
    } else {
        //proses simpan
        $sql = "INSERT INTO alternatif_kost VALUES ('$kode','$nama','$kategori','$alamat','$telp')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=kost");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA ALTERNATIF KOST</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode Alternatif</label>
                            <input type="text" class="form-control" name="kode" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Alternatif</label>
                            <input type="text" class="form-control" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control chosen" data-placeholder="Pilih Kategori" name="kategori">
                                <option value=""></option>
                                <option value="Putra">Putra</option>
                                <option value="Putra">Putri</option>
                                <option value="Putra & Putri">Putra & Putri</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" maxlength="500" required>
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input type="text" class="form-control" name="telepon" maxlength="100" required>
                        </div>
                        <input class="btn btn-primary" type="submit" name="simpanalternatif" value="Simpan">
                        <a class="btn btn-danger" href="?page=kost">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>