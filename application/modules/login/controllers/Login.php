<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends MX_Controller {

	function __construct() {
            parent::__construct();
            $this->load->library('form_validation','Recaptcha');
            $this->load->helper('my_url');
            $this->load->model('m_login');
            $this->form_validation->CI =& $this;
         }

	public function index(){
		if($this->session->userdata('logged_admin')) {
			echo "<script>alert('Anda sudah login. Jika ingin login kembali, silahkan logout terlebih dahulu');window.location.href='dashboard';</script>";
		} else {
      $data = array(
        'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
        'script_captcha' => $this->recaptcha->getScriptTag() // javascript recaptcha 
      );
			$this->load->view('login',$data);
		}
	}

	public function proses_login()
 {
 	//$this->load->library('form_validation');
   // $this->form_validation->set_rules('recaptcha_challenge_field', 'Captcha Code', 'trim|required');  
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
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

    if($this->session->userdata('logged_admin')) {
      $session_data = $this->session->userdata('logged_admin');
      redirect('dashboard');
    }

    //$session_data = $this->session->userdata('logged_admin');
    //redirect('admin');
   }
 
 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
 $recaptcha = $this->input->post('g-recaptcha-response');
    $response = $this->recaptcha->verifyResponse($recaptcha);
   //query the database
   $result = $this->m_login->getAnggota($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
        'id_user' => $row->id_user,
        'username' => $row->username
       );
       if($recaptcha != null) {
        $this->session->set_userdata('logged_admin', $sess_array);
        }
        else {
          $this->form_validation->set_message('check_database', 'Captcha required');
          return false;
        }
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }


}