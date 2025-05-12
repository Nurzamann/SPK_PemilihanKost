<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>DATA PENILAIAN KOST</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=penilaian&action=tambahpenilaian">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr align="center">
          <th width="10px">No.</th>
          <th width="40px">Kode Alternatif</th>
          <th width="100px">Nama Alternatif</th>
          <th width="50px">Tahun</th>
          <th width="50px">Harga</th>
          <th width="50px">Fasilitas</th>
          <th width="50px">Lokasi</th>
          <th width="50px">Keamanan</th>
          <th width="50px">Kebersihan</th>
          <th width="100px">Aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $i = 1;
        $sql = "SELECT penilaian.idpenilaian,alternatif_kost.code_alternatif,alternatif_kost.nama_alternatif,penilaian.tahun,penilaian.harga,penilaian.fasilitas,penilaian.lokasi,penilaian.keamanan,penilaian.kebersihan 
                FROM alternatif_kost INNER JOIN penilaian ON alternatif_kost.code_alternatif=penilaian.code_alternatif ORDER BY idpenilaian ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['code_alternatif']; ?></td>
            <td><?php echo $row['nama_alternatif']; ?></td>
            <td><?php echo $row['tahun']; ?></td>
            <td><?php echo $row['harga']; ?></td>
            <td><?php echo $row['fasilitas']; ?></td>
            <td><?php echo $row['lokasi']; ?></td>
            <td><?php echo $row['keamanan']; ?></td>
            <td><?php echo $row['kebersihan']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=penilaian&action=updatepenilaian&id=<?php echo $row['idpenilaian']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=penilaian&action=hapuspenilaian&id=<?php echo $row['idpenilaian']; ?>">
                <span class="fa fa-trash"></span>
              </a>
            </td>
          </tr>
        <?php
        }
        $conn->close();
        ?>

      </tbody>
    </table>
  </div>
</div>