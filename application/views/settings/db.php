<!-- BEGIN: Content-->
<div class="app-content content">
  <!-- <div class="content-overlay"></div> -->
  <!-- <div class="header-navbar-shadow"></div> -->
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

      <div class="row" hidden>
        <div class=" col-12">
          <div class="alert alert-primary" role="alert">
            <div class="alert-body"><strong>Info:</strong></div>
          </div>
        </div>
      </div>


    </div>

  </div>
</div>
<!-- END: Content-->