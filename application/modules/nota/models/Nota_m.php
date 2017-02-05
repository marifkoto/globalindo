<?php
class Nota_m extends CI_Model{
 function __construct(){
 	parent::__construct();
 }
 
 // Berfungsi untuk mengambil data pada tabel user yang ada di database kita
public function add_nota($data) {
  $this->db->insert('nota', $data);
}

public function show_all() {
  $q = $this->db->order_by('id_nota','DESC')->join('sales','sales.id_sales=nota.id_sales')->join('toko','toko.id_toko=nota.id_toko'); 
    $q = $this->db->get('nota');
    return $q;
}

public function show_sales() {
  $q = $this->db->order_by('id_sales','DESC'); 
    $q = $this->db->get('sales');
    return $q;
}

public function show_toko() {
  $q = $this->db->order_by('id_toko','DESC'); 
    $q = $this->db->get('toko');
    return $q;
}

function show_sales2(){
 $this->db->select('id_sales, nama');
 
 $query = $this->db->get('sales');
 
 $sales2 = array();
 
 if($query->result()){
 foreach ($query->result() as $sales) {
 $sales2[$sales->id_sales] = $sales->nama;
 }
 return $sales2;
 }else{
 return FALSE;
 }
}

public function get_by_id($id) {
    $q = $this->db->where('id_nota',$id);
    $q = $this->db->get('nota');
    return $q;
}

public function get_by_id2($id)
    {
        $this->db->from('user');
        $this->db->where('id_user',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

public function edit_nota($id, $data){
    $this->db->where('id_nota', $id);
    $this->db->update('nota',$data); 
}

public function delete_nota($id){
    $this->db->where('id_nota', $id);
    $this->db->delete('nota');
}

public function change_password($where, $data)
    {
        $this->db->update('user', $data, $where);
        return $this->db->affected_rows();
    }

}