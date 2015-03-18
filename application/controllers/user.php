<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
  
  public function __conctruct() {
    parent::__construct();
  }

  /*
   * @method: index
   * @purpose: Will call by default on controller invoke
   * @author: Mayank
   */
  public function index() {
    if (!$this->session->userdata('id')) {
      $this->session->sess_destroy();
      $this->load->view('login');
    } else {
      $this->load->model('users');
      $data['users'] = $this->users->getList();
      $this->load->view('user/list', $data);
    }    
  }
}