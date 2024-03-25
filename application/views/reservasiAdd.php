<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">
              Tambah Reservasi Penjemputan
            </h4>
            <?php if ($this->session->flashdata('ok')) { ?>
              <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('ok'); ?>
              </div>
            <?php } else if ($this->session->flashdata('error')) { ?>
              <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Gagal!</strong> <?php echo $this->session->flashdata('error'); ?>
              </div>
            <?php } ?>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="data">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Waktu</th>
                  <th>Act</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($data as $dt) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $dt->nama; ?><br><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
                      <td><?= $dt->waktu; ?></td>
                      <td><a href="<?= base_url('reservasi/del/' . $dt->id_reservasi) ?>" onclick="return confirm('Yakin akan dihapus ?')" class="btn btn-danger">Del</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">
              Data Santri
            </h4>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="data2">
                <thead>
                  <th>No</th>
                  <th>Santri</th>
                  <th>Act</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($santri as $dt) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><b class="text-danger"><?= $dt->nama; ?></b> - <b class="text-success"><?= $dt->k_formal . ' ' . $dt->t_formal; ?></b><br><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
                      <!-- <td><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td> -->
                      <!-- <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td> -->
                      <td><button class="btn btn-success" onclick="window.location='<?= base_url('reservasi/saveAdd/' . $dt->nis) ?>'">Pilih</button></td>
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