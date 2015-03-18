<?php
Class Users extends CI_Model {
  public function authenticateUser() {
    // grab user input
    $username = $this->security->xss_clean($this->input->post('username'));
    $password = $this->security->xss_clean($this->input->post('password'));

    // prepare qeury
    $this->db->where('username', $username);
    $this->db->where('password', md5($password));

    // execute qeury
    $query = $this->db->get('users');

    if($query->num_rows() == 1) {
      $row = $query->row();
      /*if($row->is_active == 0) {
        $this->session->set_userdata('error_msg', 'Hi. '.$row->username.', your account is currently inactive. Please contact Admin.');
        return false;
      }*/

      $data = array(
        'id' => $row->id,
        'name' => $row->name,
        'email' => $row->email
      );
      $this->session->set_userdata($data);

      return true;
    }
    $this->session->set_userdata('error_msg', 'Wrong username and password.');
    
    return false;
  }

  public function getList() {
    return $this->db->get('users')->result();
  }
}
?>