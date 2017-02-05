<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Nota extends MX_Controller {

	function __construct() {
            parent::__construct();
			$this->load->model('nota_m');
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
		    $get = $this->nota_m->show_all()->result();
		   	$data =array (
				'get' => $get
			);	
			$this->load->view('nota_v',$data);
		}
		else {
			redirect('login');
		}
	}

	public function tambah_nota() {
		if($this->session->userdata('logged_admin')) {
		    $session_data = $this->session->userdata('logged_admin');
		    $username = $session_data['username'];
		    $get = $this->nota_m->show_sales()->result();
		    $get2 = $this->nota_m->show_toko()->result();
		    $data =array (
				'get' => $get,
				'get2' => $get2
			);
		    /*
		    $this->load->module('layout');
     		$this->layout->index($username);
		   	*/
				$this->load->view('tambah_nota_v', $data);
		}
		else {
			redirect('login');
		}
	}

	public function proses_tambah_nota() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
		    $id_user = $session_data['id_user'];
		    $no_nota = $this->input->post('no_nota');
		    $tgl_buat = $this->input->post('tgl_buat');
		    $id_sales = $this->input->post('sales');
		    $id_toko = $this->input->post('toko');
		    $total_jual = $this->input->post('total_jual');
		    $ip_address = $this->input->ip_address();

		    $data = array (
		    	'no_nota' => $no_nota,
		    	'tgl_buat' => $tgl_buat,
		    	'id_sales' => $id_sales,
		    	'id_toko' => $id_toko,
		    	'total_jual' => $total_jual,
		    	'ip_address' => $ip_address,
		    	'id_user' => $id_user
		    );
		    $kirim = $this->nota_m->add_nota($data);
		    redirect('nota');
		}
		else {
			redirect('login');
		}
	}

	public function edit($id) {
		if($this->session->userdata('logged_admin')) {
		     $session_data = $this->session->userdata('logged_admin');
		     $username = $session_data['username'];
		    $get = $this->nota_m->get_by_id($id)->result();
		    $get2 = $this->nota_m->show_sales()->result();
		    $get3 = $this->nota_m->show_toko()->result();
		     /*
		    $this->load->module('layout');
     		$this->layout->index($username);
     		*/
			$data =array (
				'get' => $get,
				'get2' => $get2,
				'get3' => $get3
			);
			$this->load->view('update_nota_v',$data);
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

	public function proses_update_nota() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
		    $id_user = $session_data['id_user'];
		    $id_nota = $this->input->post('id_nota');
		    $no_nota = $this->input->post('no_nota');
		    $tgl_buat = $this->input->post('tgl_buat');
		    $id_sales = $this->input->post('sales');
		    $id_toko = $this->input->post('toko');
		    $total_jual = $this->input->post('total_jual');
		    $ip_address = $this->input->ip_address();

		    $data = array (
		    	'no_nota' => $no_nota,
		    	'tgl_buat' => $tgl_buat,
		    	'id_sales' => $id_sales,
		    	'id_toko' => $id_toko,
		    	'total_jual' => $total_jual,
		    	'ip_address' => $ip_address,
		    	'id_user' => $id_user
		    );
		    $kirim = $this->nota_m->edit_nota($id_nota,$data);
		    redirect('nota');
		}
		else {
			redirect('login');
		}
	}

	public function hapus($id) {
		if($this->session->userdata('logged_admin')) {
			$hasil = $this->nota_m->delete_nota($id);
			redirect('nota');
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