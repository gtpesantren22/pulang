<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?= base_url('export/sudah'); ?>"><button class="btn btn-success">Download Data Sudah Kembali</button></a>
              <a href="<?= base_url('export/belum'); ?>"><button class="btn btn-danger">Download Data Belum Kembali</button></a>
              <a href="<?= base_url('export/telat'); ?>"><button class="btn btn-warning">Download Data Yang Terlambat</button></a>
            </h4>
          </div>
        </div>
      </div>
    </div>

    <?php
    $sqladd = '';
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Rekapan MTs</h4>
          <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
          <div class="row">
            <div class="col-9">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="">
                  <thead>
                    <tr>
                      <?php
                      foreach ($kelasDataMTs as $dt) : ?>
                        <th colspan="2">
                          <center><?= $dt->k_formal; ?></center>
                        </th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                      foreach ($kelasDataMTs as $dt) : ?>
                        <th style="background-color: green; color: white; text-align: center;">SDH</th>
                        <th style="background-color: red; color: white; text-align: center;">BLM</th>
                      <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      foreach ($kelasDataMTs as $dt) :
                        $kls = $dt->k_formal;
                        $sd = $this->db->query("SELECT a.* FROM kembali a JOIN tb_santri b ON a.nis=b.nis WHERE b.jkl = 'Laki-laki' AND b.aktif = 'Y' AND b.k_formal = '$kls' AND t_formal = 'MTs' ")->num_rows();
                        $bl = $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND k_formal = '$kls' AND t_formal = 'MTs' ")->num_rows();
                      ?>
                        <td style="background-color: green; color: white; text-align: center;"><?= $sd; ?></td>
                        <td style="background-color: red; color: white; text-align: center;"><?= $bl - $sd; ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-3">
              <?php
              $mts = $this->db->query("SELECT * FROM tb_santri WHERE t_formal = 'MTs' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              $mtsSd = $this->db->query("SELECT * FROM tb_santri a JOIN kembali b ON a.nis=b.nis WHERE t_formal = 'MTs' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              ?>
              <strong style="color: green;">Sudah Kembali : <?= $mtsSd; ?> santri</strong><br>
              <strong style="color: red;">Belum Kembali : <?= $mts - $mtsSd; ?> santri</strong>
            </div>
          </div>

        </div>

        <div class="card-body">
          <h4 class="card-title">Data Rekapan SMP</h4>
          <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
          <div class="row">
            <div class="col-9">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="">
                  <thead>
                    <tr>
                      <?php
                      foreach ($kelasDataSMP as $dt) : ?>
                        <th colspan="2">
                          <center><?= $dt->k_formal; ?></center>
                        </th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                      foreach ($kelasDataSMP as $dt) : ?>
                        <th style="background-color: green; color: white; text-align: center;">SDH</th>
                        <th style="background-color: red; color: white; text-align: center;">BLM</th>
                      <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      foreach ($kelasDataSMP as $dt) :
                        $kls = $dt->k_formal;
                        $sd = $this->db->query("SELECT a.* FROM kembali a JOIN tb_santri b ON a.nis=b.nis WHERE b.jkl = 'Laki-laki' AND b.aktif = 'Y' AND b.k_formal = '$kls' AND t_formal = 'SMP' ")->num_rows();
                        $bl = $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND k_formal = '$kls' AND t_formal = 'SMP' ")->num_rows();
                      ?>
                        <td style="background-color: green; color: white; text-align: center;"><?= $sd; ?></td>
                        <td style="background-color: red; color: white; text-align: center;"><?= $bl - $sd; ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-3">
              <?php
              $SMP = $this->db->query("SELECT * FROM tb_santri WHERE t_formal = 'SMP' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              $SMPSd = $this->db->query("SELECT * FROM tb_santri a JOIN kembali b ON a.nis=b.nis WHERE t_formal = 'SMP' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              ?>
              <strong style="color: green;">Sudah Kembali : <?= $SMPSd; ?> santri</strong><br>
              <strong style="color: red;">Belum Kembali : <?= $SMP - $SMPSd; ?> santri</strong>
            </div>
          </div>
        </div>

        <div class="card-body">
          <h4 class="card-title">Data Rekapan MA</h4>
          <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
          <div class="row">
            <div class="col-9">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="">
                  <thead>
                    <tr>
                      <?php
                      foreach ($kelasDataMA as $dt) : ?>
                        <th colspan="2">
                          <center><?= $dt->k_formal; ?></center>
                        </th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                      foreach ($kelasDataMA as $dt) : ?>
                        <th style="background-color: green; color: white; text-align: center;">SDH</th>
                        <th style="background-color: red; color: white; text-align: center;">BLM</th>
                      <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      foreach ($kelasDataMA as $dt) :
                        $kls = $dt->k_formal;
                        $sd = $this->db->query("SELECT a.* FROM kembali a JOIN tb_santri b ON a.nis=b.nis WHERE b.jkl = 'Laki-laki' AND b.aktif = 'Y' AND b.k_formal = '$kls' AND t_formal = 'MA' ")->num_rows();
                        $bl = $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND k_formal = '$kls' AND t_formal = 'MA' ")->num_rows();
                      ?>
                        <td style="background-color: green; color: white; text-align: center;"><?= $sd; ?></td>
                        <td style="background-color: red; color: white; text-align: center;"><?= $bl - $sd; ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-3">
              <?php
              $MA = $this->db->query("SELECT * FROM tb_santri WHERE t_formal = 'MA' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              $MASd = $this->db->query("SELECT * FROM tb_santri a JOIN kembali b ON a.nis=b.nis WHERE t_formal = 'MA' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              ?>
              <strong style="color: green;">Sudah Kembali : <?= $MASd; ?> santri</strong><br>
              <strong style="color: red;">Belum Kembali : <?= $MA - $MASd; ?> santri</strong>
            </div>
          </div>
        </div>

        <div class="card-body">
          <h4 class="card-title">Data Rekapan SMK</h4>
          <!-- <p class="card-description">
              Add class <code>.table-striped</code>
            </p> -->
          <div class="row">
            <div class="col-9">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="">
                  <thead>
                    <tr>
                      <?php
                      foreach ($kelasDataSMK as $dt) : ?>
                        <th colspan="2">
                          <center><?= $dt->k_formal; ?></center>
                        </th>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <?php
                      foreach ($kelasDataSMK as $dt) : ?>
                        <th style="background-color: green; color: white; text-align: center;">SDH</th>
                        <th style="background-color: red; color: white; text-align: center;">BLM</th>
                      <?php endforeach; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      foreach ($kelasDataSMK as $dt) :
                        $kls = $dt->k_formal;
                        $sd = $this->db->query("SELECT a.* FROM kembali a JOIN tb_santri b ON a.nis=b.nis WHERE b.jkl = 'Laki-laki' AND b.aktif = 'Y' AND b.k_formal = '$kls' AND t_formal = 'SMK' ")->num_rows();
                        $bl = $this->db->query("SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif = 'Y' AND k_formal = '$kls' AND t_formal = 'SMK' ")->num_rows();
                      ?>
                        <td style="background-color: green; color: white; text-align: center;"><?= $sd; ?></td>
                        <td style="background-color: red; color: white; text-align: center;"><?= $bl - $sd; ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-3">
              <?php
              $SMK = $this->db->query("SELECT * FROM tb_santri WHERE t_formal = 'SMK' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              $SMKSd = $this->db->query("SELECT * FROM tb_santri a JOIN kembali b ON a.nis=b.nis WHERE t_formal = 'SMK' AND jkl = 'Laki-laki' AND aktif  = 'Y' ")->num_rows();
              ?>
              <strong style="color: green;">Sudah Kembali : <?= $SMKSd; ?> santri</strong><br>
              <strong style="color: red;">Belum Kembali : <?= $SMK - $SMKSd; ?> santri</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->