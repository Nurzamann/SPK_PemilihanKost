<!-- letakkan proses update data disini -->

<?php

$id = $_GET['id'];

if (isset($_POST['updatecripskriteria'])) {
    $keterangan = $_POST['keterangan'];
    $nbobot = $_POST['nbobot'];

    // proses update
    $sql = "UPDATE crips_kriteria SET keterangan='$keterangan',nilai_bobot='$nbobot' WHERE idkriteria='$id' ";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=cripskriteria");
    }
}

// memanggil data dan memasukan kemasing-masing input

$sql = "SELECT crips_kriteria.idkriteria,crips_kriteria.kode_kriteria,kriteria.nama_kriteria,crips_kriteria.keterangan,crips_kriteria.nilai_bobot 
                FROM kriteria INNER JOIN crips_kriteria ON kriteria.kode_kriteria=crips_kriteria.kode_kriteria WHERE idkriteria='$id' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA CRIPS KRITERIA</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Kode Kriteria</label>
                            <input type="text" class="form-control" value="<?php echo $row["kode_kriteria"] ?>" name="kode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kriteria</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_kriteria"] ?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" value="<?php echo $row["keterangan"] ?>" name="keterangan" maxlength="500" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nilai Bobot</label>
                            <input type="number" class="form-control" value="<?php echo $row["nilai_bobot"] ?>" name="nbobot" min="0" max="5" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="updatecripskriteria" value="Update">
                        <a class="btn btn-danger" href="?page=cripskriteria">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>