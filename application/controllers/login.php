<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  
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
      //$this->load->helper(array('form'));
      $this->load->view('login');
    } else {
      redirect('dashboard', 'refresh');
    }    
  }

  /*
  * @purpose: Check Login
  * @author: Mayank
  */
  public function checkLogin() {
    $this->load->model('users');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|requried|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|requried|xss_clean');

    if ($this->form_validation->run() == false) {
      echo json_encode(array('login_success' => false, 'message' => 'Validation Failed. Try Again'));
      exit;
    }

    $result = $this->users->authenticateUser();

    if (!$result) {
      echo json_encode(array('login_success' => false, 'message' => $this->session->userdata('error_msg')));
      exit;
    } else {
      echo json_encode(array('login_success'=>true));
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}