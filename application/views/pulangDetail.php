<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Absensi Pulang Liburan</h3>
            <h6 class="font-weight-normal mb-0">Aplikasi Absensi Pulang Santri PP. Darul Lughah Wal Karomah </h6>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="mdi mdi-calendar"></i> Hari ini (<?= date('d M Y'); ?>)
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-success btn-sm float-right" onclick="window.location='<?= base_url('pulang/exportSudah') ?>'">Export Excel</button>
            <button class="btn btn-warning btn-sm float-right" onclick="window.location='<?= base_url('pulang') ?>'">Kembali</button>
            <h4 class="card-title mt-3">Data yang sudah pulang</h4>
            <div class="table-responsive">
              <table class="table table-sm" id="data4">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Waktu pulang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($sudah as $dt) :
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $dt->nama; ?></td>
                      <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td>
                      <td><?= $dt->waktu; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table table-sm" id="data3">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Waktu pulang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($belum as $dt) :
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $dt->nama; ?></td>
                      <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td>
                      <td><?= 'belum'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- content-wrapper ends -->

  <!-- <script type="application/javascript">
    /** After windod Load */
    $(window).bind("load", function() {
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
          $(this).remove();
        });
      }, 500);
    });
  </script> -->