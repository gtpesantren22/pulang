<?php $this->load->view('head'); ?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">
              Data Reservasi Penjemputan
              <button class="btn btn-primary float-right btn-sm" onclick="window.location='<?= base_url('reservasi/add') ?>'"><i class="mdi mdi-plus-circle"></i> Tambah Data</button>
            </h4>
            <br>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="dataIsi">
                <thead>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Kelas</th>
                  <th>Waktu</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <?php $this->load->view('foot'); ?>

    <script>
      $(document).ready(function() {
        loadData();
      });

      setInterval(loadData, 2000);

      function loadData() {
        $.ajax({
          url: "<?= base_url('reservasi/getAll'); ?>",
          type: "GET",
          dataType: "json",
          success: function(response) {
            $('#dataIsi tbody').empty();
            const no = 1;
            // Tambahkan baris baru ke tabel
            $.each(response.data, function(index, row) {
              var newRow = '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + row.nis + '</td>' +
                '<td>' + row.nama + '</td>' +
                '<td>' + row.desa + ' - ' + row.kec + ' - ' + row.kab + '</td>' +
                '<td>' + row.k_formal + ' ' + row.t_formal + '</td>' +
                '<td>' + row.waktu + '</td>' +
                '</tr>';
              $('#dataIsi tbody').append(newRow);
            });
          }
        })
      };
    </script>

    <!-- <?php $no = 1;
          foreach ($data as $dt) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $dt->nis; ?></td>
        <td><?= $dt->nama; ?></td>
        <td><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
        <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td>
        <td><?= $dt->waktu; ?></td>
      </tr>
    <?php endforeach; ?> -->