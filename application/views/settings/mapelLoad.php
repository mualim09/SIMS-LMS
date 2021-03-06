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
                  <input type="text" class="form-control" id="namaMapel" placeholder="Mata Pelajaran" name="namaMapel" minlength="5" data-msg="Masukan Nama Mata Pelajaran" required />
                </div>
                <!-- Kelompok Mapel input -->
                <div class="mb-1">
                  <label for="kelompokMapel">Kelompok</label>
                  <select class="select2 hide-search form-control" placeholder="Pilih" id="kelompokMapel" name="kelompokMapel" data-placeholder="Pilih Kelompok" data-msg="Pilih Kelompok Mata Pelajaran" required>
                    <option></option>
                    <optgroup label="Pilih Kelompok">
                      <option value="Kelompok A">Kelompok A</option>
                      <option value="Kelompok B">Kelompok B</option>
                      <option value="Kelompok C">Kelompok C</option>
                      <option value="Muatan Lokal">Muatan Lokal</option>
                    </optgroup>
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
      $query = getSelect('setting_mapel', '*', 'id', 'asc');
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
<script src="<?= base_url('assets/'); ?>assets/js/scripts.js"></script>
<script>
  if (feather) {
    feather.replace({
      width: 14,
      height: 14
    });
  }

  $('.dataTabel').DataTable({
    "order": [
      [0, "asc"]
    ],
    "autoWidth": true,
    pageLength: 10,
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
    }
  });

  var select2 = $('.select2');
  if (select2.length) {
    select2.each(function() {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }

  var hideSearch = $('.hide-search');
  hideSearch.select2({
    placeholder: "Pilih",
    minimumResultsForSearch: Infinity
  });
</script>