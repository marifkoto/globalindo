<?php
class M_login extends CI_Model{
 function __construct(){
 	parent::__construct();
 }
 
 // Berfungsi untuk mengambil data pada tabel user yang ada di database kita
public function getAnggota($username,$password) {
		$this->db->select('id_user,username,password,level');
		$this->db->from('user');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
    $this->db->limit(1);
    $query = $this->db->get();
 
   if($query->num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
		
    }
	
	public function check_logged(){
		return ($this->session->userdata('logged_admin'))?TRUE:FALSE;
	}



}