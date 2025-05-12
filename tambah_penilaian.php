<!-- letakkan proses tambah data disini -->
<?php

if (isset($_POST['simpanpenilaian'])) {


    // ambil data dari inputnya 
    $kode = $_POST['kode'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];
    $keamanan = $_POST['keamanan'];
    $kebersihan = $_POST['kebersihan'];

    // validasi
    $sql = "SELECT*FROM penilaian WHERE code_alternatif ='$kode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Kode Alternatif Sudah Digunakan</strong>
        </div>
<?php
    } else {
        //proses simpan
        $sql = "INSERT INTO penilaian VALUES (Null,'$kode','$tahun','$harga','$fasilitas','$lokasi','$keamanan','$kebersihan')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penilaian");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA PENILAIAN</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Kode Alternatif</label>
                            <select class="form-control chosen" data-placeholder="Pilih Kode Alternatif" name="kode">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM alternatif_kost ORDER BY code_alternatif ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['code_alternatif']; ?>"><?php echo $row['code_alternatif'] . " - " . $row['nama_alternatif']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
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
                        <div class="form-group">
                            <label for="">Harga</label>
                            <select class="form-control chosen" data-placeholder="Pilih Bobot" name="harga">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM crips_kriteria ORDER BY idkriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nilai_bobot']; ?>"><?php echo $row['nilai_bobot'] . " - " . $row['kode_kriteria'] . " - " . $row['keterangan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Fasilitas</label>
                            <select class="form-control chosen" data-placeholder="Pilih Bobot" name="fasilitas">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM crips_kriteria ORDER BY idkriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nilai_bobot']; ?>"><?php echo $row['nilai_bobot'] . " - " . $row['kode_kriteria'] . " - " . $row['keterangan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                            <select class="form-control chosen" data-placeholder="Pilih Bobot" name="lokasi">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM crips_kriteria ORDER BY idkriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nilai_bobot']; ?>"><?php echo $row['nilai_bobot'] . " - " . $row['kode_kriteria'] . " - " . $row['keterangan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keamanan</label>
                            <select class="form-control chosen" data-placeholder="Pilih Bobot" name="keamanan">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM crips_kriteria ORDER BY idkriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nilai_bobot']; ?>"><?php echo $row['nilai_bobot'] . " - " . $row['kode_kriteria'] . " - " . $row['keterangan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kebersihan</label>
                            <select class="form-control chosen" data-placeholder="Pilih Bobot" name="kebersihan">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM crips_kriteria ORDER BY idkriteria ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nilai_bobot']; ?>"><?php echo $row['nilai_bobot'] . " - " . $row['kode_kriteria'] . " - " . $row['keterangan']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                        <input class="btn btn-primary" type="submit" name="simpanpenilaian" value="Simpan">
                        <a class="btn btn-danger" href="?page=penilaian">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>