<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard extends MX_Controller {

	function __construct() {
            parent::__construct();
            //$this->load->model('m_login');
            $this->load->helper('my_url');
         }

	public function index(){
    if($this->session->userdata('logged_admin')) {
    
        $session_data = $this->session->userdata('logged_admin');
        $username = $session_data['username'];
    /*
		if($this->session->userdata('logged_admin')) {
			echo "<script>alert('Anda sudah login. Jika ingin login kembali, silahkan logout terlebih dahulu');window.location.href='dashboard2';</script>";
		} else {
      $data = array(
        'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
        'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha 
      );
      */
			$this->load->view('dashboard_v');
    }
    else {
      redirect('login');
    }
		//}
	}

  public function logout() {
    $session_data = $this->session->userdata('logged_anggota');
    $this->session->sess_destroy();
    redirect('login');
  }

/*
	public function proses_login()
 {
 	//$this->load->library('form_validation');
   $this->form_validation->set_rules('email', 'Email', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|callback_check_database');
    $recaptcha = $this->input->post('g-recaptcha-response');
    $response = $this->recaptcha->verifyResponse($recaptcha);
   if($this->form_validation->run($this) == FALSE || !isset($response['success']) || $response['success'] <> true)
   {
     //Field validation failed.  User redirected to login page
     $this->load->module('login');
     $this->login->index();
   }
   else
   {
     //Go to private area

    if($this->session->userdata('logged_anggota')) {
      $session_data = $this->session->userdata('logged_anggota');
        //$this->load->view('admin_v');
        //$this->load->module('admin');
        //$this->login->index();
      redirect('dashboard2');
    }

    //$session_data = $this->session->userdata('logged_admin');
    //redirect('admin');
   }
 
 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $email = $this->input->post('email');
 
   //query the database
   $result = $this->m_login->getAnggota($email, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
        'id_anggota' => $row->id_anggota,
        'nama_anggota' => $row->nama_anggota,
        'email_ugm_anggota' => $row->email_ugm_anggota
       );
       $this->session->set_userdata('logged_anggota', $sess_array); 
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
*/

}