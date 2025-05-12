<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpankriteria'])) {


    // ambil data dari inputnya 
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $jenis = $_POST['jenis'];

    // validasi
    $sql = "SELECT*FROM kriteria WHERE kode_kriteria ='$kode'";
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
        $sql = "INSERT INTO kriteria VALUES ('$kode','$nama','$bobot','$jenis')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=kriteria");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA KRITERIA</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode Kriteria</label>
                            <input type="text" class="form-control" name="kode" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Bobot</label>
                            <input type="number" class="form-control" name="bobot" min="0" max="50" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis</label>
                            <select class="form-control chosen" data-placeholder="Pilih Jenis" name="jenis">
                                <option value=""></option>
                                <option value="Cost">Cost</option>
                                <option value="Benefit">Benefit</option>
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" name="simpankriteria" value="Simpan">
                        <a class="btn btn-danger" href="?page=kriteria">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>