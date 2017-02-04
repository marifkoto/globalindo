<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends MX_Controller {

	function __construct() {
            parent::__construct();
			$this->load->model('users_m');
			//$this->load->helper('my_url');
         }

	public function index(){

		if($this->session->userdata('logged_admin')) {
		
		    $session_data = $this->session->userdata('logged_admin');
		    $username = $session_data['username'];
		    /*
		   	$this->load->module('layout');
     		$this->layout->index($username);
     		*/
		    $get = $this->users_m->show_all()->result();
		   	$data =array (
				'get' => $get
			);	
			$this->load->view('users_v',$data);
		}
		else {
			redirect('login');
		}
	}

	public function tambah_user() {
		if($this->session->userdata('logged_admin')) {
		    $session_data = $this->session->userdata('logged_admin');
		    $username = $session_data['username'];
		    $get = $this->users_m->show_sales()->result();
		    $data =array (
				'get' => $get
			);
		    /*
		    $this->load->module('layout');
     		$this->layout->index($username);
		   	*/
				$this->load->view('tambah_user_v', $data);
		}
		else {
			redirect('login');
		}
	}

	public function proses_tambah_user() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
		    $username = $this->input->post('username');
		    $password = md5($this->input->post('password'));
		    $level = $this->input->post('level');
		    $sales = $this->input->post('id_sales');
		    if($level == 'admin'){
		    	$id_sales = 0;
		    }
		   	if($level == 'sales'){
		   		$id_sales = $sales;
		   	}
		    $ip_address = $this->input->ip_address();

		    $data = array (
		    	'username' => $username,
		    	'password' => $password,
		    	'level' => $level,
		    	'sales' => $id_sales,
		    	'ip_address' => $ip_address
		    );
		    $kirim = $this->users_m->add_user($data);
		    redirect('users');
		}
		else {
			redirect('login');
		}
	}

	public function edit($id) {
		if($this->session->userdata('logged_admin')) {
		     $session_data = $this->session->userdata('logged_admin');
		     $username = $session_data['username'];
		    $get = $this->users_m->get_by_id($id)->result();
		    $get2 = $this->users_m->show_sales()->result();
		     /*
		    $this->load->module('layout');
     		$this->layout->index($username);
     		*/
			$data =array (
				'get' => $get,
				'get2' => $get2
			);
			$this->load->view('update_user_v',$data);
		}
		else {
			redirect('login');
		}
	}

	function get_sales(){
	 //$this->load->model('city_model');
	 header('Content-Type: application/x-json; charset=utf-8');
	 echo(json_encode($this->users_m->show_sales2()));
	}

	public function proses_update_user() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
				$id_user = $this->input->post('id_user');
		    $username = $this->input->post('username');
		    $level = $this->input->post('level');
		    $sales1 = $this->input->post('sales');
		    if($sales1=='#' and $level=='sales'){
		    	redirect_back();
		    }
		    if($level == 'admin'){
		    	$sales2 = 0;
		    }
		   	if($level == 'sales'){
		   		$sales2 = $sales1;
		   	}
		    $ip_address = $this->input->ip_address();

		    $data = array (
		    	'username' => $username,
		    	'level' => $level,
		    	'sales' => $sales2,
		    	'ip_address' => $ip_address
		    );	
		    $kirim = $this->users_m->edit_user($id_user, $data);
		    redirect('users');
		}
		else {
			redirect('login');
		}
	}

	public function hapus($id) {
		if($this->session->userdata('logged_admin')) {
			$hasil = $this->users_m->delete_user($id);
			redirect('users');
		}
		else {
			redirect('login');
		}
	}

	public function ajax_ubah_password($id)
    {
        $data = $this->users_m->get_by_id2($id);
        echo json_encode($data);
    }

	public function ubah_password() {
		     $data = array(
                'password' => md5($this->input->post('password'))
            );
        $this->users_m->change_password(array('id_user' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
	}

	public function proses_ubah_password() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
			$id_admin = $this->input->post('id_admin');
		    $password = md5($this->input->post('password'));
		    $ipakses = $this->input->ip_address();

		    $data = array (
		    	'password_admin' => $password,
		    	'ip_address' => $ipakses
		    );	
		    $kirim = $this->admin_m->change_password($id_admin, $data);
		    redirect('admin/edit/'.$id_admin);
		}
		else {
			redirect('not_found');
		}
	}

	public function logout() {
		$session_data = $this->session->userdata('logged_admin');
		$this->session->sess_destroy();
		redirect('home');
	}
	
}