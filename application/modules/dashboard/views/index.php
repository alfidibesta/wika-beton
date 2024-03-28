<section id="dashboard-analytics">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card bg-analytics text-white">
          <div class="card-content">
            <div class="card-body text-center">
              <img src="<?= base_url() ?>assets/app-assets/images/elements/decore-left.png" class="img-left" alt="card-img-left">
              <img src="<?= base_url() ?>assets/app-assets/images/elements/decore-right.png" class="img-right" alt="card-img-right">
              <div class="avatar avatar-xl bg-primary shadow mt-0">
                <div class="avatar-content">
                  <i class="feather icon-award white font-large-1"></i>
                </div>
              </div>
              <div class="text-center">
                <h1 class="mb-2 text-white">Welcome <?= profile('name') ?>,</h1>
                <p class="m-auto w-75">Selamat datang di admin panel <strong><?= $company[0]['name_company'] ?></strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row match-height">
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">Data Deadline</h4>
            </div>
            <div class="card">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Deadline</th>
                              <th>Hari</th>
                              <th>No Penawaran</th>
                              <th>Nama Pelanggan</th>
                              <th>Nama Perusahaan</th>
                              <th>Nama Proyek</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach ($data_deadline as $key => $data):
                          $today = new DateTime();
                          $deadline = new DateTime($data->deadline);
                          $diff = $today->diff($deadline)->format("%R%a days");
                          $diff_cons = $today->diff($deadline)->days;
                          if ($diff_cons <= 7) {
                      ?>
                      <tr>
                          <td><?php echo $data->id; ?></td>
                          <td><?php echo date('d-m-Y', strtotime($data->deadline)); ?></td>
                          <td><?php echo $diff; ?></td>
                          <td><?php echo $data->no_penawaran; ?></td>
                          <td><?php echo $data->pelanggan; ?></td>
                          <td><?php echo $data->nama_perusahaan; ?></td>
                          <td><?php echo $data->nama_proyek; ?></td>
                          <td>
                            <a href="<?php echo base_url('cpanel/rfq_request/detail/') . $data->id; ?>" class="btn-sm btn-primary"> <b>></b> </a>
                          </td>
                      </tr>
                      <?php
                          }
                      endforeach;
                      ?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row match-height">
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">Grafik Pembuatan SPH Per Bulan</h4>
              <div class="form-group">
                <select name="tahun" id="tahun" class="form-control" onchange="grafik()">
                    <?php
                    $current_year = date('Y');
                    foreach ($data_year as $data):
                        ?>
                        <option value="<?= $data->year ?>" <?= ($data->year == $current_year) ? 'selected' : '' ?>>
                            <?= $data->year ?>
                        </option>
                    <?php endforeach; ?>
                </select>

              </div>
            </div>
            <div class="init-loading grafik" style="height:400px;width:100%;"></div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
</div>
</div>