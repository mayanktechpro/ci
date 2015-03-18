<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Dashboard extends CI_Controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    if(!$this->session->userdata('id')) {
      $this->session->sess_destroy();
      $this->load->view('login');
    } else {
      $this->load->view('templates/header');
      $this->load->view('templates/nav');
      $this->load->view('home');
      $this->load->view('templates/footer');
    }
  }
}
?>