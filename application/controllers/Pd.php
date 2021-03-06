<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pd extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('App_model');
    is_logged_in_as_pd();
  }


  public function index()
  {
    redirect(base_url('pd/dashboard'));
  }

  public function dashboard()
  {
    $data['sesiRole']      = $this->session->userdata('role_id');
    $data['serverSetting'] = $this->App_model->getServerSetting();
    $data['profilSekolah'] = $this->App_model->getProfilSekolah();
    var_dump($_SESSION);
    $this->load->view('templates/header', $data);
    $this->load->view('pd/dashboard');
    $this->load->view('templates/footer');
  }
}
