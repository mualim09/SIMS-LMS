<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LayananPPDB extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('App_model', 'modelApp');
    $this->load->model('PPDB_Model', 'ModelPPDB');
    is_server_gtk_active();
    is_logged_in_as_gtk();
  }

  // PAGE DASBOARD
  public function index()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();
    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);

    $url_param = $this->uri->segment('3');
    $base_64 = $url_param . str_repeat('=', strlen($url_param) % 4);
    $tapel = base64_decode($base_64);

    $data['url_param']     = $tapel;
    $data['pageCollumn']   = "1-column";
    $data['page']          = "Layanan PPDB";

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('gtk/ppdb/dashboard', $data);
    $this->load->view('templates/modal', $data);
    $this->load->view('templates/footer', $data);
    $this->load->view('gtk/ppdb/ajax', $data);
  }

  function indexLoad()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();
    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);
    $page                  = $this->input->post("page");
    $this->load->view($page, $data);
  }

  public function switchAccess()
  {
    $data = [
      'id'         => htmlspecialchars($this->input->post('id', true)),
      'is_active'  => htmlspecialchars($this->input->post('is_active', true)),
    ];
    $checkData     = $this->db->get_where('ppdb_tapel', ['id' => $data['id']]);
    $row           = $checkData->row_array();
    if ($checkData->num_rows() == "1") {
      if ($data['is_active'] == "0") {
        $query = "UPDATE `ppdb_tapel` SET `is_active` = '0'";
        $this->db->query($query);
        $this->db->set('is_active', '1');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Hak Akses PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      } else {
        $query = "UPDATE `ppdb_tapel` SET `is_active` = '0'";
        $this->db->query($query);
        $this->db->set('is_active', '0');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Hak Akses PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Non-Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      }
    } elseif ($checkData->num_rows() == "0") {
      $this->session->set_flashdata('toastr', "
      <script>
      $(window).on('load', function() {
        setTimeout(function() {
          toastr['error'](
            'PPDB Tahun Pelajaran " .  $row['tapel'] . " Tidak Tersedia !',
            'Gagal !', {
              closeButton: true,
              tapToDismiss: true
            }
          );
        }, 0);
      })
      </script>");
    }
    redirect(base_url('layananPPDB/settings'));
  }

  public function switchRegistrasi1()
  {
    $data = [
      'id'              => htmlspecialchars($this->input->post('id', true)),
      'is_active_reg1'  => htmlspecialchars($this->input->post('is_active_reg1', true)),
    ];
    $checkData     = $this->db->get_where('ppdb_tapel', ['id' => $data['id']]);
    $row           = $checkData->row_array();
    if ($checkData->num_rows() == "1") {
      if ($data['is_active_reg1'] == "0") {
        $query = "UPDATE `ppdb_tapel` SET `is_active_reg1` = '0'";
        $this->db->query($query);
        $this->db->set('is_active_reg1', '1');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Registrasi PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      } else {
        $query = "UPDATE `ppdb_tapel` SET `is_active_reg1` = '0'";
        $this->db->query($query);
        $this->db->set('is_active_reg1', '0');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Registrasi PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Non-Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      }
    } elseif ($checkData->num_rows() == "0") {
      $this->session->set_flashdata('toastr', "
      <script>
      $(window).on('load', function() {
        setTimeout(function() {
          toastr['error'](
            'PPDB Tahun Pelajaran " .  $row['tapel'] . " Tidak Tersedia !',
            'Gagal !', {
              closeButton: true,
              tapToDismiss: true
            }
          );
        }, 0);
      })
      </script>");
    }
    redirect(base_url('layananPPDB/settings'));
  }

  public function switchRegistrasi2()
  {
    $data = [
      'id'              => htmlspecialchars($this->input->post('id', true)),
      'is_active_reg2'  => htmlspecialchars($this->input->post('is_active_reg2', true)),
    ];
    $checkData     = $this->db->get_where('ppdb_tapel', ['id' => $data['id']]);
    $row           = $checkData->row_array();
    if ($checkData->num_rows() == "1") {
      if ($data['is_active_reg2'] == "0") {
        $query = "UPDATE `ppdb_tapel` SET `is_active_reg2` = '0'";
        $this->db->query($query);
        $this->db->set('is_active_reg2', '1');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Daftar Ulang PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      } else {
        $query = "UPDATE `ppdb_tapel` SET `is_active_reg2` = '0'";
        $this->db->query($query);
        $this->db->set('is_active_reg2', '0');
        $this->db->where('id', $data['id']);
        $this->db->update('ppdb_tapel');
        $this->session->set_flashdata('toastr', "
        <script>
        $(window).on('load', function() {
          setTimeout(function() {
            toastr['success'](
              'Daftar Ulang PPDB Tahun Pelajaran " .  $row['tapel'] . " Di Non-Aktifkan !',
              'Berhasil !', {
                closeButton: true,
                tapToDismiss: true
              }
            );
          }, 0);
        })
        </script>");
      }
    } elseif ($checkData->num_rows() == "0") {
      $this->session->set_flashdata('toastr', "
      <script>
      $(window).on('load', function() {
        setTimeout(function() {
          toastr['error'](
            'PPDB Tahun Pelajaran " .  $row['tapel'] . " Tidak Tersedia !',
            'Gagal !', {
              closeButton: true,
              tapToDismiss: true
            }
          );
        }, 0);
      })
      </script>");
    }
    redirect(base_url('layananPPDB/settings'));
  }

  // PAGE SETTING
  public function settings()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();
    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);
    $data['pageCollumn']   = "0-column";
    $data['page']          = "Modul PPDB";

    $url_param             = $this->uri->segment('3');
    $base_64               = $url_param . str_repeat('=', strlen($url_param) % 4);
    $tapel                 = base64_decode($base_64);
    $data['url_param']     = $tapel;

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('settings/menu', $data);
    $this->load->view('gtk/ppdb/settings', $data);
    $this->load->view('templates/modal', $data);
    $this->load->view('templates/footer', $data);
    $this->load->view('gtk/ppdb/ajax', $data);
  }

  function settingsLoad()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();

    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);

    $page                  = $this->input->post("page");
    $this->load->view($page, $data);
  }

  public function tambahTapel()
  {
    $data = [
      'tapel'              => htmlspecialchars($this->input->post('tapel', true)),
      'kepalaSekolah'      => htmlspecialchars($this->input->post('kepalaSekolah', true)),
      'is_active_reg1'     => htmlspecialchars($this->input->post('is_active_reg1', true)),
    ];
    $checkData        = $this->db->get_where('ppdb_tapel', ['tapel' => $data['tapel']]);
    if ($checkData->num_rows() == "0") {
      $this->db->insert('ppdb_tapel', $data);
      $this->session->set_flashdata('toastr', "
      <script>
      $(window).on('load', function() {
        setTimeout(function() {
          toastr['success'](
            'Tahun Pelajaran " .  $data['tapel'] . " Di Tambahkan !',
            'Berhasil !', {
              closeButton: true,
              tapToDismiss: true
            }
          );
        }, 0);
      })
      </script>");
    } elseif ($checkData->num_rows() == "1") {
      $this->session->set_flashdata('toastr', "
      <script>
      $(window).on('load', function() {
        setTimeout(function() {
          toastr['error'](
            'Tahun Pelajaran " .  $data['tapel'] . " Sudah Tersedia !',
            'Gagal !', {
              closeButton: true,
              tapToDismiss: true
            }
          );
        }, 0);
      })
      </script>");
    }
    redirect(base_url('LayananPPDB/settings'));
  }

  public function deleteTapel()
  {
    $data = [
      'id'         => htmlspecialchars($this->input->post('id', true)),
      'tapel'      => htmlspecialchars($this->input->post('tapel', true)),
    ];
    $checkData     = $this->db->get_where('ppdb_tapel', ['id' => $data['id']]);
    if ($checkData->num_rows() == "1") {
      $this->db->delete('ppdb_tapel', ['id' => $data['id']]);
      $response['status']   = 'success';
      $response['judul']    = 'Berhasil !';
      $response['pesan']    = 'Tahun Pelajaran ' . $data['tapel'] . ' Telah Dihapus!';
    } elseif ($checkData->num_rows() == "0") {
      $response['status']   = 'error';
      $response['judul']    = 'Gagal !';
      $response['pesan']    = 'Tahun Pelajaran ' . $data['tapel'] . ' Tidak Ditemukan!';
    }
    echo json_encode($response);
  }

  // PAGE SETUP
  public function setUp()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();
    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);

    $url_param             = $this->uri->segment('3');
    $base_64               = $url_param . str_repeat('=', strlen($url_param) % 4);
    $tapel                 = base64_decode($base_64);
    $data['url_param']     = $tapel;
    is_ppdb_exist($tapel);

    $data['pageCollumn']   = "1-column";
    $data['page']          = "PPDB " . $tapel;
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('gtk/ppdb/setup', $data);
    $this->load->view('templates/modal', $data);
    $this->load->view('templates/footer', $data);
    $this->load->view('gtk/ppdb/ajax', $data);
  }

  function setupLoad()
  {
    $data['sessionUser']   = $this->session->userdata('username');
    $data['sessionRole1']  = $this->session->userdata('role_id_1');
    $data['sessionRole2']  = $this->session->userdata('role_id_2');
    $data['is_change']     = $this->session->userdata('is_change');
    $data['serverSetting'] = $this->modelApp->getServerSetting();
    $data['profilSekolah'] = $this->modelApp->getProfilSekolah();
    $data['tapelAktif']    = $this->modelApp->getTapelAktif();

    if ($data['sessionRole1'] != "1" || $data['sessionRole1'] != "1") {
      is_ppdb_active();
    }
    $data['userGTK']       = $this->modelApp->getUserGTK($data['sessionUser']);
    $data['profilGTK']     = $this->modelApp->getProfilGTK($data['sessionUser']);

    $page                  = $this->input->post("page");
    $url_param             = $this->input->post("tapel");
    $data['persuratan']    = $this->ModelPPDB->getPersuratan($url_param)->row_array();
    $kepalaSekolah         = $data['persuratan']['kepalaSekolah'];
    $data['kepalaSekolah'] = $this->ModelPPDB->getKepalaSekolah($kepalaSekolah)->row_array();

    $this->load->view($page, $data);
  }

  function editPersuratan()
  {
    $dataProfile = [
      'nip'                   => htmlspecialchars($this->input->post('nip', true)),
    ];

    $ppdbPersuratan = [
      'id'                    => htmlspecialchars($this->input->post('id', true)),
      'kepalaSekolah'         => htmlspecialchars($this->input->post('kepalaSekolah', true)),
      'SKPanitia'             => htmlspecialchars($this->input->post('SKPanitia', true)),
      'tanggalSKPanitia'      => htmlspecialchars($this->input->post('tanggalSKPanitia', true)),
      'SKPenerimaan'          => htmlspecialchars($this->input->post('SKPenerimaan', true)),
      'tanggalSKPenerimaan'   => htmlspecialchars($this->input->post('tanggalSKPenerimaan', true)),
      'tanggalMasuk'          => htmlspecialchars($this->input->post('tanggalMasuk', true)),
      'ttd'                   => htmlspecialchars($this->input->post('ttd', true)),
    ];

    $tapel = htmlspecialchars($this->input->post('tapel', true));

    $this->db->set($dataProfile);
    $this->db->where('username', $ppdbPersuratan['kepalaSekolah']);
    $this->db->update('profil_gtk');

    $this->db->set($ppdbPersuratan);
    $this->db->where('id', $ppdbPersuratan['id']);
    $this->db->update('ppdb_tapel');
    $this->session->set_flashdata('toastr', "
    <script>
    $(window).on('load', function() {
      setTimeout(function() {
        toastr['success'](
          'Persuratan PPDB Tahun Pelajaran" . $tapel . " telah diperbarui !',
          'Berhasil !', {
            closeButton: true,
            tapToDismiss: true
          }
        );
      }, 0);
    })
    </script>");
    redirect(base_url('layananppdb/setup/'));
  }
}
