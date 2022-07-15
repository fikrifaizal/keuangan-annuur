<?php
require_once('../../config.php');
require_once('../../helper.php');

// ambil data setelah search
if(!empty($_GET['start']) && !empty($_GET['end'])){
  $getStartDate = $_GET['start'];
  $getEndDate = $_GET['end'];

  $query = "SELECT * FROM `keuangan_masjid` WHERE (`tanggal` BETWEEN '$getStartDate' AND '$getEndDate') ORDER BY `tanggal`";
} else {
  $query = "SELECT * FROM `keuangan_masjid` ORDER BY `tanggal`";
}

// connect & query database
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <!-- table -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-table">
      <thead class="table-secondary">
        <tr class="text-center align-middle">
          <th scope="col">#</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Kas Masuk</th>
          <th scope="col">Kas Keluar</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $count = 1;
          $uangMasuk = 0;
          $uangKeluar = 0;

          // fetch data menjadi array asosisasi
          while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $uangMasuk = $uangMasuk+intval($data['masuk']);
            $uangKeluar = $uangKeluar+intval($data['keluar']);

            // tabel
            echo "<tr class='text-center align-middle'><td>".$count++."</td>";
            echo "<td>".customDateFormat($data['tanggal'])."</td>";
            echo "<td class='text-start'>".$data['keterangan']."</td>";
            if($data['masuk'] != 0) {
              echo "<td>".setIDRFormat($data['masuk'])."</td>";
              echo "<td></td>";
            } else {
              echo "<td></td>";
              echo "<td>".setIDRFormat($data['keluar'])."</td>";
            } ?>

            <td>
              <!-- button edit -->
              <a href="/user/bendahara/keuangan/action/edit.php?kid=<?= $data['id']?>" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                <span><i class="bi bi-pencil"></i></span>
              </a>
              <!-- button hapus -->
              <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" data-bs-toggle="modal" data-bs-target="#hapusModal<?=$data['id']?>">
                <span><i class="bi bi-trash"></i></span>
              </button>
            </td>

            <!-- Modal Delete -->
            <div class="modal fade" tabindex="-1" id="hapusModal<?=$data['id']?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Peringatan!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <span>Apakah anda yakin untuk menghapus data ini?</span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <a href="/user/bendahara/keuangan/action/delete.php?kid=<?= $data['id']?>" class="btn btn-danger">
                      <span>Hapus</span>
                    </a>
                  </div>
                </div>
              </div>
            </div><?php
          }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="fw-bold">Jumlah</td>
          <td class='text-center align-middle'><?= setIDRFormat($uangMasuk)?></td>
          <td class='text-center align-middle'><?= setIDRFormat($uangKeluar)?></td>
        </tr>
        <tr>
          <td colspan="3" class="fw-bold">Saldo Saat Ini</td>
          <td colspan="2" class='text-center align-middle'>Rp <?= number_format($uangMasuk-$uangKeluar,0,'.','.')?></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</html>