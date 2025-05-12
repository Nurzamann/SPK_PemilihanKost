<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>ALTERNATIF KOST</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=kost&action=tambahalternatif">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr align="center">
          <th width="100px">Kode Alternatif</th>
          <th width="200px">Nama Alternatif</th>
          <th width="100px">Kategori</th>
          <th width="300px">Alamat</th>
          <th width="100px">No Tlp</th>
          <th width="80px">Aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT*FROM alternatif_kost ORDER BY code_alternatif ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $row['code_alternatif']; ?></td>
            <td><?php echo $row['nama_alternatif']; ?></td>
            <td><?php echo $row['kategori']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['no_tlp']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=kost&action=updatealternatif&code_alternatif=<?php echo $row['code_alternatif']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=kost&action=hapusalternatif&code_alternatif=<?php echo $row['code_alternatif']; ?>">
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