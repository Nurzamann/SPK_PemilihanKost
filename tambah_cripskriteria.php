<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpancripskriteria'])) {


    // ambil data dari inputnya 
    $kode = $_POST['kode'];
    $keterangan = $_POST['keterangan'];
    $nbobot = $_POST['nbobot'];

    // validasi
    $sql = "SELECT*FROM crips_kriteria WHERE keterangan ='$keterangan'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Keterangan Sudah Digunakan</strong>
        </div>
<?php
    } else {
        //proses simpan
        $sql = "INSERT INTO crips_kriteria VALUES (Null,'$kode','$keterangan','$nbobot')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=cripskriteria");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA CRIPS KRITERIA</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode Kriteria</label>
                            <select class="form-control chosen" data-placeholder="Pilih Kode Kriteria" name="kode">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM kriteria ORDER BY kode_kriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['kode_kriteria']; ?>"><?php echo $row['kode_kriteria'] . " - " .$row['nama_kriteria']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" maxlength="500" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nilai Bobot</label>
                            <input type="number" class="form-control" name="nbobot" min="0" max="5" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpancripskriteria" value="Simpan">
                        <a class="btn btn-danger" href="?page=cripskriteria">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>