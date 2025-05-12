<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>KRITERIA</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=kriteria&action=tambahkriteria">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr align="center">
          <th width="100px">Kode Kriteria</th>
          <th width="200px">Nama Kriteria</th>
          <th width="100px">Bobot</th>
          <th width="100px">Jenis Kriteria</th>
          <th width="80px">Aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT*FROM kriteria ORDER BY kode_kriteria DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $row['kode_kriteria']; ?></td>
            <td><?php echo $row['nama_kriteria']; ?></td>
            <td><?php echo $row['bobot']; ?></td>
            <td><?php echo $row['jenis_kriteria']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=kriteria&action=updatekriteria&kode_kriteria=<?php echo $row['kode_kriteria']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=kriteria&action=hapuskriteria&kode_kriteria=<?php echo $row['kode_kriteria']; ?>">
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