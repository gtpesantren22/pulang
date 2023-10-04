<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data santri Kembali <i style="color: blueviolet;">Lembaga <?= $formal . ' Kelas ' . $kelas; ?></i> <i style="color: brown;">(<?= $cek_kelas_s_jml + $cek_kelas_b_jml; ?> santri)</i>
              <a href="<?= base_url('kembali'); ?>"> <button class="btn btn-outline-warning float-right btn-sm"><i class="mdi mdi-arrow-left-bold-circle-outline"></i> Kembali</button>
              </a>
            </h4>

          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data santri Kembali (<?= $cek_kelas_s_jml; ?> santri)</h4>
            <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Waktu</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($cek_kelas_s as $dt) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $dt->nama; ?></td>
                      <td><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
                      <td><?= $dt->waktu; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data santri Belum Kembali (<?= $cek_kelas_b_jml; ?> santri)</h4>
            <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($cek_kelas_b as $dt) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $dt->nama; ?></td>
                      <td><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->