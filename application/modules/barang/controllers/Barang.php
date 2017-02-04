<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Barang extends MX_Controller {

	function __construct() {
            parent::__construct();
			$this->load->model('barang_m');
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
		    $get = $this->barang_m->show_all()->result();
		   	$data =array (
				'get' => $get
			);	
			$this->load->view('barang_v',$data);
		}
		else {
			redirect('login');
		}
	}

	public function tambah_barang() {
		if($this->session->userdata('logged_admin')) {
		    $session_data = $this->session->userdata('logged_admin');
		    $username = $session_data['username'];
		    $id_user = $session_data['id_user'];
		    $get = $this->barang_m->show_supplier()->result();
		    $data =array (
				'get' => $get,
				'id_user' => $id_user
			);
			
		    /*
		    $this->load->module('layout');
     		$this->layout->index($username);
		   	*/
				$this->load->view('tambah_barang_v', $data);
		}
		else {
			redirect('login');
		}
	}

	public function proses_tambah_barang() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
		    $id_user = $this->input->post('id_user');
		    $ip_address = $this->input->ip_address();
			$nama = $this->input->post('nama');
			$harga = $this->input->post('harga');
			$jumlah = $this->input->post('qty');
			$tgl_diterima = $this->input->post('tgl_diterima');
			$supplier = $this->input->post('id_supplier');

			$nmfile = "file_".$nama."_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
	        $config['upload_path'] = './assets/image/gambar_barang/original'; //path folder
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '3072'; //maksimum besar file 3M
	        $config['max_width']  = '5000'; //lebar maksimum 5000 px
	        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
	        $config['file_name'] = $nmfile; //nama yang terupload nantinya

	        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                	'nama' => $nama,
                	'harga' => $harga,
                	'qty' => $jumlah,
                  	'gambar' =>$gbr['file_name'],
                  	'tgl_diterima' => $tgl_diterima,
                  	'id_supplier' => $supplier,
		    		'ip_address' => $ip_address,
		    		'id_user' => $id_user
                );

                $this->barang_m->add_barang($data); //akses model untuk menyimpan ke database

                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/image/gambar_barang/resized'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = FALSE;
                $config2['width'] = 452; //lebar setelah resize menjadi 100 px
                $config2['height'] = 302; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('barang'); //jika berhasil maka akan ditampilkan view upload
            }else{
            	echo $this->upload->display_errors(); die();
                redirect_back(); //jika gagal maka akan ditampilkan form upload
            }
        }

		}
		else {
			redirect('login');
		}
	}

	public function edit($id) {
		if($this->session->userdata('logged_admin')) {
		     $session_data = $this->session->userdata('logged_admin');
		     $id_user = $session_data['id_user'];
		    $get = $this->barang_m->get_by_id($id)->result();
		    $get2 = $this->barang_m->show_supplier()->result();
		     /*
		    $this->load->module('layout');
     		$this->layout->index($username);
     		*/
			$data =array (
				'get' => $get,
				'get2' => $get2
			);
			$this->load->view('update_barang_v',$data);
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

	public function proses_update_barang() {
		if($this->session->userdata('logged_admin')) {
			$session_data = $this->session->userdata('logged_admin');
			$id_user = $session_data['id_user'];
			$id_barang = $this->input->post('id_barang');
		    $nama = $this->input->post('nama');
		    $harga = $this->input->post('harga');
		    $qty = $this->input->post('qty');
		    $tgl_diterima = $this->input->post('tgl_diterima');
		    $supplier = $this->input->post('id_supplier');
		    $ip_address = $this->input->ip_address();

		    $data = array (
		    	'nama' => $nama,
                'harga' => $harga,
                'qty' => $qty,
                'tgl_diterima' => $tgl_diterima,
                'id_supplier' => $supplier,
		    	'ip_address' => $ip_address,
		    	'id_user' => $id_user
		    );	
		    $kirim = $this->barang_m->edit_barang($id_barang, $data);
		    redirect('barang');
		}
		else {
			redirect('login');
		}
	}

	public function ubah_gambar() {
        	$session_data = $this->session->userdata('logged_admin');
		     $id_user = $session_data['id_user'];
		     $nama = $this->input->post('nama');
		     $gambar_lama= $this->input->post('gambar');
		    $ip_address = $this->input->ip_address();

			$nmfile = "file_".$nama."_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
	        $config['upload_path'] = './assets/image/gambar_barang/original/'; //path folder
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '3072'; //maksimum besar file 3M
	        $config['max_width']  = '5000'; //lebar maksimum 5000 px
	        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
	        $config['file_name'] = $nmfile; //nama yang terupload nantinya

	        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  	'gambar' =>$gbr['file_name'],
		    		'ip_address' => $ip_address,
		    		'id_user' => $id_user
                );

                $this->barang_m->change_gambar(array('id_barang' => $this->input->post('id')), $data);
       			 echo json_encode(array("status" => TRUE));

                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/image/gambar_barang/resized/'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = FALSE;
                $config2['width'] = 452; //lebar setelah resize menjadi 100 px
                $config2['height'] = 302; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              	}

              	$path_uploads = './assets/image/gambar_barang/original/'.$gambar_lama;
				$path_hasil_resize = './assets/image/gambar_barang/resized/'.$gambar_lama;
				chown($path_uploads, 465);
				chown($path_hasil_resize, 465);
				unlink($path_uploads);
				unlink($path_hasil_resize);

                //redirect_back(); //jika berhasil maka akan ditampilkan view upload
            }
        }
	}

	public function hapus() {
		if($this->session->userdata('logged_admin')) {
			$id = $this->input->get('var1');
			$filename = $this->input->get('var2');
			$hasil = $this->barang_m->delete($id);
			$path_uploads = './assets/image/gambar_barang/original/'.$gambar_lama;
			$path_hasil_resize = './assets/image/gambar_barang/resized/'.$gambar_lama;
			chown($path_uploads, 465);
			chown($path_hasil_resize, 465);
			if(unlink($path_uploads) && unlink($path_hasil_resize)) {
			     redirect('barang');
			}
			else {
			     redirect_back();
			}
		}
		else {
			redirect('login');
		}
	}

	public function ajax_ubah_barang($id)
    {
        $data = $this->barang_m->get_by_id2($id);
        echo json_encode($data);
    }

	public function logout() {
		$session_data = $this->session->userdata('logged_admin');
		$this->session->sess_destroy();
		redirect('home');
	}
	
}