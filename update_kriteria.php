<!-- letakkan proses update data disini -->

<?php

if (isset($_POST['updatekriteria'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $jenis = $_POST['jenis'];

    // proses update
    $sql = "UPDATE kriteria SET nama_kriteria='$nama',bobot='$bobot',jenis_kriteria='$jenis' WHERE kode_kriteria='$kode'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=kriteria");
    }
}

// memanggil data dan memasukan kemasing-masing input
$kode = $_GET['kode_kriteria'];

$sql = "SELECT * FROM kriteria WHERE kode_kriteria='$kode'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA KRITERIA</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Kode Kriteria</label>
                            <input type="text" class="form-control" value="<?php echo $row["kode_kriteria"]?>" name="kode" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kriteria</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_kriteria"]?>" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Bobot</label>
                            <input type="number" class="form-control" value="<?php echo $row["bobot"]?>" name="bobot" min="0" max="50" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis</label>
                            <select class="form-control chosen" data-placeholder="Pilih Jenis" name="jenis">
                                <option value="<?php echo $row["jenis_kriteria"]?>"><?php echo $row["jenis_kriteria"]?></option>
                                <option value="Cost">Cost</option>
                                <option value="Benefit">Benefit</option>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" name="updatekriteria" value="Update">
                        <a class="btn btn-danger" href="?page=kriteria">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>