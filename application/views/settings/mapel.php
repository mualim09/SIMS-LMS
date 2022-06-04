<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-8 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0"><?= $page ?></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?= base_url('gtk/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="<?= base_url('settings'); ?>">Pengaturan Aplikasi</a>
                </li>
                <li class="breadcrumb-item active"><?= $page ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-end col-md-3 col-4">
        <div class="mb-1 breadcrumb-right">
          <a href="<?= base_url('settings'); ?>" type="button" class="btn btn-sm btn-primary">
            <i data-feather='chevrons-left'></i>
            <span>Kembali</span>
          </a>
        </div>
      </div>
    </div>

    <div class="content-body">

      <!-- Data Mata Pelajaran Start -->
      <section id="SettingsMataPelajaran">
        <div class="row">
          <!-- Data Mata Pelajaran Card -->
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Mata Pelajaran</h4>
                <a href="javascript:void(0)" type="button" class="btn btn-sm btn-primary" data-bs-id="tambahData" id="tambahDataButton" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                  Tambah Data Mata Pelajaran
                </a>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahDataModal">Tambah Data Mata Pelajaran</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="validate-form" action="<?= base_url('settings/tambahMapel'); ?>" method="POST">
                      <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                          <div class="alert-body"><strong>Tips: Penulisan Mata Pelajaran Tidak Boleh Di Singkat !</strong></div>
                        </div>
                        <!-- Mata Pelajaran input -->
                        <div class="mb-1">
                          <label class="form-label" for="namaMapel">Mata Pelajaran</label>
                          <input type="text" class="form-control" id="namaMapel" placeholder="Mata Pelajaran" name="namaMapel" minlength="5" required />
                        </div>
                        <!-- Kelompok Mapel input -->
                        <div class="mb-1">
                          <label for="kelompokMapel">Kelompok</label>
                          <select class="select2 form-control" id="kelompokMapel" name="kelompokMapel">
                            <option value="Kelompok A">Kelompok A</option>
                            <option value="Kelompok B">Kelompok B</option>
                            <option value="Kelompok C">Kelompok C</option>
                            <option value="Muatan Lokal">Muatan Lokal</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Tambah Data</button>
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Reset</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <?php
              $query = "SELECT * FROM `setting_mapel` ORDER BY `id` ASC";
              $query = $this->db->query($query);
              if ($query->num_rows() <= 0) { ?>
                <div class="text-center">
                  <h3 class="text-danger">Tidak Ada Data <br> </h3>
                  <h3 class="text-danger myicon"><i data-feather='x-circle' style="width: 100;"></i></h3>
                  <h4 class="mb-3 mt-2">Silahkan Tambah Data Mata Pelajaran</h4>
                </div>
              <?php } else { ?>
                <div class="card-body">
                  <table class="dataTabel table table-hover table-responsive compact text-center" style="height: 450px;">
                    <thead>
                      <tr>
                        <th style="width: 2%;">Kelompok</th>
                        <th style="width: 5%;">Mata Pelajaran</th>
                        <th style="width: 1%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($query->result_array() as $i) {
                        $id              = $i['id'];
                        $kelompok        = $i['kelompokMapel'];
                        $mapel           = $i['namaMapel'];
                      ?>
                        <tr>
                          <td>
                            <span class="font-weight-bold"><?= $kelompok ?></span>
                          </td>
                          <td>
                            <span class="font-weight-bold"><?= $mapel ?></span>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger btn-sm" aria-expanded="false" data-id="<?= $id; ?>" data-mapel="<?= $mapel; ?>" data-kelompok="<?= $kelompok; ?>" id="hapusMapel">
                              <i data-feather="trash"></i>
                              Hapus
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                </div>
              <?php } ?>
              <!--/ Data Mata Pelajaran  Card -->

            </div>
          </div>
        </div>
      </section>
      <!-- Data Tahun Pelajaran end -->

    </div>

  </div>
</div>
<!-- END: Content-->