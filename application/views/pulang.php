<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Absensi Pulang Santri</h3>
                        <h6 class="font-weight-normal mb-0">Aplikasi Absensi Pulang Santri PP. Darul Lughah Wal Karomah
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Hari ini (<?= date('d M Y'); ?>)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Scan KTS dibawah ini !</h4>
                        <?php if ($this->session->flashdata('yes')) { ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('yes'); ?>
                        </div>
                        <?php } else if ($this->session->flashdata('wrong')) { ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Gagal!</strong> <?php echo $this->session->flashdata('wrong'); ?>
                        </div>
                        <?php } ?>
                        <?= form_open('pulang/add') ?>
                        <div class="form-group">
                            <input type="text" name="nis" class="form-control" id="exampleInputUsername1"
                                placeholder="Scan KTS" autofocus required>
                        </div>

                        <?= form_close(); ?>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sudah as $dt) : ?>
                                <tr>
                                    <td><?= $dt->nama; ?></td>
                                    <td><?= $dt->k_formal . ' ' . $dt->t_formal; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">

                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Data Santri MTS (<?= $mts_data; ?> santri)</p>
                                <p style="font-size: 25px;" class="fs-30 mb-3">S : <?= $mts_data_ambil; ?> / B :
                                    <?= $mts_data - $mts_data_ambil; ?></p>
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Cek Data Perkelas
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <?php foreach ($mts_kelas as $dt) : ?>
                                        <a class="dropdown-item"
                                            href="<?= base_url('cek2/kelas/MTs/') . $dt->k_formal; ?>">Kelas
                                            <?= $dt->k_formal; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Data Santri SMP (<?= $smp_data; ?> santri)</p>
                                <p style="font-size: 25px;" class="fs-30 mb-3">S : <?= $smp_data_ambil; ?> / B :
                                    <?= $smp_data - $smp_data_ambil; ?></p>
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Cek Data Perkelas
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <?php foreach ($smp_kelas as $dt) : ?>
                                        <a class="dropdown-item"
                                            href="<?= base_url('cek2/kelas/SMP/') . $dt->k_formal; ?>">Kelas
                                            <?= $dt->k_formal; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Data Santri MA (<?= $ma_data; ?> santri)</p>
                                <p style="font-size: 25px;" class="fs-30 mb-3">S : <?= $ma_data_ambil; ?> / B :
                                    <?= $ma_data - $ma_data_ambil; ?></p>
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Cek Data Perkelas
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <?php foreach ($ma_kelas as $dt) : ?>
                                        <a class="dropdown-item"
                                            href="<?= base_url('cek2/kelas/MA/') . $dt->k_formal; ?>">Kelas
                                            <?= $dt->k_formal; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Data Santri SMK (<?= $smk_data; ?> santri)</p>
                                <p style="font-size: 25px;" class="fs-30 mb-3">S : <?= $smk_data_ambil; ?> / B :
                                    <?= $smk_data - $smk_data_ambil; ?></p>
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Cek Data Perkelas
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <?php foreach ($smk_kelas as $dt) : ?>
                                        <a class="dropdown-item"
                                            href="<?= base_url('cek2/kelas/SMK/') . $dt->k_formal; ?>">Kelas
                                            <?= $dt->k_formal; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

    <script type="application/javascript">
    /** After windod Load */
    $(window).bind("load", function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 500);
    });
    </script>