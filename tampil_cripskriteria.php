<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>CRIPS KRITERIA</strong></div>
  <div class="card-body">
    <a class="btn btn-primary mb-2" href="?page=cripskriteria&action=tambahcripskriteria">Tambah</a>
    <table class="table table-bordered" id="myTable">
      <thead>
        <tr align="center">
          <th width="30px">No.</th>
          <th width="100px">Kode Kriteria</th>
          <th width="100px">Nama Kriteria</th>
          <th width="300px">Keterangan</th>
          <th width="100px">Nilai Bobot</th>
          <th width="80px">Aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $i=1;
        $sql = "SELECT crips_kriteria.idkriteria,crips_kriteria.kode_kriteria,kriteria.nama_kriteria,crips_kriteria.keterangan,crips_kriteria.nilai_bobot 
                FROM kriteria INNER JOIN crips_kriteria ON kriteria.kode_kriteria=crips_kriteria.kode_kriteria ORDER BY idkriteria ASC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['kode_kriteria']; ?></td>
            <td><?php echo $row['nama_kriteria']; ?></td>
            <td><?php echo $row['keterangan']; ?></td>
            <td><?php echo $row['nilai_bobot']; ?></td>
            <td align="center">
              <a class="btn btn-warning" href="?page=cripskriteria&action=updatecripskriteria&id=<?php echo $row['idkriteria']; ?>">
                <span class="fas fa-edit"></span>
              </a>
              <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=cripskriteria&action=hapuscripskriteria&id=<?php echo $row['idkriteria']; ?>">
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