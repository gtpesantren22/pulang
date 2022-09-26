<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data Santri Putri</h4>
            <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered" id="data">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Formal</th>
                  <th>Madin</th>
                  <th>Kamar</th>
                  <th>Act</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($pi as $dt) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $dt->nama; ?></td>
                      <td><?= $dt->desa . '-' . $dt->kec . '-' . $dt->kab; ?></td>
                      <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td>
                      <td><?= $dt->k_madin . ' ' . $dt->r_madin; ?></td>
                      <td><?= $dt->kamar . ' / ' . $dt->komplek; ?></td>
                      <td><button class="btn btn-primary">Detail</button></td>
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